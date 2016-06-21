<?php

	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	$db = new database();
	$db->connect();
	
	switch($_GET['action'])
	{
		case 'add':
			$sql = "
				INSERT INTO 
					locations (id, name)
				VALUES 
					(NULL, '".$_POST['input_name']."')
			";
			
			$result = $db->query($sql);
			
			if($result)
			{
				$return = 'Lagerplatz '.$_POST['input_name'].' wurde angelegt.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			
			break;
		
		case 'del':
			$sql = "UPDATE
						products
					SET
						location = ''
					WHERE
						location = {$_GET['id']}
				";
			$db->query($sql);
			
			
			$sql = "DELETE FROM
						locations
					WHERE
						id={$_GET['id']}
			";
			$result = $db->query($sql);
			if($result)
			{
				$return = 'Lagerplatz wurde gelöscht.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			break;
			
		case 'edit':
			$sql = "UPDATE
						locations
					SET
						name='{$_POST['input_name']}'
					WHERE
						id={$_GET['id']}
			";
			$result = $db->query($sql);
			if($result)
			{
				$return = 'Die &Auml;nderungen wurden &uuml;bernommen.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			break;
			
		default:
			break;
	}
	
	$db->disconnect();
	
	
?>
<html>
	<head>
		<meta http-equiv="refresh" content="1; URL=index.php?pid=location_conf">
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