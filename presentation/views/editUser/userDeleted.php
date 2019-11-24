<!-- 
Project name: CST-236 ecommerce store app Milestone1
    Version:   1.0
Module name:  userDeleted.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/23/2019
Description: This file deletes a user and confirms to that a user has been removed.
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
?>		

<?php
    if(unserialize($_SESSION['User'])->getRole() == 4) { //check for admin status first
        $bs = new UserBusinessService();
        if(!$bs->deleteUser($_GET['UserID'])) {
            echo "Failed to remove that user!";
            exit();
        }
    }
    else {
        echo "You must be an admin to delete a user!";
        exit();
    }
?>

<div class="message">
	<!-- Home page message -->
	<h2>User has been removed from the Database</h2>
	<a href="/presentation/views/search/search.php">Click Here</a> to return to the Search page.
	
	<!-- warning message if any -->
	
</div>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT']. '/utility/_footer.php'?>
