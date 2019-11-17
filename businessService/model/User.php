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
    private $role;
    
    
    //constructor
    public function __construct($name, $password, $role) {
        $this->name = $name;
        $this->password = $password;
        $this->role = $role;
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
     * @return Integer
     */
    public function getRole()
    {
        return $this->role;
    }

    
    
}

