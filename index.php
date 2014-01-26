<?php
require_once("Config.class.php");
Config::init();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>MDV Fahrplan</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="media/style.css" type="text/css">

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="media/jquery.newsfade.1.0.js"></script>

<script>
(function($){
    $(document).ready(function(){
        $.ajaxSetup({
            cache: false,
            beforeSend: function(){
                $('#loading').show();
            },
            complete: function(){
                $('#loading').hide();
            },
            success: function(){
                $('#loading').hide();
            }
        });

		//plan table refresh
        $("#content").load("content.php");
        var contentRefreshId = setInterval(function(){
            $("#content").load('content.php');
        }, <?php echo Config::$pref['refreshplan'] * 1000 ?>);
        
        
		//temperature refresh
        $("#temp").load("metadata.php?get=temp");
        var tempRefreshId = setInterval(function(){
            $("#temp").load("metadata.php?get=temp");
        }, <?php echo Config::$pref['refreshtemp'] * 1000 ?>);
        
        
        loadnews();
        showTime();
        
    });
})(jQuery);


//load news and start fading
function loadnews(){
	$("#news_content").load("news.php", function(){
		$('#news_content li').hide();
		fadeinout($('#news_content li:first'));
	});
}

//function for fading news elements      
function fadeinout(e){
	e.delay().fadeIn().delay(<?php echo Config::$pref['refreshnews'] * 1000 ?>).fadeOut(function(){
		if(e.next().length > 0){
			fadeinout(e.next());
		}else{
			loadnews();
		}
	});	
}

//show system time
function showTime(){
	var date=new Date();
	var h = date.getHours();
	var m = date.getMinutes();
	
	//always show two digits
	h = checkTime(h);
	m = checkTime(m);
	$("#curTime").text(h + ":" + m);
	t = setTimeout('showTime()',1000);
}

//helper function: add 0 so that there are always two digits
function checkTime(i){
	if(i < 10){
		i = "0" + i;
	}
	return i;
}

</script>

</head>

<body>

<table style="width: 100%;">
<tr id="content" style="vertical-align: top;"></tr>
</table>


<div class="news_wrapper">
	<ul id="news_content"></ul>
</div>


<div id="curTime"></div>
<div id="temp"></div>


<div id="loading">Refreshing...</div>


</body>
</html>
