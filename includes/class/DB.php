<?php

/**
 * @author Arthur Verdon
 *
 */

/**
 * the class who manage the interaction with a mysql database
 *
 */
class DB {

    private $hostname;
    private $username;
    private $password;
    private $database;
    private $driver;
    public $pdo;
    private $build_request;
    private $result_request;

    /**
     * 1) load the conf
     * 2) connect to DB
     * @param array $db_conf This array must contain this four param : hostname,
     * username, password and database
     */
    public function __construct($db_conf = array()) {
        $this->build_request = "";

        if ($db_conf == array()) {
            try {
                $this->pdo = new PDO(DB_NAME, USERNAME, PASSWORD,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"));
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                print "Error: " . $e->getMessage() . "<br/>";
                die();
            }
        } else {

            $this->hostname = $db_conf['hostname'];
            $this->username = $db_conf['username'];
            $this->password = $db_conf['password'];
            $this->database = $db_conf['database'];
            $this->driver = $db_conf['driver'];

            try {
                $this->pdo = new PDO($this->driver . ':host=' . $this->hostname . ';dbname=' . $this->database, $this->username, $this->password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"));
            } catch (PDOException $e) {
                print "Error: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }

    /**
     * You can make a personalize without using the query builder with this
     * function
     * @param string $query
     * @return \db
     */
    public function query($query) {
        $this->build_request = $query;

        return $this;
    }


    /**
     * execute the sql request
     * @return \db
     */
    public function execute() {
        $this->result_request = $this->pdo->query($this->build_request);

        return $this;
    }

    /**
     * return the sql request in a string
     * @return string
     */
    public function get_sql_request_string() {
        return $this->build_request;
    }

    /**
     * fetch your result in an associative array
     *
     * @return array
     */
    public function fetch_assoc() {
        $result = array();
        while ($row = $this->result_request->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * fetch your result in a numeric array
     *
     * @return array
     */
    public function fetch_num() {
        $result = array();
        while ($row = $this->result_request->fetch(PDO::FETCH_NUM)) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * fetch your result as object in an array
     *
     * @param string $class_to_use this param define the name of the class to
     * use for the convertion in object. By default the class used is stdClass
     * @return type
     */
    public function fetch_obj($class_to_use = 'stdClass') {
        $result = array();

        foreach ($this->result_request->fetchAll(PDO::FETCH_CLASS, $class_to_use) as $row) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * destruct method close the connection to the server
     */
    public function __destruct() {
        $this->pdo = null;
    }

}
