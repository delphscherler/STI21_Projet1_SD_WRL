<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';
require_once __DIR__.'/../validation.php';

if(isset($_POST['add'])) {

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
    $user->username = $uname;
    $user->password = password_hash($passwd, PASSWORD_DEFAULT);
    $user->validity = $validity;
    $user->role = $role;

    $user->save();
    addFlashMessage('success', 'User was successfully created!');
}
