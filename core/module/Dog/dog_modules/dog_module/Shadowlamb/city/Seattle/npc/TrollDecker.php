<?php
final class Seattle_TrollDecker extends SR_NPC
{
	public function getNPCLevel() { return 11; }
	public function getNPCPlayerName() { return 'TrollDecker'; }
	public function getNPCMeetPercent(SR_Party $party) { return 60.00; }
	public function getNPCEquipment()
	{
		return array(
			'weapon' => 'Fichetti',
			'armor' => 'LeatherVest',
			'legs' => 'Trousers',
			'boots' => 'LeatherBoots',
			'helmet' => 'Cap',
		);
	}

	public function getNPCInventory() { return array('Ammo_5mm', 'Ammo_5mm', 'Ammo_5mm', 'Ammo_5mm', 'Ammo_5mm'); }
	public function getNPCModifiers() {
		return array(
			'race' => 'troll',
			'gender' => 'male',
			'strength' => rand(3, 5),
			'quickness' => rand(1, 2),
			'distance' => rand(8, 10),
			'pistols' => rand(1, 2),
			'firearms' => rand(2, 3),
			'sharpshooter' => rand(0, 1),
			'nuyen' => rand(40, 120),
			'base_hp' => rand(3, 9),
		);
	}
	
	public function getNPCLoot(SR_Player $player)
	{
		$quest = SR_Quest::getQuest($player, 'Seattle_Johnson1');
		$quest instanceof Quest_Seattle_Johnson1;
		$quest->onKilled($player);
		
		if (rand(1,3) === 1)
		{
			return array('IDCard');
		}
		
		return array();
	}
	
}
?>