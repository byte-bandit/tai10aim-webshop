<?php
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	//$ext = pathinfo($_FILES['input_picture']['name'], PATHINFO_EXTENSION);
	//Mandatory security checks (in terms of correct file input) still need to be performed!
	 
	$target_path = '../images/website/banner.png';
		
	if(!move_uploaded_file($_FILES['input_picture']['tmp_name'], $target_path))
	{
		//exit('There was an error uploading your picture! name: '.$_FILES['input_picture']['name']);
		//Chris: Not relevant here ;)
	}	
	
	$db = new database();
	$db->connect();
	
	$sql = "
		UPDATE
			shop_conf
		SET
			`shopname` = '".$_POST['input_name']."',
			`layout` = ".$_POST['input_layout'].",
			`impressum` = '".$_POST['input_impressum']."',
			`agb` = '".$_POST['input_agb']."'
		WHERE
			id=1
	";
	
	if(!$result = $db->query($sql))
	{
		echo($result.'<br>');
		exit('There was an error uploading the new info to the database.');
	}
	
	$db->disconnect();
?>

<html>
	<head>
		<meta http-equiv="refresh" content="0; URL=index.php?pid=shop_conf">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Administration</title>
	</head>
	<body>
	<center>
		Ihre &Auml;nderungen wurden &uuml;bernommen!<br><br>
	</center>
	</body>
</html>
