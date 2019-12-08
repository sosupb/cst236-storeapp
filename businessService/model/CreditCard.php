<?php

/**
 * 
 * Description: This calss holds all the information for a credit card 
 * 
 * @author Marc
 * Dec 7, 2019
 */
class CreditCard
{
    //properties
    private $name;
    private $number;
    private $cvv;
    private $expiration;
    
  
    //constructor
    public function __construct($name, $number, $cvv, $expiration) {
        $this->name = $name;
        $this->number = $number;
        $this->cvv = $cvv;
        $this->expiration = $expiration;
    }
    
    //methods
    
    //this function returns a printable version of the number replacing all the digits with X except the last four
    public function getSafeNumber() {
        return "XXXX-XXXX-XXXX-" . substr($this->number,15,4);
    }
    
    //getters
    public function getName()
    {
        return $this->name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function getExpiration()
    {
        return $this->expiration;
    }
    
}

