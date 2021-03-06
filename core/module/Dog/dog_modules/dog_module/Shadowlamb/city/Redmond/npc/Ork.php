<?php
final class Redmond_Ork extends SR_NPC
{
	public function getNPCLevel() { return 6; }
	public function getNPCPlayerName() { return 'AngryOrk'; }
	public function canNPCMeet(SR_Party $party) { return true; }
	public function getNPCMeetPercent(SR_Party $party) { return 60.00; }
	
	public function getNPCModifiers()
	{
		return array(
			'race' => 'halfork',
			'strength' => rand(2, 3),
			'quickness' => rand(1, 2),
			'base_hp' => rand(3, 6),
			'distance' => rand(0, 1),
			'nuyen' => rand(30, 70),
		);
	}
	
	public function getNPCEquipment()
	{
		return array(
			'weapon' => 'Knife',
			'armor' => 'LeatherVest',
			'boots' => 'Sneakers',
		);
	}
	
	public function getNPCLoot(SR_Player $player)
	{
		# check for the first killed ork 
		foreach ($player->getParty()->getMembers() as $member)
		{
			$member instanceof SR_Player;
			$quest = SR_Quest::getQuest($member, 'Renraku_I');
			$quest instanceof Quest_Renraku_I;
			if (false === $quest->checkOrk($member))
			{
				$quest->setOrk($member);
			}
		}
		
		# OrkRage
		$quest = SR_Quest::getQuest($player, 'Redmond_OrkRage');
		$quest instanceof Quest_Redmond_OrkRage;
		if ($quest->isInQuest($player))
		{
			$quest->onKilled($player);
		}
		
		return array();
	}
}
?>
