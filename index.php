<?php
error_reporting("E_ALL & ~E_NOTICE");
ini_set('display_errors', 1);

require_once("StationMonitor.class.php");
require_once("Config.class.php");

Config::init();

$sm = new StationMonitor("11330");




//how many rows to show
$getshow = intval($_GET['show']);
$showmax = ($getshow >= 1) ? $getshow : Config::$pref['showmax'];
?>




<html>
<head>
<title>MDV Fahrplan</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="media/style.css" type="text/css">
<meta http-equiv="refresh" content="10; URL=<?php echo $_SERVER['REQUEST_URI']; ?>">

</head>

<body>

<div id="curTime">
	<?php
	echo date("H:i", $sm->getRequestTime());
	?>
</div>


<table style="width: 100%;">
<tr style="vertical-align: top;">


<?php
foreach(Config::$pref['stations'] AS $station){
	echo "<td>";
	

	$sm = new StationMonitor($station);
	$journeys = $sm->getJourneys();


	$tabletpl = Config::getTemplate("plantable"); 
	$rowtpl   = Config::getTemplate("planrow");

	
	//decide how many rows to show
	if(count($journeys) > $showmax){
		$count = $showmax;
	}else{
		$count = count($journeys);
	}
	
	
	$planrows = array();
	
	//go through journeys
	for($i = 0; $i < $count; $i++){
		$jo = $journeys[$i];
	
		//cut away "Leipzig" from the beginning of the label
		if(substr($jo->label, 0, 9) == "Leipzig, "){
			$jo->label = substr($jo->label, 9);
		}
		
		//only show timediff if not null
		$jo->timeDiff = ($jo->timeDiffValue) ? $jo->timeDiff : "";
		
		$search = array("{BGCOLOR}","{LINENUM}","{LABEL}","{TIME}","{TIMEDIFF}");
		$replace = array("#".$jo->color, $jo->shortLabel, $jo->label, $jo->time, $jo->timediff);
		$planrows[] = str_replace($search, $replace, $rowtpl);
	}
	
	
	
	$search = array("{STATIONNAME}", "{PLANROWS}");
	$replace = array($sm->getStationName(), implode("\n", $planrows));
	$table = str_replace($search, $replace, $tabletpl);
	
	echo $table;
	
	echo "</td>";
}
?>


</tr>
</table>


</body>
</html>
