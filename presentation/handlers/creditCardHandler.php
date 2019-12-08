<!--
Project name: CST-326
    Version:   1.0
Module name:  creditCardHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/7/2019
Description:
   This file handles setting up credit card validation and moving to the next page of checkout
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    
    if($_SESSION['User_ID'] != -1 && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $ccbs = new CreditCardBusinessService();
        
        //format number
        $number = $_POST['Number'];
        if(strpos($number, '-') == false && strlen($number) == 16) {
            $formatted_number = preg_replace("/^(\d{4})(\d{4})(\d{4})(\d{4})$/", "$1-$2-$3-$4", $number);
            $number = $formatted_number;
        }
        
        
        $card = new CreditCard($_POST['Name'], $number, $_POST['CVV'], $_POST['Month'] . " " . $_POST['Year']);
        
        if($ccbs->validateCard($card)) {
            $_SESSION[CreditCard] = serialize($card);
            header("Location: /presentation/views/checkout/processCheckout.php?Page=2"); //move to shipping info page of checkout
        }
        else {
            header("Location: /presentation/views/checkout/processCheckout.php?Page=1&Validation=0"); //return error for credit card validation
        }
    } 