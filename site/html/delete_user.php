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

   <!-- Supprimer un utilisateur!-->
   <h2 class="text-tertiary">Delete a user</h2>	
   <hr style="border-top:1px dotted #ccc;"/>
   <button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>		
   <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label class="form-label mt-4">Username :</label>
				<select class="form-select" name="to_del_username" required="required">
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
            <button name="delete" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Delete</button>
        </form>
    </div>
    <?php
    
    	if(ISSET($_POST['delete'])) {

            require('connexion.php');
		
            $uname=$_POST["to_del_username"];    //receiving username field value in $uname variable  
            $del = "DELETE FROM users WHERE username='".$uname."'";		
            $file_db->exec($del);
            echo '<script type ="text/JavaScript">';  
            echo 'alert("User successfully deleted")';  
            echo '</script>';	
            exit();
                          
            // Close file db connection
            $file_db = null;
        }
    ?>
        </body>		
</html>