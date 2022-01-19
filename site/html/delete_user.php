<?php
session_start();

//Control if user is logged in
if(!isset($_SESSION['uid'])){
    var_dump('what');
   header("Location:index.php");
}

require_once __DIR__.'/model/entities/user.php';

$user = User::getById($_GET['id']);

require_once __DIR__.'/action/delete_user.php';
require_once __DIR__.'/includes/header.php';
?>

<!-- Supprimer un utilisateur!-->
<h2 class="text-tertiary">Delete a user</h2>
<hr style="border-top:1px dotted #ccc;"/>
<button class="btn btn-info" onclick="document.location.href='inbox.php'">Home</button>
<button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>
<hr style="border-top:1px dotted #ccc;"/>
<div class="col-md-6">
    <h3>Are you sure you want to delete <?= $user->username ?>?</h3>
    <form method="post">
        <div class="form-group">
            <input type="hidden" name="user_id" value="<?= $user->id ?>">
        </div>
        <button name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-log-in"></span>Delete</button>
        <button name="cancel" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span>Cancel</button>
    </form>
</div>
<?php
require_once __DIR__.'/includes/footer.php';