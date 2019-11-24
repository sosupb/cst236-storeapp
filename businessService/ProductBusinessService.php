<?php

/**
 * 
 * Description:  This class handles all services for each product
 * 
 * @author Marc
 * Nov 16, 2019
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';

class ProductBusinessService
{
    //methods
    public function findByProductName($pattern) {
        $products = array();
        
        $dbservice = new ProductDataService();
        $products = $dbservice->findByProductName($pattern);
        
        return $products;
    }
    
    public function findByID($id) {
        $dbservice = new ProductDataService();
        
        $product = $dbservice->findByID($id);
        
        return new Product($id, $product['PRODUCT_NAME'], $product['DESCRIPTION'], $product['PRICE']);
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
    
    public function updateProduct($id, $name, $description, $price){
        $dbService = new ProductDataService();
        
        if($id < 0){ //insert as new product
            return $dbService->insertProduct($name, $description, $price);   
        }
        else {
            return $dbService->updateProduct($id, $name, $description, $price);
        }
    }
    
    public function deleteProduct($id) {
        $dbService = new ProductDataService();
        return $dbService->deleteProduct($id);
    }
}

