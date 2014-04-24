<?php

require_once '/var/www/github_trigger_config.php';

if (!isset($_GET['token']) || $_GET['token'] !== SECRET_ACCESS_TOKEN ) {
	header('HTTP/1.0 403 Forbidden');
	echo '403 Forbidden.';
} else {
	echo 'Accessed.';

	if ( $_POST['payload'] ) {
		echo 'Redeployed.';
		shell_exec( '/var/www/deploy_html' );
	}
}
?>
