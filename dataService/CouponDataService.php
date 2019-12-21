<?php

/**
 * 
 * Description: This class is designed to interface with the database to find and validate coupon codes 
 * 
 * @author Marc
 * Dec 20, 2019
 */
class CouponDataService
{
    //method to find a specific coupon code if it exists, a true value means the code exists
    public function checkCouponValidity($code) {
        $db = new Database();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM coupons WHERE coupons.CODE LIKE ?");
        
        if(!$stmt) {
            $conn->close();
            return false; // problem with the database so do no allow code to be used
        }
        
        $stmt->bind_param('s', $code);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result->num_rows < 1) {    //this code was not found in the database to return true
            $conn->close();
            return false;
        }
        
        $conn->close();
        return true; //there was a matching code so return true
    }
    
    //method to find if the current user has already used the given code, a true value means that this user can use the code still
    public function checkCouponUsage($code, $user_id) {
        $db = new Database();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM coupons JOIN coupon_users ON coupons.ID = coupon_users.COUPON_ID WHERE coupons.CODE LIKE ? AND coupon_users.USER_ID LIKE ?");
        
        if(!$stmt) {
            return false; // problem with the database so do no allow code to be used
        }
        
        $stmt->bind_param('si', $code, $user_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result->num_rows > 0) {   //this user has used this code already
            return false; //do not allow them to use it again
        }
        
        return true; //they are allowed to use the code
    }
    
    //method for retrieveing all the coupon information
    public function getCouponInfo($code) {
        $db = new Database();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM coupons WHERE coupons.CODE LIKE ?");
        
        if(!$stmt) {
            return null; // problem with the database so return a null array
        }
        
        $stmt->bind_param('s', $code);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result->num_rows < 1) {    //this code was not found in the database so return null
            return null;
        }
        
        return $result->fetch_assoc(); //return the coupon information
    }

    //This method adds a user to the list of having used a particular coupon once already
    public function addCouponUser($conn, $code, $user_id) {
        //find th id of the current coupon code
        $stmt = $conn->prepare("SELECT ID FROM coupons WHERE coupons.CODE LIKE ?");
        
        if(!$stmt) {
            return false; // problem with the database so return a null array
        }
        
        $stmt->bind_param('s', $code);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result->num_rows < 1) {    //this code was not found in the database so return null
            return false;
        }
        
        //no place the user and Coupon into the database
        $stmt = $conn->prepare("INSERT INTO coupon_users (USER_ID, COUPON_ID) VALUES (?, ?)");
        if(!$stmt) {
            return false; // problem with the database so return a null array
        }
        
        $stmt->bind_param('ii', $user_id, $result->fetch_assoc()['ID']);
        $stmt->execute();
        
        if($stmt->affected_rows < 1) {    //they were not successfully added to the database
            return false;
        }
        return true; //successful entry
    }
}

