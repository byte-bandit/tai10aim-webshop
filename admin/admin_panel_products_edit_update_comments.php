<?php

	require_once('admin_panel_products_edit_func.php');
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			products
		WHERE
			id={$_GET['id']}
	";
	
	$db->query($sql);
	$row = $db->fetch_object();
	
	$sql = "
        SELECT
                *
        FROM
                product_sizes
        ORDER BY 
                id ASC
    ";
	
	$db->query($sql);
	$db->disconnect();

	$cat = new CategoryLister();
	$return = $cat->getCatList();
	$fahreZeigestockEin=0;
  
	function setCategories($array, $catID)
	{
		foreach($array as $arr)
		{
			foreach($arr as $key => $value)
			{
				if($key == 'id')
				{
				  $myid = $value;
				  if($myid == $catID)
				  {
					$nap = 'selected ';
				  }else{
					$nap = '';
				  }
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
					  echo('</optgroup>');
					  $fahreZeigestockEin = 0;
					}
					echo('<optgroup label="'.$myname.'">');
					$fahreZeigestockEin = 1;
					setCategories($value, $catID);
				  }else{
					echo('<option '.$nap.'value="'.$myid.'" label="'.$myname.'">'.$myname.'</option>');
				  }
				  
				}
			}
		}
	}
?>

<form action="edit_product_func.php?action=update&id=<?=$row->id?>" enctype="multipart/form-data" method="post">
    <table id="admin">
      <tr class="alt">
        <td width="200px">
          Name:
        </td>
        <td colspan="3">
          <input style="width:800px;" type="text" size="80" maxlength="32" name="input_name" value="<?=$row->name?>">
        </td>
      </tr>
      <tr>
        <td>
          Beschreibung:
        </td>
        <td colspan="3">
          <textarea style="width:800px;" cols="80" rows="15" maxlength="2048" name="input_desc" wrap="pyshical"><?=$row->desc?></textarea>
        </td>
      </tr>
      <tr class="alt">
        <td>
          Kategorie:
        </td>
        <td colspan="3">
          <select name="input_kategorie" size="10" style="width:800px;">
            <?
			setCategories($return['subitems'], $row->category_id);
			?>
        </select>
        </td>
      </tr>
      <tr>
            <td>
          Größe:
        </td>
        <td>
          <select name="input_size" size="1" style="width:300px;">
             <?php
			 
              while($row2 = $db->fetch_object())
              {
				if($row->size == $row2->id)
				{
					echo('<option selected value="'.$row2->id.'">'.$row2->name.'</option>');
				}else{
					echo('<option value="'.$row2->id.'">'.$row2->name.'</option>');
				}
              }
			  
             ?>
          </select>
        </td>
            <td width="200px">
          Lagerbestand:
        </td>
        <td>
          <input style="width:250px;" type="text" size="80" maxlength="32" name="input_amount" value="<?=$row->amount?>">
        </td>
          </tr>
      <tr class="alt">
        <td>
          Preis:
        </td>
        <td align="right" style="padding-right:25px;">
          <input style="width:100px;" type="text" size="80" maxlength="32" name="input_price" value="<?=$row->price?>"> €
        </td>
        <td>
          Artikelnummer:
        </td>
        <td>
          <input style="width:250px;" type="text" size="80" maxlength="32" name="input_article_nr" value="<?=$row->article_nr?>">
        </td>
      </tr>
      <tr>
        <td>
          Referenzbilder:
        </td>
        <? createImages($row->article_nr, $row->picture_url, $row->id); ?>
      </tr>
    </table>
  <br>
  <input type="image" src="../icon/accept.png" title="Änderungen übernehmen">
  <a href="delete_product.php?id=<?=$row->id?>" onclick="return GB_showCenter('Produkt löschen', this.href)"><img src="../icon/bin_closed.png" title="Produkt löschen"></a>
  </form>
  
  <?php
	
		function createImages($nr, $fav, $id)
		{
			$res = opendir('../images/products/'.$nr.'/');
			$i = 0;
			
			while($file = readdir($res))
			{
				if($file <> "." and $file <> ".." and $i < 3)
				{
					$i ++;
					?>
						<td align="center">
						<a href="<?='../images/products/'.$nr.'/'.$file?>" rel="gb_image[]"><img <? if($file == basename($fav)) { echo('border="4"'); } ?> src="<?='../images/products/'.$nr.'/'.$file?>" style="width:100px; height:100px;" alt="<?=$file?>"></a>
						<br>
						<a href="admin_panel_products_edit_update_pic.php?id=<?=$id?>&action=update&pic=<?=$file?>&artnr=<?=$row->article_nr?>" onclick="return GB_showCenter('Admin', this.href, 150,320)" alt="edit" title="Bild ändern"><img src="../icon/page_edit.png" alt="edit" title="Bild ändern"></a>
						<a href="admin_panel_products_edit_delete_pic.php?id=<?=$id?>&pic=<?=$file?>&nr=<?=$nr?>" onclick="return GB_showCenter('Admin', this.href)"><img src="../icon/cancel.png" alt="delete" title="Bild löschen"></a>
						<?
							if($file <> basename($fav))
							{
								echo('<a href="index.php?pid=products_edit&id='.$id.'&action=setstd&pic='.$file.'"><img src="../icon/picture.png" alt="std" title="Als Standartbild wählen"></a>');
							}
						?>
						</td>
					<?
				}
			}
			
			if($i < 3)
			{
				for($n = $i; $n < 3; $n++)
				{
					?>
						<td align="center">
						<a href="admin_panel_products_edit_update_pic.php?id=<?=$id?>&action=add" onclick="return GB_showCenter('Admin', this.href, 150,320)" alt="new" title="Bild hinzufügen"><img src="../icon/add.png" alt="edit" title="Bild hinzufügen"></a>
						</td>
					<?
				}
			}
		}
  
  ?>