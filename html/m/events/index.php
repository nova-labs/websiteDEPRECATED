<?php
	require_once('MeetupAPIClientForPHP/Meetup.php');
	require_once('MeetupAPIClientForPHP/MeetupApiRequest.class.php');
	require_once('MeetupAPIClientForPHP/MeetupApiResponse.class.php');
	require_once('MeetupAPIClientForPHP/MeetupConnection.class.php');
	require_once('MeetupAPIClientForPHP/MeetupExceptions.class.php');
	require_once('MeetupAPIClientForPHP/MeetupEvents.class.php');

	/* FUNCTIONS =============================================================== */
	
	/* VARIABLES =============================================================== */
	$pageSize = 20;
	$pageOffset = 0;
	/* CONNECTION ============================================================== */

	
	// Meetup API
	$meetupApiKey = '487c5610485011526e3194a4aa7324'; // Ted Markson
	$meetupConnection = new MeetupKeyAuthConnection($meetupApiKey);
	$meetupHandle = new MeetupEvents($meetupConnection);
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
	<script type="text/javascript">
	$(document).ready(function() {
		function refresh(){ location.reload(true); }
		$('#refresh-button').click(function() { refresh(); });
	}); 
	</script>
</head> 


<body>
<div data-role="page" class="type-interior"  style="text-align:center;">

	<div data-role="header" data-id="head" data-position="fixed">
		<a href="/m/" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a id="refresh-button" href="#" data-icon="refresh" data-iconpos="notext" data-rel="dialog" data-transition="fade">Refresh</a>
		<h1>Nova Labs Events</h1>
		<div data-role="navbar">
				<ul>
					<li><a href="/m/about/" data-prefetch="true" data-transition="slidefade">About</a></li>
					<li><a href="/m/environment/" data-transition="slidefade">Environment</a></li>
					<li><a href="/m/events/" class="ui-btn-active ui-state-persist">Events</a></li>
					<li><a href="/m/machines/" data-transition="slidefade">Machines</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /header -->
	
	
<div data-role="content">
<ul data-role="listview" data-theme="c" data-divider-theme="d">
<?php
	/* MAIN ==================================================================== */
	date_default_timezone_set('America/New_York');

	// Parameters for meetup api request
	$params = array(
		'group_id'=>3629072,  // Nova Makers meetup group id
		'page'=>$pageSize,
		'offset'=>$pageOffset,
	);
	$events = $meetupHandle->getEvents( $params );

	// Stop if meetup returns no data
	if (count($events) <= 0) break;

	// First category print
	echo "<li data-role='list-divider'>This Week</li>";

	// Today's time in sec since epoch
	$now = time();


	// For each member make a new record
	foreach($events as $event)
	{
		// Current event's time in seconds since epoch
		$currentEventTime = ($event['time']/1000);

		$id             = $event['id'];
		$visibility     = $event['visibility'];
		$status         = $event['status'];
		$name           = $event['name'];
		$yes_rsvp_count = $event['yes_rsvp_count'];
		$updated        = date('D, M d g:iA',$event['updated']/1000);
		$created        = date('D, M d g:iA',$event['created']/1000);
//		if(new DateTime("yesterday") < new DateTime($currentEventTime) < new DateTime("tomorrow"))
//		{
//			$event_time = date('Today at g:iA',$currentEventTime);
//		}
//		if(new DateTime(time()) < new DateTime($currentEventTime) < new DateTime("tomorrow"))
//		else
//		{
//		}

		$event_time     = date('D, M d g:iA',$currentEventTime);
		$venue          = "{$event['venue']['name']}, {$event['venue']['city']}, {$event['venue']['state']}";
		$description    = $event['description'];
		$event_url      = $event['event_url'];


		// Calculate event's time difference in weeks
		switch(intval(($currentEventTime - $now) / (604800)))
		{
			case 1: $printStr = "Next Week"; break;
			case 2: $printStr = "In two weeks"; break;
			case 3: $printStr = "In three weeks"; break;
			case 4: $printStr = "More than a month away"; break;
		}

		// If event is in next week, end the group 
		if($lastPrintStr != $printStr)
		{
			echo "<li data-role='list-divider'>{$printStr}</li>";

			$lastPrintStr = $printStr;
		}
		echo "<li><a href='{$event_url}'>";
		echo "<h4>{$name}</h4>";
		echo "<p>{$event_time}</p>";
		echo "<p>{$venue_name}</p>";
		echo "<p class='ui-li-aside'><strong>{$yes_rsvp_count} Going</strong></p>";
		echo "</a></li>";
	}
?>
</ul>
</div>


<div data-role="footer" class="footer-docs" data-theme="c">
		<p>&copy; 2012 Nova Labs Inc</p>
</div>
	
</div><!-- /page -->

</body>
</html>
