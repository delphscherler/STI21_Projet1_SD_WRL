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
}