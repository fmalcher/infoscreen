<?php

class Config{
	public static $pref;
	
	public static function init(){
		self::$pref = array(
			"showmax"  => 10,
			"stations" => array(11330, 13007, 11343)
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