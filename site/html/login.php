<?php
    require_once 'connexion.php';
 
    if(ISSET($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
 
        $query=$file_db->query("SELECT COUNT(*) as count FROM `users` WHERE `username`='$username' AND `password`='$password'");
        $row=$query->fetchArray();
        $count=$row['count'];
 
        if($count > 0){
            //echo "<div class='alert alert-success'>Login successful</div>";
			echo "Login successful";
        }else{
            //echo "<div class='alert alert-danger'>Invalid username or password</div>";
			echo "Invalid username or password";
        }
    }
	
?>