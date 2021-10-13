<?php

    require('connexion.php');

	if(ISSET($_POST['add'])) {

		$uname=$_POST["usr_username"];    //receiving username field value in $uname variable
		$password=$_POST["usr_password"];    //receiving password field value in $password variable  
		$validity= $_POST["validity"];       //receiving validity value in $validity variable 
		$role = $_POST["role"];              //receiving role value in $role variable 


		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $file_db->query($sql)->fetchAll();


		//If username already exists, display error message
		if ( sizeof($ret) == 1 ){
			echo '<script type ="text/JavaScript">';  
			echo 'alert("This username already exists")';  
			echo '</script>';
			exit();
		}
		else{
			$file_db->exec("INSERT INTO users (username, password, validity, role) 
			VALUES ('$uname', '$password', '$validity', '$role')");					
			echo '<script type ="text/JavaScript">';  
			echo 'alert("New user successfully added")';  
			echo '</script>';
			exit();
		}


	}

	if(ISSET($_POST['delete'])) {
		
		$uname=$_POST["to_del_username"];    //receiving username field value in $uname variable

		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $file_db->query($sql)->fetchAll();

		//If username does not exist, display error message
		if ( sizeof($ret) == 0 ){
			echo '<script type ="text/JavaScript">';  
			echo 'alert("This username does not exists")';  
			echo '</script>';	
			exit();
		}
		else{
			$del = "DELETE FROM users WHERE username='".$uname."'";		
			$file_db->exec($del);
			echo '<script type ="text/JavaScript">';  
			echo 'alert("User successfully deleted")';  
			echo '</script>';	
			exit();
		}
	}
	if(ISSET($_POST['show'])) {
		
		$uname=$_POST["to_mod_username"];    //receiving username field value in $uname variable

		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $file_db->query($sql)->fetchAll();

		//If username does not exist, display error message
		if ( sizeof($ret) == 0 ){
			echo '<script type ="text/JavaScript">';  
			echo 'alert("This username does not exists")';  
			echo '</script>';	
			exit();
		}
		else{
			echo $uname;
			foreach  ($file_db->query($sql) as $row) {
				$val = $row['validity'];		
				$rol = $row['role'];
				$pwd = $row['password'];
				echo "password : ";
				echo $pwd;
				if($row['validity'] == 0){
					echo " Inactive";
				}
				if($row['validity'] == 1){
					echo " Active";
				}
				if($row['role'] == 0){
					echo " Not Admin";
				}
				if($row['role'] == 1){
					echo " Admin";
				}
			}
			include 'modify_user.php';

		}
	}




		
	// Close file db connection
	$file_db = null;	
?>