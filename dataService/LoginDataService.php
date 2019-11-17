<?php

/**
 * 
 * Description: handles all the data information for logins
 * 
 * @author Marc
 * Nov 16, 2019
 */

class LoginDataService
{
    //methods
    public function loginUser($userName, $password) {
        
        $db = new Database();
        
        $conn = $db->getConnection();
        
        $result = mysqli_query($conn, "SELECT * FROM `users` WHERE USER_NAME LIKE '" . $userName . "'" . " AND PASSWORD LIKE BINARY '" . $password . "'");
        
        if(mysqli_num_rows($result) == 0) {
            $conn->close();
            return -1;
        }
        else if(mysqli_num_rows($result) == 1) {
            $conn->close();
            return mysqli_fetch_object($result)->USER_ID;
        }
        else {
            $conn->close();
            return -1;
        }
    }
}

