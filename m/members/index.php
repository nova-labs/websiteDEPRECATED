<?php
	require_once('MeetupAPIClientForPHP/Meetup.php');
	require_once('MeetupAPIClientForPHP/MeetupApiRequest.class.php');
	require_once('MeetupAPIClientForPHP/MeetupApiResponse.class.php');
	require_once('MeetupAPIClientForPHP/MeetupConnection.class.php');
	require_once('MeetupAPIClientForPHP/MeetupExceptions.class.php');
	require_once('MeetupAPIClientForPHP/MeetupMembers.class.php');

	/* FUNCTIONS =============================================================== */
	function requestAllMeetupMembers($meetupHandle,$pageSize,$groupId)
	{
		// Start requests from 0
		$pageOffset = 0;
		$pageSize = 200;

		// Make members array
		$members = array ();

		do {
			// Parameters for Meetup API request
			$params = array(
				'group_id'=>$groupId,  // Nova Makers Meetup group ID
				'page'=>$pageSize,
				'offset'=>$pageOffset,
			);
			try
			{
				$received = $meetupHandle->getMembers( $params );
			} catch (Exception $e) {
				echo "{$e->getMessage()}\n";
			}

			// Merge received elements into all collected elements
			$members = array_merge($members,$received);

			// Will ask for next page
			$pageOffset++;
		} while(count($received) >=1 AND $pageOffset < 10);
		return $members;
	}
	
	/* VARIABLES =============================================================== */
	$pageSize = 20;
	$pageOffset = 0;
	$groupId  = 3629072;  // Nova Makers Meetup group ID
	$noPhotoUrl = 'http://img2.meetupstatic.com/2982428616572973604/img/noPhoto_80.gif';

	/* CONNECTION ============================================================== */

	
	// Meetup API
	$meetupApiKey = '487c5610485011526e3194a4aa7324'; // Ted Markson
	$meetupConnection = new MeetupKeyAuthConnection($meetupApiKey);
	$meetupHandle = new MeetupMembers($meetupConnection);
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
<div data-role="page" class="type-interior" style="text-align:center;">

	<div data-role="header" data-id="head" data-position="fixed">
		<a href="./" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a id="refresh-button" href="#" data-icon="refresh" data-iconpos="notext" data-rel="dialog" data-transition="fade">Refresh</a>
		<h1>Nova Labs Members</h1>
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
<ul data-role="listview" data-theme="c" data-divider-theme="d" data-filter="true" data-filter-placeholder="Search members..." data-split-icon="gear" data-split-theme="c">
<?php
	/* MAIN ==================================================================== */
	date_default_timezone_set('America/New_York');

	// Looping requests to Meetup for all members. Set variables at top of file
	$members = requestAllMeetupMembers($meetupHandle,$pageSize,$groupId);

	// Display member rows
	foreach($members as $member)
	{
		$id         = $member['id'];
		$name       = $member['name'];
		$city       = $member['city'];
		$state      = $member['state'];
		$joined     = $member['joined'];
		$visited    = $member['visited'];
		$person_url = $member['link'];
		$thumb_url  = (!empty($member['photo'])?$member['photo']['thumb_link']:$noPhotoUrl);
		$bio        = (!empty($member['bio'])?$member['bio']:'');

		echo "<li><a href='{$person_url}'>";
//		echo "<img style='width:45px;' src='{$thumb_url}' />";
		echo "<h4>{$name}</h4>";
		echo "<p>{$bio}</p>";
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
