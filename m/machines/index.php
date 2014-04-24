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
	<script type="text/javascript">
	$(document).ready(function() {
		function refresh(){ location.reload(true); }
		$('#refresh-button').click(function() { refresh(); });
	}); 
	</script>
</head> 

<body> 
	<div data-role="page" class="type-interior">

	<div data-role="header" data-id="head" data-position="fixed">
		<a href="/m/" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a id="refresh-button" href="#" data-icon="refresh" data-iconpos="notext" data-rel="dialog" data-transition="fade">Refresh</a>
		<h1>Nova Labs Machines</h1>
		<div data-role="navbar">
				<ul>
					<li><a href="/m/about/" data-prefetch="true" data-transition="slidefade">About</a></li>
					<li><a href="/m/environment/" data-transition="slidefade">Environment</a></li>
					<li><a href="/m/events/" data-transition="slidefade">Events</a></li>
					<li><a href="/m/machines/" class="ui-btn-active ui-state-persist">Machines</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /header -->
	
	<div data-role="content">
		<div class="content-primary">
		<ul data-role="listview" data-theme="c" data-divider-theme="d">
		  <li><a href="#"><h4>Laser Cutter (aka Mongo)</h4><p>100W C02 laser.</p><p>Donated by Palantir Technologies.</p></a></li>
		  <li><a href="#"><h4>MendelMax V1.5 3D Printers</h4><p>Uses 1.75mm ABS filament with 0.35mm nozzle</p><p>Donated by Members of Nova Labs.</p></a></li>
		  <li><a href="#"><h4>Blacktoe CNC Router</h4><p>2' x 4' cutting area with 2HP Porter Cable router. We have bits but prefer users bring their own.</p><p>Collocated by Neil M.</p></a></li>
		  <li><a href="#"><h4>LoboCNC Router Mill</h4><p>Bed-type milling machine accurate to one-one-thousandth (DRO accurate to one-ten-thousandth)</p><p>X,Y,Z travel is 10" x 8" x 7". Max jog speed is 45 IPM. Table dimensions 15" x 4".</p><p>Use to cut woods, plastics, carbon fiber, fiber glass, aluminum, brass.</p></a></li>
		  <li><a href="#"><h4>US Cutter Vinyl Cutter</h4><p>34" cut width, continuous feed. ThermoFlex Plus vinyl rumored to work best.</p></a></li>
		  <li><a href="#"><h4>Harbor Freight Mill / Lathe Machine</h4><p>Model #44142</p>
		  <p>18" x 7" carriage and cross slide travel</p>
		  <p>Tapers: MT4 main chuck / MT2 tail stock</p>
		  </a></li>
		</ul>
		</div><!--/content-primary -->		

		<div class="content-secondary">
		</div>

		</div><!-- /content -->
		</div><!-- /page -->
		</body>
		</html>
