<?php>
  require_once('../../confidential/_GLOBALS.php');
  require_once('../class/classloader.php'); 
  require_once('../authgate.php');

?>
<html>
<head>
	<title>Sample Webshop</title>
	<script type="text/javascript">
		var GB_ROOT_DIR = "../greybox/";
	</script>
	<script type="text/javascript" src="greybox/AJS.js"></script>
	<script type="text/javascript" src="greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="greybox/gb_scripts.js"></script>
	<?php
	require_once('address_preset_func.php');
	$address2="	<script type='text/javascript'>
					var del_street = '".$row_address2->street."';
					var del_number = '".$row_address2->number."';
					var del_zip = '".$row_address2->zipcode."';
					var del_location = '".$row_address2->location."';
				</script>";
	echo($address2);	
	?>
	<script type="text/javascript">
	var step = 1;
	function extraadress()
	{
		if(bill_adress_check.checked==true)
			{
			document.all.bill_adress_field.innerHTML = '';
			}
		else
			{
			document.all.bill_adress_field.innerHTML = 	'<input name="street2" type="text" placeholder="Straße" value="'+del_street+'" required> Ihre Straße</input>'+
														'<input name="number2" type="text" placeholder="Hausnummer" value="'+del_number+'" required> Ihre Hausnummer</input><br/>'+
														'<input name="zipcode2" type="text" placeholder="Postleitzahl" value="'+del_zip+'" required> Ihre Postleitzahl</input>'+
														'<input name="location2" type="text" placeholder="Ort" value="'+del_location+'" required> Ihr Wohnort</input><br/>';
														
			}
	}
	</script>
	<script type="text/javascript" src="order.js"> </script>
	<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<link href="style_order.css" rel="stylesheet" type="text/css" />

	<link rel="icon" href="../favicon.png" type="image/png">
	<link rel="shortcut icon" href="../favicon.png" type="image/png">
</head>
<body>
	<center>
		<table width="624" height="464" style="max-height:768; overflow:hidden; table-border:collapse;" border="0"> 
			<colgroup>
				<col width="624">
			</colgroup>
			
			<tr class="banner">
				<td class="banner">
					<center><a href="tai10aim.cwsurf.de/index.php"><img src="/images/website/banner.png" width="624"></a></center>
				</td>
			</tr>

			<tr>
				<td>
					
						<div id="progresscontent">
							<script type="text/javascript">
							document.write(progressBar(steps, step));
							</script>
						</div>
				</td>
			</tr>
			<tr>
				<td>
					<form method="POST" action="order_accept.php">
						<div class="panel" id="panel1" style="display: visible; ">
							<fieldset>
								<legend >Artikelübersicht</legend>
									<?php
									require_once('../functions/cartview.php');
									echo(cartview(5,false));
									?>
							</fieldset>
							<button type="button" onclick="setCookie();incStep();return event.returnValue = showPanel(this, 'panel'+step);">Weiter</button>
						</div>
					
					
						<div class="panel" id="panel2" style="display: none; ">
							<fieldset>
								<legend >Liefer- und Rechnungsadresse</legend>
								<br>
								<div id="paket_adress_field">
								<?php	
								if($_SESSION['user_login'] == 1)
								{
									require_once('address_preset_form.php');
								}
								else
								{
									require_once('address_set.php');
								}
								?>
								</div>
								<input type="checkbox" checked id="bill_adress_check" onchange="extraadress();">Lieferadresse ist mit Rechnungsadresse identisch <br><br>
								<div id="bill_adress_field">
								</div>
							</fieldset>
							<button type="button" onclick="incStep();return event.returnValue = showPanel(this, 'panel'+step);">Weiter</button>
						</div>
						<div class="panel" id="panel3" style="display: none; ">
							<fieldset>
								<legend >Bezahloptionen</legend>
								<p>Bei uns sind folgende Bezahlarten möglich:</p>
								<ul>
								<li><input type="radio" name="payment" value="transfer" checked> Überweisung</li><br>
								<li><input type="radio" name="payment" value="ondelivery"> Nachname</li>
								</ul>
							</fieldset>
							<button type="button" onclick="incStep();return event.returnValue = showPanel(this, 'panel'+step);">Weiter</button>
						</div>
						<div class="panel" id="panel4" style="display: none; ">
							<fieldset>
								<legend >Zusammenfassung und Bestätigung</legend>
								<input id="item_post" value="<?=$_COOKIE['cart_items']?>" type="hidden"></input>
							</fieldset>
							<input type="Submit"></input>
						</div>
		
						<br />

						

					</form>
				</td>
			</tr>

			<tr>
				<td class="downbar">
					<ul>
						<li><a href="/data/agb.php" target="_blank" >AGB´s</a></li> 
						<li><a href="/data/impressum.php" target="_blank" >Impressum</a></li>
					</ul>
				</td>
			</tr>
</body>

</html>