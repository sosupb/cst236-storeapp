<?php

/**
 * 
 * Description: This class is used to group together information on a single order detail
 * 
 * @author Marc
 * Dec 7, 2019
 */
class OrderDetials
{
    //properties
    private $id;
    private $order_id;
    private $product_id;
    private $quantity;
    private $price;
    private $description;
    
    
    //constructor
    public function __construct($id, $order_id, $product_id, $quantity, $price, $description){
        $this->id = $id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->description = $description;
    }
    
    
    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getOrder_id()
    {
        return $this->order_id;
    }

    public function getProduct_id()
    {
        return $this->product_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }    
    
    //setters
    public function setId($id)
    {
        $this->id = $id;
    }
    
}

