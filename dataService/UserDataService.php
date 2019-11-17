<?php

/**
 * 
 * Description: This class allows for searchs of users in the database by several different fields. 
 * 
 * @author Marc
 * Nov 16, 2019
 */

class UserDataService
{
    //methods
    public function findByUserName($pattern) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT ID, USER_NAME, ROLE FROM users WHERE USER_NAME LIKE ?");
        
        if(!$stmt) {
            echo "SQL error during search set up.";
            exit();
        }
        
        $like_pattern = "%" . $pattern . "%";
        $stmt->bind_param("s", $like_pattern);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if(!$result) {
            echo "SQL error during results.";
            return null;
            exit();
        }
        else {
            $userArray = array();
            
            while($user = $result->fetch_assoc()) {
                array_push($userArray, $user);
            }
            return $userArray;
        }
    }

    public function findByID($id) {
            
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT ID, USER_NAME, ROLE FROM users WHERE USER_NAME LIKE ?");
        
        if(!$stmt) {
            echo "SQL error during search set up.";
            exit();
        }
        
        $stmt->bind_param("s", $id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if(!$result) {
            echo "SQL error during results.";
            return null;
            exit();
        }
        else {
            return $result->fetch_assoc();
        }
    }

    public function findByFirstName($pattern) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT users.USER_ID, USER_NAME, FIRST_NAME, LAST_NAME, ROLE 
                                      FROM users JOIN address ON users.USER_ID = address.USER_ID 
                                      WHERE FIRST_NAME LIKE ?");
        
        if(!$stmt) {
            echo "SQL error during search set up.";
            exit();
        }
        
        $like_pattern = "%" . $pattern . "%";
        $stmt->bind_param("s", $like_pattern);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if(!$result) {
            echo "SQL error during results.";
            return null;
            exit();
        }
        else if($result->num_rows == 0){
            return null;
        } 
        else 
        {
            $userArray = array();
            
            while($user = $result->fetch_assoc()) {
                array_push($userArray, $user);
            }
            return $userArray;
        }
    }
}

