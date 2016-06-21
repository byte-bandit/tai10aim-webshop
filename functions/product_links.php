<?php
	require_once("products.php");
	
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

	$seite = $_GET["seite"];  //Abfrage auf welcher Seite man ist
	$cats = array();
	$qt = "";
	
	//Wenn man keine Seite angegeben hat, ist man automatisch auf Seite 1
	if(!isset($seite))
	{
	   $seite = 1;
	}

	
	function fillCats($t)
	{
		global $cats;
		$cats[] = $t;
	}


	//Einträge pro Seite: Hier 6 pro Seite
	$eintraege_pro_seite = 6; 

	//Ausrechen welche Spalte man zuerst ausgeben muss:

	$start = $seite * $eintraege_pro_seite - $eintraege_pro_seite;
	
	if(isset($_GET['supid']) and $_GET['supid']<>"")
	{
		$cat = new CategoryLister();
		$subs = $cat->getTotalSubCategories($_GET['supid'], 1);
		array_walk_recursive($subs, 'fillCats');
		$f = 0;
		foreach($cats as $val)
		{
			if($f == 0)
			{
				$f = 1;
				$qt = "
					WHERE
						(category_id={$val}";
			}else{
				$qt = $qt." OR
					category_id={$val}";
			}
		}
		$qt = $qt.")";
	}
	
	$dbf = new database();
	$dbf->connect();
	
	$sql = "SELECT
				*
			FROM
				categories
			WHERE
				active = 0
	";
	
	$dbf->query($sql);
	
	while($rowd = $dbf->fetch_object())
	{
		if($qt == '')
		{
			$qt = "
				WHERE category_id <> ".$rowd->id;
		}
		$qt = $qt." AND category_id <> ".$rowd->id;
	}
	$dbf->disconnect();

	$db = new database();
	$db->connect();

	$sql = "
		SELECT 
			* 
		FROM 
			products {$qt}
		ORDER BY 
			{$_GET['sort']} {$_GET['order']}
		LIMIT 
			{$start}, {$eintraege_pro_seite}
	";
	
	//echo($sql);

	$db->query($sql);
	
	if($_GET['sort'] == "`desc`")
	{
		$_GET['sort'] = "desc";
	}
	
	$cols = array(
		"name" => "Name",
		"rating" => "Rating",
		"price" => "Preis",
	);

	if($db->count() >= 1)
	{
		?>
		<table>
		<tr>
			<th>
				Sortierung:
			</th>
		<?
			foreach($cols as $sort => $label) {
				$sortorder = "ASC";
				if(isset($_GET['sort']) && $_GET['sort'] == $sort && isset($_GET['order']) && $_GET['order'] == "ASC") {
					$sortorder = "DESC";
				}
		?>
			<th>
				<a href="index.php?seite=<?=$seite?>&supid=<?=$_GET['supid']?>&sort=<?=$sort?>&order=<?=$sortorder?>"><?=$label?></a>
			</th>

		<?
			}
		?>
		</tr>
		<tr><td colspan="5">
		<?   
			while($row = $db->fetch_object())
			{   
				
			?>
			<table class="product_links">
			<tr>
				<td width="100px" height="100px">
						<a  href="index.php?action=viewProduct&id=<?=$row->id?>"><?drawThumbnails($row->picture_url);?></a>	
				</td>
				<td colspan="4">
					<a style="font-size:1.0em;" href="index.php?action=viewProduct&id=<?=$row->id?>"><?=$row->name?></a>
					<br>
					<?=$row->price.' €';?> <?=drawRating(getRating($row->id));?>
					<br>
					<?=substr(strip_tags($row->desc),0,100).'...';?>
				</td>
			</tr>
			</table>
			<?
			}
			?>
		</td></tr>
		</table>
		<?
	}
	else
		{echo "<div id='noarticle'>Keine Artikel zu dieser Kategorie vorhanden. :(</div>		";
		}
		

	$sql = "
		SELECT 
			* 
		FROM 
			products {$qt}
		ORDER BY 
			id ASC 
	";
	$result = $db->query($sql);
	$db->disconnect();
	
	$menge = mysql_num_rows($result);

	//Errechnen wieviele Seiten es geben wird
	$wieviel_seiten = $menge / $eintraege_pro_seite;
	
	if($wieviel_seiten>=1)
	{
		//Ausgabe der Seitenlinks:
		echo "<br>";
		echo "<div style='text-align:bottom;' align=\"center\">";
		echo "<b>Seite:</b> ";

		//Ausgabe der Links zu den Seiten
		for($a=0; $a < $wieviel_seiten; $a++)
			{
			$b = $a + 1;

			//Wenn der User sich auf dieser Seite befindet, keinen Link ausgeben
			if($seite == $b)
			{
			echo "  <b>$b</b> ";
			}

			//Aus dieser Seite ist der User nicht, also einen Link ausgeben
			else
			{
			echo "  <a href=\"?seite=$b&supid=".$_GET['supid']."\">$b</a> ";
			}


			}
		echo "</div>";
	}
?>
