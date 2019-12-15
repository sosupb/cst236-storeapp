<!--
Project name: CST-326
    Version:   1.0
Module name:  salesReportHandlerHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/14/2019
Description:
   This file is used to help generate a sales report for an admin to view.
-->
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    $askForDates = TRUE; //this flag is used to determine if we should ask the user for dates
    
    //grab the form data to display the report from the previous form
    if(isset($_GET['BeginningDate']) && isset($_GET['EndingDate'])) {
        $askForDates = FALSE;
        
        $beginDate = $_GET['BeginningDate'];
        $endDate = $_GET['EndingDate'];
        
        $bs = new OrderBusinessService();
        $ordersList = $bs->findListOfOrdersByDate($beginDate, $endDate);
        
    }
    
    