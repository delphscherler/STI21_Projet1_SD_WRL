<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../authorization.php';

if (isset($_POST['cancel'])) {
    // delete CSRF token
    unset($_SESSION['token']);
    redirect('administration.php');
}

if (isset($_POST['delete'])) {

    // Check CSRF Token
    checkCSRFToken($_POST['token']);

    // Make sure the current user has the correct permission
    if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
        addFlashMessage('info', 'You don\'t have the permissions to access this page');
        redirect('inbox.php');
    }

    $user = User::getById($_POST['user_id']);
    $user->delete();

    // delete CSRF token
    unset($_SESSION['token']);

    addFlashMessage('success', 'User successfully deleted!');
    redirect('administration.php');
}
