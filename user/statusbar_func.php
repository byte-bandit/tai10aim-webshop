<?
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			users
		WHERE
			id = ".$_SESSION['user_id']."
	";
	
	$db->query($sql);
	$row = $db->fetch_object();
	
	$db->disconnect();
?>