<!-- 
Project name: CST-236 Ecommerce Store App
    Version:   1.0
Module name:  header.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description: This file contains all the required php and html to create the top header for each page in the application
 -->
<?php
    include_once 'header.php'
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/cst236-storeapp/presentation/formStyle.css">
		<title>Welcome To The Store</title>
	</head>
	
	<body>
		<!-- wrapper -->
		<div class="wrapper">	
            <!-- Upper Navigation Bar -->
            <div class="navbar" style="justify-content: flex-end;">
              <?php 
              if(isset($_SESSION['User_ID']) && $_SESSION['User_ID'] != -1) {
                  echo '<p>You are logged in as ' . $_SESSION['UserName'] . ' </p>';
                  echo '<a href="/cst236-storeapp/presentation/views/login/logout.php">Logout</a>';
              } else {
                  $_SESSION['User_ID'] = -1;
                  echo '<a href="/cst236-storeapp/presentation/views/login/login.php">Login/Sign Up</a>';
              }
                    
              ?>
              
            </div>
            
            <!-- Header -->
            <div class="header">
              <h1>Welcome To The Store</h1>
            </div>
            
            
            <!-- Navigation Bar -->
            <div class="navbar">
              <!-- each tab on the nav bar has a color change to notify which page you are on -->
              <a href="/cst236-storeapp/index.php" <?php if(basename($_SERVER['PHP_SELF']) == "index.php") { echo 'style="background-color: #429b82";'; } ?>>Home</a>
              <a href="/cst236-storeapp/presentation/views/catalog/catalog.php?CatalogPage=1" <?php if(basename($_SERVER['PHP_SELF']) == "catalog.php") { echo 'style="background-color: #429b82";'; } ?>>Catalog</a>
              <a href="/cst236-storeapp/presentation/views/search/search.php" <?php if(basename($_SERVER['PHP_SELF']) == "search.php") { echo 'style="background-color: #429b82";'; } ?>>Search</a>
              <!-- add more buttons for the header here -->
              
            </div>