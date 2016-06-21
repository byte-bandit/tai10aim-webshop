<?php
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
	
	$db = new database();
	$db->connect();
	
	
	switch($_GET['action'])
	{
		case 'add':
			if($_POST['input_name'] <> "" and $_POST['input_kategorie'] <> "")
			{
				$sql = "INSERT INTO
							categories(id, name, id_sup, active)
						VALUES(
							NULL,
							'".$_POST['input_name']."',
							'".$_POST['input_kategorie']."',
							'1'
						);
				";
				$result = $db->query($sql);
				if($result)
				{
					$return = 'Kategorie wurde angelegt.';
				}else{
					$return = 'Versuch fehlgeschlagen.';
				}
			}else{
				$return = 'Not enough data';
			}
			break;
		
		case 'del':
			deleteCategories($_GET['id']);
			break;
			
		case 'edit':
			if($_POST['input_name'] <> "" and $_POST['input_kategorie'] <> "")
			{
				$sql = "UPDATE
							categories
						SET
							name = '".$_POST['input_name']."',
							id_sup = ".$_POST['input_kategorie']."
						WHERE
							id = ".$_GET['id']."
				";
				$result = $db->query($sql);
				if($result)
				{
					$return = 'Kategorie wurde geändert.';
				}else{
					$return = 'Versuch fehlgeschlagen.';
				}
			}else{
				$return = 'Not enough data';
			}
			break;
			
		case 'set_active':
			setActive($_GET['id'], 1);
			setMyChildActive($_GET['id']);
			break;
		
		case 'set_inactive':
			setActive($_GET['id'], 0);
			break;
			
		default:
			break;
	}
	
	$db->disconnect();
	
	
	
	
	
	
	function deleteCategories($myid)
	{
		$db = new database();
		$db->connect();
		
		$sql = "SELECT
					*
				FROM
					categories
				WHERE
					id_sup = ".$myid."
			";
					
		$db->query($sql);
			

		while($row = $db->fetch_object())
		{
			deleteCategories($row->id);
		}
		
		$sql = "SELECT
					*
				FROM
					products
				WHERE
					category_id = ".$myid."
			";
				
		$db->query($sql);
		
		
		while($row = $db->fetch_object())
		{
			rrmdir('../images/products/'.$row->article_nr);
		}
		
		$sql = "DELETE FROM
					products
				WHERE
					category_id = ".$myid."
			";
				
		$db->query($sql);
		
		$sql = "DELETE FROM
					categories
				WHERE
					id = ".$myid."
			";
				
		$db->query($sql);
	}
	
	
	function rrmdir($dir) {
	if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 }
	
	
	function setMyChildActive($myid)
	{
		$db = new database();
			$db->connect();
			
			$sql = "UPDATE
						categories
					SET
						active = 1
					WHERE
						id = ".$myid."
				";
				
			$db->query($sql);
		$sql = "SELECT
					*
				FROM
					categories
				WHERE
					id_sup = ".$myid."
			";
					
		$db->query($sql);
			

		while($row = $db->fetch_object())
		{
			setMyChildActive($row->id);
		}
	}
	
	
	
	function setActive($myid, $activate)
	{
			$db = new database();
			$db->connect();
			
			$sql = "UPDATE
						categories
					SET
						active = ".$activate."
					WHERE
						id = ".$myid."
				";
				
			$db->query($sql);
			
			if($activate == 0)
			{
				$sql = "SELECT
							*
						FROM
							categories
						WHERE
							id_sup = ".$myid."
					";
					
				$db->query($sql);
			

				while($row = $db->fetch_object())
				{
						setActive($row->id, $activate);
				}
				
				
				
			}else{
			
				$sql = "SELECT
							*
						FROM
							categories
						WHERE
							id = ".$myid."
					";
				$db->query($sql);
				$row = $db->fetch_object();
				
				$sql = "SELECT
							*
						FROM
							categories
						WHERE
							id = ".$row->id_sup."
					"; 
				$db->query($sql);
				while($row = $db->fetch_object())
				{
						setActive($row->id, $activate);
				}
			}
			$db->disconnect();
			
	}
	
?>
<html>
	<head>
		<meta http-equiv="refresh" content="1; URL=index.php?pid=category_conf">
		<title>Administration</title>
	</head>
	<body>
		<?php
			
			echo($return);
			//echo($result);
			//echo($pwhash);
		?>
	</body>
</html>