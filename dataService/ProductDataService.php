<?php

/**
 * 
 * Description: This class helps manage any product search queries to an from the database. 
 * 
 * @author Marc
 * Nov 16, 2019
 */

class ProductDataService
{
    //methods
    
    /**
     * This method takes in a search pattern and looks for any matching products in the database.
     * @param String $pattern the product name search pattern.
     */
    function findByProductName($pattern) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT ID, PRODUCT_NAME, DESCRIPTION, PRICE FROM products WHERE PRODUCT_NAME LIKE ?");
        
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
            $productArray = array();
            
            while($product = $result->fetch_assoc()) {
                array_push($productArray, $product);
            }
            return $productArray;
        } 
    }
    
    public function findByID($id) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT ID, PRODUCT_NAME, DESCRIPTION, PRICE FROM products WHERE ID LIKE ?");
        
        if(!$stmt) {
            echo "SQL error during product search set up.";
            exit();
        }
        
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($result === false) {
            echo "SQL error during product results.";
            return null;
            exit();
        }
        else {
            return $result->fetch_assoc();
        }
    }
    
    public function getProductsByPage($page) {
        $db = new Database();
        $connection = $db->getConnection();

        $stmt = $connection->prepare("SELECT ID, PRODUCT_NAME, DESCRIPTION, PRICE FROM products LIMIT 10 OFFSET " . (($page - 1) * 10));
        
        if(!$stmt) {
            echo "SQL error during count set up.";
            exit();
        }
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if(!$result) {
            echo "SQL error during results.";
            return null;
            exit();
        }
        else {
            $productArray = array();
            
            while($product = $result->fetch_assoc()) {
                array_push($productArray, $product);
            }
            return $productArray;
        }
    }
    
    public function getNumberOfProducts() {
        $db = new Database();
        $conn = $db->getConnection();
        $result = $conn->query("SELECT COUNT(1) FROM products");
        $rows = mysqli_fetch_array($result);
        return (int)$rows[0];
    }
    
    public function getProductByID($id) {
        $db = new Database();
        $connection = $db->getConnection();
        $result = $connection->query("SELECT ID, PRODUCT_NAME, DESCRIPTION, PRICE FROM products WHERE ID LIKE BINARY " . $id);
        
        if($result->num_rows == 1){
            return $result->fetch_assoc();
        }
        return null;
    }
    
    public function updateProduct($id, $name, $description, $price) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("UPDATE products SET PRODUCT_NAME = ?, DESCRIPTION = ?, PRICE = ? WHERE ID = ?");
        
        if(!$stmt) {
            echo "SQL error while updating a product.";
            exit();
        }
        
        $stmt->bind_param("sssi", $name, $description, $price, $id);
        
        $result = $stmt->execute();
        
        if($result === false) {
            echo "SQL error during product update results.";
            exit();
        }
    }
    
    public function insertProduct($name, $description, $price) {
        
        $db = new Database();
        
        $conn = $db->getConnection();
        
        $query = "INSERT INTO `products` (PRODUCT_NAME, DESCRIPTION, PRICE) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        
        if(!$stmt) {
            echo "SQL error while adding a new product.";
            exit();
        }
        
        $stmt->bind_param('sss', $name, $description, $price);
        
        $result = $stmt->execute();
        
        if ($result === false) { //failed insertion
            echo "SQL error during product insertion results.";
            exit();
        }
    }
    
    public function deleteProduct($id) {
        
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("DELETE FROM products WHERE ID = ?");
        
        if(!$stmt) {
            echo "SQL error while trying to remove a product.";
            exit();
        }
        
        $stmt->bind_param("i", $id);
        
        $result = $stmt->execute();
        
        if($result === false) {
            echo "SQL error while removing product results.";
            exit();
        }
        return true;
    }
}

