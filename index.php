<?php>
  require_once('../confidential/_GLOBALS.php');
  require_once('class/classloader.php');
  //require_once('authgate.php');

  if(isIE())
  {
	exit('Does not work with Internet Explorer, and never will.');
  }
  
  session_start();
  
  	$db = new database() ;
	$db->connect();
	
	$sql = "
		SELECT 
			* 
		FROM
			shop_conf
		LIMIT
			1
	";
	
	$db->query($sql);
	
	$db->disconnect();
	
	$row = $db->fetch_object();
	
	if(isset($_GET['add']) && $_GET['add'] == 1)
	{
		require_once('functions/productadd.php');
	}
?>

<html>
<head>
	<?
		if(isset($_GET['add']) && $_GET['add'] == 1)
		{
			echo('<meta http-equiv="refresh" content="1; URL=index.php?action=viewProduct&id='.$_GET['id'].'">');
		}
	?>
	<title><? echo($row->shopname); ?></title>
	<script type="text/javascript">
		var GB_ROOT_DIR = "greybox/";
	</script>
	<script type="text/javascript" src="greybox/AJS.js"></script>
	<script type="text/javascript" src="greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="greybox/gb_scripts.js"></script>
	<script language="JavaScript" type="text/javascript">
      var panels = new Array('panel1', 'panel2', 'panel3', 'panel4', 'panel5', 'panel6', 'panel7');
      var selectedTab = null;
      function showPanel(tab, name)
      {
        if (selectedTab) 
        {
          selectedTab.style.backgroundColor = '';
          selectedTab.style.paddingTop = '';
          selectedTab.style.marginTop = '4px';
        }
        selectedTab = tab;
        selectedTab.style.backgroundColor = 'white';
        selectedTab.style.paddingTop = '6px';
        selectedTab.style.marginTop = '0px';

        for(i = 0; i < panels.length; i++)
          document.getElementById(panels[i]).style.display = (name == panels[i]) ? 'block':'none';

        return false;
      }
	  function checkLen(ID,ID2) 
	{ 
		maxLen=255; 
		var txt=document.getElementById(ID).value; 
		if(txt.length>maxLen) 
			{ 
			alert("Bitte maximal "+maxLen+" Zeichen eingeben!"); 
			document.getElementById(ID).value=txt.substring(0,maxLen); 
			document.getElementById(ID2).value=0; 
			} 
		else 
			{ 
			document.getElementById(ID2).value=maxLen-txt.length; 
			} 
	} 
    </script>

	<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<link href="style.css" rel="stylesheet" type="text/css" />

	<link rel="icon" href="favicon.png" type="image/png">
	<link rel="shortcut icon" href="favicon.png" type="image/png">
</head>

<body style="background:url(images/website/background.gif) no-repeat fixed top right; background-color:#005aa1;">
	<center>
		<a href="index.php"><img src="images/website/banner.png" width="600"></a>
		<table width="1024" height="768" style="max-height:768; overflow:hidden; background-color:#123456; box-shadow: 10px 10px 20px #000; -moz-border-radius: 15px; border-radius: 15px; padding:25px; opacity:0.975;" border="0"> 
			<colgroup>
				<col width="200">
				<col width="624">
				<col width="200">
			</colgroup>

			<tr valign="top">
				<td>
					<?php include("functions/CategoryShow.php");?>
				</td>				
				<td>
						<?php
							//This feature has been disabled and is not longer in use ~--Christian	
							/*if($_SESSION['user_login'] == 1)
							{
								require_once('user/statusbar.php');
							}
							*/
							include("functions/content_container.php");
						?>
				</td>
				
				<td>
					<?php
						if(!$_SESSION['user_login'] == 1)
							{require_once('user/login_form.php');}
						else{
							require_once('functions/controlCenter.php');
						}
						
						if(isset($_COOKIE['cart_items']))
							{
							require_once('functions/cartview.php');
							echo('<br><br>');
							echo('<table width="100%" class="cart"><tr><td>');
							echo(cartview(2,true));
							if($_SESSION['user_login'] == 1)
							{
								echo("<br><a href='order/index.php' rel='gb_page[640, 580]'>Bestellen</a><br>");
							}else{
								echo('<br><font size="1em">Bitte loggen Sie sich ein, um Ihren Warenkorb zu bestellen.</font>');
							}
							echo('</td></tr></table>');
						}
					?>
				</td>
			</tr>

			<tr>
				<td align="center" colspan="3" >
					<br>
					<ul>
						<li><a href="admin/index.php">Admin</a></li>
						<li><a href="/data/impressum.php" rel="gb_page[640,480]" >Impressum</a></li>
						<li><a href="/data/agb.php" rel="gb_page[640,480]" >AGB´s</a></li>
						<li><a href="http://www.dafk.net/what/" >Mittagspause</a></li>
					</ul>
				</td>
			</tr>
		</table>
	</center>
</body>
</html> 

<?

function isIE() {
  $match=preg_match('/MSIE ([0-9]\.[0-9])/',$_SERVER['HTTP_USER_AGENT'],$reg);
  if($match==0)
    return false;
  else
    return true;
}


?>