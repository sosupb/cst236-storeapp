<?php

/**
 * 
 * Description:  This class handles all services for each product
 * 
 * @author Marc
 * Nov 16, 2019
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/cst236-storeapp/Autoloader.php';

class ProductBusinessService
{
    //methods
    public function findByProductName($pattern) {
        $products = array();
        
        $dbservice = new ProductDataService();
        $products = $dbservice->findByProductName($pattern);
        
        return $products;
    }
    
    public function getProductsByPage($page) {
        $products = array();
        
        $dbService = new ProductDataService();
        $products = $dbService->getProductsByPage($page);
        
        return $products;
    }
    
    public function getNumberOfProducts() {
        $dbService = new ProductDataService();
        return $dbService->getNumberOfProducts();
    }
    
    public function getProductByID($id) {
        $dbService = new ProductDataService();
        $product = $dbService->getProductByID($id);
        return $product;
    }
}

