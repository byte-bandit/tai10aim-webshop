<?
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			db_admins
		WHERE
			id = ".$_SESSION['admin_id']."
	";
	
	$db->query($sql);
	$row = $db->fetch_object();
	
	$sql = "
		SELECT
			*
		FROM
			categories
	";
	
	$result = $db->query($sql);
	$row2 = mysql_num_rows($result);
	
	$sql = "
		SELECT
			*
		FROM
			products
	";
	
	$result = $db->query($sql);
	$row3 = mysql_num_rows($result);
	
	$db->disconnect();
?>
<td width="20%">
	Angemeldet als: <? echo($row->name); ?>
</td>
<td width="20%">
	Benachrichtigungen: 0 
</td>
<td width="20%">
	Kategorien: <? echo($row2); ?>
</td>
<td width="20%">
	Artikel: <? echo($row3); ?>
</td>
<td width="20%">
	Datum: <? echo(date('d.m.Y')); ?>
</td>