<?
require_once('statusbar_func.php');
?>
<table id="name" frame="hsides">
	<tr id="user">
		<td width="30%">
			Angemeldet als: <? echo($row->name); ?>
		</td>
		<td width="30%">
			Nachrichten: 0 
		</td>
		<td width="30%">
			Datum: <? echo(date('d.m.Y')); ?>
		</td>
		<td>
			<a href="index.php?action=profile">Mein Profil</a>
		</td>
	</tr>
</table> 