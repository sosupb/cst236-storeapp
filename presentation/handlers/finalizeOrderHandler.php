<!--
Project name: CST-326
    Version:   1.0
Module name:  finalizeOrderHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/8/2019
Description:
   This file handles completeing the users order transactions
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    $pageTitle = "";
    $pageError = "";
    
    if($_SESSION['User_ID'] != -1) {
        
        //grab all the neccessary information
        $bs = new UserBusinessService();
        $cs = new CheckoutBusinessService();
        
        $cart = $bs->getUserCart($_SESSION['User_ID']);
        //add a code if there is one
        if(isset($_GET['Coupon'])) {
            $cs->updateCartWithCode($_GET['Coupon'], $cart);
        }
        
        $products = $cart->getItemsList();        
        $card = unserialize($_SESSION['CreditCard']);
        $address = unserialize($_SESSION['CheckoutAddress']);

        if($cs->checkout($cart, $address->getId(), $card)) {
            $pageTitle = "Your order has been completed!";
        }
        else {
            $pageTitle= "There was a problem with your order and it was not processed!";
        }
        
    } 
    else {
        header("Location: /presentation/views/login/login.php");
    }