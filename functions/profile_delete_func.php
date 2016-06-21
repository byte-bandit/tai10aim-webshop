<?php
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('../authgate.php');
	
	session_start();
	$myID = $_SESSION['user_id'];
	$_SESSION['user_login'] = 0;
	unset($_SESSION['user_login']);
	$_SESSION['user_id'] = 0;
	unset($_SESSION['user_id']);
	
	// unset cookies
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}
	
	$db = new database();
	$db->connect();
	$result = $db->query('UPDATE users SET active = 0 WHERE id = '.$myID.';');
	if($result)
	{
		$return = 'User wurde deaktiviert.';
	}else{
		echo($GLOBALS_error_msg);
		exit();
	}
	
?>

<html>
	<head>
		<meta http-equiv="refresh" content="0; URL=../index.php">
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