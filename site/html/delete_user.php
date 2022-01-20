<?php
session_start();

require_once __DIR__.'/authorization.php';
require_once __DIR__.'/helper.php';

// make sure an id was given
if (!isset($_GET['id'])) {
    addFlashMessage('warning', 'Something went wrong');
    redirect('administration.php');
}

// Make sure the current user has the correct permission
if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
    addFlashMessage('info', 'You don\'t have the permissions to access this page');
    redirect('inbox.php');
}

require_once __DIR__.'/model/entities/user.php';

$user = User::getById($_GET['id']);

// make sure that a user with the given id actually exists
if (!$user) {
    addFlashMessage('warning', 'Something went wrong');
    redirect('administration.php');
}

require_once __DIR__.'/action/delete_user.php';
require_once __DIR__.'/includes/header.php';

// Generate CSRF Token
generateCSRFToken();
?>

<!-- Supprimer un utilisateur!-->
<h2 class="text-tertiary">Delete a user</h2>
<hr style="border-top:1px dotted #ccc;"/>
<button class="btn btn-info" onclick="document.location.href='inbox.php'">Home</button>
<button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>
<hr style="border-top:1px dotted #ccc;"/>
<div class="col-md-6">
    <h3>Are you sure you want to delete <?= htmlentities($user->username) ?>?</h3>
    <form method="post">
        <div class="form-group">
            <input type="hidden" name="user_id" value="<?= $user->id ?>">
        </div>
        <input type="hidden" name="csrfmiddlewaretoken" value="<?= $_SESSION['csrfmiddlewaretoken'] ?>">
        <button name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-log-in"></span>Delete</button>
        <button name="cancel" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span>Cancel</button>
    </form>
</div>
<?php
require_once __DIR__.'/includes/footer.php';