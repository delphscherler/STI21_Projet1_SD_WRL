<?php
	session_start();
	
	//Control if user is logged in
	if(!isset($_SESSION['username'])){
	   header("Location:index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>  
   
   <!-- Modifier un utilisateur!-->
    <h2 class="text-tertiary">Modify user</h2>
	<hr style="border-top:1px dotted #ccc;"/>
	<button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>	
	<hr style="border-top:1px dotted #ccc;"/>

   <!-- Voir un utilisateur!-->
    <h4 class ="text-tertiary"> Show user</h4>		
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
				<select class="form-select" name="to_show_username" required="required">
					<?php
						require('connexion.php');
						$sql="SELECT * FROM users";
						foreach  ($file_db->query($sql) as $row) {
							$username = $row['username'];						
							echo "<option>$username</option>";
						}
						// Close file db connection
						$file_db = null;
					?>
				</select>
				<button name="show" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Show</button>
            </div>
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
		echo "Username : ";
		echo $uname;
		echo "<br>";
		foreach  ($file_db->query($sql) as $row) {
			echo " Password : ";
			echo $row['password'];
			echo "<br>";
			echo " Validity : ";
			if($row['validity'] == 0){
				echo " inactive <br>";
			}
			if($row['validity'] == 1){
				echo " active <br>";
			}
			echo " Role : ";
			if($row['role'] == 0){
				echo " not admin <br>";
			}
			if($row['role'] == 1){
				echo " admin <br>";
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