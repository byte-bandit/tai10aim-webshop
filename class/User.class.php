<?php

	//Here we got the swinger to handle user management in the Database
	//One day it shall handle user adding, deleting, updating
	class User
	{
		private $db;
	
		function User()
		{
			$this->db = new database();
		}
		
		function add($name, $prename, $surname, $pw, $email)
		{
			$this->db->connect();
			
			$pw_hash = hash_hmac($GLOBALS['GLOBALS_encryptions_passwords_algorythm'], $pw, $GLOBALS['GLOBALS_encryptions_passwords_key']);
			
			$sql = "
				INSERT INTO 
					users (id, name, prename, surname, password_hash, email, active) 
				VALUES 
					(NULL, '".$name."', '".$prename."', '".$surname."', '".$pw_hash."', '".$email."', '1')
			";
			
			$result = $this->db->query($sql);
			
			if($result)
			{
				$result = $this->db->getLastId();
			}
			
			$this->db->disconnect();
			
			return $result;
		}
	
	}

?>