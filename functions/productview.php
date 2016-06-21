<?php
require_once('productview_func.php');
$row = getProductData($_GET['id']);
?>

	<table>
      <tr>
		<td width="5%">
			<!--Nothing to do here!-->
		</td>
		<td width="10%">
			<!--Nothing to do here!-->
		</td>
		<td colspan="2">
			<h1><?=$row->name?></h1>
		</td>
	</tr>
	</tr>
		<td width="5%">
			<!--Nothing to do here!-->
		</td>
        <td width="10%" valign="top" align="left">
			<?
				echo(createImageSetURL($row->article_nr, $row->name));
			?>
			<!--<a href="<?=$row->picture_url?>" alt="pic" rel="gb_image[]"><?//drawThumbnails($row->picture_url);?></a>!-->
			<a href="#" onclick="return GB_showImageSet(page_set, 1)"><?drawThumbnails($row->picture_url);?></a>
        </td>
        <td width="30%">
        <?=$row->article_nr?>
        <br>
			<?=drawRating(getRating($_GET['id']));?>
			<br>
			<br>
			<p><h1><?=$row->price.' €'?></h1></p>
        </td>
        <td style="text-align:left;">
        	<a href="index.php?add=1&action=viewProduct&id=<?=$_GET['id']?>"><img src="images/website/shopping_cart_add.png" title="Zum Warenkorb hinzuf&uuml;gen"></a>
        </td>
      </tr>
	  <tr>
		<tr>
		<td width="5%">
			<!--Nothing to do here!-->
		</td>
		<td width="10%">
			<!--Nothing to do here!-->
		</td>
		<td colspan="2">
			<?='Noch '.$row->amount.' verf&uuml;gbar.'?>
			<br><?='Versand :'.getSize($row->size)?>
		</td>
	  </tr>
      <tr>
        <td colspan="4">
			<div>
				<a href class="tabs" onmousedown="return event.returnValue = showPanel(this, 'panel1');" id="tab1" onclick="return false;" style="background-color: white; padding-top: 6px; margin-top: 0px; ">Informationen</a>
				<a href class="tabs" onmousedown="return event.returnValue = showPanel(this, 'panel2');" id="tab2" onclick="return false;" style="background-color: white; padding-top: 6px; margin-top: 0px; ">Kommentare</a>
			</div>
			<div class="panel" id="panel1" style="display: inline; ">
				<br>
				<br>
				<?=nl2br($row->desc)?>
			</div>
			<div class="panel" id="panel2" style="display: none; ">
				<br>
				<?require_once('comment.php');?>
			</div>
        </td>
      </tr>
    </table>
    
    
    
<?php
	
		function createImageSetURL($nr, $name)
		{
			$res = opendir('images/products/'.$nr.'/');
			$i = 0;
			$return = '<script>var page_set = [';
			
			while($file = readdir($res))
			{
				if($file <> "." and $file <> ".." and $i < 6)
				{
					$i ++;
					$return = $return.'{\'caption\': \''.$name.'\', \'url\': \'../images/products/'.$nr.'/'.$file.'\'}, ';
				}
			}
			
			$return = substr($return, 0, -2);
			$return = $return.'];</script>';
			
			return $return;
		}
  
  ?>
