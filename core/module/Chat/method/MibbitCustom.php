<?php
final class Chat_MibbitCustom extends GWF_Method
{
	public function execute()
	{
		return $this->templateMibbit();
	}
	
	private function templateMibbit()
	{
		$tVars = array(
		);
		return $this->module->templatePHP('mibbit_custom.php', $tVars);
	}
}
?>