<?php
    session_start(); //needed to keep the login active for the current user
    if(isset($_SESSION['User_ID']) && $_SESSION['User_ID'] != -1) {
        
    } else {
        $_SESSION['User_ID'] = -1;
    }
?>