<?php
    require_once 'connexion.php';
 
    if(ISSET($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
	
 
		//$result = $file_db->query("SELECT COUNT(*) as count FROM `users` WHERE `username`='$username' AND `password`='$password'");
        //$row=$result->fetchArray();
        //$count=$row['count'];		

		//Open DB
		$file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
		
		$sql = "SELECT * from users WHERE username='$username' AND password='$password'";
		$ret = $file_db->query($sql);
		//$row = $ret->fetchArray();
		//$count=$row['count'];		
		
		
		// Close file db connection
		$file_db = null;
		
       if($count > 0){
            echo "<div>Login successful</div>";
        }else{
            echo "<div>Invalid username or password</div>";
        }
    }	
?>