<?php

	function getCategory($id)
	{
		$db = new database();
		$db->connect();
		
		$sql = "
			SELECT
				*
			FROM
				categories
			WHERE
				id={$id}
		";
		
		$db->query($sql);
		$row = $db->fetch_object();
		
		return $row->name;
		
	}
	
	
	function getSize($id)
	{
		$db = new database();
		$db->connect();
		
		$sql = "
			SELECT
				*
			FROM
				product_sizes
			WHERE
				id={$id}
		";
		
		$db->query($sql);
		$row = $db->fetch_object();
		
		return $row->name;
	}
	
	
	function drawRating($n)
	{
		for($i=1; $i<=$n; $i++)
		{
			echo('<img src="../'.$GLOBALS['GLOBALS_icons_rating'].'" alt="rating">');
		}
		
		for($i=5; $i>$n; $i--)
		{
			echo('<img src="../'.$GLOBALS['GLOBALS_icons_rating_empty'].'" alt="rating">');
		}
		
	}
	function getRating($id)
	{
		$rowcounter = 0;
		$ratingsum = 0;
		$rating = 0 ;
		$db = new database(); 
		$db->connect();
	
		$sql = "
			SELECT
				rating
			FROM
				comments
			WHERE
				product_id={$id}
		";
		if(!$result = $db->query($sql))
			{
				exit($GLOBALS_error_msg.'<br>'.$db->getError());
			}

		while($row = $db->fetch_object())
		{
			$rowcounter++;
			$ratingsum += $row->rating;
		}
		if($rowcounter != 0)
			{$rating = round($ratingsum / $rowcounter); }
			
		return $rating;
	}
		function setRating($pid,$rating)
	{
		$db = new database(); 
		$db->connect();
	
		$sql = "
			UPDATE
				products
			SET
				rating={$rating}
			WHERE
				id={$pid}
		";
		$db->query($sql);
	}

?>