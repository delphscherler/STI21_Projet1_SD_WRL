<?php
require_once __DIR__.'/model/entities/user.php';

class STIAuthorization {
    const ADMIN    = 1;
    const EMPLOYEE = 0;

    public static function checkSession() {
        return !empty($_SESSION['uid']);
    }

    public static function access($role = self::EMPLOYEE) {
        if (!self::checkSession())
            return false;

        $user = (new User())->find('id = ?', [$_SESSION['uid']]);

        if ($user->role != $role && $user->role != self::ADMIN)
            return false;

        return true;
    }
}