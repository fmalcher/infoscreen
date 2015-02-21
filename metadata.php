<?php

require_once("Config.class.php");
Config::init();

//könnte auch $argv für cli unterstützen

//$get = $_GET['get'];

//noch unnütz, wenn dann switch ggf. sinnvoller
//if($get == 'temp'){
	$loc   = explode(',', Config::$pref['weather_location']);
	$url="http://api.openweathermap.org/data/2.5/weather?lang=de&units=metric&lat=".$loc[0]."&lon=".$loc[1];


// StationMonitor nutzt schon curl, daher hier als besserer Ersatz für file_get_contents
if ( !function_exists('curl_init')
	|| !function_exists('curl_setopt')
	|| !function_exists('curl_exec')
){
	echo "Fehler: php_curl geht nicht!";//Fehlermeldungen ersparen Nachfragen und manuelle Suche
}else{
	$curl_handle=curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,$url);
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_USERAGENT, 'infoscreen');
	$query = curl_exec($curl_handle);
	curl_close($curl_handle);

	$wdata = json_decode($query /*file_get_contents($url)*/ );
	$temp = $wdata->main->temp;

	if($temp != ""){
		$temp = round($temp, 1); //one digit after separator
		$temp = str_replace(".", ",", $temp); //comma as separator
		$temp .= "&deg;C"; //add ¡C
	}else{
		$temp = 'Fehler: Unerwartetes Resultat ist "'.$query.'"';
	}
	echo $temp;
}
//}

?>
