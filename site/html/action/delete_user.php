<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../authorization.php';

if (isset($_POST['cancel'])) {
    redirect('administration.php');
}

if (isset($_POST['delete'])) {
    // Make sure the current user has the correct permission
    if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
        addFlashMessage('info', 'You don\'t have the permissions to access this page');
        redirect('inbox.php');
    }

    $user = User::getById($_POST['user_id']);
    $user->delete();

    addFlashMessage('success', 'User successfully deleted!');
    redirect('administration.php');
}
