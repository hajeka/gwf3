<?php
final class Forest_Exit extends SR_Exit
{
	public function getFoundText(SR_Player $player) { return $this->lang($player, 'found'); }
	public function getEnterText(SR_Player $player) { return $this->lang($player, 'enter'); }

	public function getFoundPercentage() { return 100; }
	
	public function getExitLocation() { return 'Seattle_Forest'; }
}
?>
