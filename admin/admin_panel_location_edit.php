<?php
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			locations
		WHERE
			id=".$_GET['id']."
	";
	
	$db->query($sql);
	$db->disconnect();
	$row = $db->fetch_object();
?>

<form action="location_func.php?action=edit&id=<?php echo($_GET['id']); ?>" method="post">
<table id="admin">
	<tr>
		<td width="200px">
			Name
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_name" value="<?php echo($row->name); ?>">
		</td>
	</tr>
</table>
<br>
<input type="submit" name="input_submit" value="Lagerplatz editieren">
</form>