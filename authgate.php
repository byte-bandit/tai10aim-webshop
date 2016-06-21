<?php
	
	session_start();
	  
	if(!isset($_SESSION['user_login']) or $_SESSION['user_login'] <> 1)
	{
		exit('Access denied! Please login...');
	}
?>