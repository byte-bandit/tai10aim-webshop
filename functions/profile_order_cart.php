<?php
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('productview_func.php');
?>
<html>
	<head>
		<title>Bestellung</title>
	</head>
	<body>
	<table>
		<tr>
			<th>Anzahl</th>
			<th>Artikel</th>
			<th>Preis</th>
		</tr>
	<?
	$db = new database();
	$db->connect();
	$rowcounter = 0;
	$final_pay = 0;
	$sql = "
		SELECT
			*
		FROM
			article_per_order
		WHERE
			order_id = {$_GET['order_id']}
	";
	$db->query($sql);
	while($row = $db->fetch_object()) 
	{	
	$rowcounter++;
	$product=getProductData($row->article_id);
	$final_pay += $row->amount * $product->price;
	?>
	<tr>
		<td><?=$row->amount?></td>
		<td><a href="/../index.php?action=viewProduct&id=<?=$product->id?>" target="_blank"><?=$product->name?></a></td>
		<td><?echo($row->amount * $product->price);?></td>
	</tr>
	
	<?
	}
	if($rowcounter == 0)
		{?>
			<tr>
				<td colspan="3">Keine Artikel vorhanden.</td>
			</tr>
		<?}	
	else{
		?>
		<tr>
			<td colspan="2">Endpreis:</td>
			<td><?=$final_pay?></td>
		</tr>
		<?
	}?>
	</table>
	</body>
</html>