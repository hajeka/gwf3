<?php
/**
 * A goth.
 * @author gizmore
 */
final class Delaware_MCGuest1 extends SR_TalkingNPC
{
	public function getName() { return 'Miriam'; }
	public function getNPCQuests(SR_Player $player) { return array('Delaware_MCGuest11', 'Delaware_MCGuest12'); }
	public function onNPCTalk(SR_Player $player, $word, array $args)
	{
		if ($this->onNPCQuestTalk($player, $word))
		{
			return true;
		}
		switch ($word)
		{
			case 'emo': case 'emos':
				return $this->rply('emo');
// 				return $this->reply('Yeah I hate emos.');
			case 'hipster': case 'hipsters':
				return $this->rply('hip');
// 				return $this->reply('Yeah I hate hipsters.');
			default:
				return $this->rply('def');
// 				return $this->reply("Damn \X02Hipsters\X02 and \X02Emos\X02. Pfff.");
		}
	}
}
?>
