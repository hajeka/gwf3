<?php
/**
 * osix.net
 * userscore:maxscore:usercount:challcount
 */
class WCSite_osix extends WC_Site
{
	public function parseStats($url)
	{
		if (false === ($result = GWF_HTTP::getFromURL($url, false))) {
			return htmlDisplayError(WC_HTML::lang('err_response', array(GWF_HTML::display($result), $this->displayName())));
		}

		$stats = explode(':', $result);
		if (count($stats) !== 4) {
			return htmlDisplayError(WC_HTML::lang('err_response', array(GWF_HTML::display($result), $this->displayName())));
		}
		
		$onsitescore = intval($stats[0]);
		$maxscore = intval($stats[1]);
		$usercount = intval($stats[2]);
		$challcount = intval($stats[3]);
		if ($maxscore === 0 || $challcount === 0 || $usercount === 0) {
			return htmlDisplayError(WC_HTML::lang('err_response', array(GWF_HTML::display($result), $this->displayName())));
		}
		
		return array($onsitescore, -1, -1, $maxscore, $usercount, $challcount);
	}
}
?>