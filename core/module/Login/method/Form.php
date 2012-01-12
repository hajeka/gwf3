<?php
/**
 * @author gizmore
 */
final class Login_Form extends GWF_Method
{
	protected $_tpl = 'login.tpl';
//	public function isCSRFProtected() { return false; }
	
	public function getHTAccess(GWF_Module $module)
	{
		return 'RewriteRule ^login/?$ index.php?mo=Login&me=Form'.PHP_EOL;
	}
	
	public function execute(GWF_Module $module)
	{
		GWF_Website::setPageTitle($this->_module->lang('pt_login'));
		
		if (false !== GWF_Session::getUser())
		{
			return $this->_module->error('ERR_ALREADY_LOGGED_IN');
		}

		if (false !== Common::getPost('login'))
		{
			return $this->onLogin($this->_module);
		}
		return $this->form($this->_module);
	}
	
	public function form()
	{
		$form = $this->getForm($this->_module);
		$tVars = array(
			'form' => $form->templateY($this->_module->lang('title_login')),
			'have_cookies' => GWF_Session::haveCookies(),
			'token' => $form->getFormCSRFToken(),
			'tooltip' => $form->getTooltipText('bind_ip'),
			'register' => GWF_Module::loadModuleDB('Register', false, false, true) !== false,
			'recovery' => GWF_Module::loadModuleDB('PasswordForgot', false, false, true) !== false,
		);
		return $this->_module->template($this->_tpl, $tVars);
	}

	/**
	 * @param Module_Login $module
	 * @return GWF_Form
	 */
	public function getForm()
	{
		$data = array(
			'username' => array(GWF_Form::STRING, '', $this->_module->lang('th_username')),
			'password' => array(GWF_Form::PASSWORD, '', $this->_module->lang('th_password')),
			'bind_ip' => array(GWF_Form::CHECKBOX, true, $this->_module->lang('th_bind_ip'), $this->_module->lang('tt_bind_ip')),
		);
		if ($this->_module->cfgCaptcha()) {
			$data['captcha'] = array(GWF_Form::CAPTCHA);
		}
		$data['login'] = array(GWF_Form::SUBMIT, $this->_module->lang('btn_login'));
		return new GWF_Form($this, $data);
	}
	
	public function onLogin()
	{
		require_once GWF_CORE_PATH.'module/Login/GWF_LoginFailure.php';
		$isAjax = isset($_GET['ajax']);
		$form = $this->getForm($this->_module);
		if (false !== ($errors = $form->validate($this->_module, $isAjax))) {
			if ($isAjax) {
				return $errors;
			} else {
				return $errors.$this->form($this->_module);
			}
		}
		
		$username = Common::getPostString('username');
		$password = Common::getPostString('password');
		$users = GDO::table('GWF_User');
		
		if (false === ($user = $users->selectFirstObject('*', sprintf('user_name=\'%s\' AND user_options&%d=0', $users->escape($username), GWF_User::DELETED))))
		{
			if ($isAjax) {
				return $this->_module->error('err_login');
			} else {
				return $this->_module->error('err_login').$this->form($this->_module);
			}
		}
		elseif (true !== ($error = $this->checkBruteforce($this->_module, $user, $isAjax))) {
			if ($isAjax) {
				return $error;
			} else {
				return $error.$this->form($this->_module);
			}
		}
		elseif (false === GWF_Hook::call(GWF_HOOK::LOGIN_PRE, $user, array($password, ''))) {
			return ''; #GWF_HTML::err('ERR_GENERAL', array( __FILE__, __LINE__));
		}
		elseif (false === (GWF_Password::checkPasswordS($password, $user->getVar('user_password')))) {
			if ($isAjax) {
				return $this->onLoginFailed($this->_module, $user, $isAjax);
			}
			else { 
				return $this->onLoginFailed($this->_module, $user, $isAjax).$this->form($this->_module);
			}
		}
		
		GWF_Password::clearMemory('password');
		
		return $this->onLoggedIn($this->_module, $user, $isAjax);
	}
	
	private function onLoginFailed(Module_Login $module, GWF_User $user, $isAjax)
	{
		GWF_LoginFailure::loginFailed($user);
		$time = $this->_module->cfgTryExceed();
		$maxtries = $this->_module->cfgMaxTries();
		list($tries, $mintime) = GWF_LoginFailure::getFailedData($user, $time);
		
		// Send alert mail?
		if ( ($tries === 1) && ($this->_module->cfgAlerts()) )
		{
			$this->onSendAlertMail($this->_module, $user);
		}
		
		return $this->_module->error('err_login2', array($maxtries-$tries, GWF_Time::humanDuration($time)));
	}
	
	private function checkBruteforce(Module_Login $module, GWF_User $user, $isAjax)
	{
		$time = $this->_module->cfgTryExceed();
		$maxtries = $this->_module->cfgMaxTries();
		$data = GWF_LoginFailure::getFailedData($user, $time);
		
		$tries = $data[0];
		$mintime = $data[1];
		
		if ($tries >= $maxtries) {
			return $this->_module->error('err_blocked', array(GWF_Time::humanDuration($mintime - time() + $time)));
		}
		return true;
	}
	
	private function onLoggedIn(Module_Login $module, GWF_User $user, $isAjax)
	{
		$last_url = GWF_Session::getLastURL();
		
		if (false === GWF_Session::onLogin($user, isset($_POST['bind_ip']))) {
			return GWF_HTML::err('ERR_GENERAL', array(__FILE__, __LINE__));
		}
		
		require_once GWF_CORE_PATH.'module/Login/GWF_LoginHistory.php';
		GWF_LoginHistory::insertEvent($user->getID());
		
		# save last login time
		$user->saveVar('user_lastlogin', time());
		
		if ($this->_module->cfgCleanupAlways()) {
			GWF_LoginFailure::cleanupUser($user->getID());
		}
		
		if ($isAjax)
		{
			return sprintf('1:%s', GWF_Session::getSessID());
		}
		else
		{
			GWF_Session::set('GWF_LOGIN_BACK', $last_url);
			
			if (false !== ($lang = $user->getLanguage())) {
				GWF_Language::setCurrentLanguage($lang);
			}
			
			if (0 < ($fails = GWF_LoginFailure::getFailCount($user, $this->_module->cfgTryExceed()))) {
				GWF_Session::set('GWF_LOGIN_FAILS', $fails);
			}
			
			GWF_Website::redirect(GWF_WEB_ROOT.'welcome');
		}
	}
	
	private function onSendAlertMail(Module_Login $module, GWF_User $user)
	{
		if ('' === ($to = $user->getValidMail()))
		{
			return;
		}
		
		$mail = new GWF_Mail();
		$mail->setSender(GWF_BOT_EMAIL);
		$mail->setReceiver($to);
		$mail->setSubject($this->_module->langUser($user, 'alert_subj'));
		$mail->setBody($this->_module->langUser($user, 'alert_body', array($user->displayUsername(), $_SERVER['REMOTE_ADDR'])));
		
		return $mail->sendToUser($user);
	}
	
	#################
	### Validator ###
	#################
	public function validate_username(Module_Login $module, $arg) { return false; }
	public function validate_password(Module_Login $module, $arg) { return false; } 
}

?>
