<?php
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			db_admins
		WHERE
			id=".$_GET['id']."
	";
	
	$db->query($sql);
	$db->disconnect();
	$row = $db->fetch_object();
?>

<form action="admin_func.php?action=edit&id=<?php echo($_GET['id']); ?>" method="post">
<table id="admin">
	<tr>
		<td width="200px">
			Username
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_name" value="<?php echo($row->name); ?>">
		</td>
	</tr>
	<tr class="alt">
		<td>
			Email Adresse
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_email" value="<?php echo($row->email); ?>">
		</td>
	</tr>
	<tr>
		<td>
			Passwort zur&uuml;cksetzen
		</td>
		<td>
			<? echo('<a href="reset_admin_pw.php?id='.$row->id.'" title="Passwort zur&uuml;cksetzen" rel="gb_page[400, 400]"><img src="../icon/key.png" alt="Passwort zur&uuml;cksetzen" title="Passwort zur&uuml;cksetzen"></a>'); ?>
		</td>
	</tr>
</table>
<br>
<input type="submit" name="input_submit" value="Admin editieren">
</form>
