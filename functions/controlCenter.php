<?php

	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			users
		WHERE
			id = ".$_SESSION['user_id']."
	";
	
	$db->query($sql);
	$row = $db->fetch_object();
	
	$db->disconnect();
?>

<table class="cart" width="100%">
	<tr>
		<td>
			<b>Control Center</b>
			<br>
			<p>Hallo <?=$row->name?>!</p>		
		</td>
	</tr>
		<tr>
		<td>
			<a href="index.php?action=profile&pid=options">Konto Einstellungen</a>
		</td>
	</tr>
	<tr>
		<td>
			<a href="index.php?action=profile&pid=deleteAccount">Konto l&ouml;schen</a>
		</td>
	</tr>
	<tr>
		<td>
			<a href="index.php?action=profile&pid=cart">Mein Warenkorb</a>
		</td>
	</tr>
	<!--<tr>	REMOVED hence not req.
		<td>
			<a href="index.php?action=profile&pid=address">Meine Adressen</a>
		</td>
	</tr>
	!-->
	<tr>
		<td>
			<a href="index.php?action=profile&pid=orders">Meine Bestellungen</a>
		</td>
	</tr>
	<tr>
		<td>
			<a href="index.php?action=profile&pid=comments">Meine Kommentare</a>
		</td>
	</tr>
	<tr>
		<td>
			<a href="user/logout.php">Ausloggen</a>
		</td>
	</tr>
</table>
