<?php
	#File: db.class.php
	#Author: Christian Lohr
	#Desc: Used for all our Database Connections, Queries, etc...
	
	
	
	class database {
	  private $connection = NULL;	#Points to current Connection
	  private $result = NULL;		#Holds SQL Results
	  private $counter = NULL;		#Used for row counting
	  
	  
	  
	  
	  
	  function database()
	  {
		//empty constructor
	  }
	  
	  
	  function resetPointer($target = 0)
	  {
		if($this->connection <> NULL && $this->result <> NULL)
		{
			mysql_data_seek($this->result, $target);
		}
	  }
	 
	 
	 
	 
	  #Connect To DB Using Global Variable Definitions
	  function connect()
	  {
		if($this->connection == NULL)
		{
			$this->connection = mysql_connect($GLOBALS['GLOBALS_db_address'], $GLOBALS['GLOBALS_db_user'], $GLOBALS['GLOBALS_db_pass']);
			mysql_select_db( $GLOBALS['GLOBALS_db_name'], $this->connection);
		}
	  }
	 
	 
	 
	 
	 
	 #Returns SQL GetLastID Command
	 function getLastId()
	 {
		return mysql_insert_id($this->connection);
	 }
	 
	 
	 
	 
	 
	 #Returns SQL Error
	 function getError()
	 {
		return mysql_error($this->connection);
	 }
	 
	 
	 
	 
	 
	  #Disconnects from the DB
	  function disconnect() {
	    if (is_resource($this->connection))
		{
	        mysql_close($this->connection);
			$this->connection = NULL;
		}
	  }
	 
	 
	 
	 
	 
	 
	  #Executes a (nonscalar) query and returns the Results
	  function query($query) {
	  	$this->result=mysql_query($query,$this->connection);
	  	$this->counter=NULL;
		return $this->result;
	  }
	  
	  
	  
	  
	  
	  #Fetches rows from the last query
	  function fetch($res = false) {
	  	if(!$res) { $res = $this->result; } 
	  	return mysql_fetch_assoc($res);
	  }
	  
	  
	  
	  
	  
	  #Fetches rows as objects from the last query
	  function fetch_object($res = false) {
	  	if(!$res) { $res = $this->result; } 
	  	return mysql_fetch_object($res);
	  }
	 
	 
	 
	 
	  #Counts the line of rows of the last SQL result
	  function count() {
	  	if($this->counter==NULL && is_resource($this->result)) {
	  		$this->counter=mysql_num_rows($this->result);
	  	}
		return $this->counter;
	  }
	  
	  
	  
	  
	  
	}
?>