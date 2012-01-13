<?php

final class Usergroups_Edit extends GWF_Method
{
	private $group;
	public function isLoginRequired() { return true; }
	
	public function getHTAccess()
	{
		return 'RewriteRule ^edit_usergroup/(\d+)/[^/]+$ index.php?mo=Usergroups&me=Edit&gid=$1'.PHP_EOL;
	}
	
	public function execute()
	{
		$user = GWF_Session::getUser();
		
		if (false === ($this->group = GWF_Group::getByID(Common::getGet('gid')))) {
			return $this->_module->error('err_unk_group');
		}
		$group = $this->group;

		$groupname = $group->getVar('group_name');
		if (!$user->isInGroupName($groupname)) {
			return $this->_module->error('err_unk_group');
		}
		
//		$gid = $group->getID();
//		$groups = $user->getGroups();
//		$ugo = $groups[(string)($gid)]['ug_options'];
		
		$ugo = $user->getUserGroupOptions($group->getID());
//		var_dump($ugo);
		if ( ($ugo&(GWF_UserGroup::LEADER|GWF_UserGroup::CO_LEADER)) === 0 ) {
			return $this->_module->error('err_unk_group');
		}
		
		if (false !== ($array = Common::getPostArray('kick'))) {
			return $this->onKick($this->_module, $group, $array).$this->templateEdit($group);
		}
		
		if (false !== ($array = Common::getPostArray('accept'))) {
			return $this->onAccept($this->_module, $group, $array).$this->templateEdit($group);
		}
		
		if (false !== ($array = Common::getPostArray('co'))) {
			return $this->onSetPriv($this->_module, $group, $array, GWF_UserGroup::CO_LEADER, true);
		}
		if (false !== ($array = Common::getPostArray('unco'))) {
			return $this->onSetPriv($this->_module, $group, $array, GWF_UserGroup::CO_LEADER, false);
		}
		if (false !== ($array = Common::getPostArray('mod'))) {
			return $this->onSetPriv($this->_module, $group, $array, GWF_UserGroup::MODERATOR, true);
		}
		if (false !== ($array = Common::getPostArray('unmod'))) {
			return $this->onSetPriv($this->_module, $group, $array, GWF_UserGroup::MODERATOR, false);
		}
		if (false !== ($array = Common::getPostArray('hide'))) {
			return $this->onSetPriv($this->_module, $group, $array, GWF_UserGroup::HIDDEN, true);
		}
		if (false !== ($array = Common::getPostArray('unhide'))) {
			return $this->onSetPriv($this->_module, $group, $array, GWF_UserGroup::HIDDEN, false);
		}
		
		if (false !== Common::getPost('invite')) {
			return $this->onInvite($this->_module, $group);
		}
		
		if (false !== Common::getPost('edit')) {
			return $this->onEdit($this->_module, $group);
		}
		if (false !== Common::getPost('delete')) {
			return $this->onDelete($this->_module, $group);
		}
		if (false !== Common::getPost('del_confirm')) {
			return $this->onDeleteConfirm($this->_module, $group);
		}
		
		return $this->templateEdit($group);
	}
	
	private function templateEdit(GWF_Group $group, $formDelete='')
	{
		$form = $this->getForm($this->_module, $group);
		$form_invite = $this->getFormInvite($this->_module, $group);
		
		$ipp = $this->_module->cfgIPP();
		$nUsers = $group->getVar('group_memberc');
		$nPagesM = GWF_PageMenu::getPagecount($ipp, $nUsers);
		$pageM = Common::clamp(intval(Common::getGet('memberpage')), 1, $nPagesM);
		
		$nRequests = GWF_UsergroupsInvite::countRequests($group->getID());
		$nPagesR = GWF_PageMenu::getPagecount($ipp, $nRequests);
		$pageR = Common::clamp(intval(Common::getGet('requestpage')), 1, $nPagesM);
		
		$tVars = array(
			'group' => $group,
			'form_action' => GWF_WEB_ROOT.'edit_usergroup/'.$group->getVar('group_id').'/'.$group->urlencodeSEO('group_name'),
			'form_edit' => $form->templateY($this->_module->lang('ft_edit')),
			'form_invite' => $form_invite->templateX($this->_module->lang('ft_invite')),
			'form_delete' => $formDelete,
			'pagemenu_members' => GWF_PageMenu::display($pageM, $nPagesM, GWF_WEB_ROOT.'index.php?mo=Usergroups&me=Edit&memberpage=%PAGE%&requestpage='.$pageR),
			'pagemenu_requests' => GWF_PageMenu::display($pageR, $nPagesR, GWF_WEB_ROOT.'index.php?mo=Usergroups&me=Edit&requestpage=%PAGE%&memberpage='.$pageM),
			'users' => $this->getMembers($this->_module, $group),
			'requests' => $this->getJoinRequests($this->_module, $group),
		);
		return $this->_module->templatePHP('edit.php', $tVars);
	}
	
	private function getJoinRequests(Module_Usergroups $module, GWF_Group $group)
	{
		$back = array();
		$users = GDO::table('GWF_User')->getTableName();
		$requests = GDO::table('GWF_UsergroupsInvite')->getTableName();
		$gid = $group->getID();
		$query = "SELECT user_name,user_id,user_level FROM $requests JOIN $users ON user_id=ugi_uid WHERE ugi_gid=$gid AND ugi_type='request'";
		$db = gdo_db();
		if (false === ($result = $db->queryRead($query))) {
			return $back;
		}
		while (false !== ($row = $db->fetchAssoc($result)))
		{
			$back[] = new GWF_User($row);
		}
		$db->free($result);
		return $back;
		
	}
	
	private function getMembers(Module_Usergroups $module, GWF_Group $group)
	{
		$back = array();
		$users = GDO::table('GWF_User')->getTableName();
		$groups = GDO::table('GWF_UserGroup')->getTableName();
		$gid = $group->getID();
		$query = "SELECT user_name,user_id,user_level FROM $groups JOIN $users ON user_id=ug_userid WHERE ug_groupid=$gid";
		$db = gdo_db();
		if (false === ($result = $db->queryRead($query))) {
			return $back;
		}
		while (false !== ($row = $db->fetchAssoc($result)))
		{
			$back[] = new GWF_User($row);
		}
		$db->free($result);
		return $back;
	}

	private function getFormInvite(Module_Usergroups $module, GWF_Group $group)
	{
		$data = array(
			'username' => array(GWF_Form::STRING, '', $this->_module->lang('th_user_name')),
			'invite' => array(GWF_Form::SUBMIT, $this->_module->lang('btn_invite')),
		);
		return new GWF_Form($this, $data);
	}
	
	private function getForm(Module_Usergroups $module, GWF_Group $group)
	{
		$buttons = array(
			'edit' => $this->_module->lang('btn_edit'),
			'delete' => $this->_module->lang('btn_delete'),
		);
		$data = array(
			'name' => array(GWF_Form::STRING, $group->getVar('group_name'), $this->_module->lang('th_name')),
			'join' => array(GWF_Form::SELECT, $this->_module->selectJoinType($group->getJoinMode()), $this->_module->lang('th_join')),
			'view' => array(GWF_Form::SELECT, $this->_module->selectViewType($group->getVisibleMode()), $this->_module->lang('th_view')),
			'vis_grp' => array(GWF_Form::CHECKBOX, $group->isOptionEnabled(GWF_Group::VISIBLE_GROUP), $this->_module->lang('th_vis_grp'), $this->_module->lang('tt_vis_grp')),
			'vis_mem' => array(GWF_Form::CHECKBOX, $group->isOptionEnabled(GWF_Group::VISIBLE_MEMBERS), $this->_module->lang('th_vis_mem'), $this->_module->lang('tt_vis_mem')),
			'cmd' => array(GWF_Form::SUBMITS, $buttons),
		);
		return new GWF_Form($this, $data);
	}
	
	public function validate_name(Module_Usergroups $module, $arg) { return $this->_module->validate_name($arg); }
	public function validate_join(Module_Usergroups $module, $arg) { return $this->_module->validate_join($arg); }
	public function validate_view(Module_Usergroups $module, $arg) { return $this->_module->validate_view($arg); }
	
	public function onEdit(Module_Usergroups $module, GWF_Group $group)
	{
		$form = $this->getForm($this->_module, $group);
		if (false !== ($errors = $form->validate($this->_module))) {
			return $errors.$this->templateEdit($group);
		}
		
		$options = 0;
		$options |= intval(Common::getPost('join', 0));
		$options |= intval(Common::getPost('view', 0));
		
		$options |= isset($_POST['vis_grp']) ? GWF_Group::VISIBLE_GROUP : 0;
		$options |= isset($_POST['vis_mem']) ? GWF_Group::VISIBLE_MEMBERS : 0;
		
		if (false === $this->changeGroupName($this->_module, $group, $_POST['name'])) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}

		if (false === $group->saveVar('group_options', $options)) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		if (false !== ($errors = $this->_module->adjustFlags($group))) {
			return $errors.$this->templateEdit($group);
		}
		
		return $this->_module->message('msg_edited').$this->templateEdit($group);
	}
	
	private function changeGroupName(Module_Usergroups $module, GWF_Group $group, $new_name)
	{
		if ($new_name === $group->getVar('group_name')) {
			return true;
		}
		
		if (false === ($mod_forum = GWF_Module::getModule('Forum'))) {
			return true;
		}
		$mod_forum->onInclude();
		
		if (false === ($board = GWF_ForumBoard::getByID($group->getBoardID()))) {
			return false;
		}
		
		if (false === $group->saveVar('group_name', $new_name)) {
			return false;
		}
		
		if (false === $board->saveVars(array(
			'board_title' => 'Usergroup: '.$new_name,
			'board_descr' => 'Board for the '.$new_name.' group',
		))) {
			return false;
		}
		
		return true;
	}
	
	############
	### Kick ###
	############
	public function onKick(Module_Usergroups $module, GWF_Group $group, $array)
	{
		if (!(is_array($array))) { return ''; }
//		foreach ($array as $username => $stub) { break; }
		$username = key($array);
		
		if (false === ($user = GWF_User::getByName($username))) {
			return GWF_HTML::err('ERR_UNKNOWN_USER');
		}
		
		if ($group->getFounderID() === $user->getID()) {
			return $this->_module->error('err_kick_leader');
		}
		
		if (!$user->isInGroupName($group->getName()))
		{
			return $this->_module->error('err_kick', $user->displayUsername());
		}
		
		if (false === GWF_UserGroup::removeFromGroup($user->getID(), $group->getID()))
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		return $this->_module->message('msg_kicked', array($user->displayUsername()));
	}

	##############
	### Accept ###
	##############
	public function onAccept(Module_Usergroups $module, GWF_Group $group, $array)
	{
		if (!(is_array($array))) { return ''; }
		
		$username = key($array);
//		foreach ($array as $username => $stub) { break; }
		
		if (false === ($user = GWF_User::getByName($username))) {
			return GWF_HTML::err('ERR_UNKNOWN_USER');
		}
		
		if (false === ($requst = GWF_UsergroupsInvite::getRequestRow($user->getID(), $group->getID()))) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		if (false === GWF_UserGroup::addToGroup($user->getID(), $group->getID()))
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		if (false === $requst->delete()) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		return $this->_module->message('msg_accepted', array($user->displayUsername(), $group->display('group_name')));
	}

	public function validate_username(Module_Usergroups $module, $arg) { return $this->_module->validate_username($arg); }
	public function onInvite(Module_Usergroups $module, GWF_Group $group)
	{
		$form = $this->getFormInvite($this->_module, $group);
		if (false !== ($errors = $form->validate($this->_module))) {
			return $errors.$this->templateEdit($group);
		}
		
		if (false === ($user = GWF_User::getByName($_POST['username']))) {
			return GWF_HTML::err('ERR_UNKNOWN_USER').$this->templateEdit($group);
		}
		
		$back = '';
		if (false === GWF_UsergroupsInvite::getInviteRow($user->getID(), $group->getID()))
		{
			if (false === GWF_UsergroupsInvite::invite($user->getID(), $group->getID())) {
				return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__)).$this->templateEdit($group);
			}
			
			$back = $this->sendInvitePM($this->_module, $user, $group);
		}
		
		return $back.$this->_module->message('msg_invited', array($user->displayUsername()).$this->templateEdit($group));
	}

	#################
	### Invite PM ###
	#################
	private function getPMTitle(Module_Usergroups $module, GWF_User $user, GWF_Group $group)
	{
		return $this->_module->langUser($user, 'invite_title', $group->getName());
	}
	
	private function getPMMessage(GWF_User $user, GWF_Group $group, $bbcode=true)
	{
		$href_join = '/index.php?mo=Usergroups&me=Join&gid='.$group->getVar('group_id');
		$href_deny = '/index.php?mo=Usergroups&me=Join&deny='.$group->getVar('group_id');
		$founder = $group->getFounder();
		
		if ($bbcode === true)
		{
			$link_yes = sprintf('[url=%s]%s[/url]', $href_join, $href_join);
			$link_no = sprintf('[url=%s]%s[/url]', $href_deny, $href_deny);
		}
		else
		{
			$link_yes = GWF_HTML::anchor($href_join, $href_join);
			$link_no = GWF_HTML::anchor($href_deny, $href_deny);
		}
		
		return $this->_module->langUser($user, 'invite_message', $user->getVar('user_name'), $founder->getVar('user_name'), $group->getName(), $link_yes, $link_no);
	}
	
	private function sendInvitePM(Module_Usergroups $module, GWF_User $user, GWF_Group $group)
	{
		if (false === ($mod_pm = GWF_Module::getModule('PM'))) {
			return '';
//			return $this->sendInviteEMail($this->_module, $user, $group);
		}
		
		$mod_pm->onInclude();
		$mod_pm->onLoadLanguage();
		
		$title = $this->getPMTitle($this->_module, $user, $group);
		$message = $this->getPMMessage($user, $group);
		
		$pm = GWF_PM::fakePM(GWF_Session::getUserID(), $user->getID(), $title, $message);
		if (false === $pm->insert()) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		return '';
	}
	
	private function onSetPriv(Module_Usergroups $module, GWF_Group $group, array $array, $flag, $bool)
	{
		if (false === ($user = GWF_User::getByName(key($array)))) {
			return GWF_HTML::err('ERR_UNKNOWN_USER').$this->templateEdit($group);
		}
		
		$uname = $user->displayUsername();
		
		if (false === ($row = GDO::table('GWF_UserGroup')->getRow($user->getID(), $group->getID()))) {
			return $this->_module->error('err_not_in_group', $uname).$this->templateEdit($group);
		}

		if (false === $row->saveOption($flag, $bool)) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__)).$this->templateEdit($group);
		}
		
		return
			$this->_module->message('msg_ugf_'.$flag.'_'.intval($bool), array($uname)).
			$this->templateEdit($group);
	}
	
	####################
	### Delete Group ###
	####################
	public function onDelete(Module_Usergroups $module, GWF_Group $group)
	{
		$form = $this->formDelete($this->_module, $group);
		$formDelete = $form->templateY($this->_module->lang('ft_del_group', array($group->display('group_name'))));
		return $this->templateEdit($group, $formDelete);
	}
	
	private function formDelete(Module_Usergroups $module, GWF_Group $group)
	{
		$data = array(
			'del_groupname' => array(GWF_Form::STRING, '', $this->_module->lang('th_del_groupname'), $this->_module->lang('tt_del_groupname')),
			'del_confirm' => array(GWF_Form::SUBMIT, $this->_module->lang('btn_del_group', array($group->display('group_name')))),
		);
		return new GWF_Form($this, $data);
	}
	
	public function validate_del_groupname(Module_Usergroups $module, $arg)
	{
		if ($arg !== $this->group->getName()) {
			return $this->_module->lang('tt_del_groupname');
		}
		return false;
	}
	
	public function onDeleteConfirm(Module_Usergroups $module, GWF_Group $group)
	{
		$form = $this->formDelete($this->_module, $group);
		if (false !== ($error = $form->validate($this->_module))) {
			return $error.$this->templateEdit($group);
		}
		
		if ($group->getFounderID() !== GWF_Session::getUserID()) {
			return GWF_HTML::err('ERR_NO_PERMISSION').$this->templateEdit($group);
		} 
		
		$acl = GDO::table('GWF_UserGroup');
		if (false === $acl->deleteWhere('ug_groupid='.$group->getVar('group_id'))) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		$n2 = $acl->affectedRows();
		if (false === $group->delete()) {
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		$n1 = $group->affectedRows();
		
		return $this->_module->message('msg_del_group', array($group->display('group_name'), $n1, $n2));
	}
}
	
?>
