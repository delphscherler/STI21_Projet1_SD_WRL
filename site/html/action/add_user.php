<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../validation.php';
require_once __DIR__.'/../authorization.php';

if(isset($_POST['add'])) {

    // Check CSRF Token
    checkCSRFToken($_POST['token']);

    // Make sure the current user has the correct permission
    if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
        addFlashMessage('info', 'You don\'t have the permissions to access this page');
        redirect('inbox.php');
    }

    $uname = $_POST['username'];
    $passwd = $_POST['password'];
    $validity = $_POST['validity'];
    $role = $_POST['role'];

    if (User::getByUsername($uname)) {
        addFlashMessage('danger', 'Username already used!');
        redirect('add_user.php');
    }

    if (!verifyPassword($passwd)) {
        addFlashMessage('danger', 'Password must contain between 8 and 64 characters!');
        redirect('add_user.php');
    }

    $user = new User();
    $user->username = htmlentities($uname);
    $user->password = password_hash($passwd, PASSWORD_DEFAULT);
    $user->validity = $validity;
    $user->role = $role;

    $user->save();

    // delete CSRF token
    unset($_SESSION['token']);

    addFlashMessage('success', 'User was successfully created!');
}
