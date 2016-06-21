<div class="center-texts">
	<br><b>Deine Bestellungen</b><br><br>
</div>
<table id="comments" >
	<tr>	
		<th class='purchase'>Bestellung<br>Datum</th>
		<th class='address'>Adresse</th>
		<th class='status'>Status</th> 
	</tr>
<?php	
	$db = new database();
	$db->connect();
	$db_address = new database();
	$db_address->connect();

	$sql = "
		SELECT
			*
		FROM
			purchases
		WHERE
			user_id = {$_SESSION['user_id']}
	";
	$db->query($sql);
	while($row = $db->fetch_object()) 
		{
		$sql = "
			SELECT
				*
			FROM
				addresses
			WHERE
				user_id = {$_SESSION['user_id']}
			AND
				type = 1
		";
		$db_address->query($sql);
		$row_address=$db_address->fetch_object();
		$rowcounter++;
		?>	<tr>
				<td class='purchase'>
					<a href="/../functions/profile_order_cart.php?order_id=<?=$row->id?>" rel="gb_page[640,480]"><?=$row->bill_number?></a><br>
					<?=$row->purch_date?>
				</td>
				<td class='adress'>
					<?=$row_address->street?>
					<?=$row_address->number?><br>
					<?=$row_address->zipcode?><br>
					<?=$row_address->location?><br>
					<?=$row_address->country?><br>
					<?=$row_address->state?><br>
				</td>
				<td class='status'>
				<?
				switch($row->status)
				{
				case '1':
					echo('Eingegangen<br>');
					?>
						<a href="/../functions/profile_order_storno.php?order_id=<?=$row->id?>"> Stornieren</a>
					<?
					break;
				case '2':
					echo('^Bezahlt');
					break;
				case '3':
					echo('Versendet');
					break;
				case '4':
					echo('Storniert');
					break;
				case '5':
					echo('Zurück');
					break;
				default:
					break;
				}
				?></td>
			</tr>	<?
		}
		if($rowcounter == 0)
			{?>
				<tr>
					<td colspan="3">Keine Bestellung vorhanden.</td>
				</tr>
			<?}
		$db->disconnect();
		$db_address->disconnect();		
			?>
</table>