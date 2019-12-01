<!--
Project name: CST-326
    Version:   1.0
Module name:  removeFromCart.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/30/2019
Description:
   This file handles removing an item from the cart.
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    
    if($_SESSION['User_ID'] != -1 && isset($_GET['ItemID'])) {
        $bs = new UserBusinessService();
        $bs->removeItemFromCart($_SESSION['User_ID'], $_GET['ItemID']);
    }
    
    header("Location:viewCart.php");
?>