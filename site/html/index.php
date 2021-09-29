<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
<body>
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <h3 class="text-primary">Welcome</h3>
		<h4 class="text-primary">Please login to see your messsages</h4>
        <hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required="required"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required="required"/>
                </div> 
                <center><button name="login" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button></center>
             </form>
            <br/>
            <?php include 'login.php'?>	<!-- Problème dans fichier login! -->		
        </div>
        <!-- <div class="col-md-3">
            <h6>Default username: admin</h6>
            <h6>Default password: admin</h6>
        </div> -->
    </div>
</body>		
</html>