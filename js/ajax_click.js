/*
* ajax_click.js
* chriscook.me
* edited by ted m
*/

function loadurl(dest) {
	try
	{
		// Moz supports XMLHttpRequest. IE uses ActiveX.
		// browser detction is bad. object detection works for any browser
		xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
	}

	catch (e)
	{
		// browser doesn’t support ajax
		alert("Your browser does not support ajax.\nYou'll need to go here manually: "+dest);
	}

	// the xmlhttp object triggers an event everytime the status changes
	// triggered() function handles the events
	xmlhttp.onreadystatechange = triggered;

	// open takes in the HTTP method and url.
	xmlhttp.open("GET", dest);

	// send the request. if this is a POST request we would have
	// sent post variables: send("name=aleem gender=male")
	// Moz is fine with just send(); but
	// IE expects a value here, hence we do send(null);
	xmlhttp.send("null");
}

function triggered() {
	if ((xmlhttp.readyState == 4) (xmlhttp.status == 200))
	{
		document.getElementById("ajax_click").innerHTML = xmlhttp.responseText;
	}
}