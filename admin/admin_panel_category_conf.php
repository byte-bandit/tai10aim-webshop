<?php
	
	echo('<table id="admin">');
	echo('<tr>');
	echo('<th width="100px">');
	echo('Active');
	echo('</th>');
	echo('<th>');
	echo('Name');
	echo('</th>');
	echo('<th width="100px">');
	echo('Edit');
	echo('</th>');
	echo('<th width="100px">');
	echo('Delete');
	echo('</th>');
	echo('</tr>');
	create_treeview(0, 0);
	echo('</table>');
	
	
?>
<br>
<a href="index.php?pid=add_category"><img src="../icon/add.png" alt="New" title="Kategorie hinzufügen"></a>
<?php

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
			
			//Hirarchy
			
			if($row->id_sup == 0)
			{
				echo('<tr class="alt">');
			}else{
				echo('<tr>');
			}
			
			//Cat active
			echo('<td>');
			if($row->active == 1)
			{
				echo('<a href="cat_func.php?action=set_inactive&id='.$row->id.'"><img src="../icon/flag_green.png" alt="Active"></a>');
			}else{
				echo('<a href="cat_func.php?action=set_active&id='.$row->id.'"><img src="../icon/flag_red.png" alt="Inactive"></a>');
			}
			
			//Cat name and icon
			echo('</td><td style="padding-left:'.(($level*2)+0.5).'em;">');
			if($row->id_sup == 0)
			{
				echo('<img src="../icon/folder_add.png" alt="Active">');
			}else{
				echo('<img src="../icon/folder.png" alt="Active">');
			}
			echo($row->name);
			
			//Edit and Delete
			echo('</td><td>');
			echo('<a href="index.php?pid=edit_cat&id='.$row->id.'"><img src="../icon/page_edit.png" alt="Edit" title="Kategorie editieren"></a>');
			echo('</td><td>');
			echo('<a href="cat_func.php?action=del&id='.$row->id.'"><img src="../icon/cancel.png" alt="kill" title="Kategorie löschen"></a>');
			echo('</td></tr>');
			
			create_treeview($row->id, $level+1);
		}
	$db->disconnect();
}
?>
