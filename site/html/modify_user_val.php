<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();

require_once __DIR__.'/authorization.php';
require_once __DIR__.'/helper.php';
// Make sure the current user has the correct permission
if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
    addFlashMessage('info', 'You don\'t have the permissions to access this page');
    redirect('inbox.php');
}

require_once __DIR__.'/model/entities/user.php';

$user = User::getById($_GET['id']);

require_once __DIR__.'/action/change_validity.php';
require_once __DIR__.'/includes/header.php';
?>
<h2 class ="text-tertiary">Modify validity of user</h2>
<hr style="border-top:1px dotted #ccc;"/>

<button class="btn btn-info" onclick="document.location.href='inbox.php'">Home</button>
<button class="btn btn-dark" onclick="document.location.href='modify_user.php'">Back</button>

<hr style="border-top:1px dotted #ccc;"/>

<div class="col-md-6">
    <form method="post">
        <div class="form-group">
            <label for="username">Username :</label>
            <input id="username" name="username" type="text" class="form-control" value="<?= $user->username ?>" disabled>
            <input type="hidden" name="user_id" value="<?= $user->id ?>">
        </div>
        <div class="form-group">
            <label>Validity :</label>
            <input id="val_inactive" type="radio" id="val_0" name="new_validity" value="0" required <?= (int)$user->validity === 0 ? 'checked' : '' ?>>
            <label for="val_inactive">Inactive</label>
            <input id="val_active" type="radio" id="val_1" name="new_validity" value="1" required <?= (int)$user->validity === 1 ? 'checked' : '' ?>>
            <label for="val_active">Active</label><br>
        </div>
        <button name="update" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update validity</button>
    </form>
</div>
<?php
require_once __DIR__ . '/includes/footer.php';