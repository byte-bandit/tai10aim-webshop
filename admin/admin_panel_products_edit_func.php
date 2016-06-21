<?php
	
	if(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			case 'setstd':
				setStandart();
				break;
				
		}
	}
	
	
	function setStandart()
	{
		if(!isset($_GET['pic']))
		{
			return 0;
		}
		
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
			UPDATE
				products
			SET
				`picture_url` = 'images/products/{$row->article_nr}/{$_GET['pic']}'
			WHERE
				id={$_GET['id']}
		";
		$result = $db->query($sql);
		$db->disconnect();
		return $result;
	}
	
?>