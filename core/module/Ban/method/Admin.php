<?php
final class Ban_Admin extends GWF_Method
{
	public function getUserGroups() { return GWF_Group::ADMIN; }
	
	public function execute()
	{
		if (false !== (Common::getPost('addban'))) {
			return $this->onAddBan().$this->templateAdmin();
		}
		return $this->templateAdmin();
	}
	
	private function templateAdmin()
	{
		$bans = GDO::table('GWF_Ban');
		
		$nItems = $bans->countRows();
		$ipp = $this->module->cfgItemsPerPage();
		$nPages = GWF_PageMenu::getPagecount($ipp, $nItems);
		$page = Common::clamp(intval(Common::getGet('page', 1)), 1, $nPages);
		
		$by = Common::getGet('by', 'ban_date');
		$dir = Common::getGet('dir', 'DESC');
		$orderby = $bans->getMultiOrderby($by, $dir);
		
		$form = $this->getFormBan();
		
		$tVars = array(
			'form_ban' => $form->templateY($this->module->lang('ft_add_ban')),
			'sort_url' => GWF_WEB_ROOT.'index.php?mo=Ban&me=Admin&by=%BY%&dir=%DIR%',
			'bans' => $bans->selectObjects('*', '', $orderby, $ipp, GWF_PageMenu::getFrom($page, $ipp)),
			'page_menu' => GWF_PageMenu::display($page, $nPages, GWF_WEB_ROOT.'index.php?mo=Ban&me=Admin&by='.urlencode($by).'&dir='.urlencode($dir).'&page=%PAGE%'),
		);
		return $this->module->templatePHP('admin.php', $tVars);
	}
	
	private function getFormBan()
	{
		$data = array(
			'username' => array(GWF_Form::STRING, '', $this->module->lang('th_user_name')),
			'msg' => array(GWF_Form::MESSAGE, '', $this->module->lang('th_ban_msg')),
			'ends' => array(GWF_Form::DATE_FUTURE, '20110101235959', $this->module->lang('th_ban_ends'), $this->module->lang('tt_ban_ends'), GWF_Date::LEN_SECOND, false),
			'perm' => array(GWF_Form::CHECKBOX, false, $this->module->lang('th_ban_perm'), $this->module->lang('tt_ban_perm')),
			'type' => array(GWF_Form::CHECKBOX, false, $this->module->lang('th_ban_type2'), $this->module->lang('tt_ban_type')),
			'addban' => array(GWF_Form::SUBMIT, $this->module->lang('btn_add_ban')),
		);
		return new GWF_Form($this, $data);
	}
	
	private function onAddBan()
	{
		$form = $this->getFormBan();
		if (false !== ($errors = $form->validate($this->module))) {
			return $errors;
		}
		
		$perm = $form->getVar('perm');
		$ban = $form->getVar('type');
		$ends = $form->getVar('ends');
		$msg = $form->getVar('msg');
		$userid = $this->user->getID();
		
		if ($ban) {
			if ($perm) {
				$ends = '';
			}
			elseif ($ends === '') {
				return $this->module->error('err_perm_or_date');
			}
			elseif ($ends < date('YmdHis')) {
				return $this->module->error('err_future_is_past');
			}
			
			
			GWF_Ban::insertBan($userid, $ends, $msg);
			if ($ends === '') {
				return $this->module->message('msg_permbanned', array($this->user->displayUsername()));
			} else {
				return $this->module->message('msg_tempbanned', array($this->user->displayUsername(), GWF_Time::displayDate($ends)));
			}
		} else {
			GWF_Ban::insertWarning($userid, $msg);
			return $this->module->message('msg_warned', array($this->user->displayUsername()));
		}
	}
	
	##################
	### Validators ###
	##################
	private $user = false;
	public function validate_username(Module_Ban $m, $arg)
	{
		if (false === ($this->user = GWF_User::getByName($arg))) {
			$_POST['username'] = '';
			return GWF_HTML::lang('ERR_UNKNOWN_USER');
		}
		return false;
	}
	
	public function validate_msg(Module_Ban $m, $arg)
	{
		return GWF_Validator::validateString($m, 'msg', $arg, 1, 1024, false);
	}
	
	public function validate_ends(Module_Ban $m, $arg)
	{
		return GWF_Validator::validateDate($m, 'ends', $arg, GWF_Date::LEN_SECOND, true, false);
	}
	
}

?>