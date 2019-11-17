<!--
Project name: CST-326
    Version:   2.0
Module name:  searchHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description:
   This file handles the search fields and determines which services to use.
-->

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';

$searchPattern = $_GET['name'];

if($_GET['searchType'] == "firstName"){
    $bs = new UserBusinessService();  
    $users = $bs->findByFirstName($searchPattern);
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/views/search/searchResults.php';
}
elseif($_GET['searchType'] == "productName"){
    $bs = new ProductBusinessService();
    $products = $bs->findByProductName($searchPattern);
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/views/search/searchResults.php';
}




