<?php

class STIDatabase {
    private $_conn;

    private $_statement;
    private $_bind = [];

    public function __construct() {
        // Create (connect to) SQLite database in file
        $this->_conn = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set error mode to exceptions
        $this->_conn->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
    }

    private function prepare($query, $bind) {
        $this->_statement = $this->_conn->prepare($query);
        $this->_bind = $bind;
    }

    private function execute() {
        $this->_statement->execute($this->_bind);
    }

    public function select($table, $where = '', $fields = '*', $bind = []) {
        $query = "select $fields from $table";

        if ($where) {
            $query .= " where $where";
        }

        $this->prepare($query, $bind);
    }

    public function find($entityClass) {
        $this->execute();

        $this->_statement->setFetchMode(\PDO::FETCH_CLASS, $entityClass);
        return $this->_statement->fetch();
    }

    public function findList($entityClass) {
        $this->execute();
        $this->_statement->setFetchMode(\PDO::FETCH_CLASS, $entityClass);
        return $this->_statement->fetchAll();
    }

    public function insert($table, $data) {
        $fields = implode(',', array_keys($data));
        $prepValues = ':'.implode(', :', array_keys($data));

        $query = "insert into $table ($fields) values ($prepValues)";

        $this->prepare($query, $data);
        $this->execute();
    }

    public function update($table, $data, $where = '') {
        $changes = array_reduce(array_keys($data), function ($acc, $field) {
            return $acc ? "$acc, $field = :$field" : "$field = :$field";
        });

        $query = "update $table set $changes".($where ? " where $where" : "");

        $this->prepare($query, $data);
        $this->execute();
    }

    public function delete($table, $where) {
        $query = "delete from $table where $where";
        $this->prepare($query, []);
        $this->execute();
    }
}