<?php
	
	#File: index.php
	#Author: Christian Lohr
	#Desc: Wrapper and Bootup all functions, create the displayed page
	
	
	session_start();
	require_once('../../confidential/_GLOBALS.php');	#Global Variables stored offshore for security reasons
	require_once('../class/classloader.php');			#Loads all our classes, so we only have to import them once
	
	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta name="lohr" content="admintool">
		<title>Administration</title>
		<script type="text/javascript">
			var GB_ROOT_DIR = "../greybox/";
		</script>
		<script type="text/javascript" src="tinyeditor.js"></script>
		<script type="text/javascript" src="../greybox/AJS.js"></script>
		<script type="text/javascript" src="../greybox/AJS_fx.js"></script>
		<script type="text/javascript" src="../greybox/gb_scripts.js"></script>
		<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
			if(!isset($_SESSION['login']) or $_SESSION['login'] <> 1)
			{
				require_once('login_panel.php');		#Admin not logged in. Show Login Panel
			}else{
				require_once('admin_panel.php');		#Admin successfully logged in. Show Admin Control Panel
			}
		?>
	</body>
</html>
