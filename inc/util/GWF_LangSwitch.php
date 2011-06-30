<?php
final class GWF_LangSwitch
{
	public static function select($name='lang_switch')
	{
		$current = GWF_Language::getCurrentLanguage();
		$langs = GWF_Language::getSupported();
		
		$data = array();
		
		foreach ($langs as $lang)
		{
			$lang instanceof GWF_Language;
			$data[] = array($lang->getISO(), $lang->getVar('lang_name'));
		}
		
		return GWF_Select::display($name, $data, $current->getISO(), self::getOnChange());
	}
	
	public static function getOnChange()
	{
		$current_url = GWF_Session::getCurrentURL();
		$url = Common::getProtocol().'://'.$_SERVER['HTTP_HOST'].'/';
		return 'window.location = \''.$url.'\'+this.value+\''.$current_url.'\'; return true;';
	}
}
?>