<!--
Project name: CST-326
    Version:   1.0
Module name:  registrationHandler.php
    Version:   2.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description:
   This file checks the database for duplicates in the registration process and it also handles the PHP code required for the first page of the registration. If all the users
   information has been checked it will enter them into the database and log them in for the first time.
-->

<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';

    // define error message variables and set to empty values
    $userNameRegErr = $passwordRegErr = $password2RegErr = "";
    $regMessageErr = "* required fields";
    
    
    //check each of the required fields and populate thier error message as necessary.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
         
        $user = new User($_POST["RegUserName"], $_POST["RegPassword"], 1);
        $password2 = $_POST["RegPassword2"];
        
        $ready = true;
        
        if (empty($user->getName())) { 
            $userNameRegErr = "User Name is required!";
            $ready = false;
        } elseif (preg_match('/\s/', $user->getName())) {
            $userNameRegErr = "User Name cannot contain spaces!";
            $ready = false;
        }
        
        if(empty($user->getPassword())) {
            $passwordRegErr = "Password is a required field!";
            $ready = false;
        } elseif (!preg_match('#[a-zA-Z]+#', $user->getPassword()) || !preg_match('#[0-9]+#', $user->getPassword()) || strlen($user->getPassword()) < 8) {       //password constraints
            $passwordRegErr = "Password must be 8 characters long and contain atleast one number!";
            $ready = false;
        }
        
        if(empty($password2)) {
            $password2RegErr = "You must reenter your password!";
            $ready = false;
        } elseif($user->getPassword() != $password2) {
            $password2RegErr = "Your passwords do not match!";
            $ready = false;
        } 
        
        if($ready) {
            $dbService = new RegistrationDataService();
            
            //check for a duplicate user
            
            if(!$dbService->checkUser($user->getName())) { //successful check of registration and move to next form
                $_SESSION["User"] = serialize($user);
                header('Location: /presentation/views/login/registrationFormPage2.php');
            }
            else {  //user already exists
                $regMessageErr = "The user name you entered is already in use.";
                include $_SERVER['DOCUMENT_ROOT'] . '/presentation/views/login/login.php';
                exit();
            }
        }
        else { //not ready to move to next form
            include $_SERVER['DOCUMENT_ROOT'] . '/presentation/views/login/login.php';
        }
    }
?>