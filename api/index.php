<?php 
// pull status from lumisense server (where all the status events are logged for now)
$status = json_decode(file_get_contents('http://lumisense.com/nova-labs/status/CheckStatus.php?mode=json'),true);

// a little data massage. Use boolean for door value and epoch timestamp for lastChanged parameter
$doorValue = (($status['doorvalue'] == 1)?true:false);
$doorTimestamp = strtotime($status['timestamp']);

/*
  index.php - a source file for SpaceAPI.net to get Nova Labs in the database
  print header
  get open/closed
  print contact and other static info
*/


header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-cache');


$data = array(
	"api" => "0.13",
	"space" => "Nova Labs",
	"logo" => "http://nova-labs.org/images/nova-labs_icon_160x160.png",
//	"logo" => "http://nova-labs.org/images/NOVALabs-big.png",
	"url" => "http://nova-labs.org",
	"location" => array(
		"address" => "1881 Metro Center Drive Unit F, Reston, VA 20190 USA",
		"lon" =>  -77.339477,
		"lat" =>  38.950810,
	),
	"contact" => array(
		"email" => "membership@nova-labs.org",
		"phone" => "+1 (571) 313-8908",
		"twitter" => "@novalabs",
	),
	"issue_report_channels" => array("email"),
	"state" => array(
		"open" => $doorValue,
		"lastchange" => $doorTimestamp,
//		"message" => "",
		"icon" => array(
			"open" => "http:\/\/status.raumzeitlabor.de\/images\/green.png",
			"closed" => "http:\/\/status.raumzeitlabor.de\/images\/red.png",
		),
	),
	"cache" => array("schedule" => "h.02"),
	"open" => $doorValue,
	"status" => "",
	"icon" => array(
		"open" => "http:\/\/status.raumzeitlabor.de\/images\/green.png",
		"closed" => "http:\/\/status.raumzeitlabor.de\/images\/red.png",
	),
//	"sensors" => array(
//		"people_now_present" => array(27),
//	),
);

echo json_encode($data); ?>
