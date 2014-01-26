<?php
class Config{
	public static $pref;
	
	public static function init(){
		self::$pref = array(
			"stations" => array(11330),
			"showmax"  => 7,
			"weather_location" => "51.342065,12.377057",
			"rssurl" => "http://www.tagesschau.de/xml/rss2",
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