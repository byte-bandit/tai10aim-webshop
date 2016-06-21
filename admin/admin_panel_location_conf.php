<?php
	
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			locations
		ORDER BY
			name
	";
	$result = $db->query($sql);

    $db->disconnect();
	
	
	$cols = array(
		"name" => "Name",
		"product_id" => "Produkt",
	);
?>
<table id="admin">
    <tr>
	<?
		foreach($cols as $sort => $label) {
	?>
        <th>
            <?=$label?>
        </th>
    <?
		}
    ?>
        <th>
            Edit
        </th>
        <th>
            Delete
        </th>
    </tr>
    <?
        $rowcounter = 0;
        while($row = $db->fetch_object($result)) {
		$rowcounter++;
	?>
	<tr<?=$rowcounter%2==0?" class='alt'":""?>>
		<td>
			<?=$row->name?>
		</td>
		<td>
			<?
				$sql = "SELECT
							*
						FROM
							products
						WHERE
							location = {$row->id}
				";
				
				$db2 = new database();
				$db2->connect();
				$db2->query($sql);
				if($row3 = $db2->fetch_object())
				{
					echo('<a href="index.php?pid=products_edit&id='.$row3->id.'">'.$row3->name);
				}else{
					echo('Fach ist leer.');
				}
				$db2->disconnect();
			?>
		</td>
		<td>
			<a href="index.php?pid=edit_location&id=<?=$row->id?>"><img src="../icon/page_edit.png" alt="Edit" title="Lagerplatz editieren"></a>
		</td>
		<td>
			<a href="location_func.php?action=del&id=<?=$row->id?>"><img src="../icon/cancel.png" alt="kill" title="Lagerplatz l&ouml;schen"></a>
		</td>
	</tr>
	<?
	$db->disconnect();
	}
	?>
</table>
<br>
<a href="index.php?pid=add_location"><img src="../icon/add.png" alt="New" title="Lagerplatz hinzufügen"></a>