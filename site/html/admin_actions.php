<?php

	// Create (connect to) SQLite database in file
	$db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
	// Set errormode to exceptions
	$db->setAttribute(PDO::ATTR_ERRMODE, 
							PDO::ERRMODE_EXCEPTION); 

	if(!$db){
		echo $db->lastErrorMsg();
		} else {
	    echo "Opened database successfully\n";
	 }

	if(ISSET($_POST['add'])) {

		$uname=$_POST["usr_username"];    //receiving username field value in $username variable
		$password=$_POST["usr_password"];    //receiving password field value in $password variable  
		$validity= $_POST["validity"];       //receiving validity value in $validity variable 
		$role = $_POST["role"];              //receiving role value in $role variable 

		print $uname;
		print $password;
		print $validity;
		print $role;

		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $db->query($sql)->fetchAll();

		//If username already exists, display error message
		if ( sizeof($ret) == 1 ){
			echo "This username already exists";
			exit();
		}
		else{
			$db->exec("INSERT INTO users (username, password, validity, role) 
			VALUES ('$uname', '$password', '$validity', '$role')");
			echo "New user successfully added";
		}

	}
		
	// Close file db connection
	$db = null;	
?>