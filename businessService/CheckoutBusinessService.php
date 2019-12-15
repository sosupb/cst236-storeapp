<?php
/**
 *
 * Description:  This class handles all the business logic associated without completeing a users purchase in the store
 *
 * @author Marc
 * Dec 7, 2019
 */

class CheckoutBusinessService
{
    
    //this method runs through the entire checkout process but will fail in the event that any one thing fails
    public function checkout($cart, $address_id, $card) {
        $db = new Database();
        $conn = $db->getConnection();
        
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        
        //success flags
        $orderCreation = FALSE;
        $orderDetialsCreation = FALSE;
        $cardChargeAvailable = FALSE;
        
        $bs = new UserBusinessService();
        $ods = new OrderDataService();
        $ccbs = new CreditCardBusinessService();
        
        //setup for new order fields
        $order = new Order(-1, $cart->getUserid(), $address_id, $cart->getTotal(), date("Y-m-d"));
        
        //attempt to add new order to the database
        $order->setId($ods->createNewOrder($conn, $order));
        if($order->getId() > -1){
            $orderCreation = TRUE;
        }
        
       //add each order detial to the databse
        if($orderCreation) {
            foreach($cart->getItemsList() as $item) {
                $orderDetials = new OrderDetials(-1, $order->getId(), $item['ID'], $item['QUANTITY'], $item['SUBTOTAL'], "");
                $orderDetials->setId($ods->addDetials($conn, $orderDetials));
                if($orderDetials->getId() > -1){
                    $orderDetialsCreation = TRUE;
                }
                else {
                    $orderDetialsCreation = FALSE;
                    break;
                }
            }
        }
        
        //query credit card
        $cardChargeAvailable = $ccbs->queryCreditCharge($card, $order->getTotal());
        
        if($orderCreation && $orderDetialsCreation && $cardChargeAvailable) { //all parts were performed correctly
            $ccbs->chargeCard($card, $order->getTotal());
            $conn->commit();
            $bs->removeAllItemsFromCart($cart->getUserid());
            $conn->close();
            return TRUE;
        }
        else {
            $conn->rollback();
            $conn->close();
            return FALSE;
        }
    }
}

