<?php
	function getUrlData($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	$url = "http://lumisense.com/nova-labs/status/CheckStatus.php?mode=json";
	$environment = json_decode(getUrlData($url),TRUE);
?>

<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Nova Labs Mobile</title> 
	<link rel="stylesheet" href="/m/css/jquery.mobile-1.2.0.min.css" />
	<!--<link rel="stylesheet" href="/m/css/novalabs.min.css" />-->
	<script src="/m/js/jquery-1.8.2.min.js"></script>
	<script src="/m/js/jquery.mobile-1.2.0.min.js"></script>
	<script src="/m/js/ajax_click.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		function refresh(){ location.reload(true); }
		$('#refresh-button').click(function() { refresh(); });
//		var refreshId = setInterval("refresh()", 12000);

		// demo to set slider switch value programatically
		// $("#status-switch")[0].selectedIndex = 1;
		// $("#status-switch").slider("refresh");

		// Use slide switch for triggering door switch
		$( "#status-switch" ).on( 'slidestop', function( event )
		{
			var val = $("#status-switch").val();
			//loadurl('http://lumisense.com/nova-labs/status/SetStatus.php?author=mobile&switch='+val);
			refresh();
		});
	}); 
	</script>
</head> 


<body>
<div data-role="page" class="type-interior" style="text-align:center;">

	<div data-role="header" data-id="head" data-position="fixed">
		<a href="/m/" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a id="refresh-button" href="#" data-icon="refresh" data-iconpos="notext" data-rel="dialog" data-transition="fade">Refresh</a>
		<h1>Nova Labs Environment</h1>
		<div data-role="navbar">
				<ul>
					<li><a href="/m/about/" data-prefetch="true" data-transition="slidefade">About</a></li>
					<li><a href="/m/environment/" class="ui-btn-active ui-state-persist">Environment</a></li>
					<li><a href="/m/events/" data-transition="slidefade">Events</a></li>
					<li><a href="/m/machines/" data-transition="slidefade">Machines</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /header -->

	<div data-role="content">
		<form action="#" method="GET">
			<h2>Door Status</h2>
			<style>.containing-element .ui-slider-switch { width: 9em }</style>
			<div class="containing-element">
			<select name="status-switch" id="status-switch" data-role="slider" disabled="disabled">
					<option value="0" <?php if($environment['doorvalue'] == 0) echo 'selected="1"'; ?>>Closed</option>
					<option value="1" <?php if($environment['doorvalue'] == 1) echo 'selected="1"'; ?>>Open</option>
				</select>
			</div>
			<p>Status as of <?php echo $environment['timestamp']." ".date('T'); ?></p>
			<h2>Indoor Temperature</h2>

			<p id="temperature"><?php echo $environment['temperature']; ?>&#176;F</p>
		</form>
	</div>

<!-- /content -->

<div data-role="footer" class="footer-docs" data-theme="c">
		<p>&copy; 2012 Nova Labs Inc</p>
</div>
	
</div><!-- /page -->

</body>
</html>
