<?php
	if(ISSET($_POST['login'])){		
		require('connexion.php');

		$uname=$_POST['username'];
		$password=$_POST['password'];

		$sql="SELECT * FROM users WHERE username='".$uname."'AND password='".$password."'";
		//echo $sql;
		   
	   foreach  ($file_db->query($sql) as $row) {		
			if($row['validity'] == 0){
				echo "Inactive account, please contact your administrator";
				exit();
			}
		}
		
		$ret = $file_db->query($sql)->fetchAll();
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
		$file_db = null;
	}
?>