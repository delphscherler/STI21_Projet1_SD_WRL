<?php
session_start();
//Control if user is logged in
if(!isset($_SESSION['uid'])){
   header("Location: index.php");
}

require_once __DIR__.'/helper.php';
require_once __DIR__.'/model/entities/user.php';
require_once __DIR__.'/action/change_password.php';

require_once __DIR__.'/includes/header.php';
?>
<div class="col-md-6 well">
    <h1 class="text-primary">Administration</h1>
    <hr style="border-top:1px dotted #ccc;"/>
    <button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
    <hr style="border-top: 1px dotted #ccc;"/>
    <h2 class="text-tertiary">Update password</h2>
    <div class="col-md-6">
        <form method="post">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" required="required"/>
            </div>
            <button name="update" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update</button>
        </form>
    </div>

    <h2 class="text-tertiary">Manage users</h2>
    <a href="add_user.php" class="btn btn-outline-primary">Add user</a>
    <a href="modify_user.php" class="btn btn-outline-info">Modify user</a>
    <a href="delete_user.php" class="btn btn-outline-danger">Delete user</a>
</div>
<?php
require_once __DIR__.'/includes/footer.php';