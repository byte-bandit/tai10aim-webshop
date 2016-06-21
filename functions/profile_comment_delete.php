<?php
	require_once('../authgate.php');
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
$return='';
$db = new database();
$db->connect();
$sql="
	SELECT
		*
	FROM 
		comments
	WHERE 
		id = {$_GET['comment_id']}
	";
$db->query($sql);
$row=$db->fetch_object();
if($row->user_id == $_SESSION['user_id'])
	{
	$sql="
		DELETE FROM
			comments
		WHERE
			id = {$_GET['comment_id']}
	";
	$db->query($sql);
	$db->disconnect();
	}
else
{
$return ='User-Id und/oder Kommentar nicht gefunden. Abbruch!';
}
	
?>	
<html>
	<head>
		<meta http-equiv="refresh" content="<? if($return == '') { echo('0'); } else { echo('2'); } ?>; URL=../index.php?action=profile&pid=comments">
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
