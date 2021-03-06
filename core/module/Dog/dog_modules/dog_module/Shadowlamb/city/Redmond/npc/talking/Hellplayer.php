<?php
final class Redmond_Hellplayer extends SR_TalkingNPC
{
	const TEMP_WORD = 'Redmond_Helldrinker';
	
	public function getName() { return $this->langNPC('name'); }
	
	private function isReallyPissed(SR_Player $player)
	{
		$party = $player->getParty();
		$this->rply('pissed');
// 		$this->reply('Ok, that does it! Rudy!');
		foreach ($party->getMembers() as $member)
		{
			$member->message($this->langNPCB($member, 'pissed2', array($player->getName())));
		}
// 		$party->message($player, ' pissed of the two pool players in the pub. They attack!');
		SR_NPC::createEnemyParty('Redmond_ToughGuy','Redmond_ToughGuy')->fight($party, true);
	}
	
	public function onNPCTalk(SR_Player $player, $word, array $args)
	{
		$b = chr(2);
		$t = self::TEMP_WORD;
		$quest = SR_Quest::getQuest($player, 'Redmond_Ueberpunk');
		$done = $quest->isDone($player);
		$has = $quest->isInQuest($player);
		
		switch ($word)
		{
			case 'yes':
				switch ($player->getTemp($t, 0))
				{
					case 0: $this->rply('yes0'); break;
// 					case 0: $this->reply('Yes, what?'); break;
					case 1:
					case 2: $this->isReallyPissed($player); break;
					case 3: $this->rply('yes3'); $quest->accept($player); break;
// 					case 3: $this->reply('Ok, bring me the Ueberpunks head and I will give you the reward.'); $quest->accept($player); break;
				}
				$player->unsetTemp($t);
				break;
				
			case 'no':
				switch ($player->getTemp($t, 0))
				{
					case 0: $this->rply('no0'); break;
// 					case 0: $this->reply('No, what?'); break;
					case 1:
					case 2:
						$this->rply('no2');
// 						$this->reply('Good for ya, chummer.');
						break;
					case 3:
						$this->rply('no3');
// 						$this->reply('We will find another runner for the revenge.');
						break;
				}
				$player->unsetTemp($t);
				break;
			
			case 'punk': case 'punks':
				switch ($player->getTemp($t, 0))
				{
					case 3:
					case 0:
						$this->rply('punk0');
// 						$this->reply('Are you a punk?!');
						$player->setTemp($t, 1);
						break;
					case 1:
						$this->rply('punk1');
// 						$this->reply('I asked yo, chummer: _are_you_a_punk_!?');
						$player->setTemp($t, 2);
						break;
					case 2: $this->isReallyPissed($player); $player->unsetTemp($t); break;
				}
				break;
				
			case 'biker': case 'bikers':
				$this->rply('bikers');
// 				$this->reply('Chummer, as you should notice most here are bikers. So what?');
				break;
				
			case 'shadowrun':
				if ($has === true)
				{
					$quest->checkQuest($this, $player);
				}
				elseif ($done === true)
				{
					$this->rply('thx');
// 					$this->reply('Thank ya fo` your help, chummer. We currently have no`ther job for ya`.');
				}
				else
				{
					$this->rply('run1');
					$this->rply('run2');
// 					$this->reply('Oh yo must have heard of our problem with the punks. If you kill their leader I will give you a reward.');
// 					$this->reply('Would you accept this mission, fellow runner?');
					$player->setTemp(self::TEMP_WORD, 3);
				}
				break;
				
			case 'pool':
				$this->rply('pool');
// 				$this->reply('You`re funney: http://en.wikipedia.org/wiki/Pool_%28cue_sports%29 - Read this, chummer.');
				break;
				
			case 'hello': default:
				if ($has === true)
				{
					$quest->checkQuest($this, $player);
				}
				else
				{
					$this->rply('default');
// 					$this->reply('Chummer, can`t yo` see we`re playin pool. One second...');
				}
				break;
		}
	}	
}
?>