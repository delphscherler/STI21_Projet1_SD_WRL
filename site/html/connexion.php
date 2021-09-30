<?php
// Set default timezone
  date_default_timezone_set('UTC');
 
  try {
    /**************************************
    * Create databases and                *
    * open connections                    *
    **************************************/
 
    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION); 
 
    /**************************************
    * Create tables                       *
    **************************************/
 
    // Create users
    $file_db->exec("CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY, 
                    username TEXT, 
                    password TEXT)"); 
					
	
 
    /**************************************
    * Set initial data                    *
    **************************************/
 
    // Array with some test users to insert to database             
    $users = array(
                  array('username' => 'admin',
                        'password' => 'admin')                        
                ); 
				
	/**************************************
    * Play with databases and tables      *
    **************************************/
 
	//TODO: avoid duplicates !
/*
    foreach ($users as $u) {        
        $file_db->exec("INSERT INTO users (username, password) 
                VALUES ('{$u['username']}', '{$u['password']}')");
    }
 */
    /**************************************
    * Close db connections                *
    **************************************/
 
    // Close file db connection
    $file_db = null;
  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>