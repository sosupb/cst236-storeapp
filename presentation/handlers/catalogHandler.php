<!--
Project name: CST-326
    Version:   2.0
Module name:  catalogHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description:
   This file handles the catalog display and population
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    //used to tell the user if something like an add to cart has occured
    $mainMessage = "";
    
    //check to see if we have started viewing the catalog
    $page = 1;
    if(isset($_GET['CatalogPage'])) {
        $page = $_GET['CatalogPage'];
    }
    if($_SESSION['User_ID'] != -1 && isset($_GET['AddToCart'])) { //adds a single item to the cart
        $bs = new UserBusinessService();
        $bs->addItemToUserCart($_SESSION['User_ID'], $_GET['AddToCart'], 1);
        $mainMessage = "Item has been added to your cart.";
    }
    
    //grab the list of products for this page
    $bs = new ProductBusinessService();
    $products = $bs->getProductsByPage($page);
    
    //grab the maximum number of products and find how many possible pages there can be
    $numProducts = $bs->getNumberOfProducts();
    $maxPageNumber = intdiv($numProducts, 10);
?>
    
