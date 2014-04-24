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
		<h1>About Nova Labs</h1>
		<div data-role="navbar">
				<ul>
					<li><a href="/m/about/" data-prefetch="true" class="ui-btn-active ui-state-persist">About</a></li>
					<li><a href="/m/environment/" data-transition="slidefade">Environment</a></li>
					<li><a href="/m/events/" data-transition="slidefade">Events</a></li>
					<li><a href="/m/machines/" data-transition="slidefade">Machines</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /header -->
	
	<div data-role="content">
		<div class="content-primary">
		<p><strong>Nova Labs is a nonprofit MakerSpace located in Reston, Virginia. We provide the space and tools to grow a community where enthusiastic collaborators of any skill level can converge to make things.</strong></p>

<p>Our community interests include:</p>
<ul style="list-style-type:none;"><li>Inventing - Learning - Prototyping - Biology - CNC - Teaching - Electronics - Robotics - 3D Printing - Computer Programming - Machining - Microcontrollers - Woodworking - Networking - IT Security - Knitting and Crocheting - Mechanical Engineering - Sewing - Silkscreening - Arts and Crafts - And much, much more ...</li></ul>

<p>Nova Labs, Inc. is nonprofit corporation managed by a Board of Directors and organized exclusively for educational and scientific purposes as defined by section 501(c)(3) of the Internal Revenue Code. Nova Labs is a sponsored project under School Factory. All donations submitted to School Factory (c/o Nova Labs) are tax deductible.</p>

<h2>Vision</h2>
<p>Our vision is to empower everyone to rediscover the joy of making things.</p>

<h2>Mission</h2>
<p>Our mission is threefold:</p>
<ul>
<li>To provide a community workshop where people can learn, teach and collaborate on technical and industrial works; and,</li>
<li>To promote the usefulness of competence in the technical and industrial arts to the public; and,</li>
<li>To serve as a center of information about the technical and industrial arts for members, schools, other interested groups, and the general public.</li>
</ul>
		</div><!--/content-primary -->		

		<div class="content-secondary">
		</div>

		</div><!-- /content -->
		</div><!-- /page -->
		</body>
		</html>
