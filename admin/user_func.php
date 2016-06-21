<?php
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	$db = new database();
	$db->connect();
	
	switch($_GET['action'])
	{
		case 'add':
			$result = $db->query("INSERT INTO users (id, name, prename, surname, password_hash, email, active) VALUES (NULL, '".$_POST['input_name']."', '".$_POST['input_prename']."', '".$_POST['input_surname']."', '".hash_hmac($GLOBALS_encryptions_passwords_algorythm, $_POST['input_password'], $GLOBALS_encryptions_passwords_key)."', '".$_POST['input_email']."', '1');");
			
			if($result)
			{
				$return = 'Admin '.$_POST['input_name'].' wurde angelegt.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			
			break;
		
		case 'del':
			$result = $db->query('DELETE FROM users WHERE id = '.$_GET['id'].';');
			if($result)
			{
				$return = 'User wurde gelöscht.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			break;
			
		case 'edit':
			if($_POST['input_name'] <> "" and $_POST['input_prename'] <> "" and $_POST['input_surname'] <> "" and $_POST['input_email'] <> "")
			{
				if(isset($_POST['input_password']) and $_POST['input_password'] <> "")
				{
					$pwhash = ", password_hash = '".hash_hmac($GLOBALS_encryptions_passwords_algorythm, $_POST['input_password'], $GLOBALS_encryptions_passwords_key)."'";
				}else{
					$pwhash = "";
				}
				$result = $db->query("UPDATE users SET name = '".$_POST['input_name']."', prename = '".$_POST['input_prename']."', surname = '".$_POST['input_surname']."', email = '".$_POST['input_email']."'".$pwhash." WHERE id = ".$_GET['id'].";");
				if($result)
				{
					$return = 'User wurde gelöscht.';
				}else{
					$return = 'Versuch fehlgeschlagen.';
				}
			}
			break;
			
		case 'set_active':
			$result = $db->query('UPDATE users SET active = 1 WHERE id = '.$_GET['id'].';');
			if($result)
			{
				$return = 'User wurde aktiviert.';
			}else{
				$return = 'Versuch fehlgeschlagen.';
			}
			break;
		
		case 'set_inactive':
			$result = $db->query('UPDATE users SET active = 0 WHERE id = '.$_GET['id'].';');
			if($result)
			{
				$return = 'User wurde deaktiviert.';
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
		<meta http-equiv="refresh" content="0; URL=index.php?pid=user_conf">
		<title>Administration</title>
	</head>
	<body>
		<?php
			
			//echo($return);
			//echo($result);
			//echo($pwhash);
		?>
	</body>
</html>