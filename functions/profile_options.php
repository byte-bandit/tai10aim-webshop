<form action="functions/profile_options_func.php" method="post">
		<table width="400">
			<tr class="alt">
				<td width="200px">
					Username:
				</td>
				<td>
					<input readonly type="text" size="80" maxlength="32" name="input_username" value="<?php echo($row->name); ?>">
				</td>
			</tr>
			<tr>
				<td>
					Vorname:
				</td>
				<td>
					<input required type="text" size="80" maxlength="32" name="input_prename" value="<?php echo($row->prename); ?>">
				</td>
			</tr>
			<tr class="alt">
				<td>
					Nachname:
				</td>
				<td>
					<input required type="text" size="80" maxlength="32" name="input_name" value="<?php echo($row->surname); ?>">
				</td>
			</tr>
			<tr>
				<td>
					Email:
				</td>
				<td>
					<input required type="text" size="80" maxlength="32" name="input_email" value="<?php echo($row->email); ?>">
				</td>
			</tr>
			<tr class="alt">
				<td>
					Altes Passwort:
				</td>
				<td>
					<input required type="password" size="80" maxlength="32" name="input_password_old">
				</td>
			</tr>
			<tr>
				<td>
					Neues Passwort:
				</td>
				<td>
					<input type="password" size="80" maxlength="32" name="input_password_new">
				</td>
			</tr>
			<tr class="alt">
				<td>
					Neues Passwort (Wiederholung):
				</td>
				<td>
					<input type="password" size="80" maxlength="32" name="input_password_new2">
				</td>
			</tr>
		</table>
	<br>
	<input type="submit" name="input_submit" value="Änderungen übernehmen">
	</form>
