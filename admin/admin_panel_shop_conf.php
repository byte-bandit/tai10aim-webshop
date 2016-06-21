<?php
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT 
			* 
		FROM
			shop_conf
		LIMIT
			1
	";
	
	$db->query($sql);
	
	$db->disconnect();
	
	$row = $db->fetch_object();
?>
	
	<form name="shop_opt_frm" enctype="multipart/form-data" action="shop_func.php" method="post">
		<table id="admin">
			<tr class="alt">
				<td width="200px">
					Shop Name:
				</td>
				<td>
					<input type="text" size="80" maxlength="32" name="input_name" value="<?php echo($row->shopname); ?>">
				</td>
			</tr>
			<tr>
				<td>
					Banner:
				</td>
				<td>
					<img src="../images/website/banner.png" alt="Keinen Banner hochgeladen!">
					<br>
					Neuen Banner hochladen: <? //<input type="hidden" name="max_file_size" value="900000000"> ?><input name="input_picture" type="file" /> (PNG only)
				</td>
			</tr>
			<tr class="alt">
				<td width="200px">
					Layout:
				</td>
				<td>
					<select name="input_layout" size="1" style="width:300px;">
						<option <? if($row->layout == 1) { echo('selected'); } ?> value="1">Layout 1</option>
						<!--Not included in V1<option <? //if($row->layout == 2) { echo('selected'); } ?> value="2">Layout 2</option>
						<option <? //if($row->layout == 3) { echo('selected'); } ?> value="3">Layout 3</option>!-->
					</select>
				</td>
			</tr>
			<tr class="alt">
				<td width="200px">
					Impressum:
				</td>
				<td>
					<!--<textarea style="width:800px;" cols="80" rows="15" maxlength="16000" name="input_impressum" wrap="pyshical"><?//=$row->impressum?></textarea>!-->
					<textarea id="id_impressum" wrap="physical" maxlength="16000" name="input_impressum" style="width:400px; height:200px"><?=$row->impressum?></textarea>
				</td>
			</tr>
			<tr class="alt">
				<td width="200px">
					Agb:
				</td>
				<td>
					<!--<textarea style="width:800px;" cols="80" rows="15" maxlength="16000" name="input_agb" wrap="pyshical"><?//=$row->agb?></textarea>!-->
					<textarea id="id_agb" wrap="physical" maxlength="16000" name="input_agb" style="width:400px; height:200px"><?=$row->agb?></textarea>
					<script type="text/javascript">
					
						function formSubmit()
						{
							frmElement = document.forms['shop_opt_frm'];
							frmElement.elements["input_impressum"].value = imp_ed.getEditorContent();
							frmElement.elements["input_agb"].value = agb_ed.getEditorContent();
							document.forms['shop_opt_frm'].submit();
						}
						
						var imp_ed = new TINY.editor.edit('editor',{
						id:'id_impressum',
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
						
						var agb_ed = new TINY.editor.edit('editor2',{
						id:'id_agb',
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
						bodyid:'editor2',
						footerclass:'tefooter',
						toggle:{text:'source',activetext:'wysiwyg',cssclass:'toggle'},
						resize:{cssclass:'resize'}
						});
					</script>
				</td>
			</tr>
		</table>
	<br>
	<input type="button" name="Name" value="&Auml;nderungen &uuml;bernehmen" onclick="formSubmit();">
	</form>