<?php
require_once 'SR_SearchRoom.php';

abstract class SR_Exit extends SR_SearchRoom
{
	public function getAbstractClassName() { return __CLASS__; }
	
	/**
	 * Get the exit location. Eg: Redmond_Hotel
	 */
	public abstract function getExitLocation();
	public function getExitCity() { return Common::substrUntil($this->getExitLocation(), '_'); }
	
//	public function getExitAction() { return SR_Party::ACTION_INSIDE; }
// 	public function getHelpText(SR_Player $player) { return 'You can return to this location to #leave the building.'; }
	public function getHelpText(SR_Player $player) { return $player->lang('hlp_exit'); }
	public function getLeaderCommands(SR_Player $player) { return array_merge(parent::getLeaderCommands($player), array('leave')); }
	public function getAreaSize() { return 1; }
// 	public function isExitAllowed(SR_Player $player) { return false; }
	public function on_leave(SR_Player $player, array $args)
	{
		$this->teleportOutside($player, $this->getExitLocation());
	}
	
	public function checkLocation()
	{
		parent::checkLocation();
		
		if (false !== ($exit_location = $this->getExitLocation()))
		{
			if (false === Shadowrun4::getLocationByTarget($exit_location))
			{
				die(sprintf("%s has an invalid Exit location!\n", $this->getName()));
			}
		}
		
	}
	
}
?>