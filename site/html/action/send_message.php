<?php
session_start();
require_once __DIR__.'/../authorization.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../model/entities/message.php';
require_once __DIR__.'/../model/entities/user.php';

if (isset($_POST['send'])) {
    if (!STIAuthorization::access()) {
        addFlashMessage('info', 'You need to login!');
        redirect('inbox.php');
    }

    $receiver = User::getById($_POST['receiver']);

    // the wanted receiver doesn't exist :sadcat:
    if (!$receiver) {
        addFlashMessage('danger', "No user with the id \"{$_POST['receiver']}\" was found");
        redirect('send_message.php');
    }

    // "send" the message
    $message = new Message();

    $message->sender = $_SESSION['uid'];
    $message->receiver = $receiver->id;
    // sanitize user input to avoid XSS attack
    $message->subject = htmlspecialchars($_POST['subject']);
    $message->message = htmlspecialchars($_POST['message']);
    $message->date = date('Y-m-d');
    $message->save();

    addFlashMessage('success', "Message was successfully sent to {$receiver->username}");
}