<?php
final class Seattle_BlackDwarf extends SR_TalkingNPC
{
	public function getName() { return 'Tuldir'; }
	public function getNPCQuests(SR_Player $player) { return array('Seattle_BD1','Seattle_BD2','Seattle_BD3','Seattle_BD4'); }
	
	public function onNPCTalk(SR_Player $player, $word, array $args)
	{
		if ($this->onNPCQuestTalk($player, $word))
		{
			return true;
		}
		
		switch ($word)
		{
			case 'seattle': #return $this->reply('I have been in Seattle for all my life. I just love it.'); break;
			case 'cyberware': #return $this->reply('Good cyberwear can be a great help. Just don\'t get wasted completely!'); break;
			case 'magic': #return $this->reply('I think magic is overrated'); break;
			case 'invite': #return $this->reply('Oh yeah. Please greet the guys at the party. I will have to work.'); break;
			case 'hire': #return $this->reply('I have a broken leg.'); break;
				return $this->rply($word);
				
			case 'shadowrun':
			case 'yes':
			case 'no':
			case 'malois':
				return $this->rply('all');
				#return $this->reply('We know all of it.');
			
			case 'runes': case 'rune':
				return $this->rply('runes');
				#return $this->reply('I used to have the finest runes in my shop.'); break;
				
			default:
				return $this->rply('default');
				#return $this->reply("Hello. I know my shop looks wasted, but I am still in business! All my {$b}Runes{$b} are gone!");
		}
	}
}
?>
