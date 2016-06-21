<?php
	if(strlen($_POST['input_name']) < 1)
	{
		return('Field "name" is not a valid value');
	}
	
	if(strlen($_POST['input_email']) < 1)
	{
		return('Field "email" is not a valid value');
	}
	
	if(hash_hmac($GLOBALS_encryptions_passwords_algorythm, $_POST['input_password_old'], $GLOBALS_encryptions_passwords_key) <> $row->pw_hash)
	{
		return('Password is incorrect.');
	}
	
	if(strlen($_POST['input_password_new']) > 0)
	{
		if($_POST['input_password_new'] <> $_POST['input_password_new2'])
		{
			return('Field "repeat password" does not match field "password"');
		}
		
		//At this point, all the entries in the formular should be correct
		//A new password is tried to be set
		$sql = "UPDATE
					db_admins
				SET
					name = '".$_POST['input_name']."',
					email = '".$_POST['input_email']."',
					pw_hash = '".hash_hmac($GLOBALS_encryptions_passwords_algorythm, $_POST['input_password_new'], $GLOBALS_encryptions_passwords_key)."'
				WHERE
					id = ".$row->id."
		";
		
		$result2 = $db->query($sql);
		
		//make user login again
		require_once('logout.php');
	}else{
		//At this point, all the entries in the formular should be correct
		//No new password is tried to be set
		$sql = "UPDATE
					db_admins
				SET
					name = '".$_POST['input_name']."',
					email = '".$_POST['input_email']."'
				WHERE
					id = ".$row->id."
		";
		$result2 = $db->query($sql);
	}
?>