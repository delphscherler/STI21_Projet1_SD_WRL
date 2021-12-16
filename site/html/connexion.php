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
    /*
    // Create users
    $file_db->exec("CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY, 
                    username TEXT, 
                    password TEXT,
					validity INTEGER,
					role INTEGER,
					UNIQUE(username))"); 
					
	$file_db->exec("CREATE TABLE IF NOT EXISTS messages (
                    id INTEGER PRIMARY KEY, 
                    sender TEXT, 
                    receiver TEXT,
					subject TEXT,
					date TEXT,
					message TEXT)"); 
	
    */
    /**************************************
    * Set initial data                    *
    **************************************/

      /*
    // Array with some test users to insert to database
	//validity = 1 -> valid / validity = 0 -> not valid
	//role = 1 -> admin / role = 0 -> user
    $users = array(
                  array('username' => 'admin',
                        'password' => 'admin',
                        'validity' => 1 ,
                        'role' => 1),
				  array('username' => 'test',
                        'password' => 'test',
                        'validity' => 1 ,
                        'role' => 0) 
                ); 
	*/
	/**************************************
    * Play with databases and tables      *
    **************************************/ 
    /*
    foreach ($users as $u) {        
        $file_db->exec("INSERT OR IGNORE INTO users (username, password, validity, role) 
                VALUES ('{$u['username']}', '{$u['password']}', '{$u['validity']}', '{$u['role']}')");
    }
    */
    /**************************************
    * Close db connections                *
    **************************************/
 
    // Close file db connection
   // $file_db = null;
  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
