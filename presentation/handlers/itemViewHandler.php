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
    
    //check to see if we have started viewing the catalog
    $itemID = 1;
    if(isset($_GET['ItemID'])) {
        $itemID = $_GET['ItemID'];
    }
    
    //grab the list of products for this page
    $bs = new ProductBusinessService();
    $product = $bs->getProductByID($itemID);
?>
    
