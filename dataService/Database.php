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
    private $dbServerName = "uoa25ublaow4obx5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com"; //"localhost";
    private $dbUsername = "hiemwb6q2xnmt8yu"; //"root";
    private $dbPassword = "va9jwcx8x6uxxu37"; //"root";
    private $dbName = "cqsnoocnm70s1snx"; //"cst236_storeapp_db";
    
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

