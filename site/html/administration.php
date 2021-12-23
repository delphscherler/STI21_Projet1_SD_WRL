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
		<button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
		<hr style="border-top:1px dotted #ccc;"/>    
        <!-- Gestion du changement de mot de passe! -->
        <h2 class="text-tertiary">Update password</h2>		
        <div class="col-md-6">    
            <form method="POST">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" required="required"/>
                </div>
                <button name="update" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update</button>
            </form>
            <?php
                require_once('change_password.php');
                if(isset($_POST['update'])){
                    changePassword($_SESSION['username'], $_POST['new_password']);
                }
            ?>
        </div>
        <?php
            $uname = $_SESSION['username'];
            $sql="SELECT * FROM users WHERE username='".$uname."'";
            //echo $sql;
            require('connexion.php');

            foreach  ($file_db->query($sql) as $row) {
                $val = $row['role'];
            }            

			//If administrator -> user management
            if($val == 1){
				echo "<hr style=\"border-top:1px dotted #ccc;\"/>";
                include 'user_mngmnt.php';
            }
           // Close file db connection
            $file_db = null;	
        ?>
    </body>		
</html>