<form action="admin_func.php?action=add" method="post">
<table id="admin">
	<tr class="alt">
		<td width=200px">
			Username
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_name">
		</td>
	</tr>
	<tr>
		<td>
			Passwort
		</td>
		<td>
			<input type="password" size="80" maxlength="32" name="input_password">
		</td>
	</tr>
	<tr class="alt">
		<td>
			Email
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_email">
		</td>
	</tr>
</table>
<br>
<input type="submit" name="input_submit" value="Admin anlegen">
</form>