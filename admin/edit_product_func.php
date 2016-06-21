<?php
	session_start();
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
	
	if($_GET['action'] == 'update')
	{
	//DONT RENAME THE ARTICLE NUMMER JUST YET
	// if($_POST['input_article_nr'] <> $row->article_nr)
	// {
		// if(!rename("../images/products/".$row->article_nr, "../images/products/".$_POST['input_article_nr']))
		// {
			// $db->disconnect();
			// exit("Aktualisieren der Artikelnummer nicht möglich.");
		// }
	// }
	
	$sql = "
			UPDATE
				products
			SET
				`name` = '{$_POST['input_name']}',
				`desc` = '{$_POST['input_desc']}',
				`category_id` = {$_POST['input_kategorie']},
				`size` = {$_POST['input_size']},
				`amount` = {$_POST['input_amount']},
				`price` = {$_POST['input_price']},
				`article_nr` = '{$_POST['input_article_nr']}',
				`location` = '{$_POST['input_location']}'
			WHERE
				id={$_GET['id']}
		";
		
	$db->query($sql);
	$db->disconnect();
	}elseif($_GET['action'] == 'del') {
		
		delete_directory('../images/products/'.$row->article_nr);
	
		$sql = "
			DELETE FROM
				products
			WHERE
				id={$_GET['id']}
		";
		$db->query($sql);
		$db->disconnect();
		
	}
	
	
	
	
	function delete_directory($dirname)
	{
	
    if (is_dir($dirname))
		$dir_handle = opendir($dirname);
        if (!$dir_handle)
          return false;
       while($file = readdir($dir_handle)) {
          if ($file != "." && $file != "..") {
             if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
             else
                delete_directory($dirname.'/'.$file);    
          }
       }
       closedir($dir_handle);
       rmdir($dirname);
       return true;
    }
     

?>
<html>
	<head>
		<title>Administration</title>
		<meta http-equiv="refresh" content="0; URL=index.php?pid=products">
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
		top.location.href="index.php?pid=products";
		}

		window.setTimeout("grey_frame_close()", closetime*1000);

		</script>
	</head>
	<body>

	</body>
</html>