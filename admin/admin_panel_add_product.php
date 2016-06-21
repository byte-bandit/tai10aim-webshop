<?php
  $cat = new CategoryLister();
  $return = $cat->getCatList();
  $fahreZeigestockEin=0;
  
  function setCategories($array)
  {
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
              echo('</optgroup>');
              $fahreZeigestockEin = 0;
            }
            echo('<optgroup label="'.$myname.'">');
            $fahreZeigestockEin = 1;
            setCategories($value);
          }else{
            echo('<option value="'.$myid.'" label="'.$myname.'">'.$myname.'</option>');
          }
          
        }
      }
    }
  }
?>

<form name="inputfrm1" action="add_product_func.php" enctype="multipart/form-data" method="post">
    <table id="admin">
      <tr class="alt">
        <td width="200px">
          Name:
        </td>
        <td colspan="3">
          <input style="width:800px;" type="text" size="80" maxlength="32" name="input_name">
        </td>
      </tr>
      <tr>
        <td>
          Beschreibung:
        </td>
        <td colspan="3">
          <textarea id="input" cols="80" rows="15" maxlength="2048" name="input_desc" wrap="pyshical"></textarea>
          <script type="text/javascript">
		  
				function formSubmit()
				{
					frmElement = document.forms['inputfrm1'];
					frmElement.elements["input_desc"].value = edit1.getEditorContent();
					document.forms['inputfrm1'].submit();
				}
						
						
				var edit1 = new TINY.editor.edit('editor',{
					id:'input',
					width:584,
					height:175,
					cssclass:'te',
					controlclass:'tecontrol',
					rowclass:'teheader',
					dividerclass:'tedivider',
					controls:['bold','italic','underline','strikethrough','|','subscript','superscript','|',
							  'orderedlist','unorderedlist','|','outdent','indent','|','leftalign',
							  'centeralign','rightalign','blockjustify','|','unformat','|','undo','redo','n',
							  'font','size','style','|','image','hr','link','unlink','|','cut','copy','paste','print'],
					footer:true,
					fonts:['Verdana','Arial','Georgia','Trebuchet MS'],
					xhtml:true,
					cssfile:'style.css',
					bodyid:'editor',
					footerclass:'tefooter',
					toggle:{text:'source',activetext:'wysiwyg',cssclass:'toggle'},
					resize:{cssclass:'resize'}
				});
				</script>
        </td>
      </tr>
      <tr class="alt">
        <td>
          Kategorie:
        </td>
        <td colspan="3">
          <select name="input_kategorie" size="10" style="width:800px;">
            <?
			setCategories($return['subitems']);
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
              
              $db = new database();
			  $db->connect();
              
              $sql = "
                SELECT
                    *
                FROM
                    product_sizes
                ORDER BY 
                    id ASC
                ";
               
              $db->query($sql);
              
              while($row = $db->fetch_object())
              {
                echo('<option value="'.$row->id.'">'.$row->name.'</option>');
              }
              
              $db->disconnect();
            ?>
          </select>
        </td>
            <td width="200px">
          Lagerbestand:
        </td>
        <td>
          <input style="width:250px;" type="text" size="80" maxlength="32" name="input_amount">
        </td>
          </tr>
      <tr class="alt">
        <td>
          Preis:
        </td>
        <td align="right" style="padding-right:25px;">
          <input style="width:100px;" type="text" size="80" maxlength="32" name="input_price"> €
        </td>
        <td>
          Artikelnummer:
        </td>
        <td>
          <input style="width:250px;" type="text" size="80" maxlength="32" name="input_article_nr">
        </td>
      </tr>
      <tr>
        <td>
          Referenzbild:
        </td>
        <td align="left">
          <input type="hidden" name="max_file_size" value="1000000"><input name="input_picture" type="file" />
        </td>
		<td>
          Lagerplatz:
        </td>
        <td align="left">
          <select name="input_location" size="1" style="width:300px;">
            <?php
              
              $db = new database();
			  $db->connect();
              
              $sql = "
                SELECT
                    *
                FROM
                    locations
                ORDER BY 
                    name
                ";
               
              $db->query($sql);
              
			  $db2 = new database();
			  $db2->connect();
              while($row = $db->fetch_object())
              {
				$sql = "
					SELECT
						*
					FROM
						products
					WHERE
						location = {$row->id}
                ";
				
				$db2->query($sql);
				$ress = 1;
				$ress = $db2->count();
				if($ress == 0)
				{
					echo('<option value="'.$row->id.'">'.$row->name.'</option>');
				}
              }
			  $db2->disconnect();
              
              $db->disconnect();
            ?>
          </select>
        </td>
      </tr>
    </table>
  <br>
  <input type="button" name="input_submit" value="Produkt einstellen" onclick="formSubmit();">
  </form>
