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
    private $dbServerName = getenv('DB_SERVER'); //"localhost"; //
    private $dbUsername = getenv('DB_USER_NAME'); //"root"; //
    private $dbPassword = getenv('DB_PASSWORD'); //"root"; //
    private $dbName = getenv('DB_NAME'); //"cst236_storeapp_db"; //
    
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

