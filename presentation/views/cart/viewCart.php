<!-- 
Project name: CST-236 ecommerce store app Milestone 4
    Version:   1.0
Module name:  viewCart.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/30/2019
Description: This file displays the users cart items in a list and allows them to remove items as needed.
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/cartHandler.php';
?>		

<div class="message">
	<!-- Home page message -->
	<h2><?php if($_SESSION['User_ID'] != -1){echo "Shopping Cart for " . $_SESSION['UserName'];} else { echo "You must be logged in to view a cart.";}?></h2>
	<!-- warning message if any -->
	<?php
        //warning messages here
    ?>
</div>

<?php if($_SESSION['User_ID'] != -1) {include "_displayCartContents.php";} ?>

<div style="padding: 20px; text-align: center;">
	<!-- Checkout button -->
	<button class="cartButton" onclick="window.location.href='/presentation/views/checkout/processCheckout.php?Page=1'">Checkout</button>
</div>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT']. '/utility/_footer.php'?>
