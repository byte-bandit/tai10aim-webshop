<?php
	
	//This baby is supposed to deliver a list of category IDs
	//This way you have your correct order of categories available
	
	class CategoryLister
	{
		private $db;
		
		function CategoryLister()
		{
			//Constructor
			$this->db = new database();
		}
		
		function getTotalSubCategories($init, $active=0)
		{
			$item = $this->getSubCategoryRec($init, $active);
			$this->db->disconnect();
			//$item = $this->structureReturnArray($item);
			return $item;
		}
		
		function structureReturnArray($arr)
		{
			$return = array();
			
			if(!is_array($arr))
			{
				$return[] = $arr;
			}
			foreach($arr as $val)
			{
				if(is_array($val))
				{
					foreach($val as $key)
					{
						$return[] = $this->structureReturnArray($key);
					}
				}
				$return = $val;
			}
			return $return;
		}
		
		function getCatList($level=0)
		{
			$this->db = new database();
			$this->db->connect();
			$catList = $this->getCatRecursive($level);
			$this->db->disconnect();
			return $catList;
		}
		
		function getSubCategoryRec($i, $active=0)
		{
			$items = array();
			$this->db->connect();
			
			if($active == 1)
			{
				$sql = "
				SELECT
					*
				FROM
					categories
				WHERE
					`id_sup` = {$i}
				AND
					`active` = 1
				ORDER BY
					`id` ASC
			";
			}else{
				$sql = "
				SELECT
					*
				FROM
					categories
				WHERE
					`id_sup` = {$i}
				ORDER BY
					`id` ASC
			";
			}
			
			
			
			$result = $this->db->query($sql);

			if(mysql_num_rows($result) > 0)
			{
				while($row = $this->db->fetch_object($result))
				{
					$items[] = $this->getSubCategoryRec($row->id, $active);
				}
			}
			
			$items[] = $i;
			return $items;
		}
		
		function getCatRecursive($id)
		{
			$item = array();
			$subItems = array();
			
			$sql = "
				SELECT
					*
				FROM
					categories
				WHERE
					id_sup = {$id}
				ORDER BY
					name ASC
			";	
			$result = $this->db->query($sql);
			
			if(mysql_num_rows($result) > 0) {
				while($cats = $this->db->fetch_object($result)) {
					$subItems[] = $this->getCatRecursive($cats->id);
				}
			}
			
				
			$sql = "
				SELECT
					*
				FROM
					categories
				WHERE
					id = {$id}
				LIMIT 1
			";	
			$result = $this->db->query($sql);
			
			if(mysql_num_rows($result) > 0) {
				$cat = $this->db->fetch_object($result);
				
				$item = array(
					"id" => $cat->id,
					"name" => $cat->name,
					"subitems" => $subItems
				);
			}else{
				$item = array(
					"id" => 0,
					"name" => "root",
					"subitems" => $subItems
					);
			}
			return $item;
		}
	}
?>