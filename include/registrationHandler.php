<!--
Project name: CST-326
    Version:   1.0
Module name:  registrationHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description:
   This file checks the database for duplicates in the registration process and it also handles the PHP code required for the different pages of the registration. If all the users
   information has been checked it will enter them into the database and log them in for the first time.
-->

<?php
    require_once 'User.php';
    require_once 'Address.php';
    
    include_once 'myFunctions.php';

    // define error message variables and set to empty values
    $userNameErr = $firstNameErr = $lastNameErr = $passwordErr = $password2Err = "";
    $mainMessageErr = "* required fields";
    
    $user = new User("", "");
    
    // define variable to determine if we are ready to insert into the database
    $ready = FALSE;
    
    //check each of the required fields and populate thier error message as necessary.
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["LoginUserName"])) {  
        
        $ready = TRUE; //we have been through the form at least once.
         
        $user = new User($_POST["RegUserName"], $_POST["RegPassword"]);
        $password2 = $_POST["RegPassword2"];
        
        if (empty($user->getName())) {
          $userNameErr = "User Name is required!";
          $ready = FALSE;
        } elseif (preg_match('/\s/', $user->getName())) {
            $userNameErr = "User Name cannot contain spaces!";
            $ready = FALSE;
        }
        
        if(empty($user->getPassword())) {
            $passwordErr = "Password is a required field!";
            $ready = FALSE;
        }            
        if(empty($password2)) {
            $password2Err = "You must reenter your password!";
            $ready = FALSE;
        } elseif($user->getPassword() != $password2) {
            $password2Err = "Your passwords do not match!";
            $ready = FALSE;
        } elseif (!preg_match('#[a-zA-Z]+#', $user->getPassword()) || !preg_match('#[0-9]+#', $user->getPassword()) || strlen($user->getPassword()) < 8) {       //password constraints
            $passwordErr = "Password must be 8 characters long and contain atleast one number!";
            $ready = FALSE;
        }
    }
    
    //runs only if all fields that are required have been filled out
    if($ready) {
        
        //create connection to our database
        $db = dbOpen();
        //check if we have a connection
  
        $duplicateUserQuery = mysqli_query($db, "SELECT * FROM `users` WHERE USER_NAME LIKE '" . $user->getName() . "'");
        if(mysqli_num_rows($duplicateUserQuery) > 0) {
            $userNameErr = "The user name you entered is already in use.";
        } else { //we are ready to move on to the address form
            
            $user = new User($_POST["RegUserName"], $_POST["RegPassword"]);
            $_SESSION["User"] = serialize($user);
            header('Location: registrationFormPage2.php');
        }
    }
    
?>