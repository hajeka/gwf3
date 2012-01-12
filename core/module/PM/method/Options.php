<?php

final class PM_Options extends GWF_Method
{
	public function isLoginRequired() { return true; }
	public function getHTAccess(GWF_Module $module)
	{
		return 'RewriteRule ^pm/options/?$ index.php?mo=PM&me=Options'.PHP_EOL;
	}
		
	/**
	 * @var GWF_PMOptions
	 */
	private $options;
	
	public function execute(GWF_Module $module)
	{
		if (false !== ($error = $this->sanitize($this->_module))) {
			return $error;
		}
		
		if ('all' === Common::getGet('auto_folder')) {
			return $this->onAutoFolder($this->_module).$this->templateOptions($this->_module);
		}
		
		if (false !== (Common::getPost('ignore'))) {
			return $this->onIgnore($this->_module).$this->templateOptions($this->_module);
		}
		if (false !== ($username = Common::getGet('unignore'))) {
			return $this->onUnIgnore($this->_module, $username).$this->templateOptions($this->_module);
		}
		
		if (false !== Common::getPost('change')) {
			return $this->onChange($this->_module).$this->templateOptions($this->_module);
		}
		
		return $this->templateOptions($this->_module);
	}
	
	public function sanitize()
	{
		if (false === ($this->options = GWF_PMOptions::getPMOptionsS())) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		return false;
	}
	
	public function getForm()
	{
		$data = GWF_FormGDO::dataFromGDOExclusive($this->_module, $this->options, array('pmo_uid', 'pmo_options'));
		$data['email'] = array(GWF_Form::CHECKBOX, $this->options->isOptionEnabled(GWF_PMOptions::EMAIL_ON_PM), $this->_module->lang('th_pmo_options&'.GWF_PMOptions::EMAIL_ON_PM));
		$data['guestpm'] = array(GWF_Form::CHECKBOX, $this->options->isOptionEnabled(GWF_PMOptions::ALLOW_GUEST_PM), $this->_module->lang('th_pmo_options&'.GWF_PMOptions::ALLOW_GUEST_PM));
		$data['change'] = array(GWF_Form::SUBMIT, $this->_module->lang('btn_save'));
		return new GWF_Form($this, $data);
	}
	
	public function getFormIgnore()
	{
		$data = array(
			'username' => array(GWF_Form::STRING, '', $this->_module->lang('th_user_name')),
			'reason' => array(GWF_Form::STRING, '', $this->_module->lang('th_reason')),
			'ignore' => array(GWF_Form::SUBMIT, $this->_module->lang('btn_ignore2')),
		);
		return new GWF_Form($this, $data);
	}
	
	public function templateOptions()
	{
		$uid = GWF_Session::getUserID();
		$form = $this->getForm($this->_module);
		$form2 = $this->getFormIgnore($this->_module);
		$action = GWF_WEB_ROOT.'pm/options';
		$tVars = array(
			'form' => $form->templateY($this->_module->lang('ft_options'), $action),
			'form_ignore' => $form2->templateX($this->_module->lang('ft_ignore'), $action),
			'ignores' => GDO::table('GWF_PMIgnore')->selectAll('user_name, pmi_reason', "pmi_uid=$uid", 'user_name ASC', array('pmi_iuser'), -1, -1, GDO::ARRAY_N),
			'href_auto_folder' => $this->getMethodHref('&auto_folder=all'),
		);
		return $this->_module->templatePHP('options.php', $tVars);
	}
	
	private function onChange()
	{
		$form = $this->getForm($this->_module);
		if (false !== ($errors = $form->validate($this->_module))) {
			return $errors;
		}
		
		if (false === $this->options->saveVars(array(
			'pmo_signature' => $form->getVar('pmo_signature'),
			'pmo_auto_folder' => $form->getVar('pmo_auto_folder'),
		))) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		if (false === $this->options->saveOption(GWF_PMOptions::ALLOW_GUEST_PM, isset($_POST['guestpm']))) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		$email = isset($_POST['email']);
		if ($email && !GWF_Session::getUser()->hasValidMail()) {
			$email = false;
			unset($_POST['email']);
			return $this->_module->error('err_no_mail');
		}
		
		if (false === $this->options->saveOption(GWF_PMOptions::EMAIL_ON_PM, $email)) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		return $this->_module->message('msg_changed');
	}

	public function validate_pmo_auto_folder(Module_PM $module, $arg) { return $this->_module->validate_pmo_auto_folder($arg); }
	public function validate_pmo_signature(Module_PM $module, $arg) { return $this->_module->validate_pmo_signature($arg); }
	
	private function onIgnore()
	{
		if (false === ($method = $this->_module->getMethod('Ignore'))) {
			return GWF_HTML::err('ERR_METHOD_MISSING', array( 'Ignore', 'PM'));
		}
		
		if (false === ($user = GWF_User::getByName(Common::getPostString('username')))) {
			return GWF_HTML::err('ERR_UNKNOWN_USER');
		}
		
		$method instanceof PM_Ignore;
		return $method->onIgnore($this->_module, 'do', $user->getID(), Common::getPostString('reason'));
	}

	private function onUnIgnore(Module_PM $module, $username)
	{
		if (false === ($method = $this->_module->getMethod('Ignore'))) {
			return GWF_HTML::err('ERR_METHOD_MISSING', array( 'Ignore', 'PM'));
		}
		
		if (false === ($user = GWF_User::getByName($username))) {
			return GWF_HTML::err('ERR_UNKNOWN_USER');
		}
		
		#$method instanceof PM_Ignore;
		return $method->onIgnore($this->_module, 'do_not', $user->getID());
	}
	
	/**
	 * Put all your PMs into auto-folders.
	 * @param Module_PM $module
	 * @return string
	 */
	private function onAutoFolder()
	{
		$user = GWF_Session::getUser();
		$userid = GWF_Session::getUserID();
		
		if (false === ($pmo = GWF_PMOptions::getPMOptions($user))) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		if (0 >= ($peak = $pmo->getAutoFolderValue())) {
			return $this->_module->message('msg_auto_folder_off');
		}
		
		$del = GWF_PM::OWNER_DELETED;
		# count pm from and to user.
		$conditions = "(pm_owner=$userid AND pm_options&$del=0)";
		$db = gdo_db();
		$pms = GDO::table('GWF_PM');
		$sorted = array();
		if (false === ($result = $pms->select('*', $conditions))) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		# Sort By UID
		while (false !== ($row = $db->fetchAssoc($result)))
		{
			$pm = new GWF_PM($row);
			$other_user = $pm->getOtherUser($user);
			$other_uid = $other_user->getID();
			
			if (!(isset($sorted[$other_uid]))) {
				$sorted[$other_uid] = array();
			}
			$sorted[$other_uid][] = $pm;
		}
		$db->free($result);
		
		$back = '';
		foreach ($sorted as $uid => $pms)
		{
			if (count($pms) < $peak) {
				continue;
			}
			
			$other_user = $pms[0]->getOtherUser($user);
			$foldername = $other_user->getVar('user_name');

			# Create the folder if not exists.
			if (false === ($folder = GWF_PMFolder::getByName($foldername, $user))) {
				$folder = GWF_PMFolder::fakeFolder($user->getID(), $foldername);
				if (false === ($folder->insert())) {
					return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
				}
				$back .= $this->_module->message('msg_auto_folder_created', array($other_user->displayUsername()));
			}
			
			$moved = 0;
			foreach ($pms as $pm)
			{
				if (false !== $pm->move($user, $folder))
				{
					$moved++;
				}
			}
			if ($moved > 0) {
				$back .= $this->_module->message('msg_auto_folder_moved', array($moved, $other_user->displayUsername()));
			}
		}
		
		return $back.$this->_module->message('msg_auto_folder_done');
	}
}


?>