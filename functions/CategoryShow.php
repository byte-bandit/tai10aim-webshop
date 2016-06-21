
<table class="cats" width="100%">
	<tr>
		<td>

<?php


	
  
  $cat = new CategoryLister();
  
  $return = $cat->getCatList();
  
  $level = 0;

  printCategories($return['subitems'],$level);
  function printCategories($array,$level)
  {
	
    foreach($array as $arr)
    {
      foreach($arr as $key => $value)
      {
        if($key == 'name')
        {
          $myname = $value;
        }
		if($key == 'id')
        {
          $myid = $value;
        }
        
        if($key == 'subitems')
        {
			$catDB = new database();
			$catDB->connect();
			$sql = "SELECT
						*
					FROM
						categories
					WHERE
						id={$myid}
			";
			$catDB->query($sql);
			$catDB->resetPointer(0);
			$catDB->disconnect();
			$catRow = $catDB->fetch_object();
          if(count($value) > 0 && $catRow->active == 1)
          {
            echo('<p class="cat" style="text-indent:'.(15*(1+$level)).'px;"><a href="index.php?supid='.$myid.'">'.$myname.'</a></p>');
			$level++;
            printCategories($value,$level);
			$level--;
          }elseif($catRow->active == 1){
            echo('<p class="cat" style="text-indent:'.(15*(1+$level)).'px;"><a href="index.php?supid='.$myid.'">'.$myname.'</a></p>');
          }
          
        }
		
      }
    }
  }
?>

</td>
	</tr>
</table>
