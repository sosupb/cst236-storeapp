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
        $couponApplied = FALSe;
        
        //services required for checkout
        $bs = new UserBusinessService();
        $ods = new OrderDataService();
        $ccbs = new CreditCardBusinessService();
        $cds = new CouponDataService();
        
        //setup for new order fields
        $order = new Order(-1, $cart->getUserid(), $address_id, $cart->getTotalAfterDiscount(), date("Y-m-d"));
        
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
        
        //check for coupon discounts
        if($cart->getIsDicountActive()){ //if there is a discount we need to apply it
            if($this->checkCouponValidity($cart->getDiscountCode())) {
                if($this->checkCouponUsage($cart->getDiscountCode(), $cart->getUserid())) {
                    $couponApplied = $this->addCouponUser($conn, $cart->getDiscountCode(), $cart->getUserid());
                }
                else {
                    $couponApplied = FALSE;
                }
            }
            else {
                $couponApplied = FALSE;
            }
        }
        else {
            $couponApplied = TRUE;  //no discount so continue with order
        }
        
        if($orderCreation && $orderDetialsCreation && $cardChargeAvailable && $couponApplied) { //all parts were performed correctly
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

    //this function will add the user to the coupon list showing that it has been used before
    public function addCouponUser($conn, $code, $user_id) {
        $cdService = new CouponDataService();
        return $cdService->addCouponUser($conn, $code, $user_id);
    }
    
    //this method checks for a valid coupon
    public function checkCouponValidity($code) {
        $dbService = new CouponDataService();
        return $dbService->checkCouponValidity($code);
    }
    
    //this method checks to see if the user had used a coupon already
    public function checkCouponUsage($code, $user_id) {
        $dbService = new CouponDataService();
        return $dbService->checkCouponUsage($code, $user_id);
    }
    
    //this method takes a cost amount and applies a coupon discount to it
    public function updateCartWithCode($code, $cart) {
        $dbService = new CouponDataService();
        
        $coupon = $dbService->getCouponInfo($code);
        if($coupon == null) {
            return; //return without no changes to cart
        }
        
        $cart->setIsDicountActive(true); //enable this discount
        $cart->setDiscountCode($coupon['CODE']);
        
        if($coupon['ISPERCENT']) { //this discount needs to be treated as a percentage off
            $cart->setIsDiscountPercent(true); //this discount is a percentage
            $cart->setDiscount($coupon['AMOUNT']);
        }
        else { //this discount is a flat amount off of the total
            $cart->setIsDiscountPercent(false); //this discount is a flat rate off the total
            $cart->setDiscount($coupon['AMOUNT']);
        }
    }
}

