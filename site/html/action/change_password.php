<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../validation.php';
require_once __DIR__.'/../helper.php';


if (isset($_POST['update'])) {
    $user = (new User())->find('id = ?', [$_SESSION['uid']]);

    if (!verifyPassword($_POST['new_password'])) {
        addFlashMessage('danger', 'Password must contain between 8 and 64 characters.');
        redirect('administration.php');
    }

    $user->password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $user->save();

    addFlashMessage('success', 'Password successfully updated!');
    redirect('administration.php');
}
