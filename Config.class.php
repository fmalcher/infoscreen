<?php
class Config{
	public static $pref;
	
	public static function init(){
		self::$pref = array(
			"stations" => array(11330),
			"showmax"  => 7,
			"weather_location" => "51.342065,12.377057",
			"rssurl" => "http://www.tagesschau.de/xml/rss2",
			"tagesschau_onlytoday" => 1, //only show today's posts from Tagesschau RSS feed
			"refreshplan" => 30,
			"refreshtemp" => 300,
			"refreshnews" => 9,
		);
	}
	
	public static function getTemplate($tpl){
		$tplpath = "templates/";
		$file = $tplpath.$tpl.".tpl";

		if(file_exists($file)){
			return file_get_contents($file);
		}else{
			return 0;
		}
	}
}

?>