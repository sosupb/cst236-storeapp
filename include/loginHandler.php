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
    require_once 'User.php';
    
    include_once 'myFunctions.php';
    
    // define error message variables and set to empty values
    $userNameErr = $passwordErr = "";
    $mainMessageErr = "";
    
    // define variable to determine if we are ready to insert into the database
    $ready = FALSE;
    
    //check each of the required fields and populate thier error message as necessary.
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["LoginUserName"])) {
        
        $ready = TRUE; //we have been through the form at least once and need to populate it with values
        $user = new User($_POST["LoginUserName"], $_POST["LoginPassword"]);
        
        if (empty($user->getName())) {
            $userNameErr = "* User Name is required!";
            $ready = FALSE;
        }
        
        if(empty($user->getPassword())) {
            $passwordErr = "* Password is a required field!";
            $ready = FALSE;
        }
        
        if($ready && $_SESSION['loginAttempts'] > 1) {   //ready to attempt another login
            
            $db = dbOpen();
                
            $loginQuery = mysqli_query($db, "SELECT * FROM `users` WHERE USER_NAME LIKE '" . $user->getName() . "'" . " AND PASSWORD LIKE BINARY '" . $user->getPassword() . "'");

            if(mysqli_num_rows($loginQuery) == 0) {
                $_SESSION['loginAttempts'] -= 1;
                $mainMessageErr = "The username or password is incorrect. Please try again. You have " . $_SESSION['loginAttempts'] . " more attempts.";
            } elseif(mysqli_num_rows($loginQuery) == 1) {
                $_SESSION['UserName'] = $user->getName();
                $_SESSION['User'] = serialize($user);
                $_SESSION['User_ID'] = mysqli_fetch_object($loginQuery)->USER_ID;

                $db->close();
                header("Location: index.php");
            }
                          
            $db->close();
        } elseif($_SESSION['loginAttempts'] <= 1) {    //we are out of attempts
            $_SESSION['loginAttempts'] = 0;
            $mainMessageErr = "You are out of login attempts! Please come back later!";
        }
    }
?>