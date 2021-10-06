<?php  

	if(ISSET($_POST['send'])){

		$receiver=$_POST["receiver"];         //receiving receiver field value in $name variable
		$subject=$_POST["subject"];             //receiving subject field value in $password variable  
		$message_body= $_POST["message_body"];  //receiving message_body field value in $password variable 
		$sender = $_SESSION['username'];
		$date = date('d.m.Y h:i');

		//Message confirmation
		/*echo "Message confirmation:";
		echo "Receiver: $receiver "; 
		echo "Subject: $subject";
		echo "Message: $message_body";
		echo "Thank you for submitting";*/
		echo "Message is send !";		

		//Saving the message in the database
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

		$send = "INSERT INTO messages (sender, receiver, subject, date, message) 
				VALUES ('$sender', '$receiver', '$subject', '$date', '$message_body')";				
		
		//echo $send;
				
		$db->exec("INSERT INTO messages (sender, receiver, subject, date, message) 
				VALUES ('$sender', '$receiver', '$subject', '$date', '$message_body')");

		// Close file db connection
		$db = null;
	}

?>  