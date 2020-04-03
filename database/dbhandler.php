<?php

define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('database', 'newsportall');
define('port', '3308');

class Database {
    
    private $con = null;
    static $inst = null;

    public function __construct() {
        try {
            $this->con = new mysqli(host, user, pass, database, port);
        } catch (Exception $e) {
            die ('Unable to connect to the database.');
        }
    }

    public function __destruct() {
        if($this->con) {
            $this->con->close();
        }
    }

    static function getInstance() {
        if(self::$inst == null) {
            self::$inst = new Database();
        }
        return self::$inst;
    }

    //check if the table exists
    public function tableExists($tableName) {
        $check = $this->con->query("SELECT 1 FROM $tableName");
        if($check !== false && $check->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    //count number of rows found matching a spesific query
    public function numRows($sql) {
        $numRows = $this->con->query($sql);
        return $numRows->num_rows;
    }

    //check if the value exists
    public function exists($table = '', $checkVal = '', $params = array()) {
        if(empty($table) || empty($checkVal) || empty($params)) {
            return false;
        }

        $check = array();
        $placeh = '';
        foreach($params as $field => $value) {
            if(!empty($field) && !empty($value)) {
                $check[] = "$field = '?'";
            }
        }

        $check = implode('AND', $check);
        $sql = "SELECT $checkVal FROM $table WHERE $check";
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {

            call_user_func_array( 
                array( $stmt, 'bind_param' ), 
                array_merge( 
                    array( T_STRING ), 
                    array_map( function( &$item ) { return $item; }, $params ) 
                ) 
            );

            $stmt->execute();
            $stmt->store_result();
            $resultCheck = $stmt->num_rows();
        }

        return $resultCheck;
    }

    //select from database without binding parameters
    public function getWithoutParameters($sql) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    //select from database with a binding parameter
    public function getWithParameter($sql, $param) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("s", $param);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    //insert data into database
    public function insertData($sql, $param1, $param2, $param3) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("sss", $param1, $param2, $param3);
            $stmt->execute();
        }
    }

    public function deleteData($sql, $param) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("s", $param);
            $stmt->execute();
        }
    }

    public function checkLogIn($sql, $param1, $param2) {
        $stmt = $this->con->stmt_init();

        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("ss", $param1, $param2);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }
 

}
