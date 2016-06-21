<?php
    $db = new database();
	$db->connect();
    
    if(!isset($_GET['sort']) || !$_GET['sort']) {
		$_GET['sort'] = "name";
    }
	
	if(!isset($_GET['order']) || !$_GET['order']) {
		$_GET['order'] = "ASC";
    }
	
	$sql = "
		SELECT
			*
		FROM
			users
		ORDER BY
			{$_GET['sort']} {$_GET['order']}
	";
	$db->query($sql);

    $db->disconnect();
	
	
	$cols = array(
		"active" => "Active",
		"name" => "Username",
		"prename" => "Vorname",
		"surname" => "Nachname",
		"email" => "E-Mail-Adresse"
	);
?>
<table id="admin">
    <tr>
	<?
		foreach($cols as $sort => $label) {
			$sortorder = "ASC";
			if(isset($_GET['sort']) && $_GET['sort'] == $sort && isset($_GET['order']) && $_GET['order'] == "ASC") {
				$sortorder = "DESC";
			}
	?>
        <th>
            <a href="index.php?pid=user_conf&sort=<?=$sort?>&order=<?=$sortorder?>"><?=$label?></a>
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
        while($row = $db->fetch_object()) {
		$rowcounter++;
	?>
	<tr<?=$rowcounter%2==0?" class='alt'":""?>>
		<td>
	<?
		if($row->active == 1) {
	?>
			<a href="user_func.php?action=set_inactive&id=<?=$row->id?>"><img src="../icon/flag_green.png" alt="Active"></a>
	<?
		} else {
	?>
			<a href="user_func.php?action=set_active&id=<?=$row->id?>"><img src="../icon/flag_red.png" alt="Inactive"></a>
	<?
		}      

	?>
		</td>
		<td>
			<?=$row->name?>
		</td>
		<td>
			<?=$row->prename?>
		</td>
		<td>
			<?=$row->surname?>
		</td>
		<td>
			<?=$row->email?>
		</td>
		<td>
			<a href="index.php?pid=edit_user&id=<? echo($row->id); ?>"><img src="../icon/page_edit.png" alt="Edit" title="User editieren"></a>
		</td>
		<td>
			<a href="user_func.php?action=del&id=<? echo($row->id); ?>"><img src="../icon/cancel.png" alt="kill" title="User l&ouml;schen"></a>
		</td>
	</tr>
	<?
	}
	?>
</table>
<br>
<a href="index.php?pid=add_user"><img src="../icon/add.png" alt="New" title="User hinzufügen"></a>