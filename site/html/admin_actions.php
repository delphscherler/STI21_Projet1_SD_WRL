<?php

    require('connexion.php');

	if(ISSET($_POST['add'])) {

		$uname=$_POST["usr_username"];    //receiving username field value in $uname variable
		$password=$_POST["usr_password"];    //receiving password field value in $password variable  
		$validity= $_POST["validity"];       //receiving validity value in $validity variable 
		$role = $_POST["role"];              //receiving role value in $role variable 

		print $uname;
		print $password;
		print $validity;
		print $role;


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

	if(ISSET($_POST['modify'])) {
		
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
			foreach  ($file_db->query($sql) as $row) {					
				$us = $row['username'];
				$pa = $row['password'];
				$va = $row['validity'];
				$ro = $row['role'];
			}
			echo ' Current user ';
			print $us;
			echo ' has password ';
			print $pa;
			//print $va;
			//print $ro;

			//Display current status of user

			if($va == 1){
				echo ' is active ';
			}
			else{
				echo ' is not active ';
			} 
			if($ro == 1){
				echo 'and is an administrator.';
			} 
			else{
				echo 'and is a collaborator.';
			} 
			
			//include 'modify_user.php';


			exit();
		}
	}
}
		
	// Close file db connection
	$file_db = null;	
?>