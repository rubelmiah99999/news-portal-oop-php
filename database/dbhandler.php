<?php

class Database {
    var $host;
    var $user;
    var $pass;
    var $database;
    var $port;
    var $socket;

    var $con;

    public function __construct()
    {
        $con = $this->con;
        $host = "localost";
        $user = "root";
        $pass = "";
        $database = "newsportal";
        $port = "3308";
        $socket = "";
    }

    public function connectToDB() {
        $con = new mysqli($this->host, $this->user, $this->pass,
                $this->database, $this->port, $this->socket);

        if(!$con) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        } else {
            return $con;
        }
        
    }

}
