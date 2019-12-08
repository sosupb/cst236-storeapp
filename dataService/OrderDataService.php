<?php

/**
 * 
 * Description: This class handles data services related to adding and viewing product orders 
 * 
 * @author Marc
 * Dec 7, 2019
 */
class OrderDataService
{
    //requires an open connection to the database
    public function createNewOrder($conn, $order) {

        $stmt = $conn->prepare("INSERT INTO orders (USER_ID, ADDRESS_ID, TOTAL, DATE) VALUES (?, ?, ?, ?)");
        
        if(!$stmt) {
            echo "SQL error during statment prepare for createNewOrder()";
            exit();
        }

        $user = $order->getUser_id();
        $address = $order->getAddress_id();
        $total = $order->getTotal();
        $date = $order->getDate();
        
        $stmt->bind_param("iids", $user, $address, $total, $date);
        
        $stmt->execute();
        
        if($stmt->affected_rows > 0) { //success
            return $conn->insert_id;
        }
        else { //failed insert
            echo "Error while attempting to add order information to database.";
            return -1;
        }
    }
    
    //requires an open connection to the database
    public function addDetials($conn, $orderDetails){
        $stmt = $conn->prepare("INSERT INTO order_details (ORDER_ID, PRODUCT_ID, QUANTITY, PRICE, DESCRIPTION) VALUES (?, ?, ?, ?, ?)");
        
        if(!$stmt) {
            echo "SQL error during statment prepare for addDetials()";
            exit();
        }
        
        $order = $orderDetails->getOrder_id();
        $product = $orderDetails->getProduct_id();
        $quantity = $orderDetails->getQuantity();
        $price = $orderDetails->getPrice();
        $description = $orderDetails->getDescription();
        
        $stmt->bind_param("iiids", $order, $product, $quantity, $price, $description);
        
        $stmt->execute();
        
        if($stmt->affected_rows > 0) { //success
            return $conn->insert_id;
        }
        else { //failed insert
            echo "Error while attempting to add order detials information to database.";
            return -1;
        }
    }
}

