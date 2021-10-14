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
    <!-- Gestion des utilisateurs! -->    
    <h2 class="text-tertiary">Manage users</h2>	    
    <form method="POST">
		<button name="add" class="btn btn-outline-primary">Add user</button>
		<button name="modify" class="btn btn-outline-info">Modify user</button>
		<button name="delete" class="btn btn-outline-danger">Delete user</button>		
	</form>   

    <?php 
    	//Administration
	if(ISSET($_POST['add'])) {
		header("Location: add_user.php");
	}
    	//Administration
	if(ISSET($_POST['delete'])) {
		header("Location: delete_user.php");
	}
    	//Administration
	if(ISSET($_POST['modify'])) {
		header("Location: modify_user.php");
	}
    ?>

    </body>		
</html>