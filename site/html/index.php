<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
<body>
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
    <?php include 'connexion.php'?>
        <h1 class="text-primary">Welcome</h1>
		<h2 class="text-primary">Please login to see your messsages</h2>
		<?php
			print_r($_SESSION);
		?>
        <hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-6">
            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required="required"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required="required"/>
                </div> 
                <button name="login" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button>
             </form>
            <br/>
			 <?php include 'login.php'?>
        </div>
    </div>
</body>		
</html>