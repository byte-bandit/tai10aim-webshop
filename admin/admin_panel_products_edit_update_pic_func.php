<?php

	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	  
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			products
		WHERE
			id={$_GET['id']}
	";
	$db->query($sql);
	$row = $db->fetch_object();
	$ext = pathinfo($_FILES['input_picture']['name'], PATHINFO_EXTENSION);
	
	//Mandatory security checks (in terms of correct file input) still need to be performed!
	
	if(!file_exists('../images/products/'.$row->article_nr))
	{
		mkdir('../images/products/'.$row->article_nr);
	}
  
	$target_path = 'images/products/'.$row->article_nr.'/'.date('YmdHi').'.'.$ext;
  
	if(!move_uploaded_file($_FILES['input_picture']['tmp_name'], '../'.$target_path))
	{
		exit('There was an error uploading your picture!');
	}
	
	if($_GET['action'] == 1)
	{
	if(basename($row->picture_url) == $_GET['pic'])
	{
		$sql = "
			UPDATE
				products
			SET
				`picture_url` = '{$target_path}'
			WHERE
				id={$row->id}
		";
		
		$db->query($sql);
	}
	
	unlink('../images/products/'.$row->article_nr.'/'.$_GET['pic']);
	}
?>
<html>
	<head>
		<title>Administration</title>
		    <script type="text/javascript">
				var GB_ROOT_DIR = "./greybox/";
			</script>

			<script type="text/javascript" src="greybox/AJS.js"></script>
			<script type="text/javascript" src="greybox/AJS_fx.js"></script>
			<script type="text/javascript" src="greybox/gb_scripts.js"></script>
			<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />

		<script type="text/javascript" language="JavaScript">
		closetime = 0;

		function grey_frame_close() {
		top.document.getElementById("GB_window").style.visibility = "hidden";
		top.document.getElementById("GB_overlay").style.visibility = "hidden";
		top.location.reload();
		}

		window.setTimeout("grey_frame_close()", closetime*1000);

		</script>
	</head>
	<body>

	</body>
</html>