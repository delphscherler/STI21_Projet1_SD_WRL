
 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>  
   
   <!-- Modifier un utilisateur!-->
    <h3 class="text-tertiary">Modify a user</h3>
	<button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>	

   <!-- Voir un utilisateur!-->
    <h4 class ="text-tertiary"> Show a user</h4>		
    <div class="col-md-6">    
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="to_show_username" class="form-control" required="required"/>
            </div>
            <button name="show" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>show</button>
        </form>
    </div>

	<!-- Modifier le mot de passe d'un utilisateur!-->
	<h4 class ="text-tertiary"> Modify password of a user</h4>		   
    <div class="col-md-6"> 
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="pwd_username" class="form-control" required="required"/>
            </div>
			<div class="form-group">
                <label>Password :</label>
                <input type="password" name="new_password" class="form-control" required="required"/>
            </div>
            <button name="upd_pwd" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>modify user</button>
        </form>
    </div>

	<!-- Modifier la validité d'un utilisateur!-->
	<h4 class ="text-tertiary"> Modify validity of a user</h4>		   
	<div class="col-md-6"> 
        <form method="POST">
            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="val_username" class="form-control" required="required"/>
            </div>
			<div class="form-group">
                <label>Validity :</label>
                <input type="radio" id="val_0" name="new_validity" value="0" required="required">
                <label for="html">Inactif</label>
                <input type="radio" id="val_1" name="new_validity" value="1" required="required">
                <label for="css">Actif</label><br>
            </div>
            <button name="upd_val" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>modify user</button>
        </form>
    </div>

	<!-- Modifier le role d'un utilisateur!-->
    	<h4 class ="text-tertiary"> Modify role of a user</h4>	
		<div class="col-md-6">    
			<form method="POST">
				<div class="form-group">
					<label>Username :</label>
					<input type="text" name="role_username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Role :</label>
					<input type="radio" id="role_0" name="new_role" value="0" required="required">
					<label for="html">Collaborateur</label>
					<input type="radio" id="role_1" name="new_role" value="1" required="required">
					<label for="css">Administrateur</label><br>
				</div>
				<button name="upd_role" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>modify user</button>
			</form>
    	</div>

    <?php
    if(ISSET($_POST['show'])) {

		require('connexion.php');
		
		$uname=$_POST["to_show_username"];    //receiving username field value in $uname variable
		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $file_db->query($sql)->fetchAll();

		//If username does not exist, display error message
		if ( sizeof($ret) == 0 ){
			echo '<script type ="text/JavaScript">';  
			echo 'alert("This username does not exists")';  
			echo '</script>';	
			exit();
		}
		else{
			echo "Username : ";
			echo $uname;
			foreach  ($file_db->query($sql) as $row) {
				$val = $row['validity'];		
				$rol = $row['role'];
				$pwd = $row['password'];
				echo " Password : ";
				echo $pwd;
				echo " Validity : ";
				if($row['validity'] == 0){
					echo " inactive";
				}
				if($row['validity'] == 1){
					echo " active";
				}
				echo " Role : ";
				if($row['role'] == 0){
					echo " not admin";
				}
				if($row['role'] == 1){
					echo " admin";
				}
			}

		}
		// Close file db connection
		$file_db = null;
	}

	if(ISSET($_POST['upd_pwd'])) {

		require('connexion.php');
		$uname=$_POST["pwd_username"];    //receiving username field value in $uname variable
		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $file_db->query($sql)->fetchAll();
		//If username does not exist, display error message
		if ( sizeof($ret) == 0 ){
			echo '<script type ="text/JavaScript">';  
			echo 'alert("This username does not exists")';  
			echo '</script>';	
			exit();
		}
		else{
			$upd = "UPDATE users SET password='".$_POST['new_password']."' WHERE username='".$uname."'";		
			$file_db->exec($upd);
			echo '<script type ="text/JavaScript">';  
			echo 'alert("Password successfully updated")';  
			echo '</script>';	
			exit();

		}
		// Close file db connection
		$file_db = null;
	}

	if(ISSET($_POST['upd_val'])) {

		require('connexion.php');
		$uname=$_POST["val_username"];    //receiving username field value in $uname variable
		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $file_db->query($sql)->fetchAll();

		//If username does not exist, display error message
		if ( sizeof($ret) == 0 ){
			echo '<script type ="text/JavaScript">';  
			echo 'alert("This username does not exists")';  
			echo '</script>';	
			exit();
		}
		else{
			$upd = "UPDATE users SET validity='".$_POST['new_validity']."' WHERE username='".$uname."'";		
			$file_db->exec($upd);
			echo '<script type ="text/JavaScript">';  
			echo 'alert("Validity successfully updated")';  
			echo '</script>';	
			exit();

		}
		// Close file db connection
		$file_db = null;
	}

	if(ISSET($_POST['upd_role'])) {

		require('connexion.php');
		$uname=$_POST["role_username"];    //receiving username field value in $uname variable
		$sql="SELECT * FROM users WHERE username='".$uname."'";
		$ret = $file_db->query($sql)->fetchAll();

		//If username does not exist, display error message
		if ( sizeof($ret) == 0 ){
			echo '<script type ="text/JavaScript">';  
			echo 'alert("This username does not exists")';  
			echo '</script>';	
			exit();
		}
		else{
			$upd = "UPDATE users SET role='".$_POST['new_role']."' WHERE username='".$uname."'";		
			$file_db->exec($upd);
			echo '<script type ="text/JavaScript">';  
			echo 'alert("Role successfully updated")';  
			echo '</script>';	
			exit();
		}
		// Close file db connection
		$file_db = null;
	}	
    ?>

    </body>		
</html>