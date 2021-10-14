<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>  

	<!-- Modifier le mot de passe d'un utilisateur!-->
	<h2 class ="text-tertiary"> Modify password of user</h2>		
	<hr style="border-top:1px dotted #ccc;"/>	
    <button class="btn btn-dark" onclick="document.location.href='modify_user.php'">Back</button>	
	<hr style="border-top:1px dotted #ccc;"/>	
	<div class="col-md-6"> 
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
				<select class="form-select" name="pwd_username" required="required">
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
            </div>
			<div class="form-group">
                <label>Password :</label>
                <input type="password" name="new_password" class="form-control" required="required"/>
            </div>
            <button name="upd_pwd" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update Password</button>
        </form>
    </div>
    <?php
        if(ISSET($_POST['upd_pwd'])) {

            require('connexion.php');
            $uname=$_POST["pwd_username"];    //receiving username field value in $uname variable
            $upd = "UPDATE users SET password='".$_POST['new_password']."' WHERE username='".$uname."'";		
            $file_db->exec($upd);
            echo '<script type ="text/JavaScript">';  
            echo 'alert("Password successfully updated")';  
            echo '</script>';	
            exit();  
            // Close file db connection
            $file_db = null;
        }
    ?>
    </body>		
</html>