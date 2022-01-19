<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../validation.php';
require_once __DIR__.'/../authorization.php';

if (isset($_POST['update'])) {
    $authUser = User::getById($_SESSION['uid']);

    // Make sure the current user has the correct permission
    if ($_POST['user_id'] !== $_SESSION['uid'] && !STIAuthorization::access(STIAuthorization::ADMIN)) {
        addFlashMessage('info', 'You don\'t have the permissions to access this page');
        redirect('inbox.php');
    }

    // check if a non admin is trying to change the password of another user
    if ($_POST['user_id'] !== $_SESSION['uid'] && $authUser->role != 1) {
        // if this is the case, we display an error message
        addFlashMessage('danger', 'You can only change your own password');
    } else {
        // fetch the user we want to modify
        $user = $_POST['user_id'] === $_SESSION['uid'] ? $authUser : User::getById($_POST['user_id']);

        // make sure the password respects our policy
        if (!verifyPassword($_POST['new_password'])) {
            addFlashMessage('danger', 'Password must contain between 8 and 64 characters.');
        } else {
            // hash the password and update the user with the new hash
            $user->password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $user->save();

            addFlashMessage('success', 'Password successfully updated!');
        }
    }
}
