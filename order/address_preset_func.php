<?php
	require_once('../user/statusbar_func.php');
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			addresses
		WHERE
			user_id = ".$_SESSION['user_id']."
		AND
			type = '1'
	";
	
	$db->query($sql);
	$row_address1 = $db->fetch_object();
	$sql = "
		SELECT
			*
		FROM
			addresses
		WHERE
			user_id = ".$_SESSION['user_id']."
		AND
			type = '2'
	";
	$db->query($sql);
	$row_address2 = $db->fetch_object();
	$db->disconnect();
?>