<!--
Project name: CST-326
    Version:   1.0
Module name:  checkoutHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/7/2019
Description:
   This file handles setting up the process for checkout
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    //title for current page of checkout
    $checkoutTitle = "";
    $checkoutError = "";
    $page = 1;
    
    if($_SESSION['User_ID'] != -1) {
        $bs = new UserBusinessService();
        $cart = $bs->getUserCart($_SESSION['User_ID']);
        $products = $cart->getItemsList();
        if(count($products) < 1) { // no items in cart
            header("Location: /presentation/views/cart/viewCart.php");
        }
    } 
    else { //not logged in so divert to the login page
        header("Location: /presentation/views/login/login.php");
    }
    
    if(!isset($_GET['Page']) || $_GET['Page'] == 1) { //payment page
        $checkoutTitle = "Checkout Payment";
        $page = 1;
        if(isset($_GET['Validation']) && $_GET['Validation'] == 0) {//card failed validation
            $checkoutError = "Card Failed Validation";
        }
    }
    else if($_GET['Page'] == 2) { //address page
        $checkoutTitle = "Checkout Shipping";
        $page = 2;
    }
    else if($_GET['Page'] == 3 && $_SERVER['REQUEST_METHOD'] == 'POST') { //address posted
        if(isset($_POST['OldAddress'])) { // they want to use the address on file
            $bs = new UserBusinessService();
            $address = $bs->getUserAddress($_SESSION['User_ID']);
        }
        else {
            $address = new Address(-1, $_POST['FirstName'], $_POST['LastName'], "", $_POST['Address'], '', $_POST['City'], $_POST['State'], $_POST['Zip'], $_POST['Country']);
            $bs = new UserBusinessService();
            $bs->insertAddress($_SESSION['User_ID'], $_POST['FirstName'], "", $_POST['LastName'], $_POST['Address'], '', $_POST['City'], $_POST['State'], $_POST['Zip'], $_POST['Country']);
            $address->setId($bs->getUserAddress($_SESSION['User_ID'])->getId());
        }
        $_SESSION['CheckoutAddress'] = serialize($address);
        header("Location: /presentation/views/checkout/processCheckout.php?Page=3");
    }
    else if($_GET['Page'] == 3) { //finished process now ask for finializing
        $checkoutTitle = "Checkout Finalize";
        
        //credit card
        if(isset($_SESSION['CreditCard'])) {
            $card = unserialize($_SESSION['CreditCard']);
            $page = 3;
        }
        else {
            $checkoutError = "There was a problem with your credit card during checkout";
            $page = 4;
        }
        
        //address
        if(isset($_SESSION['CheckoutAddress']) && $page == 3) {
            $address = unserialize($_SESSION['CheckoutAddress']);
        }
        else {
            $checkoutError = "There was a problem with your address during checkout";
            $page = 4;
        }
    }
    
?>