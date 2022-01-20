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

    /**
     * @param $query string query to execute
     * @param $bind array data to bind
     * @return void
     */
    private function prepare($query, $bind) {
        // prepare the next query we're going to execute
        $this->_statement = $this->_conn->prepare($query);
        // store the values we'll need to bind to our request
        // i.e. replace any `?` in the request by the actual value
        $this->_bind = $bind;
    }

    /**
     * Execute a prepared statement
     * @return void
     */
    private function execute() {
        $this->_statement->execute($this->_bind);
    }

    /**
     * @param $table string table affected
     * @param $where string condition for query
     * @param $fields string what to select
     * @param $bind string data for where close
     * @return void
     */
    public function select($table, $where = '', $fields = '*', $bind = []) {
        $query = "select $fields from $table";

        // add any conditions to the query
        if ($where) {
            $query .= " where $where";
        }

        // prepare the request
        $this->prepare($query, $bind);
    }

    /**
     * Fetch a single result of a previously executed query
     * @param $entityClass string name of the classe to instantiate
     * @return mixed
     */
    public function find($entityClass) {
        $this->execute();

        // set the fetch mode to convert the result into an instance of the specified entity class
        $this->_statement->setFetchMode(\PDO::FETCH_CLASS, $entityClass);
        return $this->_statement->fetch();
    }

    /**
     * Fetch the results of a previously executed query
     * @param $entityClass string name of the classe to instantiate
     * @return mixed
     */
    public function findList($entityClass) {
        $this->execute();

        // set the fetch mode to convert the result into an instance of the specified entity class
        $this->_statement->setFetchMode(\PDO::FETCH_CLASS, $entityClass);
        return $this->_statement->fetchAll();
    }

    /**
     * Perform an insert query
     * @param $table string table affected
     * @param $data array new data to insert in the database
     * @return void
     */
    public function insert($table, $data) {
        // list all the fields we're going to insert
        $fields = implode(',', array_keys($data));
        // create the name placeholders for to bind our data
        // e.g. $data = ['username' => 'duckee']
        //      $changes = username = :username
        //      And then PDO will replace the placeholder with the actual value when executing the query
        $prepValues = ':'.implode(', :', array_keys($data));

        $query = "insert into $table ($fields) values ($prepValues)";

        // prepare and execute the request
        $this->prepare($query, $data);
        $this->execute();
    }

    /**
     * Perform an update query
     * @param $table string table affected
     * @param $data array new data to insert in the database
     * @param $where string condition for query
     * @return void
     */
    public function update($table, $data, $where = '') {
        // create the named placeholders for to bind our data
        // e.g. $data = ['username' => 'duckee']
        //      $changes = username = :username
        //      And then PDO will replace the placeholder with the actual value when executing the query
        $changes = array_reduce(array_keys($data), function ($acc, $field) {
            return $acc ? "$acc, $field = :$field" : "$field = :$field";
        });

        $query = "update $table set $changes".($where ? " where $where" : "");

        $this->prepare($query, $data);
        $this->execute();
    }

    /**
     * Perform a delete query
     * @param $table string table affected
     * @param $where string condition for query
     * @return void
     */
    public function delete($table, $where) {
        $query = "delete from $table where $where";
        $this->prepare($query, []);
        $this->execute();
    }
}