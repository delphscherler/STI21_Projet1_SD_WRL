<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>  

        <!-- Modifier le role d'un utilisateur!-->
        <button class="btn btn-dark" onclick="document.location.href='modify_user.php'">Back</button>	
	    <hr style="border-top:1px dotted #ccc;"/>
        <h4 class ="text-tertiary"> Modify role of a user</h4>	
        <div class="col-md-6">    
            <form method="POST">
                <div class="form-group">
                    <label>Username :</label>
                    <select class="form-select" name="role_username" required="required">
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
                    <label>Role :</label>
                    <input type="radio" id="role_0" name="new_role" value="0" required="required">
                    <label for="html">Collaborateur</label>
                    <input type="radio" id="role_1" name="new_role" value="1" required="required">
                    <label for="css">Administrateur</label><br>
                </div>
                <button name="upd_role" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update Role</button>
            </form>
        </div>
        <?php
        	if(ISSET($_POST['upd_role'])) {

                require('connexion.php');
                $uname=$_POST["role_username"];    //receiving username field value in $uname variable
                $upd = "UPDATE users SET role='".$_POST['new_role']."' WHERE username='".$uname."'";		
                $file_db->exec($upd);
                echo '<script type ="text/JavaScript">';  
                echo 'alert("Role successfully updated")';  
                echo '</script>';	
                exit();
                // Close file db connection
                $file_db = null;
            }
            
        ?>
            </body>		
</html>