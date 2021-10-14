<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>
       
       <!-- Ajouter un utilisateur!-->

    <h2 class="text-tertiary">Add a new user</h2>
	<hr style="border-top:1px dotted #ccc;"/>	
    <button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>	
	<hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="usr_username" class="form-control" required="required"/>
            </div>
            <div class="form-group">
                <label>Password :</label>
                <input type="password" name="usr_password" class="form-control" required="required"/>
            </div>
            <div class="form-group">
                <label>Validity :</label>
                <input type="radio" id="val_0" name="validity" value="0" required="required">
                <label for="html">Inactif</label>
                <input type="radio" id="val_1" name="validity" value="1" required="required">
                <label for="css">Actif</label><br>
            </div>
            <div class="form-group">
                <label>Role :</label>
                <input type="radio" id="role_0" name="role" value="0" required="required">
                <label for="html">Collaborateur</label>
                <input type="radio" id="role_1" name="role" value="1" required="required">
                <label for="css">Administrateur</label><br>
            </div>
            <button name="add" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Add</button>
        </form>
    </div>
    <?php

    	if(ISSET($_POST['add'])) {

            require('connexion.php');

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
            		
            // Close file db connection
            $file_db = null;
        }
        ?>
    </body>		
</html>