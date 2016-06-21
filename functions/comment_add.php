<?php
if($_SESSION['user_login'] == 1)
{
?>
<tr>
	<td colspan=3>
		<form name="addComment" onSubmit="" method="POST" action="functions/comment_add_func.php?id=<?=$_GET['id']?>">
					<textarea  style="resize:none;" id="commentfield" name="commentfield" rows="4" cols="60" onkeyup="checkLen('commentfield', 'counter')"></textarea>
					<ul>
						<li><input type="text" id="counter" readonly value="255"size="3"></li>
						<li><input type="radio" value="1" name="points">1</input></li>
						<li><input type="radio" value="2" name="points">2</input></li>
						<li><input type="radio" value="3" name="points">3</input></li> 
						<li><input type="radio" value="4" name="points">4</input></li>
						<li><input type="radio" value="5" name="points" checked>5</input></li>
						<li><input type="submit" name="commentadd" value="Kommentar hinzufügen"></input></li>
					</ul>
		</form>
	</td>
</tr>
<?
}

 
?>
</table>