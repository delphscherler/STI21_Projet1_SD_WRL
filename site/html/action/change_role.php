<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';

if (isset($_POST['update'])) {
    $user = (new User())->find('id = ?', [$_POST['user_id']]);

    $newRole = $_POST['new_role'];
    if ($newRole < 0 || $newRole > 1) {
        addFlashMessage('danger', 'Unknown role!');
    } else {
        $user->role = $newRole;
        $user->save();

        addFlashMessage('success', 'Role successfully changed!');
    }
}
