<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
<body>
    </nav>
    <div></div>
    <div>
        <h3>Welcome</h3>
        <hr style="border-top:1px dotted #ccc;"/>
        <div>
            <form action="" method="POST">
                <div>
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required="required"/>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required="required"/>
                </div>
 
                <button name="login"> Login</button>
 
            </form>
            <br />
            <?php include 'login.php'?> <!-- TODO: cette partie ne fonctionne pas -->
        </div>
        <div>
            <h6>Default username: admin</h6>
            <h6>Default password: admin</h6>
        </div>
    </div>
 
</body>	
</html>