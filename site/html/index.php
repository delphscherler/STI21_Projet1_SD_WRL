<?php
session_start();

require_once __DIR__.'/login.php';
require_once __DIR__.'/includes/header.php';
?>

<div class="col-md-3"></div>
<div class="col-md-6 well">
    <h1 class="text-primary">Welcome</h1>
    <h2 class="text-primary">Please login to see your messsages</h2>
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
            <button name="login" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Login</button>
         </form>
    </div>
</div>

<?php
require_once __DIR__.'/includes/footer.php';