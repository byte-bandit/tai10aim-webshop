<?
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	switch($_GET['action'])
	{
		case 'setStatus':
			$db = new database();
			$db->connect();
			
			$sql = "
				UPDATE
					purchases
				SET
					status = {$_POST['input_status']}
				WHERE
					id = {$_GET['id']}
			";
			$db->query($sql);
			$db->disconnect();
			break;
		
		case 'archive':
			$db = new database();
			$db->connect();
			
			$sql = "
				UPDATE
					purchases
				SET
					archive = 1
				WHERE
					id = {$_GET['id']}
			";
			$db->query($sql);
			$db->disconnect();
			break;
	}
?>

<html>
	<head>
		<meta http-equiv="refresh" content="0; URL=index.php?pid=orders">
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