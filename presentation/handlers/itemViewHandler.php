<!--
Project name: CST-326
    Version:   2.0
Module name:  itemViewHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description:
   This file handles grabbing a single item from the catalog.
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    //used to tell the user if something like an add to cart has occured
    $mainMessage = "";
    
    //check for admin status
    $adminStatus = false;
    if(isset($_SESSION['User'])){
        if(unserialize($_SESSION['User'])->getRole() == 4) {
            $adminStatus = true;
        }
    }
    
    //check to see if we have started viewing the catalog
    $itemID = 1;
    if(isset($_GET['ItemID'])) {
        $itemID = $_GET['ItemID'];
    }
    
    if(isset($_GET['AddToCart'])) { //adds a single item to the cart
        if($_SESSION['User_ID'] != -1) {
            $bs = new UserBusinessService();
            $bs->addItemToUserCart($_SESSION['User_ID'], $_GET['AddToCart'], 1);
            $mainMessage = "This item has been added to your cart.";
        }
        else {
            $mainMessage = "<p style='color: red;'>You must be logged in to add to your cart.</p>";
        }
    }
    
    //grab the list of products for this page
    $bs = new ProductBusinessService();
    $product = $bs->getProductByID($itemID);
    
?>
    
