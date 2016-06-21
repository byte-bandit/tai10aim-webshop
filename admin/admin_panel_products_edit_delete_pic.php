<?php
	session_start();
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	if(!isset($_GET['id']) || !isset($_GET['pic']) || !isset($_GET['nr']))
	{
		exit('Parameter "ID", "NR" oder "PIC" not specified');
	}
	
?>
<html>
	<head>
	</head>
	<body>
		<center>
		<img src="../images/products/<?=$_GET['nr']?>/<?=$_GET['pic']?>" alt="pic">
		<form action="admin_panel_products_edit_delete_pic_func.php?id=<?=$_GET['id']?>&pic=<?=$_GET['pic']?>" enctype="multipart/form-data" method="post">
		<br>
		<input type="submit" name="input_submit" value="Ja, Bild wirklich löschen!">
		</form>
		</center>
	</body>
</html>