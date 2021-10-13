<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>  
   
   <!-- Modifier un utilisateur!-->
    <h3 class="text-tertiary">Modify a user</h3>
	<button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>	
	<hr style="border-top:1px dotted #ccc;"/>

   <!-- Voir un utilisateur!-->
    <h4 class ="text-tertiary"> Show a user</h4>		
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="to_show_username" class="form-control" required="required"/>
            </div>
            <button name="show" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>show</button>
        </form>
    </div>
	<hr style="border-top:1px dotted #ccc;"/>

	<!-- Modifier le mot de passe d'un utilisateur!-->
        <form method="POST">
            <button name="update_pwd" class="btn btn-outline-primary"><span class="glyphicon glyphicon-log-in"></span>Modify password of a user</button>
			<button name="update_val" class="btn btn-outline-info"><span class="glyphicon glyphicon-log-in"></span>Modify validity of a user</button>
			<button name="update_role" class="btn btn-outline-danger"><span class="glyphicon glyphicon-log-in"></span>Modify role of a user</button>
        </form>
	<hr style="border-top:1px dotted #ccc;"/>

    <?php
    if(ISSET($_POST['show'])) {

		require('connexion.php');
		
		$uname=$_POST["to_show_username"];    //receiving username field value in $uname variable
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
			echo "Username : ";
			echo $uname;
			foreach  ($file_db->query($sql) as $row) {
				$val = $row['validity'];		
				$rol = $row['role'];
				$pwd = $row['password'];
				echo " Password : ";
				echo $pwd;
				echo " Validity : ";
				if($row['validity'] == 0){
					echo " inactive";
				}
				if($row['validity'] == 1){
					echo " active";
				}
				echo " Role : ";
				if($row['role'] == 0){
					echo " not admin";
				}
				if($row['role'] == 1){
					echo " admin";
				}
			}

		}
		// Close file db connection
		$file_db = null;
	}

	if(ISSET($_POST['update_pwd'])) {
		header("Location: modify_user_pwd.php");
	}

	if(ISSET($_POST['update_val'])) {
		header("Location: modify_user_val.php");
	}

	if(ISSET($_POST['update_role'])) {
		header("Location: modify_user_role.php");
	}	
    ?>

    </body>		
</html>