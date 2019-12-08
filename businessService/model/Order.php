<?php

/**
 * 
 * Description: This class is designed to store all the information on a single order.
 * 
 * @author Marc
 * Dec 7, 2019
 */
class Order
{
    //properties
    private $id;
    private $user_id;
    private $address_id;
    private $total;
    private $date;
    
    
    //constructor
    public function __construct($id, $user_id, $address_id, $total, $date) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->address_id = $address_id;
        $this->total = $total;
        $this->date = $date;
    }
    
    
    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getAddress_id()
    {
        return $this->address_id;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getDate()
    {
        return $this->date;
    }
    
    //setters
    public function setId($id)
    {
        $this->id = $id;
    }
    
}

