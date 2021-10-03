<?php
	if(ISSET($_POST['login'])){
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
		$uname=$_POST['username'];
		$password=$_POST['password'];

		$sql="SELECT * FROM users WHERE username='".$uname."'AND password='".$password."'";
		//echo $sql;
		   
	   /* foreach  ($db->query($sql) as $row) {
			print $row['username'] . "\t";
			print $row['password'] . "\t";
			print $row['validity'] . "\n";
		}*/
		$ret = $db->query($sql)->fetchAll();
	   // print sizeof($ret);

		if( sizeof($ret) == 0 ){
			echo "Invalid username or password";
			exit();
		}
		else{
			//echo "Login successful";
			$_SESSION["username"] = $uname;
			header('Location: inbox.php');
			exit();
		}

		// Close file db connection
		$db = null;
	}
?>