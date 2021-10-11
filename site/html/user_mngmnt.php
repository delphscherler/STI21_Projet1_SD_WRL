<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>
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
            <button name="add" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>add</button>
        </form>
    </div>
  
    <!-- Supprimer un utilisateur!-->
    <h3 class="text-tertiary">Delete a user</h3>		
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="to_del_username" class="form-control" required="required"/>
            </div>
            <button name="delete" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>delete</button>
        </form>
    </div>

    <!-- Modifier un utilisateur!-->
    <h3 class="text-tertiary">Modify a user</h3>		
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="to_mod_username" class="form-control" required="required"/>
            </div>
            <button name="modify" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>modify</button>
        </form>
    </div>
    <?php include 'admin_actions.php'?>

    </body>		
</html>