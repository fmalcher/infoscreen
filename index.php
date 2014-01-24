<?php
require_once("StationMonitor.class.php");
error_reporting("E_ALL & ~E_NOTICE");
ini_set('display_errors', 1);

$sm = new StationMonitor("11330");

//print_r($sm->getJourneys()); exit;

//how many rows to show
$showmax = ($_GET['show']) ? $_GET['show'] : 10;
?>




<html>
<head>
<title>MDV Fahrplan</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="/media/style.css" type="text/css">
<meta http-equiv="refresh" content="10; URL=<?php echo $_SERVER['REQUEST_URI']; ?>">

</head>

<body>

<div id="curTime">
	<?php
	//echo date("H:i");
	
	//this is a workaround... better parse the timestamp or use local time
	$date = explode("+", $data['requestTimeStamp']);
	echo $date[1];
	?>
</div>

<table class="plan">

<tr class="headline">
<td colspan="2">
	<?php echo $data['stationName']; ?>
</td>
</tr>

<?php
//decide how many rows to show
if(count($data['journeys']) > $showmax){
	$count = $showmax;
}else{
	$count = count($data['journeys']);
}

for($i = 0; $i < $count; $i++){
	$journey = $data['journeys'][$i];
	
	//cut away "Leipzig" from the beginning of the label
	if(substr($journey['label'],0,9) == "Leipzig, "){
		$journey['label'] = substr($journey['label'],9);
	}
?>

<tr class="planrow">
<td style="background-color:#<?php echo $journey['color'] ?>;" class="icon">
<?php echo $journey['shortLabel'] ?>
</td>
<td class="info">
<div class="label"><?php echo $journey['label'] ?></div>
<div class="time">
	<?php echo $journey['time'] ?>
	<span class="timeDiff">
	<?php if($journey['timeDiffValue']) { echo $journey['timeDiff']; } ?>
	</span>
</div>

</td>
</tr>

<?php } ?>


</table>

</body>
</html>
