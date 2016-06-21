<?php

	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	if ($_GET['reset'] == 1)
	{
		$db = new database();
		$db->connect();
		
		$sql = "SELECT
					*
				FROM
					db_admins
				WHERE
					id = ".$_GET['id']."
		";
		
		$db->query($sql);
		
		$row = $db->fetch_object();
		
		
		$pwReset = md5($row->name.$row->email.time());
		
		$sql = "UPDATE
					db_admins
				SET
					pw_hash = '".hash_hmac($GLOBALS_encryptions_passwords_algorythm, $pwReset, $GLOBALS_encryptions_passwords_key)."'
				WHERE
					id = ".$_GET['id']."
		";
		
		$db->query($sql);
		
		$db->disconnect();

		
		$to = $row->email;
		$subject = "Ihr Webshop Konto wurde zurückgesetzt.";
		$msg = "Hallo ".$row->name."!<br>Dein Passwort wurde zurückgesetzt. Logge dich bitte mit diesem Kennwort ein, um dein Passwort zu ändern.<br><br>".$pwReset."<br><br>";
		mail($to,$subject,$msg);
	}
	
?>
<html>
	<head>
		<title>Passwort zur&uuml;cksetzen</title>
	</head>
	<body>
		<?php
			
			if($_GET['reset'] == 1)
			{
				echo('Das Passwort wurde zurückgesetzt! Eine Nachricht wurde an '.$row->email.' gesendet.<br>Sie k&ouml;nnen dieses Fenster jetzt schließen.');
			}else{
				?>
				Klicken Sie <a href="reset_admin_pw.php?reset=1&id=<? echo($_GET['id']); ?>">hier</a>, um das Kennwort zurückzusetzen.
				<?
			}
		?>
	</body>
</html>
