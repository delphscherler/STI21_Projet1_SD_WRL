<?php
require_once __DIR__.'/../model/entities/user.php';
require_once __DIR__.'/../helper.php';

if (isset($_POST['update'])) {
    $user = (new User())->find('id = ?', [$_POST['user_id']]);

    $newValidity = $_POST['new_validity'];
    if ($newValidity < 0 || $newValidity > 1) {
        addFlashMessage('danger', 'Unknown validity!');
    } else {
        $user->validity = $newValidity;
        $user->save();

        addFlashMessage('success', 'Validity successfully changed!');
    }
}
