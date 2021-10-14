<?php  

	if(ISSET($_POST['send'])){

		$receiver=$_POST["receiver"];         //receiving receiver field value in $name variable
		$subject=$_POST["subject"];             //receiving subject field value in $password variable  
		$message_body= $_POST["message_body"];  //receiving message_body field value in $password variable 
		$sender = $_SESSION['username'];
		date_default_timezone_set('Europe/Zurich');
		$date = date('d.m.Y H:i');

		//Message confirmation
		echo "<div class=\"alert alert-dismissible alert-success\">";
		echo "Message is send!";
		echo "</div>";

		//Saving the message in the database
		require('connexion.php');

		$send = "INSERT INTO messages (sender, receiver, subject, date, message) 
				VALUES ('$sender', '$receiver', '$subject', '$date', '$message_body')";				
		
		//echo $send;
				
		$file_db->exec("INSERT INTO messages (sender, receiver, subject, date, message) 
				VALUES ('$sender', '$receiver', '$subject', '$date', '$message_body')");

		// Close file db connection
		$file_db = null;
	}

?>  