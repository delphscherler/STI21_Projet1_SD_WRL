<?php

require_once __DIR__.'/model/entities/user.php';
require_once __DIR__.'/helper.php';

if (isset($_POST['login'])) {

    $uname  = $_POST['username'];
    $passwd = $_POST['password'];

    $user = (new User())->find('username = ?', [$uname]);

    if ($user && password_verify($passwd, $user->password) && $user->validity) {
        // create session
        $_SESSION["username"] = $user->id;
        // return to inbox
        redirect('inbox.php');
    } else {
        addFlashMessage('danger', 'Invalid username or password!');
        redirect('index.php');
    }
}
