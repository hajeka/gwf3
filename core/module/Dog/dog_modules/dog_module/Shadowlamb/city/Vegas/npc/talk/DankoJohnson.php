<?php
final class Vegas_DankoJohnson extends SR_TalkingNPC
{
	public function getName() { return $this->langNPC('name'); }
	
	function getNPCQuests(SR_Player $player)
	{
		return array(
			'Vegas_DJ1',
		);
	}
}
?>
