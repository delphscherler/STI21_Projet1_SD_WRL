<?php
session_start();

require_once __DIR__.'/authorization.php';
require_once __DIR__.'/helper.php';
// Make sure the current user has the correct permission
if ($_GET['id'] && !STIAuthorization::access(STIAuthorization::ADMIN)) {
    addFlashMessage('info', 'You don\'t have the permissions to access this page');
    redirect('inbox.php');
}

require_once __DIR__.'/action/change_password.php';
require_once __DIR__.'/includes/header.php';
?>
<div class="col-md-6 well">
    <h1 class="text-primary">Change password</h1>
    <hr style="border-top:1px dotted #ccc;"/>
    <button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
    <hr style="border-top: 1px dotted #ccc;"/>
    <div class="col-md-6">
        <form method="post">
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" name="new_password" class="form-control" required="required"/>
            </div>
            <input type="hidden" name="user_id" value="<?= isset($_GET['id']) ? $_GET['id'] : $_SESSION['uid'] ?>">
            <button name="update" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update</button>
        </form>
    </div>
</div>
<?php

require_once __DIR__.'/includes/footer.php';

