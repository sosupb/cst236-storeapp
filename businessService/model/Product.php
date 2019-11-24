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
    private $id;
    private $name;
    private $description;
    private $price;
    
    
    //constructor
    public function __construct($id, $name, $description, $price) {
        $this->id = $id;
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
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}

