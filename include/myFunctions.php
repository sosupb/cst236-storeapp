<!--
Project name: CST-236 ECommerce Store App
    Version:   1.0
Module name:  myFunctions.php
    Version:   1.0
Author:		 Marc Teixeira
Date:        11/9/2019
Description:
    A set of utility functions used for the site
   
-->

<?php

//function to open the database for insertion and searching
function dbOpen() {
    $db = new mysqli('uoa25ublaow4obx5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'hiemwb6q2xnmt8yu', 'va9jwcx8x6uxxu37', 'cqsnoocnm70s1snx');
    //check if we have a connection
    if (mysqli_connect_errno()) {
        $_SESSION['warningMessage'] = "Could not connect to server at this time!";
        header('Location: index.php');
        exit();
    }
    return $db;
}

//checks the database for a duplicate entry
function checkDuplicate($field, $table, $columnName, $id = -1, $idName = "") {
    
    $db = dbOpen();
    $duplicateQuery = mysqli_query($db, "SELECT * FROM `" . $table . "` WHERE " . $columnName . " LIKE '" . $field . "'");
    if(mysqli_num_rows($duplicateQuery) > 0 && $id != mysqli_fetch_object($duplicateQuery)->$idName) {
        
        //found duplicate
        $db->close();
        return TRUE;
    }
    
    //no duplicate found 
    $db->close();
    return FALSE;
}

//checks the database for a duplicate link of two tables
function checkDuplicateLink($table, $field1, $columnName1, $field2, $columnName2) {
    
    $db = dbOpen();
    $duplicateQuery = mysqli_query($db, "SELECT * FROM `" . $table . "` WHERE " . $columnName1 . " LIKE '" . $field1 . "' AND " . $columnName2 . " LIKE '" . $field2 . "'");
    if(mysqli_num_rows($duplicateQuery) > 0) {
        
        //found duplicate
        $db->close();
        return TRUE;
    }
    
    //no duplicate found
    $db->close();
    return FALSE;
}

?>
