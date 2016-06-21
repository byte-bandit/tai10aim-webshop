<?php
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			users
		WHERE
			id=".$_GET['id']."
	";
	
	$db->query($sql);
	$db->disconnect();
	$row = $db->fetch_object();
?>

<form action="user_func.php?action=edit&id=<?php echo($_GET['id']); ?>" method="post">
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
			Vorname
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_prename" value="<?php echo($row->prename); ?>">
		</td>
	</tr>
	<tr>
		<td>
			Nachname
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_surname" value="<?php echo($row->surname); ?>"
		</td>
	</tr>
	<tr class="alt">
		<td>
			Passwort
		</td>
		<td>
			<input type="password" size="80" maxlength="32" name="input_password">
		</td>
	</tr>
	<tr>
		<td>
			Email Adresse
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_email" value="<?php echo($row->email); ?>">
		</td>
	</tr>
</table>
<br>
<input type="submit" name="input_submit" value="User editieren">
</form>