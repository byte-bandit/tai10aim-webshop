<?php
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			categories
		WHERE
			id=".$_GET['id']."
	";
	
	$db->query($sql);
	$db->disconnect();
	$row = $db->fetch_object();
	
	/*
  $cat = new CategoryLister();
  $return = $cat->getCatList();
  $fahreZeigestockEin=0;
  
  function setCategories($array, $targetID, $mineID)
  {
    foreach($array as $arr)
    {
      foreach($arr as $key => $value)
      {
		$isChecked = '';
	  
        if($key == 'id')
        {
          $myid = $value;
        }
        if($key == 'name')
        {
        $myname = $value;
        }
        
        if($key == 'subitems')
        {
          if(count($value) > 0 && $myid <> $mineID)
          {
            if($fahreZeigestockEin == 1)
            {
			  echo('</blockquote>');
              $tabAmount --;
			  $fahreZeigestockEin = 0;
            }
			if($myid == $targetID)
			{
				$isChecked = 'checked';
			}
			echo('<blockquote>');
			echo('<input type="radio" name="input_kategorie" value="'.$myid.'" '.$isChecked.' > '.$myname.'</br>');
            $fahreZeigestockEin = 1;
            setCategories($value, $targetID, $mineID);
          }elseif($myid <> $mineID){
			if($myid == $targetID)
			{
				$isChecked = 'checked';
			}
			echo('<input type="radio" name="input_kategorie" value="'.$myid.'" '.$isChecked.' > '.$myname.'</br>');
          }
          
        }
      }
    }
  }
  */
?>
<?
function create_treeview($id_sup, $level, $myID, $mySupID)
{
		$db = new database();
		$db->connect();
		
		$sql = "
			SELECT
				*
			FROM
				categories
			WHERE
				id_sup = ".$id_sup."
			ORDER BY
				name Asc
		";
		
		$db->query($sql);
		
		while($row = $db->fetch_object())
		{
			if($row->id <> $myID && $row->id_sup <> $myID)
			{
				if($row->id == $mySupID)
				{
					$isChecked = 'checked';
				}else{
					$isChecked = '';
				}
				echo('<tr>');
				//Cat name and icon
				echo('<td style="padding-left:'.(($level*2)+0.5).'em;">');
				echo('<input type="radio" name="input_kategorie" value="'.$row->id.'" '.$isChecked.'> '.$row->name);
				echo('</td></tr>');
				
				create_treeview($row->id, $level+1, $myID, $mySupID);
			}
		}
	$db->disconnect();
}
?>



<form action="cat_func.php?action=edit&id=<?php echo($_GET['id']); ?>" method="post">
<table id="admin">
	<tr>
		<td width="200px">
			ID
		</td>
		<td>
			<?php echo($row->id); ?>
		</td>
	</tr>
	<tr class="alt">
		<td>
			Bezeichnung
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_name" value="<?php echo($row->name); ?>">
		</td>
	</tr>
	<tr>
		<td>
			&Uuml;berkategorie
		</td>
		<td>
            <?
				//<select name="input_kategorie" size="10" style="width:600px;">
				if($row->id_sup == 0)
				{
					$isChecked = 'checked';
				}else{
					$isChecked = '';
				}
				echo('<input type="radio" name="input_kategorie" value="0" '.$isChecked.'>Wurzelkategorie</br>');
				echo('<table border="0">');
				create_treeview(0,0,$row->id, $row->id_sup);
				echo('</table>');
				//</select>
			?>
		</td>
	</tr>

</table>
<br>
<input type="submit" name="input_submit" value="Kategorie editieren">
</form>
