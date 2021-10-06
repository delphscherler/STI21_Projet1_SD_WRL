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
        <h2 class="text-tertiary">Changement de mot de passe</h2>		
        <div class="col-md-6">    
            <form method="POST">
                <div class="form-group">
                    <label>Nouveau mot de passe</label>
                    <input type="text" name="new_password" class="form-control" required="required"/>
                </div>
                <button name="update" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>update</button>
            </form>
            <?php include 'change_password.php'?>
        </div>
        <!-- Gestion des utilisateurs! -->    
        <!-- Ajouter un utilisateur!-->


		
    </body>		
</html>