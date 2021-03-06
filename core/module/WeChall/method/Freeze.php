<?php
/**
 * Freeze a user on a site.
 * @author gizmore
 */
final class WeChall_Freeze extends GWF_Method
{
	public function getUserGroups() { return GWF_Group::STAFF; }
	
	public function execute()
	{
		require_once GWF_CORE_PATH.'module/WeChall/WC_RegAt.php';
		require_once GWF_CORE_PATH.'module/WeChall/WC_SiteDescr.php';
		require_once GWF_CORE_PATH.'module/WeChall/WC_Freeze.php';
		require_once GWF_CORE_PATH.'module/WeChall/WC_HistoryUser2.php';
		if (false !== Common::getPost('freeze')) {
			return $this->onFreeze().$this->templateFreeze();
		}
		
		if (false !== ($data = Common::getPost('unfreeze'))) {
			return $this->onUnFreeze($data).$this->templateFreeze();
		}
		
		return $this->templateFreeze();
	}
	
	private function formFreeze()
	{
		$data = array(
			'username' => array(GWF_Form::STRING, '', $this->module->lang('th_user_name')),
			'siteid' => array(GWF_Form::SELECT, $this->getSiteSelect(), $this->module->lang('th_site_name')),
			'freeze' => array(GWF_Form::SUBMIT, $this->module->lang('btn_freeze')),
		);
		return new GWF_Form($this, $data);
	}
	
	private $user = false;
	public function validate_username(Module_WeChall $m, $arg)
	{
		if (false === ($this->user = GWF_User::getByName($arg))) {
			return GWF_HTML::lang('ERR_UNKNOWN_USER');
		}
		return false;
	}
	
	private $site = false;
	public function validate_siteid(Module_WeChall $m, $arg)
	{
		if (false === ($this->site = WC_Site::getByID($arg))) {
			return $m->lang('err_site');
		}
		return false;
	}
	
	private function getSiteSelect()
	{
		$selected = intval(Common::getPost('siteid', 0));
		$data = array();
		$data[] = array($this->module->lang('th_sel_favsite'), 0);
		$sites = WC_Site::getSitesRanked();
		foreach ($sites as $site)
		{
			$site instanceof WC_Site;
			$data[] = array($site->getVar('site_name'), $site->getID());
		}
		return GWF_Select::display('siteid', $data, $selected);
	}
	
	private function templateFreeze()
	{
		$freezes = GDO::table('WC_Freeze');
		$ipp = $this->module->cfgItemsPerPage();
		$nItems = $freezes->countRows();
		$nPages = GWF_PageMenu::getPagecount($ipp, $nItems);
		$page = Common::clamp(intval(Common::getGet('page', 1)), 1, $nPages);
		$from = GWF_PageMenu::getFrom($page, $ipp);
		
		$by = Common::getGet('by', '');
		$dir = Common::getGet('dir', '');
		$orderby = $freezes->getMultiOrderby($by, $dir);
		
		$form = $this->formFreeze();
		
		$tVars = array(
//			'frozen' => $freezes->selectAll($orderby, $ipp, $from),
			'frozen' => $freezes->selectObjects('*', '', $orderby, $ipp, $from),
			'form' => $form->templateY($this->module->lang('ft_freeze')),
			'form_action' => $this->getMethodHref(),
			'page_menu' => GWF_PageMenu::display($page, $nPages, sprintf(GWF_WEB_ROOT.'index.php?mo=WeChall&me=Freeze&by=%s&dir=%s&page=%%PAGE%%', urlencode($by), urlencode($dir))),
			'sort_url' => GWF_WEB_ROOT.'index.php?mo=WeChall&me=Freeze&by=%BY%&dir=%DIR%',
			'href_ddos' => $this->module->getMethodURL('UpdateAll'),
			'href_convert' => $this->module->getMethodURL('Convert'),
			'href_update' => $this->module->getMethodURL('Admin', '&remote_update=yes'),
			'href_chall_cache' => $this->module->getMethodURL('Admin', '&chall_cache=yes'),
			'href_recalc_all' => $this->module->getMethodURL('Admin', '&recalc=all'),
			'href_sitetags' => $this->module->getMethodURL('Admin', '&sitetags=yes'),
			'href_freeze' => $this->module->getMethodURL('Freeze'),
		);
		return $this->module->templatePHP('freeze.php', $tVars);
	}
	
	private function onFreeze()
	{
		$form = $this->formFreeze();
		if (false !== ($error = $form->validate($this->module))) {
			return $error;
		}
		
		$userid = $this->user->getID();
		$siteid = $this->site->getID();
		
		if (WC_Freeze::isUserFrozenOnSite($userid, $siteid))
		{
			return $this->module->message('msg_frozen', array($this->user->displayUsername(), $this->site->displayName()));
		}

		$old_totalscore = $this->user->getVar('user_level');
		
		# Is linked?
		if (false !== ($row = WC_RegAt::getRegatRow($userid, $siteid)))
		{
			# Unlink
			if (false === WC_RegAt::unlink($userid, $siteid)) {
				return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
			}
			$this->site->increase('site_linkcount', -1);
			
			WC_RegAt::calcTotalscores(); #($this->user);
		}

		# Insert event.
		$rank = WC_RegAt::calcExactRank($this->user);
		$this->user = GWF_User::getByID($userid);
		$totalscore = $this->user->getVar('user_level');
		
		WC_HistoryUser2::insertEntry($this->user, $this->site, 'ban', 0, $row->getOnsiteScore(), $totalscore-$old_totalscore);
		
		# Insert Freeze
		if (false === WC_Freeze::freezeUser($userid, $siteid)) {
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}
		
		# All done :)
		return $this->module->message('msg_frozen', array($this->user->displayUsername(), $this->site->displayName()));
	}
		
	private function onUnFreeze($data)
	{
		if (false !== ($err = GWF_Form::validateCSRF_WeakS())) {
			return GWF_HTML::error('WeChall', $err);
		}
		
		if (!is_array($data)) {
			return GWF_HTML::err('ERR_GENERAL', array(__FILE__, __LINE__));
		}
		foreach ($data as $key => $value) { break; }
		$data = explode(',', $key);
		if (count($data) !== 2) {
			return GWF_HTML::err('ERR_GENERAL', array(__FILE__, __LINE__));
		}
		$userid = intval($data[0]);
		$siteid = intval($data[1]);
		
		if (false === ($user = GWF_User::getByID($userid))) {
			return GWF_HTML::err('ERR_UNKNOWN_USER');
		}
		if (false === ($site = WC_Site::getByID($siteid))) {
			return $this->module->error('err_site');
		}
		
		if (WC_Freeze::isUserFrozenOnSite($userid, $siteid))
		{
			# Unfreeze
			if (false === WC_Freeze::unfreezeUser($userid, $siteid)) {
				return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
			}
			
			# Insert event.
			$rank = WC_RegAt::calcExactRank($user);
			WC_HistoryUser2::insertEntry($user, $site, 'unban');
		}

		# Done
		return $this->module->message('msg_unfrozen', array($user->displayUsername(), $site->displayName()));
	}
}
?>