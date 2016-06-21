<?php
  require_once('../../confidential/_GLOBALS.php');
  require_once('../class/classloader.php');
  session_start();
  
  $user = new User();
  if($nr = $user->add($_POST['login'], $_POST['prename'], $_POST['name'], $_POST['pw1'], $_POST['mail1']))
  {
	$_SESSION['user_login'] = 1;
	$_SESSION['user_id'] = $nr;
  }
?>
<html>
	<head >
		<title>Registrierung beim Web Shop</title>
		<script type="text/javascript">
			var GB_ROOT_DIR = "http://tai10aim.cwsurf.de/greybox/";
		</script>
		<script type="text/javascript" src="greybox/AJS.js"></script>
		<script type="text/javascript" src="greybox/AJS_fx.js"></script>
		<script type="text/javascript" src="greybox/gb_scripts.js"></script>
		<script type="text/javascript" language="JavaScript">
			closetime = 0;

			function grey_frame_close() {
			top.document.getElementById("GB_window").style.visibility = "hidden";
			top.document.getElementById("GB_overlay").style.visibility = "hidden";
			top.location.reload();
			}

			window.setTimeout("grey_frame_close()", closetime*1000);

		</script>
		<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
		<link href="style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	</body>
</html>