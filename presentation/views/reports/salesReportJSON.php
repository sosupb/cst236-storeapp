<!-- 
Project name: CST-236 ecommerce store app Milestone6
    Version:   1.0
Module name:  salesReportJSON.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/14/2019
Description: This file helps to generate a new sales report for viewing by an admin user but instead of a nice formatted design it send it to the screen as JSON code
 -->

<!-- header -->
<?php 

      include $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php'; 
      include $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/salesReportHandler.php';
      
      if(isset($ordersList)) {
        ini_set('serialize_precision','-1'); //this stops php's bad behavior with the floating decimals representing money values
        echo "<pre>" . json_encode($ordersList, JSON_PRETTY_PRINT) . "</pre>"; //the pre tags need to be there to use the JSON_PRETTY_PRINT instead of HTML formats
      }
?>		
