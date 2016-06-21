<?php
	session_start();
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


?>
<html>
	<head>
		<meta http-equiv="refresh" content="2; URL=../index.php">
		<title>Log Out</title>
	</head>
	<body>
		Vielen Dank!
		<br>
		Sie werden in 2 Sekunden weitergeleitet!
	</body>
</html>