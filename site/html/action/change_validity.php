<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../authorization.php';

if (isset($_POST['update'])) {
    // Check CSRF Token
    checkCSRFToken($_POST['csrfmiddlewaretoken']);

    // Make sure the current user has the correct permission
    if (!STIAuthorization::access(STIAuthorization::ADMIN)) {
        addFlashMessage('info', 'You don\'t have the permissions to access this page');
        redirect('inbox.php');
    }

    $user = User::getById($_POST['user_id']);

    $newValidity = $_POST['new_validity'];
    if ($newValidity < 0 || $newValidity > 1) {
        addFlashMessage('danger', 'Unknown validity!');
    } else {
        $user->validity = $newValidity;
        $user->save();
        // delete CSRF token
        unset($_SESSION['csrfmiddlewaretoken']);

        addFlashMessage('success', 'Validity successfully changed!');
    }
}
