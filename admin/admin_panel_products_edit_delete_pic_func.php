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
	
	unlink('../images/products/'.$row->article_nr.'/'.$_GET['pic']);
	
	if(basename($row->picture_url) == $_GET['pic'])
	{
		$sql = "
			UPDATE
				products
			SET
				`picture_url` = ''
			WHERE
				id={$row->id}
		";
		
		$db->query($sql);
	}
	
	$db->disconnect();
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