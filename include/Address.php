<?php
/**
 * 
 * Address.php
 * Description: This class is designed to hold a name and address.
 * Author: Marc
 * Date Nov 10, 2019
 */

class Address
{
    //properties
    private $firstName;
    private $lastName;
    private $middleName;
    private $addressLineOne;
    private $addressLineTwo;
    private $city;
    private $state;
    private $postalCode;
    private $country;
    
    
    //constructor
    public function __construct($firstName, $lastName, $middleName, $addressLineOne, $addressLineTwo, $city, $state, $postalCode, $country) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->addressLineOne = $addressLineOne;
        $this->addressLineTwo = $addressLineTwo;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->country = $country;
    }
    
    
    //methods
    
    
    
    //getters and setters

    /**
     * @return String
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return String
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return String
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @return String
     */
    public function getAddressLineOne()
    {
        return $this->addressLineOne;
    }

    /**
     * @return String
     */
    public function getAddressLineTwo()
    {
        return $this->addressLineTwo;
    }

    /**
     * @return String
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return String
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return String
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return String
     */
    public function getCountry()
    {
        return $this->country;
    }
    
}

