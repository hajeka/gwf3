<?php
final class Renraku_Secretary extends SR_TalkingNPC
{
	public function getName() { return $this->langNPC('name'); }
// 	public function getName() { return 'The secretary'; }
	
	public function onNPCTalk(SR_Player $player, $word, array $args)
	{
		$b = chr(2);
		$quest = SR_Quest::getQuest($player, 'Seattle_GJohnson3');
		
		switch ($word)
		{
			case 'employee': case 'employees':
				return $this->rply('employee');
// 				return $this->reply('Ìf you are not an employee you are supposed to leave. Else, how can I help you?');
			
			case 'renraku':
				return $this->rply('renraku');
// 				return $this->reply("The office is only for {$b}employee{$b}.");
			
			default:
				if ($quest->isInQuest($player) && ($quest->getAmount()==0))
				{
					$this->rply('please');
// 					$this->reply('Hello. Please deliver the package to the bureau. The floor to the left. Room 0104.');
					$player->giveKnowledge('places', 'Renraku_Bureau');
					return true;
				}
				else
				{
					return $this->rply('default');
// 					return $this->reply('Hello, how can I help you.');
				}
		}
	}
}
?>