<?php
	session_start();
	require_once('../../confidential/_GLOBALS.php');	#Global Variables stored offshore for security reasons
	require_once('../class/classloader.php');			#Loads all our classes, so we only have to import them once
	
	$db = new database();
	$db->connect();
	
	$sql = "SELECT
				*
			FROM
				shop_conf
			WHERE
				id = 1
	";
	
	$db->query($sql);
	
	$row = $db->fetch_object();
	
	$db->disconnect();
	
	echo($row->impressum);

?>