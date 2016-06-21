<?php

	require_once('authgate.php');
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			db_admins
		WHERE
			id = ".$_SESSION['admin_id']."
	";
	
	
	
	$db->query($sql);
	
	
	$row = $db->fetch_object();
	$return = require_once('admin_func_check.php');
	$db->disconnect();
	
?>
<html>
	<head>
		<meta http-equiv="refresh" content="0; URL=index.php?pid=account_conf">
		<title>Administration</title>
	</head>
	<body>
		<?php
			
			echo($return);
		?>
		<br>
		<br>
		Sie werden in 1 Sekunden weitergeleitet!
	</body>
</html>