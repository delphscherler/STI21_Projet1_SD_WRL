<?php
	if(ISSET($_POST['login'])){		
		require('connexion.php');

		$uname=$_POST['username'];
		$password=$_POST['password'];

		$stmt = $file_db->prepare("SELECT * FROM users WHERE username='".$uname."'");
		$stmt->execute();
		$res = $stmt->fetch();
		$passwordDB = $res['password'];
		//On vérifie le mot de passe
        if(password_verify($password, $passwordDB)){
            //On vérifie la validité
            if($res['validity'] == 0){
                echo "<div class=\"alert alert-dismissible alert-danger\">";
                echo "Inactive account, please contact your administrator.";
                echo "</div>";
                exit();
            }
            //On crée la session
            $_SESSION["username"] = $uname;
            //On redirige sur inbox
            header('Location: inbox.php');
            exit();
        }
        else{
            echo "<div class=\"alert alert-dismissible alert-danger\">";
            echo "Invalid username or password!";
            echo "</div>";
            exit();
        }

		// Close file db connection
		$file_db = null;
	}
?>