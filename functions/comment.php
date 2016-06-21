
			<table id="comments" >
			<tr>	
				<th class='author'>User<br>Datum</th>
				<th class='content'>Kommentar</th>
				<th class='rating'>Bewertung</th>
			</tr>
<?php	
			$db = new database();
			$db->connect();
			$db_user = new database();
			$db_user->connect();
	
			$sql = "
				SELECT
					*
				FROM
					comments
				WHERE
					product_id={$_GET['id']}
			";
	
			if(!$result = $db->query($sql))
				{exit($GLOBALS_error_msg.'<br>'.$db->getError());}
	


			while($row = $db->fetch_object())
			{
				$sql = "
					SELECT
						*
					FROM
						users
					WHERE
						id={$row->user_id}
				";
				$db_user->query($sql);
				$row_user = $db_user->fetch_object();

				$rowcounter++;
			?>	<tr>
					<td class='author'><?=$row_user->name?><br><?=$row->timestamp?></td>
					<td class='content'><?=$row->content?></td>
					<td class='rating'><?drawRating($row->rating)?></td>
				</tr>	<?
			}
			if($rowcounter == 0)
			{?>
				<tr>
					<td colspan="3">Zurzeit sind noch keine Kommentare angelegt.</td>
				</tr>
			<?}
			$db->disconnect();
			$db_user->disconnect();
			require_once('comment_add.php');
			

?>
			
