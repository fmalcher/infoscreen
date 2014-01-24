<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://hn1.the-agent-factory.de/easygo2/rest/regions/MDV/modules/stationmonitor?con10=1&con01=1&sm10=0&sm01=0&source=HISTORY&cStyle=0&transportFilter=00011111&hafasID=11330&mode=DEP&sm01=0&sm10=0&con01=1&con10=1&cStyle=0',
    CURLOPT_USERAGENT => 'easy.GO Client Android v4.0.3_easyGO_4.0.7 Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36',
    CURLOPT_HTTPHEADER => array("EasyGO-Client-ID: 62796187481377194541492","Accept: application/json"),
));
$resp = curl_exec($curl);
curl_close($curl);
$data = json_decode($resp, true);

//print_r($data);exit;

//how many rows to show
$showmax = ($_GET['show']) ? $_GET['show'] : 10;
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<meta http-equiv="refresh" content="10; URL=<?php echo $_SERVER['REQUEST_URI']; ?>">
<style type="text/css">
<!--
body{
	background: black;
	text-align: center;
	font-family: sans-serif;
}

table.plan{
	margin: auto;
	border-spacing: 5px 0 0 0;
}

table.plan tr.planrow:nth-child(even){
	background: #3a3a3a;
}

table.plan tr.planrow:nth-child(odd){
	background: #565656;
}

td.icon{
	color: white;
	text-align: center;
	vertical-align: middle;
	width: 70px;
	height: 70px;
	font-size: 32px;
	font-weight: bold;
	
}

td.info{
	width: 300px;
	color: white;
	padding: 7px 7px 7px 20px;
}

td.info div.time{
	font-size: 20px;
	font-weight: bold;
}

td.info div.label{
	font-size: 13px;
}

td.info div.time span.timeDiff{
	color: #cb0e0e;
	font-size: 14px;
}

div#curTime{
	position:absolute;
	right: 20px;
	top: 20px;
	color: white;
	font-weight: bold;
	font-size: 24px;
}

table.plan tr.headline td{
	color: white;
	font-weight: bold;
	font-size: 18px;
	text-align: center;
	height: 40px;
	background-color: #707070;
}

-->
</style>
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

<table class="plan" cellpadding="0">

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
