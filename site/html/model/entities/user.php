<?php

require_once __DIR__.'/entity.php';

class User extends Entity {
    protected static $_table = 'users';
    protected static $_class = 'User';

    protected static $db_fields = ['id', 'username', 'password', 'validity', 'role'];

    protected $id;
    protected $username = '';
    protected $password = '';
    protected $validity = 1;
    protected $role = 0;

    public static function getById($id) {
        return (new User())->find('id = ?', [$id]);
    }

    public static function getByUsername($uname) {
        return (new User())->find('username = ?', [$uname]);
    }

    public static function getAll() {
        return (new User())->findAll();
    }
}