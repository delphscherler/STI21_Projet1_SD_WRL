<?php
session_start();

require_once __DIR__.'/helper.php';
require_once __DIR__.'/authorization.php';
require_once __DIR__.'/model/entities/user.php';
require_once __DIR__.'/model/entities/message.php';

if (!STIAuthorization::access()) {
    addFlashMessage('info', 'You need to login!');
    redirect('inbox.php');
}

// TODO make sure $_GET['id'] was given

// get the message we want to view
$message = Message::getById($_GET['id']);

// check that we are trying to view one of our messages
if ($_SESSION['uid'] !== $message->receiver) {
    addFlashMessage('info', 'You can only view your messages!');
    redirect('inbox.php');
}

require_once __DIR__.'/includes/header.php';
?>

<div class="col-md-6 well">
    <h1 class="text-primary">Message</h1>
    <hr style="border-top:1px dotted #ccc;"/>
    <button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
    <hr style="border-top:1px dotted #ccc;"/>
    <!-- Actions buttons -->

    <a href="send_message.php?receiver=<?= $message->sender ?>" class="btn btn-info">Answer</a>
    <a href="delete_message.php?id=<?= $message->id ?>" class="btn btn-danger">Delete</a>

    <table class="table table-hover">
        <tr>
            <th>Sender:</th>
            <td><?= htmlentities(User::getById($message->sender)->username) ?></td>
        </tr>
        <tr>
            <th>Date:</th>
            <td><?= $message->date ?></td>
        </tr>
        <tr>
            <th>Subject:</th>
            <td><?= htmlentities($message->subject) ?></td>
        </tr>
        <tr>
            <th>Message:</th>
            <td><?= htmlentities($message->message) ?></td>
        </tr>
    </table>
</div>
<?php
require_once __DIR__.'/includes/footer.php';
