<?php
/*function drawRating($n)
	{
		for($i=1; $i<=$n; $i++)
		{
			echo('<img src="../'.$GLOBALS['GLOBALS_icons_rating'].'" alt="rating">');
		}
		
		for($i=5; $i>$n; $i--)
		{
			echo('<img src="../'.$GLOBALS['GLOBALS_icons_rating_empty'].'" alt="rating">');
		}
		
	}
*/
require_once('products.php');
?>
<div class="center-texts">
	<br><b>Deine Kommentare</b><br><br>
</div>
<table id="comments" >
	<!--<tr>	THANKS CPT: OBVIOUS
		<th class='product'>Produkt<br>Datum</th>
		<th class='content'>Kommentar</th>
		<th class='rating'>Bewertung</th>
		<th class='edit'>Edit</th> 
	</tr>-->
<?php	
	$db = new database();
	$db->connect();
	$db_product = new database();
	$db_product->connect();	
	$sql = "
		SELECT
			*
		FROM
			comments
		WHERE
			user_id='{$_SESSION['user_id']}'
	";
	$db->query($sql);
		
	while($row = $db->fetch_object()) 
		{
		$sql = "
			SELECT
				*
			FROM
				products
			WHERE
				id={$row->product_id}
		";
		$db_product->query($sql);
		$row_product = $db_product->fetch_object();
		$rowcounter++;
		?>	
		<table class="cart" style="margin-bottom:0px;">
			<tr>
				<td>
					<a href="/../index.php?action=viewProduct&id=<?=$row->product_id?>" >
						<?=$row_product->name?>
					</a>
					<br><?=$row->timestamp?>
				</td>
				<td class='content'><font face="Verdana, serif" style="font-size:0.8em;"><?=$row->content?></font></td>
				<td class='rating' nowrap><?drawRating($row->rating)?></td>
				<td class='edit' width="5%">
					<a href="/../functions/profile_comment_delete.php?comment_id=<?=$row->id?>" >
						<img src="/../icon/cancel.png"></img>
					</a>
				</td>
			</tr>
		<table>
		<?
		}
		if($rowcounter == 0)
			{?>
				<tr>
					<td colspan="4">Zurzeit sind noch keine Kommentare angelegt.</td>
				</tr>
			<?}?>
</table>
