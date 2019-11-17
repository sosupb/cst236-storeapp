<!--
Project name: CST-236 ECommerce Store App
    Version:   1.0
Module name:  loginHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description:
    This file contains all the calls to the database for a login attempt. The user must enter the correct information within 10 tries or else they will be locked out.
   
-->

<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    // define error message variables and set to empty values
    $userNameErr = $passwordErr = "";
    $loginMessageErr = "";
    
    //check each of the required fields and populate thier error message as necessary.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $ready = true; //we have been through the form at least once and need to populate it with values
        
        $user = new User($_POST["LoginUserName"], $_POST["LoginPassword"], 1);
        
        if (empty($user->getName())) {
            $userNameErr = "* User Name is required!";
            $ready = false;
        }
        
        if(empty($user->getPassword())) {
            $passwordErr = "* Password is a required field!";
            $ready = false;
        }
        
        if($_SESSION['loginAttempts'] > 1 && $ready) {   //ready to attempt another login
            
            $dbService = new LoginDataService();
            
            $_SESSION['User_ID'] = $dbService->loginUser($user->getName(), $user->getPassword());
            
            if($_SESSION['User_ID'] > -1) {  //successful login
                $_SESSION['UserName'] = $user->getName();
                $_SESSION['User'] = serialize($user);
                
                header("Location: /cst236-storeapp/index.php");
            } 
            else {          //failed login
                $_SESSION['loginAttempts'] -= 1;
                $loginMessageErr = "The username or password is incorrect. Please try again. You have " . $_SESSION['loginAttempts'] . " more attempts.";
                include '../views/login/login.php';
                exit();
            }
                          
        } 
        elseif($_SESSION['loginAttempts'] <= 1) {    //we are out of attempts
            $_SESSION['loginAttempts'] = 0;
            $loginMessageErr = "You are out of login attempts! Please come back later!";
            include '../views/login/login.php';
        } 
        else { //not ready
            $loginMessageErr = "";
            include '../views/login/login.php';
        }
    }
?>