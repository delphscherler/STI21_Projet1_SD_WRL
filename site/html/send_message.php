<?php
session_start();
require_once __DIR__.'/authorization.php';

if (!STIAuthorization::access()) {
    addFlashMessage('info', 'You need to login!');
    redirect('inbox.php');
}

require_once __DIR__.'/model/entities/user.php';
require_once __DIR__.'/model/entities/message.php';
require_once __DIR__.'/action/send_message.php';
require_once __DIR__.'/includes/header.php';

// Generate CSRF Token
generateCSRFToken();
?>

<div class="col-md-6 well">
<h1 class="text-primary">New Message</h1>
<hr style="border-top:1px dotted #ccc;"/>
<button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
<hr style="border-top:1px dotted #ccc;"/>
<div class="col-md-6">
    <form method="post">
        <div class="form-group"> <!-- Destinataire! -->
            <label for="receiver">Receiver</label>
            <!-- Retrieve receiver -->
            <select name="receiver" id="receiver" class="form-control">
            <?php foreach (User::getAll() as $user): ?>
                <?php if ($user->id !== $_SESSION['uid']): ?>
                <option value="<?= $user->id ?>"
                    <?php
                    // if a receiver was given, select it
                    if (isset($_GET['receiver']) && $_GET['receiver'] === $user->id):
                    ?>
                        selected
                    <?php endif; ?>
                >
                    <?= $user->username ?>
                </option>
                <?php endif; ?>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input id="subject" type="text" name="subject" class="form-control" required="required">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" cols="40"  class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="csrfmiddlewaretoken" value="<?= $_SESSION['csrfmiddlewaretoken'] ?>">
            <button name="send" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Send</button>
        </div>
    </form>
</div>
<?php
require_once __DIR__.'/includes/footer.php';