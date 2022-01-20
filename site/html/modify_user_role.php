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

require_once __DIR__.'/action/change_role.php';
require_once __DIR__.'/includes/header.php';

// Generate CSRF Token
generateCSRFToken();
?>

<!-- Modifier le role d'un utilisateur!-->
<h2 class ="text-tertiary">Modify role of user</h2>
<hr style="border-top:1px dotted #ccc;"/>
<button class="btn btn-info" onclick="document.location.href='inbox.php'">Home</button>
<button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>
<hr style="border-top:1px dotted #ccc;"/>

<div class="col-md-6">
    <form method="post">
        <div class="form-group">
            <label for="username">Username :</label>
            <input id="username" name="username" type="text" class="form-control" value="<?= $user->username ?>" disabled>
            <input type="hidden" name="user_id" value="<?= $user->id ?>">
        </div>
        <div class="form-group">
            <label>Role :</label>
            <input type="radio" id="role_0" name="new_role" value="0" required <?= (int)$user->role === 0 ? 'checked' : '' ?>>
            <label for="html">Collaborator</label>
            <input type="radio" id="role_1" name="new_role" value="1" required <?= (int)$user->role === 1 ? 'checked' : '' ?>>
            <label for="css">Administrator</label><br>
        </div>
        <input type="hidden" name="csrfmiddlewaretoken" value="<?= $_SESSION['csrfmiddlewaretoken'] ?>">
        <button name="update" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Update role</button>
    </form>
</div>
<?php
require_once __DIR__ . '/includes/footer.php';