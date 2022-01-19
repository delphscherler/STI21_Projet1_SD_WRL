<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';

if (isset($_POST['cancel'])) {
    redirect('administration.php');
}

if (isset($_POST['delete'])) {
    $user = User::getById($_POST['user_id']);
    $user->delete();

    addFlashMessage('success', 'User successfully deleted!');
    redirect('administration.php');
}
