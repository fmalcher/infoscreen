<?php
require_once("inc/lastRSS.php");
require_once("Config.class.php");
Config::init();


$rss = new lastRSS();
$rss->cache_dir   = "";
$rss->cache_time  = 0;
$rss->cp          = "UTF-8";
$rss->date_format = "l";

if($rs = $rss->get(Config::$pref['rssurl'])){
	foreach($rs['items'] AS $item){
		echo "<li>\n";
		echo "<h2>".$item['title']."</h2>\n";
		echo $item['description'];
		echo "</li>\n";
	}
}

?>