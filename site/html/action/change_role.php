<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../authorization.php';

if (isset($_POST['update'])) {
    // Make sure the current user has the correct permission
    if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
        addFlashMessage('info', 'You don\'t have the permissions to access this page');
        redirect('inbox.php');
    }

    $user = User::getById($_POST['user_id']);

    $newRole = $_POST['new_role'];
    if ($newRole < 0 || $newRole > 1) {
        addFlashMessage('danger', 'Unknown role!');
    } else {
        $user->role = $newRole;
        $user->save();

        addFlashMessage('success', 'Role successfully changed!');
    }
}
