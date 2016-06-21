<?php
	session_start();
	$_SESSION['login'] = 0;
	unset($_SESSION['login']);
?>
<html>
	<head>
		<meta http-equiv="refresh" content="2; URL=index.php">
		<title>Administration</title>
	</head>
	<body>
		Vielen Dank!
		<br>
		Sie werden in 2 Sekunden weitergeleitet!
	</body>
</html>