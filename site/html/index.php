<?php

session_start();

require_once __DIR__.'/helper.php';
require_once __DIR__.'/action/login.php';
require_once __DIR__.'/includes/header.php';

// Generate CSRF Token
generateCSRFToken();
?>

<div class="col-md-3"></div>
<div class="col-md-6 well">
    <h1 class="text-primary">Welcome</h1>
    <h2 class="text-primary">Please login to see your messages</h2>
    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-6">
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" class="form-control" required="required"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" required="required"/>
            </div>
            <input type="hidden" name="csrfmiddlewaretoken" value="<?= $_SESSION['csrfmiddlewaretoken'] ?>">
            <button name="login" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Login</button>
         </form>
    </div>
</div>


<?php
require_once __DIR__.'/includes/footer.php';