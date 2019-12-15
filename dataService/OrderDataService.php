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

        $stmt = $conn->prepare("INSERT INTO orders (USER_ID, ADDRESS_ID, TOTAL, ORDER_DATE) VALUES (?, ?, ?, ?)");
        
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
    
    //This function will query the server to find all the orders that took place between the two given dates
    public function findListOfOrdersByDate($beginDate, $endDate) {
        $db = new Database();
        $conn = $db->getConnection();
        
        //This prepared statement joins orders, orderdetails, and products tables based on the given range of order dates
        $stmt = $conn->prepare("SELECT orders.ID, orders.ORDER_DATE, orders.TOTAL, order_details.PRICE AS SUBTOTAL, order_details.QUANTITY, products.PRODUCT_NAME, products.PRICE 
                                FROM orders 
                                INNER JOIN order_details ON orders.ID = order_details.ORDER_ID
                                INNER JOIN products ON order_details.PRODUCT_ID = products.ID 
                                WHERE ORDER_DATE BETWEEN ? AND ?
                                ORDER BY order_details.QUANTITY DESC");
        
        if(!$stmt) {
            $conn->close();
            return null;
        }
        
        $stmt->bind_param('ss', $beginDate, $endDate);
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows == 0) {
            $conn->close();
            return null;
        }
        
        $index = 0;
        $orders = array();
        while($row = $result->fetch_assoc()) {
            //We need to populate an associative array with the proper tags
            $orders[$index] = array('ID'=>$row['ID'], 'ORDER_DATE'=>$row['ORDER_DATE'], 'TOTAL'=>$row['TOTAL'], 'SUBTOTAL'=>$row['SUBTOTAL'], 'QUANTITY'=>$row['QUANTITY'], 'PRODUCT_NAME'=>$row['PRODUCT_NAME'], 'PRICE'=>$row['PRICE']);
            $index++;
        }
        
        $conn->close();
        return $orders;
    }
}

