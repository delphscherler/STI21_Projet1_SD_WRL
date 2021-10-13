<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>  

    <!-- Modifier la validité d'un utilisateur!-->
    <button class="btn btn-dark" onclick="document.location.href='modify_user.php'">Back</button>	
	<hr style="border-top:1px dotted #ccc;"/>
	<h4 class ="text-tertiary"> Modify validity of a user</h4>		   
	<div class="col-md-6"> 
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
				<input list="browsers" name="val_username" class="form-control" required="required">
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
			<div class="form-group">
                <label>Validity :</label>
                <input type="radio" id="val_0" name="new_validity" value="0" required="required">
                <label for="html">Inactif</label>
                <input type="radio" id="val_1" name="new_validity" value="1" required="required">
                <label for="css">Actif</label><br>
            </div>
            <button name="upd_val" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update Validity</button>
        </form>
    </div>
    <?php
    	if(ISSET($_POST['upd_val'])) {
    
            require('connexion.php');
            $uname=$_POST["val_username"];    //receiving username field value in $uname variable
           /* $sql="SELECT * FROM users WHERE username='".$uname."'";
            $ret = $file_db->query($sql)->fetchAll();
    
            //If username does not exist, display error message
            if ( sizeof($ret) == 0 ){
                echo '<script type ="text/JavaScript">';  
                echo 'alert("This username does not exists")';  
                echo '</script>';	
                exit();
            }*/
            
                $upd = "UPDATE users SET validity='".$_POST['new_validity']."' WHERE username='".$uname."'";		
                $file_db->exec($upd);
                echo '<script type ="text/JavaScript">';  
                echo 'alert("Validity successfully updated")';  
                echo '</script>';	
                exit();
    
            
            // Close file db connection
            $file_db = null;
        }
    ?>
            </body>		
</html>