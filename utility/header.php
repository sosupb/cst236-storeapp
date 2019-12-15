<?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
    
    session_start(); //needed to keep the login active for the current user
    if(isset($_SESSION['User_ID']) && $_SESSION['User_ID'] != -1) {
        $user = unserialize($_SESSION['User']);
        
        if($user->getRole() == 4) { //set admin status for level four roles
            $_SESSION['Admin'] = true;
        }
        else {
            $_SESSION['Admin'] = false;
        }
    } else {
        $_SESSION['User_ID'] = -1;
        $_SESSION['Admin'] = false;
    }
?>