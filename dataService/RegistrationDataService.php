<?php

/**
 * 
 * Description: handles all data information for a registering user
 * 
 * @author Marc
 * Nov 16, 2019
 */

class RegistrationDataService
{
    //methods
    /**
     * checks for a duplicate username in the database
     * @param String $userName
     * @return boolean true is there is a duplicate in the database
     */
    public function checkUser($userName) {
        
        $db = new Database();
        
        $conn = $db->getConnection();
        
        $result = mysqli_query($conn, "SELECT * FROM `users` WHERE USER_NAME LIKE '" . $userName . "'");
        
        if(mysqli_num_rows($result) == 0) {
            $conn->close();
            return false;
        }
        else {
            $conn->close();
            return true;
        }
    }
    
    public function insertUser($userName, $password, $role) {
        
        $db = new Database();
        
        $conn = $db->getConnection();
       
        $query = "INSERT INTO `users` (USER_NAME, PASSWORD, ROLE) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $userName, $password, $role);
        
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) { //successful entry
            $loginQuery = mysqli_query($conn, "SELECT * FROM `users` WHERE USER_NAME LIKE '" . $userName . "'");
            $conn->close();
            return mysqli_fetch_object($loginQuery)->USER_ID;
        }
        else { //failed attempt to register.
            $conn->close();
            return -1;
        }
    }
    
    public function insertAddress($ID, $firstName, $middleName,$lastName, $address1, $address2, $city, $state, $zipCode, $country) {
        
        $db = new Database();
        
        $conn = $db->getConnection();
        
        //insert parameters for an address
        $query = "INSERT INTO `address` (USER_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME,
                                   ADDRESS_1, ADDRESS_2, CITY, STATE, ZIPCODE, COUNTRY) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssssss', $ID, $firstName, $middleName,$lastName, $address1, $address2, $city, $state, $zipCode, $country);
        
        $stmt->execute();
         
        if ($stmt->affected_rows > 0) { //successful entry
            $conn->close();
            return true;       
        } else { //there was and error
            $conn->close();
            return false;
        }
    }
    
    public function checkCart($id){
        $db = new Database();
        
        $conn = $db->getConnection();
        
        //insert parameters for a cart
        $query = "SELECT * FROM cart WHERE USER_ID LIKE ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        
        $stmt->execute();
        if($stmt->num_rows < 1) {
            return false;
        }
        return true;
    }
    
    public function generateNewCart($id) {
        
        $total = 0.0;
        $db = new Database();
        
        $conn = $db->getConnection();
        
        //insert parameters for a cart
        $query = "INSERT INTO `cart` (USER_ID, TOTAL) VALUES (?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('id', $id, $total);
        
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) { //successful entry
            $conn->close();
            return true;
        } else { //there was and error
            $conn->close();
            return false;
        }
    }
}
