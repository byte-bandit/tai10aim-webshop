<?php
    $db = new database();
	$db->connect();
	
	if(isset($_GET['showall']) && $_GET['showall'] == 1)
	{
		$archived = "";
	}else{
		$archived = "WHERE
						archive = 0
					";
	}
	
	$sql = "
		SELECT
			*
		FROM
			purchases
		{$archived}
		ORDER BY
			bill_number
	";
	$db->query($sql);

    $db->disconnect();
	
?>
<a href="index.php?pid=orders&showall=1">Alle Bestellungen einsehen</a>
<table id="admin" style="font-size:1.2em;">
    <tr>
		<th>
            Rechnungsnummer
        </th>
		<th>
            Username
        </th>
		<th>
            Lieferadresse
        </th>
		<th>
            Artikel
        </th>
		<th>
            Status
        </th>
        <th>
            Abfertigung
        </th>
    </tr>
    <?
        $rowcounter = 0;
        while($row = $db->fetch_object()) {
		$rowcounter++;
	?>
	<tr<?=$rowcounter%2==0?" class='alt'":""?>>
		<td valign="top">
			<?=$row->bill_number?>
			<br>
			<?=$row->purch_date?>
		</td>
		<td valign="top">
			<?
				$db2 = new database();
				$db2->connect();
				
				$sql = "
					SELECT
						*
					FROM
						users
					WHERE
						id={$row->user_id}
				";
				$db2->query($sql);
				$db2->disconnect();
				$row2 = $db2->fetch_object();
				echo($row2->name);
			?>
		</td>
		<td valign="top">
			<?
				$db_address = new database();
				$db_address->connect();
				$sql = "
					SELECT
						*
					FROM
						addresses
					WHERE
						user_id = {$row->user_id}
					AND
						type = 1
				";
				$db_address->query($sql);
				$db_address->disconnect();
				$row_address=$db_address->fetch_object();
			?>
			<?=$row_address->street?>
			<?=$row_address->number?><br>
			<?=$row_address->zipcode?><br>
			<?=$row_address->location?><br>
			<?=$row_address->country?><br>
			<?=$row_address->state?><br>
		</td>
		<td valign="top">
			<?
				require_once('admin_panel_orders_showArticles.php');
			?>
		</td>
		<td valign="top">
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
					echo('Bezahlt');
					break;
				case '3':
					echo('Versendet');
					break;
				case '4':
					echo('Storniert');
					break;
				case '5':
					echo('Rücksendung');
					break;
				default:
					break;
				}
				
			if($row->archive == 1)
			{
				echo('<br>Archiviert');
			}
		?>
		</td>
		<td valign="top">
			<form method="POST" action="admin_panel_orders_func.php?action=setStatus&id=<?=$row->id?>">
				<select name="input_status" size="1" style="width:100px;">
					<option selected value="1">Eingegangen</option>
					<option value="2">Bezahlt</option>
					<option value="3">Versendet</option>
					<option value="4">Storniert</option>
					<option value="5">Rücksendung</option>
				</select>
				<br>
				<input type="image" src="../icon/page_edit.png" alt="Status &auml;ndern" title="Status &auml;ndern">
				<a href="admin_panel_orders_func.php?action=archive&id=<?=$row->id?>"><img src="../icon/folder_page.png" alt="archive" title="Archivieren"></a>
			</form>
		</td>
	</tr>
	<?
	}
	?>
</table>
<br>