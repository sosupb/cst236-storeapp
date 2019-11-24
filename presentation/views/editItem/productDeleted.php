<!-- 
Project name: CST-236 ecommerce store app Milestone3
    Version:   1.0
Module name:  productDeleted.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/24/2019
Description: This file deletes a product and confirms to that the product has been removed.
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
?>		

<?php
if(isset($_SESSION['User'])) {
    if(unserialize($_SESSION['User'])->getRole() == 4 && isset($_GET['ItemID'])) { //check for admin status first
        $bs = new ProductBusinessService();
        if(!$bs->deleteProduct($_GET['ItemID'])) {
            echo "Failed to remove that user!";
            exit();
        }
    }
    else {
        echo "You must be an admin to delete a product!";
        exit();
    }
}
else {
    echo "You must be logged in as an admin to delete a product!";
    exit();
}
?>

<div class="message">
	<!-- Home page message -->
	<h2>Product has been removed from the Database</h2>
	<a href="/presentation/views/search/search.php">Click Here</a> to return to the Search page.
	
	<!-- warning message if any -->
	
</div>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT']. '/utility/_footer.php'?>
