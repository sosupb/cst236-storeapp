<!--
Project name: CST-326
    Version:   1.0
Module name:  registrationHandler2.php
    Version:   2.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description:
   This file checks the database for duplicates in the registration process and it also handles the PHP code required for the second page of the registration. If all the users
   information has been checked it will enter them into the database and log them in for the first time.
-->

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';

// define error message variables and set to empty values
$firstNameErr = $lastNameErr = "";
$regMessageErr = "* required fields";


//check each of the required fields and populate thier error message as necessary.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ready = true; 
    
    //check for empty fields
        
    $address = new Address($_POST["FirstName"], $_POST["LastName"], $_POST["MiddleName"], $_POST["Address1"], $_POST["Address2"], $_POST["City"], $_POST["State"], $_POST["Zipcode"], $_POST["Country"]);
    
    if (empty($address->getFirstName())) {
        $firstNameErr = "You must enter a first name!";
        $ready = FALSE;
    }
    
    if (empty($address->getLastName())) {
        $lastNameErr = "You must enter a last name!";
        $ready = FALSE;
    }
    
    //runs only if all fields that are required have been filled out
    if($ready) {
        
        $user = unserialize($_SESSION['User']);

        $firstName = $address->getFirstName();
        $middleName = $address->getMiddleName();
        $lastName = $address->getLastName();
        $address1 = $address->getAddressLineOne();
        $address2 = $address->getAddressLineTwo();
        $city = $address->getCity();
        $state = $address->getState();
        $zipCode = $address->getPostalCode();
        $country = $address->getCountry();
        
        
        //insert the new user
        $dbService = new RegistrationDataService();
        
        $_SESSION['User_ID'] = $dbService->insertUser($user->getName(), $user->getPassword(), $user->getRole());
        
        if($_SESSION['User_ID'] > -1) { //successfully registered
            $_SESSION["User"] = serialize($user);
            $_SESSION['UserName'] = $user->getName();
        }
        else { //failed to insert new user
            $regMessageErr = "Could not create new user!";
            include '/presentation/views/login/registrationFormPage2.php';
            exit();
        }
        
        if($dbService->insertAddress($_SESSION['User_ID'], $firstName, $middleName, $lastName, $address1, $address2, $city, $state, $zipCode, $country)) {
            header("Location: /presentation/views/login/registered.php");
        }
        else {
            $mainMessageErr = "An error has occurred. You were not regester.";
            include '/presentation/views/login/registrationFormPage2.php';
            exit();
        }
            
    } else {
        $regMessageErr = "* required fields";
        include '/presentation/views/login/registrationFormPage2.php';
    }
    
}
?>