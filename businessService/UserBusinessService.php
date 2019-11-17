<?php

/**
 * 
 * Description: This class handles all servers for user information.
 * 
 * @author Marc
 * Nov 16, 2019
 */

require_once '../../Autoloader.php';

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
        
        return $user;
    }
    
    public function findByFirstName($pattern) {
        $users = array();
        
        $dbservice = new UserDataService();
        $users = $dbservice->findByFirstName($pattern);
        
        return $users;
    }
}

