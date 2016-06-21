<?php
	session_start();
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	if(!isset($_GET['action']))
	{
		exit('Action not specified');
	}
	
	if($_GET['action'] == 'update')
	{
		$mode = 1;
		$t1 = 'Bild aktualisieren';
	}elseif($_GET['action'] == 'add')
	{
		$mode = 2;
		$t1 = 'Bild hinzufügen';
	}else{
		exit();
	}
	
	if($mode == 1)
	{
		if(!isset($_GET['pic']) || !isset($_GET['artnr']))
		{
			exit('Missing one or more parameters of "pic", "artnr"');
		}
	}
	
?>
<html>
	<head>
	</head>
	<body>
		<center>
		<form action="admin_panel_products_edit_update_pic_func.php?id=<?=$_GET['id']?>&action=<?=$mode?>&pic=<?=$_GET['pic']?>" enctype="multipart/form-data" method="post">
		<input type="hidden" name="max_file_size" value="1000000"><input name="input_picture" type="file" />
		<br>
		<input type="submit" name="input_submit" value="<?=$t1?>">
		</form>
		</center>
	</body>
</html>