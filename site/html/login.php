<?php
    require_once 'connexion.php';
 
    if(ISSET($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
 
		//PROBLEM avec query
 
       /*$result = $file_db->query("SELECT COUNT(*) as count FROM `users` WHERE `username`='$username' AND `password`='$password'");
        $row=$result->fetchArray();
        $count=$row['count'];*/
			
		
       if($count > 0){
            //echo "<div class='alert alert-success'>Login successful</div>";
			echo "<div>Login successful</div>";
        }else{
            //echo "<div class='alert alert-danger'>Invalid username or password</div>";
			echo "<div>Invalid username or password</div>";
        }
    }
	
	echo "<div>Invalid username or password</div>";
?>