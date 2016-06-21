<?
require_once('address_preset_func.php');
	$address2="	<script type='text/javascript'>
					var del_street = ".$row_address2->street.";
					var del_number = ".$row_address2->number.";
					var del_zip = ".$row_address2->zipcode.";
					var del_location = ".$row_address2->location.";
				</script>";
	echo($address2);	
?>
