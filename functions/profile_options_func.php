<?php

	require_once('../authgate.php');
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	
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

	$return = '';
	
	
	if(hash_hmac($GLOBALS_encryptions_passwords_algorythm, $_POST['input_password_old'], $GLOBALS_encryptions_passwords_key) <> $row->password_hash)
	{
		$return = 'Password is incorrect.';
	}
	
	if(strlen($_POST['input_password_new']) > 0)
	{
		if($_POST['input_password_new'] <> $_POST['input_password_new2'])
		{
			$return = 'Field "repeat password" does not match field "password"';
		}
		
		//At this point, all the entries in the formular should be correct
		//A new password is tried to be set
		$sql = "UPDATE
					users
				SET
					prename = '".$_POST['input_prename']."',
					surname = '".$_POST['input_name']."',
					email = '".$_POST['input_email']."',
					password_hash = '".hash_hmac($GLOBALS_encryptions_passwords_algorythm, $_POST['input_password_new'], $GLOBALS_encryptions_passwords_key)."'
				WHERE
					id = ".$row->id."
		";
		
		$result2 = $db->query($sql);
		
		//make user login again
		//require_once('../user/logout.php'); //not required 
	}else{
		//At this point, all the entries in the formular should be correct
		//No new password is tried to be set
		$sql = "UPDATE
					users
				SET
					prename = '".$_POST['input_prename']."',
					surname = '".$_POST['input_name']."',
					email = '".$_POST['input_email']."'
				WHERE
					id = ".$row->id."
		";
		$result2 = $db->query($sql);
	}
	
	
	
	
	$db->disconnect();
	
?>
<html>
	<head>
		<meta http-equiv="refresh" content="<? if($return == '') { echo('0'); } else { echo('2'); } ?>; URL=../index.php?action=profile&pid=options">
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