<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';

if (isset($_POST['login'])) {

    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

    if (!$token || $token !== $_SESSION['token']) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }

    $uname  = $_POST['username'];
    $passwd = $_POST['password'];

    $user = User::getByUsername($uname);

//     var_dump($user);
//     die();

    if ($user && password_verify($passwd, $user->password) && $user->validity) {
        // create session
        $_SESSION["uid"] = $user->id;
        // return to inbox
        redirect('inbox.php');
    } else {
        addFlashMessage('danger', 'Invalid username or password!');
        redirect('index.php');
    }
}
