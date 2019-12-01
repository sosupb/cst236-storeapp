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
    
    public function addItemToUserCart($id, $itemid, $quantity) {
        $db = new Database();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare("SELECT ID FROM cart WHERE USER_ID LIKE ?");
        
        if(!$stmt) {
            echo "SQL error while trying to retrieve cart to add an item.";
            exit();
        }
        
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($result === false){
            echo "Error trying to retrieve cart.";
            exit();
        }
        
        $cartid = $result->fetch_assoc()['ID'];
        
        //check for duplicate entry
        
        $stmt = $connection->prepare("SELECT cart_details.ID FROM cart_details WHERE PRODUCT_ID LIKE ? AND CART_ID LIKE ?"); 
            
        $stmt->bind_param("ii", $cartid, $itemid);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result === false){
            echo "Error trying to retrieve cart_details.";
            exit();
        }
        else if($result->num_rows == 0) { //no entries
            $stmt = $connection->prepare("INSERT INTO cart_details (CART_ID, PRODUCT_ID, QUANTITY) VALUES (?, ?, ?)");
            
            $stmt->bind_param("iii", $cartid, $itemid, $quantity);
            
            $stmt->execute();
            
            if($stmt->affected_rows == 0){
                echo "Error trying to add to cart_details.";
            }
        }
        else { //update entry
            $stmt = $connection->prepare("UPDATE cart_details SET QUANTITY = QUANTITY + ? WHERE CART_ID LIKE ? AND PRODUCT_ID LIKE ?");
            
            $stmt->bind_param("iii", $quantity, $cartid, $itemid);
            
            $stmt->execute();
           
        }
    }
    
    public function removeItemFromCart($id, $itemid){
        $db = new Database();
        $connection = $db->getConnection();
        
        //select the cart first
        
        $stmt = $connection->prepare("SELECT ID FROM cart WHERE USER_ID LIKE ?");
        
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result === false){
            echo "Error trying to retrieve cart for item removal.";
            exit();
        }
        
        $cartid = $result->fetch_assoc()['ID'];
        
        //remove the item from the users cart
        
        $stmt = $connection->prepare("DELETE FROM cart_details WHERE CART_ID LIKE ? AND PRODUCT_ID LIKE ?");
        
        $stmt->bind_param("ii", $cartid, $itemid);
        
        $stmt->execute();
        
        $stmt->get_result();
        if($stmt->affected_rows == 0){
            echo "Error trying to delete cart item.";
        }
        
    }
    
    /*
     * This function retrieves infromation on the users cart from the database and returns an array containing product names, id, quantites and price
     */
    public function getUserCart($id) {
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT products.ID, products.PRODUCT_NAME, cart_details.QUANTITY, products.PRICE, products.DESCRIPTION 
                                      FROM cart_details 
                                      INNER JOIN cart ON cart.ID = cart_details.CART_ID
                                      INNER JOIN products ON products.ID = cart_details.PRODUCT_ID
                                      WHERE cart.USER_ID LIKE ?");
        
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
        }
        else {
            $itemArray = array();
            
            while($item = $result->fetch_assoc()) {
                array_push($itemArray, $item);
            }
            return $itemArray;
        }
    }
}

