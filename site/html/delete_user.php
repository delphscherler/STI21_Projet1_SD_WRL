<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>

   <!-- Supprimer un utilisateur!-->
   <h3 class="text-tertiary">Delete a user</h3>	
   <button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>		
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input list="browsers" name="to_del_username" class="form-control" required="required">
                <datalist id="browsers">
                    <?php
                        require('connexion.php');
                        $sql="SELECT * FROM users";
                        foreach  ($file_db->query($sql) as $row) {
                            $username = $row['username'];						
                            echo "<option value=\"$username\">";
                        }
                        // Close file db connection
                        $file_db = null;
                    ?>
                </datalist>
            </div>
            <button name="delete" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>delete</button>
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