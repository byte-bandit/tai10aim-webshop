<?php
    $db = new Database();
	$db->connect();
    
    if(!isset($_GET['sort']) || !$_GET['sort']) {
		$_GET['sort'] = "name";
    }
	
	if(!isset($_GET['order']) || !$_GET['order']) {
		$_GET['order'] = "ASC";
    }
	
	if($_GET['sort'] == "desc")
	{
		$_GET['sort'] = "`desc`";
	}
	
	$sql = "
		SELECT
			*
		FROM
			products
		ORDER BY
			{$_GET['sort']} {$_GET['order']}
	";
	
	if($_GET['sort'] == "`desc`")
	{
		$_GET['sort'] = "desc";
	}
	
	$db->query($sql);

    $db->disconnect();
	
	
	$cols = array(
		"name" => "Name",
		"desc" => "Beschreibung",
		"category_id" => "Kategorie",
		"rating" => "Rating",
		"price" => "Preis",
		"size" => "Größe",
		"amount" => "Lagermenge",
		"article_nr" => "Artikelnummer"
	);
?>
<table id="admin">
    <tr>
		<th>
			Bild
		</th>
	<?
		foreach($cols as $sort => $label) {
			$sortorder = "ASC";
			if(isset($_GET['sort']) && $_GET['sort'] == $sort && isset($_GET['order']) && $_GET['order'] == "ASC") {
				$sortorder = "DESC";
			}
	?>
        <th>
            <a href="index.php?pid=products&sort=<?=$sort?>&order=<?=$sortorder?>"><?=$label?></a>
        </th>
    <?
		}
    ?>
    </tr>
    <?
        $rowcounter = 0;
		
		
		
        while($row = $db->fetch_object()) {
		$rowcounter++;
		
	?>
	<tr<?=$rowcounter%2==0?" class='alt'":""?>>
		<td>
			<img src="<? echo('../'.$row->picture_url); ?>" title="<?=$row->name?>" style="width:100px; height:100px;">
		</td>
		<td>
			<a style="font-size:1.0em;" href="index.php?pid=products_edit&id=<?=$row->id?>"><?=$row->name?></a>
		</td>
		<td>
			<?=substr(strip_tags($row->desc),0,100).'...';?>
		</td>
		<td>
			<?=getCategory($row->category_id);?>
		</td>
		<td nowrap>
			<?=drawRating($row->rating);?>
		</td>
		<td nowrap>
			<?=$row->price.' €';?>
		</td>
		<td nowrap>
			<?=getSize($row->size);?>
		</td>
		<td nowrap>
			<?=$row->amount;?>
		</td>
		<td nowrap>
			<?=$row->article_nr;?>
		</td>
	</tr>
	<?
	}
	?>
</table>


<?php

	function getCategory($id)
	{
		$db = new database();
		$db->connect();
		
		$sql = "
			SELECT
				*
			FROM
				categories
			WHERE
				id={$id}
		";
		
		$db->query($sql);
		$row = $db->fetch_object();
		
		return $row->name;
		
	}
	
	
	function getSize($id)
	{
		$db = new database();
		$db->connect();
		
		$sql = "
			SELECT
				*
			FROM
				product_sizes
			WHERE
				id={$id}
		";
		
		$db->query($sql);
		$row = $db->fetch_object();
		
		return $row->name;
	}
	
	
	function drawRating($n)
	{
		for($i=1; $i<=$n; $i++)
		{
			echo('<img src="../'.$GLOBALS['GLOBALS_icons_rating'].'" alt="rating">');
		}
		
		for($i=5; $i>$n; $i--)
		{
			echo('<img src="../'.$GLOBALS['GLOBALS_icons_rating_empty'].'" alt="rating">');
		}
		
	}

?>