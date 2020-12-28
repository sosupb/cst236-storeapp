<?php

/**
 * 
 * Description: This class connects and gives access to a database
 * 
 * @author Marc
 * Nov 16, 2019
 */

class Database
{
    //properties
    private $dbServerName;  //"localhost"; //
    private $dbUsername; //"root"; //
    private $dbPassword; //"root"; //
    private $dbName; //"cst236_storeapp_db"; //

    //constructor
    public function __construct() {
        $this->dbServerName = getenv('DB_SERVER');
        $this->dbUsername = getenv('DB_USER_NAME'); 
        $this->dbPassword = getenv('DB_PASSWORD'); 
        $this->dbName = getenv('DB_NAME');
    }
    //methods
    public function getConnection() {
        $conn = new mysqli($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName);
        if($conn->connect_error) {
            echo "Connection failed " .$conn->connect_error . "<br>";
        }
        else {
            return $conn;
        }
    }
}

