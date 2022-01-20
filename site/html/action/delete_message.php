<?php
require_once __DIR__.'/../model/entities/message.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../authorization.php';

if (isset($_POST['cancel'])) {
    redirect('inbox.php');
}

if (isset($_POST['delete'])) {
    $message = Message::getById($_POST['message_id']);

    // make sure that it's a connected user performing the request and that he's
    // trying to delete one of his messages
    if ($_SESSION['uid'] !== $message->receiver || !STIAuthorization::access()) {
        addFlashMessage('info', 'You don\'t have the permissions to access this page');
        redirect('inbox.php');
    }

    $message->delete();

    addFlashMessage('success', 'Message successfully deleted!');
    redirect('inbox.php');
}
