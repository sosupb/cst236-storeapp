<?php

/**
 * 
 * Description: This class is used to aquire sales report information for orders and products 
 * 
 * @author Marc
 * Dec 14, 2019
 */
class OrderBusinessService
{
    //This function will return an array of products that were sold within the given date range
    public function findListOfOrdersByDate($beginDate, $endDate) {
        $dbService = new OrderDataService();
        return $dbService->findListOfOrdersByDate($beginDate, $endDate);
    }
}

