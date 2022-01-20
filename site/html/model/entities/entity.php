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

    /**
     * PHP magic function to access object properties ("replaces" a long list of getters)
     * @param $property
     * @return null|mixed
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    /**
     * * PHP magic function to change object properties ("replaces" a long list of setters)
     * @param $property
     * @param $value
     * @return $this
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * Find a single entity
     * @param $where string extra condition to apply to the request
     * @param $bind array data to bind to the request
     * @return mixed
     */
    public function find($where = '', $bind = []) {
        $this->_db->select(static::$_table, $where, $this->fields(), $bind);
        return $this->_db->find(static::$_class);
    }

    /**
     * Find an array of entities
     * @param $where string extra condition to apply to the request
     * @param $bind array data to bind to the request
     * @return mixed
     */
    public function findAll($where = '', $bind = []) {
        $this->_db->select(static::$_table, $where, $this->fields(), $bind);
        return $this->_db->findList(static::$_class);
    }

    /**
     * Save (insert or update) the current state of the entity in the DB
     * @param $where string extra condition to apply to the request
     * @return void
     */
    public function save($where = '') {
        $data = [];
        // create an associative array with all the db fields of the entity
        foreach (static::$db_fields as $key) {
            $data[$key] = $this->$key;
        }

        $updating = false;
        // determine if we're creating an entity or updating one
        // if a pk attribute is set, it means that the entity already exists
        foreach (static::$primary_keys as $pk) {
            if ($this->$pk) {
                $updating = true;
                break;
            }
        }

        if ($updating) {
            // create the condition for the update
            // i.e. the primary key(s) and any extra conditions
            $condition = $this->wherePK() . ($where ? " && $where" : "");
            $this->_db->update(static::$_table, $data, $condition);
        } else {
            $this->_db->insert(static::$_table, $data);
        }
    }

    /**
     * Delete the current entity from the DB
     * @return void
     */
    public function delete() {
        $this->_db->delete(static::$_table, $this->wherePK());
    }

    /**
     * Convert the db fields into a string
     * @return string
     */
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