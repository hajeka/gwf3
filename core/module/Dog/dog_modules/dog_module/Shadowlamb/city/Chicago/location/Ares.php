<?php
final class Chicago_Ares extends SR_Store
{
	public function getNPCS(SR_Player $player) { return array('talk' => 'Chicago_AresMan'); }
	public function getFoundPercentage() { return 60.0; }

	public function getFoundText(SR_Player $player) { return $this->lang($player, 'found'); }
	public function getEnterText(SR_Player $player) { return $this->lang($player, 'enter'); }
	
	public function getStoreItems(SR_Player $player)
	{
		return array(
			array('Ammo_Arrow', 100.0, 9.95),
			array('Ammo_4mm', 100.0, 29.95),
			array('Ammo_5mm', 100.0, 29.95),
			array('Ammo_7mm', 100.0, 39.95),
			array('Ammo_9mm', 100.0, 49.95),
			array('Ammo_11mm', 100.0, 59.95),
			array('Ammo_Shotgun', 100.0, 69.95),
			array('Stimpatch', 100.0, 750),
			array('FirstAid', 100.0, 500),
			array('AresViper', 100.0, 1250),
			array('Fichetti', 100.0, 1450),
			array('RugerWarhawk', 100.0, 1650),
			array('KevlarVest', 100.0, 25000),
			array('KevlarHelmet', 100.0, 35000),
			array('KevlarLegs', 100.0, 25000),
			array('KevlarShield', 100.0, 35000),
			array('LightBodyArmor', 100.0, 75000),
			array('CombatHelmet', 100.0, 25000),
		);
	}
	
}
?>