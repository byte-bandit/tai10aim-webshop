<?php
	session_start();
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	if(!isset($_GET['id']))
	{
		exit('Parameter "ID" not specified');
	}
	
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			products
		WHERE
			id = {$_GET['id']}
	";
	
	$db->query($sql);
	$db->disconnect();
	$row = $db->fetch_object();
	
?>
<html>
	<head>
	</head>
	<body>
		<center>
		<?=$row->name?>
		<br>
		<img src="<?='../'.$row->picture_url?>" alt="pic" style="width:200px; height:200px;">
		<br>
		<br>
		Diesen Artikel wirklich löschen?
		<br>
		<br>
		<form action="edit_product_func.php?action=del&id=<?=$_GET['id']?>" enctype="multipart/form-data" method="post">
		<br>
		<input type="submit" name="input_submit" value="Ja, Produkt wirklich löschen!">
		</form>
		</center>
	</body>
</html>