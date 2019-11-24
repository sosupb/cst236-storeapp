<!--
Project name: CST-326 Milestone 3
    Version:   1.0
Module name:  editItemHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description:
   This file handles grabbing a single item from the catalog.
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    $itemErrMessage = "";
    $itemNameErr = $itemPriceErr = "";
    $adminStatus = false;
    
    $user = unserialize($_SESSION['User']);
    
    if($user->getRole() == 4) { //set admin status for level four roles
        $adminStatus = true;
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST") { //changing an entry
        
        //grab the changed or new itemitem
        $viewedItem = new Product($_POST['ID'], $_POST['Name'], $_POST['Description'], $_POST['Price']);
        
        $ready = true;
        
        //check for errors and empty fields
        if (empty($viewedItem->getName())) {
            $itemNameErr = "Item Name is required!";
            $ready = false;
        }
        
        if(empty($viewedItem->getPrice())) {
            $itemPriceErr = "Item Price is required!";
            $ready = false;
        }
        
        //we are ready to update the user
        if($ready) {
            
            $bs = new ProductBusinessService();
            
            $bs->updateProduct($viewedItem->getId(), $viewedItem->getName(), $viewedItem->getDescription(), $viewedItem->getPrice());
            $itemErrMessage = "Product has been Updated!";
        }
        
    }
    else if(!isset($_GET['ItemID'])) {  //adding a new entry
        $viewedItem = new Product(-1, "", "", "");
    }
    else {
        
        if($adminStatus) { //we are an admin
            $bs = new ProductBusinessService();
            $viewedItem = $bs->findByID($_GET['ItemID']);
        }
        else {
            $userErrMessage = "You do not have access to edit product information.";
        }
    }
    
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/views/editItem/editItem.php';
    
    ?>
    
    
