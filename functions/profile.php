<?php

	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			users
		WHERE
			id = ".$_SESSION['user_id']."
	";
	
	$db->query($sql);
	$row = $db->fetch_object();
	
	$db->disconnect();
	
	
	
	switch($_GET['pid'])
	{
		case 'options':
			require_once('profile_options.php');
			break;
			
		case 'deleteAccount':
			require_once('profile_delete.php');
			break;
			
		case 'orders':
			require_once('profile_orders.php');
			break;
			
		case 'comments':
			require_once('profile_comments.php');
			break;
			
		case 'cart':
			require_once('profile_cart.php');
			break;
			
		case 'address':
			require_once('profile_address.php');
			break;
		
		default:
			require_once('profile_overview.php');
			break;
	}
?>
