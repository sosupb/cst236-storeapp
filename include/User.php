<?php
/**
 * 
 * User.php
 * Description: This class is designed to hold all the information from a singal user.
 * Author: Marc
 * Date Nov 10, 2019
 */

require_once 'Address.php';

class User
{
    //properties
    private $name;
    private $password;
    private $address;
    
    
    //constructor
    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }
    
    
    //methods
 
    
    //getters and setters

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
    
}

