<?php
	require_once('../authgate.php');
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('products.php');
	
	$db = new database();
	$db->connect();
	
	$sql = "SELECT
				*
			FROM
				users
			WHERE
				id = {$_SESSION['user_id']}
	";
	
	$db->query($sql);
	$row = $db->fetch_object();
	
	$ip=$_SERVER['REMOTE_ADDR'];
	
	$sql = "INSERT INTO
				comments
			(
				id,
				product_id,
				user_id,
				timestamp,
				ip,
				content,
				rating
			)
			VALUES
			(
				NULL,
				{$_GET['id']},
				{$_SESSION['user_id']},
				CURRENT_TIMESTAMP,
				'{$ip}',
				'{$_POST['commentfield']}',
				{$_POST['points']}
			)
	;";
	$db->query($sql);
	$db->disconnect();
	
	$newRate = getRating($_GET['id']);
	setRating($_GET['id'], $newRate);

?>
<html>
	<head>
		<meta http-equiv="refresh" content="0; URL=/../index.php?action=viewProduct&id=<?=$_GET['id']?>">
		<title>Kommentar hinzugefügt</title>
	</head>
	<body>
		<br>
		Refresh.
	</body>
</html>
