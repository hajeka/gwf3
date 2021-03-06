<?php

final class WeChall_GraphSite extends GWF_Method
{
	public function getHTAccess()
	{
		return
			'RewriteRule ^usercount_graph/for/([^/]+)$ index.php?mo=WeChall&me=GraphSite&site=$1&type=sitehist_usercount&no_session=true'.PHP_EOL.
			'RewriteRule ^challcount_graph/for/([^/]+)$ index.php?mo=WeChall&me=GraphSite&site=$1&type=sitehist_challcount&no_session=true'.PHP_EOL.
			'RewriteRule ^score_graph/for/([^/]+)$ index.php?mo=WeChall&me=GraphSite&site=$1&type=sitehist_score&no_session=true'.PHP_EOL;
	}
	
	public function execute()
	{
		GWF3::setConfig('store_last_url', false);
		
		return $this->graph(Common::getGet('site'), Common::getGet('type'));
	}
	
	private function graph($sitename, $type)
	{
		if (false === ($site = WC_Site::getByName($sitename))) {
			return $this->module->error('err_site');
		}
		require_once GWF_CORE_PATH.'module/WeChall/WC_HistorySite.php';
		if (false === GDO::table('WC_HistorySite')->getWhitelistedBy($type, false)) {
			return GWF_HTML::err('ERR_GENERAL', array(__FILE__, __LINE__));
		}
		
		$dir = dirname(GWF_JPGRAPH_PATH).'/';
		require_once $dir.'jpgraph.php';
		require_once $dir.'jpgraph_date.php';
		require_once $dir.'jpgraph_line.php';
		require_once $dir.'jpgraph_plotline.php';
		
		return $this->graphB($site, $type);
	}
	
	private function graphB(WC_Site $site, $field)
	{
		$graphtitle = $this->module->lang('gt_site_'.$field, array($site->getVar('site_name')));
		$siteid = $site->getID();
		$history = GDO::table('WC_HistorySite');
		if (false === ($result = $history->select("sitehist_date, {$field}", 'sitehist_sid='.$siteid, 'sitehist_date ASC')))
		{
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}
		
//		$db = gdo_db();
//		$table = $history->getTableName();
//		if (false === ($result = $db->query("SELECT sitehist_date, $field FROM $table WHERE sitehist_sid=$siteid ORDER BY sitehist_date ASC"))) {
//			return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
//		}
		
		//load in the data
		$xdataarray = array();
		$ydataarray = array();
		$highestvalue = 0;
//		while (false !== ($row = $db->fetchRow($result)))
		while (false !== ($row = $history->fetch($result, GDO::ARRAY_N)))
		{
			$value = (int) $row[1];
			$day = GWF_Time::getDate(8, $row[0]);
			$xdataarray[$day] = $row[0];
			$ydataarray[$day] = $value;
			if ($value > $highestvalue)
			{   
				$highestvalue = $value;
			}
		}
		$history->free($result);
		
		$xdataarray = array_values($xdataarray);
		$ydataarray = array_values($ydataarray);
		
		// add current value
		$xdataarray[] = time();
		$ydataarray[] = $value = $site->getVar(str_replace('hist_', '_', $field));
		if ($value > $highestvalue) {   
			$highestvalue = $value;
		}
		
		
		if ($highestvalue === 0) {
			$graph = new Graph($this->module->cfgGraphWidth(), $this->module->cfgGraphHeight());
			$graph->SetScale('intlin', 1, 2, 1, 2);
			$caption = new Text($this->module->lang('err_graph_empty'), 0.1, 0.8);
//			$caption->SetFont(FS_BOLD);
			$graph->AddText($caption);
			$graph->stroke();
			die(0);
		}
		
		$dateformat = "M.y";
		$datemargin = strlen(date($dateformat)) * 11; 
		
		//define the graph
		$graph = new Graph($this->module->cfgGraphWidth(), $this->module->cfgGraphHeight());
		
		$graph->SetScale('datlin', 0, 1.05 * $highestvalue);
		$graph->title->Set($graphtitle);
//		$graph->title->SetFont(FF_ARIAL, FS_NORMAL, 12);
		$graph->SetColor(array(238, 238, 238));
		$graph->SetMarginColor(array(208, 211, 237));
		$graph->SetShadow();
		$graph->xaxis->SetLabelAngle(90);
//		$graph->xaxis->SetTickPositions($xticks, NULL, $xdataarray);
		$graph->xaxis->scale->SetDateFormat($dateformat);
		$graph->img->SetMargin(50, 40, 40, $datemargin);
		
		$lineplot = new LinePlot($ydataarray, $xdataarray);
		$lineplot->SetColor("blue");
		$lineplot->SetWeight(2);
		$graph->Add($lineplot);
//		$graph->img->SetAntiAliasing();
		// Display the graph
		GWF_HTTP::noCache();
		$graph->Stroke();
		die(0);
	}
	
}

?>