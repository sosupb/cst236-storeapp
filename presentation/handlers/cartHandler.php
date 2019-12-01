<!--
Project name: CST-326
    Version:   1.0
Module name:  cartHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/30/2019
Description:
   This file handles setting up the view for the users cart
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    
    if($_SESSION['User_ID'] != -1) {
        $bs = new UserBusinessService();
        $cart = $bs->getUserCart($_SESSION['User_ID']);
        $products = $cart->getItemsList();
    }
?>