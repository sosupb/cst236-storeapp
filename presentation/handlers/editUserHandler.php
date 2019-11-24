<!--
Project name: CST-236 ECommerce Store App
    Version:   1.0
Module name:  editUserHandler.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/23/2019
Description:
    This file assists the editUser page and checks retrieves thier information and checks for admin status.
   
-->

<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/utility/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    $userErrMessage = "";
    $adminStatus = false;
    
    $user = unserialize($_SESSION['User']);
    
    if($user->getRole() == 4) { //set admin status for level four roles
        $adminStatus = true;
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $viewedUser = new User($_POST['ID'], $_POST['UserName'], '', $_POST['Role']);
        $viewedAddress = new Address($_POST["FirstName"], $_POST["LastName"], $_POST["MiddleName"], $_POST["Address1"], $_POST["Address2"], $_POST["City"], $_POST["State"], $_POST["Zipcode"], $_POST["Country"]);
        
        $ready = true;
        
        //check for errors and empty fields
        if (empty($viewedUser->getName())) {
            $userNameRegErr = "User Name is required!";
            $ready = false;
        } elseif (preg_match('/\s/', $viewedUser->getName())) {
            $userNameRegErr = "User Name cannot contain spaces!";
            $ready = false;
        }
        
        if (empty($viewedAddress->getFirstName())) {
            $firstNameErr = "You must enter a first name!";
            $ready = FALSE;
        }
        
        if (empty($viewedAddress->getLastName())) {
            $lastNameErr = "You must enter a last name!";
            $ready = FALSE;
        }
        
        //we are ready to update the user
        if($ready) {
            
            $bs = new UserBusinessService();
            
            $bs->updateUser($viewedUser->getId(), $viewedUser->getName(), $viewedUser->getRole());
            $bs->updateAddress($viewedUser->getId(), $viewedAddress->getFirstName(), $viewedAddress->getMiddleName(), $viewedAddress->getLastName(), $viewedAddress->getAddressLineOne(), $viewedAddress->getAddressLineTwo(), $viewedAddress->getCity(), $viewedAddress->getState(), $viewedAddress->getPostalCode(), $viewedAddress->getCountry());
            $userErrMessage = "Profile has been Updated!";
        }
        
    }
    else {
        //grad the current user and check for admin status
        $user = unserialize($_SESSION['User']);
        
        if($adminStatus) { //we are an admin
            $bs = new UserBusinessService();
            $viewedUser = $bs->findByID($_GET['UserID']);
            $viewedAddress = $bs->getUserAddress($viewedUser->getId());
        } //normal user
        else if($_SESSION['User_ID'] == $_GET['UserID']) {
            $bs = new UserBusinessService();
            $viewedUser = $bs->findByID($_GET['UserID']);
            $viewedAddress = $bs->getUserAddress($viewedUser->getId());
        }
        else {
            $userErrMessage = "You do not have access to view that users information.";
        }
    }
    
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/views/editUser/editUser.php';
    
    ?>
    
    
    