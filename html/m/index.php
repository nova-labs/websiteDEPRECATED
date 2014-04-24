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
		<a href="/m/" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-active ui-state-persist">Home</a>
		<a id="refresh-button" href="#" data-icon="refresh" data-iconpos="notext" data-rel="dialog" data-transition="fade">Refresh</a>
		<h1>Nova Labs Mobile</h1>
		<div data-role="navbar">
				<ul>
					<li><a href="/m/about/" data-prefetch="true" data-transition="slidefade">About</a></li>
					<li><a href="/m/environment/" data-transition="slidefade">Environment</a></li>
					<li><a href="/m/events/" data-transition="slidefade">Events</a></li>
					<li><a href="/m/machines/" data-transition="slidefade">Machines</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /header -->
	
	<div data-role="content">
		<div class="content-primary" style="text-align:center;">
		<p><strong>Welcome to Nova Labs Mobile!</strong></p>
		<p>Choose a link above.</p>
		
		</div><!--/content-primary -->		

		<div class="content-secondary">
		</div>

		</div><!-- /content -->
		</div><!-- /page -->
		</body>
		</html>
