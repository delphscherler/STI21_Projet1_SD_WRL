<?php

//echo "Your password has been successfully updated";

	// Create (connect to) SQLite database in file
	$db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
	// Set errormode to exceptions
	$db->setAttribute(PDO::ATTR_ERRMODE, 
							PDO::ERRMODE_EXCEPTION); 

	if(!$db){
		echo $db->lastErrorMsg();
		} else {
	   // echo "Opened database successfully\n";
	 }		
	
	if(ISSET($_POST['update'])) {	
	//	header("Location: administration.php"); //stay in inbox
		$upd = "UPDATE users SET password='".$_POST['new_password']."' WHERE username='".$_SESSION['username']."'";		
		$db->exec($upd);
	}

	// Close file db connection
	$db = null;	
?>