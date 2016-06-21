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
					db_admins (id, name, pw_hash, email, active)
				VALUES 
					(NULL, '".$_POST['input_name']."', '".hash_hmac($GLOBALS_encryptions_passwords_algorythm, $_POST['input_password'], $GLOBALS_encryptions_passwords_key)."', '".$_POST['input_email']."', '1')
			";
			
			$result = $db->query($sql);
			
			if($result)
			{
				$return = 'Admin '.$_POST['input_name'].' wurde angelegt.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			
			break;
		
		case 'del':
			$result = $db->query('DELETE FROM db_admins WHERE id = '.$_GET['id'].';');
			if($result)
			{
				$return = 'Admin '.$_POST['input_name'].' wurde gelöscht.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			break;
			
		case 'set_active':
			$result = $db->query('UPDATE db_admins SET active = 1 WHERE id = '.$_GET['id'].';');
			if($result)
			{
				$return = 'Admin wurde aktiviert.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			break;
		
		case 'set_inactive':
			$result = $db->query('UPDATE db_admins SET active = 0 WHERE id = '.$_GET['id'].';');
			if($result)
			{
				$return = 'Admin wurde deaktiviert.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			break;
			
		case 'edit':
			$result = $db->query("UPDATE db_admins SET name = '".$_POST['input_name']."', email = '".$_POST['input_email']."' WHERE id = ".$_GET['id'].";");
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
		<meta http-equiv="refresh" content="1; URL=index.php?pid=admin_conf">
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