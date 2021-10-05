<?php

	// Create (connect to) SQLite database in file
	$db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
	// Set errormode to exceptions
	$db->setAttribute(PDO::ATTR_ERRMODE, 
							PDO::ERRMODE_EXCEPTION); 

	if(!$db){
		echo $db->lastErrorMsg();
		} else {
	    //echo "Opened database successfully\n";
	 }

	if(ISSET($_POST['read'])) {
		header("Location: show_message.php");				
	}
	if(ISSET($_POST['answer'])) {
		header("Location: new_message.php");				
	}			
	
	if(ISSET($_POST['delete'])) {	
		header("Location: inbox.php"); //stay in inbox
		$del = "DELETE FROM messages WHERE sender='".$_POST['sender']."' AND date='".$_POST['date']."' AND subject='".$_POST['subject']."'";		
		$db->exec($del);
	}

	// Close file db connection
	$db = null;	
?>