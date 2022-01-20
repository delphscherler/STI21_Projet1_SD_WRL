<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

session_start();
require_once __DIR__.'/authorization.php';
require_once __DIR__.'/model/entities/user.php';
require_once __DIR__.'/model/entities/message.php';

if (!STIAuthorization::access()) {
    addFlashMessage('info', 'You need to login!');
    redirect('inbox.php');
}

$messages = Message::getAll([
    'receiver' => 1,
]);
$user = User::getById($_SESSION['uid']);



// Logout and close session
if(ISSET($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
}

//New message
if(ISSET($_POST['new'])) {
    header("Location: send_message.php");
}

//Administration
if(ISSET($_POST['admin'])) {
    header("Location: administration.php");
}

require_once __DIR__.'/includes/header.php';
?>

<h1 class="text-primary">Inbox</h1>
<h2 class="text-primary">Hello <?= $user->username ?>!</h2>
<hr style="border-top:1px dotted #ccc;"/>

<form method="POST">
    <button name="new" class="btn btn-outline-primary">New message</button>
    <?php if (STIAuthorization::access(STIAuthorization::ADMIN)): ?>
    <button name="admin" class="btn btn-outline-info">Administration</button>
    <?php endif; ?>
    <a href="modify_passwd.php" class="btn btn-outline-info">Change my password</a>
    <button name="logout" class="btn btn-outline-danger">Log out</button>
</form>

<hr style="border-top:1px dotted #ccc;"/>

<table class="table table-hover">
    <thead>
        <tr class="table-primary">
            <th>Sender</th>
            <th>Date</th>
            <th>Subject</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach (Message::getAll(['receiver' => $user->id]) as $message): ?>
        <tr>
            <td><?= User::getById($message->sender)->username ?></td>
            <td><?= $message->date ?></td>
            <td><?= $message->subject ?></td>
            <td>
                <a href="read_message.php?id=<?= $message->id ?>" class="btn btn-primary">Read</a>
                <a href="send_message.php?receiver=<?= $message->sender ?>" class="btn btn-info">Answer</a>
                <a href="delete_message.php?id=<?= $message->id ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
require_once __DIR__.'/includes/footer.php';
