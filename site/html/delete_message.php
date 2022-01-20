<?php
session_start();

// make sure an id was given
if (!isset($_GET['id'])) {
    addFlashMessage('warning', 'Something went wrong');
    redirect('inbox.php');
}

require_once __DIR__.'/authorization.php';

if (!STIAuthorization::access()) {
    addFlashMessage('info', 'You need to login!');
    redirect('inbox.php');
}

require_once __DIR__.'/action/delete_message.php';

require_once __DIR__.'/includes/header.php';
?>

<div class="col-md-6 well">
    <h1 class="text-primary">Delete Message</h1>
    <hr style="border-top:1px dotted #ccc;"/>
    <button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-6">
        <h3>Are you sure you want to delete this message?</h3>
        <form method="post">
            <div class="form-group">
                <input type="hidden" name="message_id" value="<?= $_GET['id'] ?>">
            </div>
            <button name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-log-in"></span>Delete</button>
            <button name="cancel" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span>Cancel</button>
        </form>
    </div>
</div>
<?php
require_once __DIR__.'/includes/footer.php';
