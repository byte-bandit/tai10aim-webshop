<?
	require_once('../functions/productview_func.php');
	
	$db_articles = new database();
	$db_articles->connect();
	$rowcounter = 0;
	$final_pay = 0;
	$sql = "
		SELECT
			*
		FROM
			article_per_order
		WHERE
			order_id = {$row->id}
	";
	$db_articles->query($sql);
	
?>
<table width="100%" style="font-size:1.2em;">
	<tr>
		<th>Anzahl</th>
		<th>Artikel</th>
		<th>Preis</th>
	</tr>
	<?
		while($row_articles = $db_articles->fetch_object()) 
		{	
			$rowcounter++;
			$product=getProductData($row_articles->article_id);
			$final_pay += $row_articles->amount * $product->price;
	?>
	<tr>
		<td><?=$row_articles->amount?></td>
		<td><a href="../index.php?action=viewProduct&id=<?=$product->id?>" target="_blank"><?=$product->name?></a></td>
		<td><?echo($row_articles->amount * $product->price);?></td>
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