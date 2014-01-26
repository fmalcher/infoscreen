<?php

class Config{
	public static $pref;
	
	public static function init(){
		self::$pref = array(
			"showmax"  => 8,
			"refreshplan" => 30,
			"refreshtemp" => 300,
			"refreshnews" => 8,
			"stations" => array(11330, 13007, 11343),
			"weather_location" => "51.342065,12.377057"
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