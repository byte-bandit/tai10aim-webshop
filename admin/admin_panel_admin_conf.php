<?php
	#File: admin_panel_admin_conf.php
	#Author: Christian Lohr
	#DESC: Displays a List of all Admins incl. Options to edit/delete them
	
	
	
	#DB HANDLE
	$db = new database();
	$db->connect();
	
	$sql = "
		SELECT
			*
		FROM
			db_admins
	";
	
	$db->query($sql);
	$db->disconnect();
	
	
	
	
	
	#STATIC CONTENT:
?>
<table id="admin">
	<tr>
		<th>
			Active
		</th>
		<th>
			Name
		</th>
		<th>
			Email Addresse
		</th>
		<th>
			Edit
		</th>
		<th>
			Delete
		</th>
	</tr>
	<?php
	
	
	
	
		#Creating the List:
		$rowcounter = 0;	#Used for alternating Row Color Styles
		
		
		while($row = $db->fetch_object())
		{
			//Alternating Row Colors
			$rowcounter ++;
			if($rowcounter % 2 == 0)	#Using MOD to check for rest of division
			{
				echo('<tr>');
			}else{
				echo('<tr class="alt">');
			}
			
			//Set Active/Inactive
			echo('<td>');
			if($row->superadmin == 0) //Only availible to not-superadmin admins
			{
				if($row->active == 1)
				{
					#Admin Active - Give Option to disable
					echo('<a href="admin_func.php?action=set_inactive&id='.$row->id.'"><img src="../icon/flag_green.png" alt="Active"></a>');
				}else{
					#Admin Disabled - Give Option to Enable
					echo('<a href="admin_func.php?action=set_active&id='.$row->id.'"><img src="../icon/flag_red.png" alt="Inactive"></a>');
				}
			}else{
				#Superadmin! Those cannot be disabled!
				echo('<font color="#FF0000">Superadmin</font>');
			}
			
			
			
			
			
			//Name
			echo('</td><td>');
			if($row->superadmin) { echo('<b><font color="#FF0000">');}
			echo($row->name);
			if($row->superadmin) { echo('</font></b>');}
			
			
			
			
			
			//Password
			echo('</td><td>');	
			if($row->superadmin) { echo('<b><font color="#FF0000">');}
			echo($row->email);
			if($row->superadmin) { echo('</font></b>');}
			
			
			
			
			
			//Edit and Delete
			echo('</td><td>');
			if($row->superadmin == 0) //Only availible to not-superadmin admins
			{
				echo('<a href="index.php?pid=edit_admin&id='.$row->id.'"><img src="../icon/page_edit.png" alt="Edit"></a>');
				echo('</td><td>');
				echo('<a href="admin_func.php?action=del&id='.$row->id.'"><img src="../icon/cancel.png" alt="kill" title="Admin löschen"></a>');
			}else{
				echo('<font color="#FF0000">Superadmin</font></td><td><font color="#FF0000">Superadmin</font>');
			}
			echo('</td></tr>');
		}
		
	?>
</table>
<br>
<a href="index.php?pid=add_admin"><img src="../icon/add.png" alt="New" title="Admin hinzufügen"></a>
