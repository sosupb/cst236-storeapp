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
    
    $pageTitle = "Report Request"; //The current title of the page
    
    $warningMessage = ""; //used to relate any errors to the user
    if(isset($_GET['message'])){
        if($_GET['message'] == 1) { //one or more of the date fields is null
            $warningMessage = "You must enter in an Ending Date and a Beginning Date!";
        }
        else if($_GET['message'] == 2) { //the ending date was before the beginning date
            $warningMessage = "Your Beginning Date must be before the Ending Date.";
        }
    }
    
    
    $askForDates = TRUE; //this flag is used to determine if we should ask the user for dates
    
    //grab the form data to display the report from the previous form
    if(isset($_GET['BeginningDate']) && isset($_GET['EndingDate'])) {
        
        if($_GET['BeginningDate'] == null || $_GET['EndingDate'] == null) {
            header("Location: /presentation/views/reports/salesReport.php?message=1");
            exit;
        }
        else if($_GET['BeginningDate'] > $_GET['EndingDate']) {
            header("Location: /presentation/views/reports/salesReport.php?message=2");
            exit;
        }
        else if(isset($_GET['Generate']) && $_GET['Generate'] == 'JSON') {
            header("Location: /presentation/views/reports/salesReportJSON.php?BeginningDate=" . $_GET['BeginningDate'] .
                                                                        "&EndingDate=" . $_GET['EndingDate']);
            exit;
        }
        $askForDates = FALSE;
        
        $beginDate = $_GET['BeginningDate'];
        $endDate = $_GET['EndingDate'];
        
        $pageTitle = "Report from: " . $beginDate . " to " . $endDate;
        
        $bs = new OrderBusinessService();
        $ordersList = $bs->findListOfOrdersByDate($beginDate, $endDate);
        
    }
    
    