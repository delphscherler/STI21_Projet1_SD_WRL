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
    <div class="col-md-6 well">
        <h1 class="text-primary">Administration</h1>		
        <hr style="border-top:1px dotted #ccc;"/>
		<button class="btn btn-dark" onclick="history.go(-1);">Back</button>
		<hr style="border-top:1px dotted #ccc;"/>    
        <!-- Gestion du changement de mot de passe! -->
        <h2 class="text-tertiary">Update password</h2>		
        <div class="col-md-6">    
            <form method="POST">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" required="required"/>
                </div>
                <button name="update" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>update</button>
            </form>
            <?php include 'change_password.php'?>
        </div>
        <!-- Gestion des utilisateurs! -->    
        <h2 class="text-tertiary">Manage users</h2>		
        <!-- Ajouter un utilisateur!-->
        <h3 class="text-tertiary">Add a new user</h3>		
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
                    <input type="radio" id="val_0" name="validity" value="0" >
                    <label for="html">Inactif</label>
                    <input type="radio" id="val_1" name="validity" value="1">
                    <label for="css">Actif</label><br>
                </div>
                <div class="form-group">
                    <label>Role :</label>
                    <input type="radio" id="role_0" name="role" value="0">
                    <label for="html">Collaborateur</label>
                    <input type="radio" id="role_1" name="role" value="1">
                    <label for="css">Administrateur</label><br>
                </div>
                <button name="add" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>add</button>
            </form>
            <?php include 'admin_actions.php'?>
        </div>



		
    </body>		
</html>