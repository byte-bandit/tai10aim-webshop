<?php
	session_start();
	if(!isset($_SESSION['login']) or $_SESSION['login'] <> 1)
	{
		exit('Access denied!');
	}
?>