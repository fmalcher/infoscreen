<?php
require_once("Config.class.php");
Config::init();

$get = $_GET['get'];

if($get == "temp"){
	$loc   = explode(",", Config::$pref['weather_location']);
	$wdata = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?lang=de&units=metric&lat=".$loc[0]."&lon=".$loc[1]));
	$temp = $wdata->main->temp;

	$temp = round($temp, 1); //one digit after separator
	$temp = str_replace(".", ",", $temp); //comma as separator
	$temp .= "&deg;C"; //add ¡C
	
	echo $temp;
}

?>