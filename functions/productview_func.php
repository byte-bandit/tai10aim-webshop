<?php
	
require_once('products.php');
function getProductdata($id)
{	
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			products
		WHERE
			id={$id}
		LIMIT 0,1 
	";
	
	if(!$result = $db->query($sql))
	{
		exit($GLOBALS_error_msg.'<br>'.$db->getError());
	}
	
	$db->disconnect();
	$row = $db->fetch_object();
	return $row;
}
function getProductName($id)
{
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			products
		WHERE
			id={$id}
		LIMIT 0,1 
	";
	
	if(!$result = $db->query($sql))
	{
		exit($GLOBALS_error_msg.'<br>'.$db->getError());
	}
	
	$db->disconnect();
	$row = $db->fetch_object();
	$name=$row->name;
	return $name;
}
?>