<?php
session_start();

require_once __DIR__.'/authorization.php';
require_once __DIR__.'/helper.php';
// Make sure the current user has the correct permission
if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
    addFlashMessage('info', 'You don\'t have the permissions to access this page');
    redirect('inbox.php');
}

require_once __DIR__.'/action/add_user.php';
require_once __DIR__.'/includes/header.php';

// Generate CSRF Token
generateCSRFToken();
?>
<h2 class="text-tertiary">Add a new user</h2>

<hr style="border-top:1px dotted #ccc;"/>

<button class="btn btn-info" onclick="document.location.href='inbox.php'">Home</button>
<button class="btn btn-dark" onclick="document.location.href='administration.php'">Back</button>

<hr style="border-top:1px dotted #ccc;"/>

<div class="col-md-6">
    <form method="post">
        <div class="form-group">
            <label for="username">Username :</label>
            <input id="username" type="text" name="username" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="password">Password :</label>
            <input id="password" type="password" name="password" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label>Validity :</label>
            <input type="radio" id="val_0" name="validity" value="0" required="required">
            <label for="html">Inactive</label>
            <input type="radio" id="val_1" name="validity" value="1" required="required">
            <label for="css">Active</label><br>
        </div>
        <div class="form-group">
            <label>Role :</label>
            <input id="role_collaborator" type="radio" name="role" value="0" required="required">
            <label for="role_collaborator">Collaborator</label>
            <input id="role_administrator" type="radio" id="role_1" name="role" value="1" required="required">
            <label for="role_administrator">Administrator</label><br>
        </div>
        <input type="hidden" name="csrfmiddlewaretoken" value="<?= $_SESSION['csrfmiddlewaretoken'] ?>">
        <button name="add" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Add</button>
    </form>
</div>

<?php
require_once __DIR__.'/includes/footer.php';