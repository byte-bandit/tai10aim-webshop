<?php

  $cat = new CategoryLister();
  $return = $cat->getCatList();
  $fahreZeigestockEin=0;
  
  function setCategories($array, $level)
  {
	$curLevel = $level;
    foreach($array as $arr)
    {
      foreach($arr as $key => $value)
      {  
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
          if(count($value) > 0)
          {
            if($fahreZeigestockEin == 1)
            {
			  echo('</blockquote>');
              $tabAmount --;
			  $fahreZeigestockEin = 0;
            }
			echo('<input type="radio" name="input_kategorie" value="'.$myid.'"> '.$myname.'</br>');
			echo('<blockquote>');
            $fahreZeigestockEin = 1;
            setCategories($value, $curLevel+1);
          }else{
			echo('<input type="radio" name="input_kategorie" value="'.$myid.'"> '.$myname.'</br>');
          }
          
        }
      }
    }
  }
?>


<?
function create_treeview($id_sup, $level)
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
			
			echo('<tr>');
					
			//Cat name and icon
			echo('<td style="padding-left:'.(($level*2)+0.5).'em;">');
			echo('<input type="radio" name="input_kategorie" value="'.$row->id.'"> '.$row->name);
			echo('</td></tr>');
			
			create_treeview($row->id, $level+1);
		}
	$db->disconnect();
}
?>



<form action="cat_func.php?action=add" method="post">
<table id="admin">
	<tr class="alt">
		<td width="200px">
			Name
		</td>
		<td>
			<input type="text" size="80" maxlength="32" name="input_name">
		</td>
	</tr>
	<tr>
		<td>
			&Uuml;berkategorie
		</td>
		<td>
			<table border="0">
			<?
				echo('<input type="radio" name="input_kategorie" value="0">Wurzelkategorie</br>');
				create_treeview(0,0);
			?>
			</table>
		</td>
	</tr>

	</tr>
</table>
<br>
<input type="submit" name="input_submit" value="Kategorie anlegen">
</form>