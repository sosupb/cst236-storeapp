<?php

/**
 * 
 * Description: This class handles all servers for user information.
 * 
 * @author Marc
 * Nov 16, 2019
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';

class UserBusinessService
{
    //methods
    public function findByUserName($pattern) {
        $users = array();
        
        $dbservice = new UserDataService();
        $users = $dbservice->findByUserName($pattern);
        
        return $users;
    }
    
    public function findByID($id) {
        $dbservice = new UserDataService();
        
        $user = $dbservice->findByID($id);
        
        return new User($id, $user['USER_NAME'], '', $user['ROLE']);
    }
    
    public function findByFirstName($pattern) {
        $users = array();
        
        $dbservice = new UserDataService();
        $users = $dbservice->findByFirstName($pattern);
        
        return $users;
    }
    
    public function getUserAddress($id) {
        $dbService = new UserDataService();
        
        $address = $dbService->getUserAddress($id);
        echo $address['FIRST_NAME'];
        return new Address($address['FIRST_NAME'], $address['LAST_NAME'], $address['MIDDLE_NAME'], $address['ADDRESS_1'], $address['ADDRESS_2'], $address['CITY'], $address['STATE'], $address['ZIPCODE'], $address['COUNTRY']);
    }
    
    public function loginUser($name, $password) {
        $dbService = new LoginDataService();
        $userID = $dbService->loginUser($name, $password);
        
        return $userID;
    }
    
    public function checkUser($userName) {
        $dbService = new RegistrationDataService();
        return $dbService->checkUser($userName);
    }
    
    public function updateUser($id, $userName, $role){
        $dbService = new UserDataService();
        return $dbService->updateUser($id, $userName, $role);
    }
    
    public function updateAddress($ID, $firstName, $middleName,$lastName, $address1, $address2, $city, $state, $zipCode, $country) {
        $dbService = new UserDataService();
        return $dbService->updateAddress($ID, $firstName, $middleName, $lastName, $address1, $address2, $city, $state, $zipCode, $country);
    }
    
    public function deleteUser($id) {
        $dbService = new UserDataService();
        return $dbService->deleteUser($id);
    }
    
    public function insertUser($userName, $password, $role){
        $dbService = new RegistrationDataService();
        return $dbService->insertUser($userName, $password, $role);
    }
    
    public function insertAddress($ID, $firstName, $middleName,$lastName, $address1, $address2, $city, $state, $zipCode, $country) {
        $dbService = new RegistrationDataService();
        return $dbService->insertAddress($ID, $firstName, $middleName, $lastName, $address1, $address2, $city, $state, $zipCode, $country);
    }
}

