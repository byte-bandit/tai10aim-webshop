<?php
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
$db = new database();
$db->connect();
$sql="
	SELECT
		*
	FROM 
		purchases
	WHERE 
		id = {$_GET['order_id']}
	";
$db->query($sql);
$row=$db->fetch_object();
if($row->user_id == $_SESSION['user_id'])
	{
	$sql="
		DELETE FROM
			article_per_order
		WHERE
			order_id = {$_GET['order_id']}
	";
	$db->query($sql);
	$sql="
		UPDATE
			purchases
		SET
			type = 4, 
			pay_date = CURRENT_TIMESTAMP
		WHERE
			id = {$_GET['order_id']}
	";
	$db->query($sql);
	$db->disconnect();
	}
else
{
$return ='User-Id und/oder Bestellung nicht gefunden. Abbruch!';
}
	
?>	
<html>
	<head>
		<meta http-equiv="refresh" content="<? if($return == '') { echo('0'); } else { echo('2'); } ?>; URL=../index.php?action=profile&pid=orders">
		<title>Profil</title>
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