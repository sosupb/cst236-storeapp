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
        $stmt = $connection->prepare("SELECT USER_ID, USER_NAME, ROLE FROM users WHERE USER_ID LIKE ?");
        
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

    public function getUserAddress($id) {
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT * FROM address WHERE USER_ID LIKE BINARY ?");
        
        if(!$stmt) {
            echo "SQL error during search set up.";
            exit();
        }
        
        $stmt->bind_param("i", $id);
        
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
    
    public function updateUser($id, $userName, $role) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("UPDATE users SET USER_NAME = ?, ROLE = ? WHERE USER_ID = ?");
        
        if(!$stmt) {
            echo "SQL error during while updating a user.";
            exit();
        }
        
        $stmt->bind_param("ssi", $userName, $role, $id);
        
        $result = $stmt->execute();
        
        if($result === false) {
            echo "SQL error during user update results.";
            exit();
        }
    }
    
    public function updateAddress($id, $firstName, $middleName,$lastName, $address1, $address2, $city, $state, $zipCode, $country) {
        
        $db = new Database();
        
        $conn = $db->getConnection();
        
        //insert parameters for an address
        $query = "UPDATE address SET  FIRST_NAME = ?, MIDDLE_NAME = ?, LAST_NAME = ?, ADDRESS_1 = ?, ADDRESS_2 = ?, CITY = ?, STATE = ?, ZIPCODE = ?, COUNTRY = ? WHERE USER_ID = ?";
        $stmt = $conn->prepare($query);
        
        if(!$stmt) {
            echo "SQL error while updating an address.";
            exit();
        }
        
        $stmt->bind_param('ssssssssss', $firstName, $middleName,$lastName, $address1, $address2, $city, $state, $zipCode, $country, $id);
        
        $result = $stmt->execute();
        
        if($result === false) {
            echo "SQL error during address update results.";
            exit();
        }
    }
    
    public function deleteUser($id) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("DELETE FROM users WHERE USER_ID = ?");
        
        if(!$stmt) {
            echo "SQL error while trying to remove a user.";
            exit();
        }
        
        $stmt->bind_param("i", $id);
        
        $result = $stmt->execute();
        
        if($result === false) {
            echo "SQL error while removing user results.";
            exit();
        }
        return true;
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

