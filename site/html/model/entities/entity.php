<?php
require_once __DIR__.'/../database.php';

class Entity {
    protected $_db;

    protected static $_table = '';
    protected static $_class = '';

    protected static $db_fields = [];
    protected static $primary_keys = ['id'];

    public function __construct() {
        $this->_db = new STIDatabase();
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    public function find($where = '', $bind = []) {
        $this->_db->select(static::$_table, $where, $this->fields(), $bind);
        return $this->_db->find(static::$_class);
    }

    public function findAll($where = '', $bind = []) {
        $this->_db->select(static::$_table, $where, $this->fields(), $bind);
        return $this->_db->findList(static::$_class);
    }

    public function save($where = '') {
        $data = [];
        foreach (static::$db_fields as $key) {
            $data[$key] = $this->$key;
        }

        $updating = false;
        // determine if we're creating an entity or updating one
        foreach (static::$primary_keys as $pk) {
            if ($this->$pk) {
                $updating = true;
                break;
            }
        }

        if ($updating) {
            $condition = $this->wherePK() . ($where ? " && $where" : "");
            $this->_db->update(static::$_table, $data, $condition);
        } else {
            $this->_db->insert(static::$_table, $data);
        }
    }

    public function delete() {
        $this->_db->delete(static::$_table, $this->wherePK());
    }

    private static function fields() {
        return implode(',', static::$db_fields);
    }

    private function wherePK() {
        $where = ' ';
        foreach (static::$primary_keys as $key) {
            $where .= "$key = {$this->$key} &&";
        }

        return rtrim($where, "&");
    }

}