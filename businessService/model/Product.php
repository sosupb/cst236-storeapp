<?php

/**
 * 
 * Description: This class represents one product with a name description and price
 * 
 * @author Marc
 * Nov 16, 2019
 */

class Product
{
    //properties
    private $name;
    private $description;
    private $price;
    
    
    //constructor
    public function __construct($name, $description, $price) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
    
    
    //methods
    
    
    //getters and setters

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
    
}

