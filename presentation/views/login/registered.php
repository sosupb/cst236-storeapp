<!-- 
Project name: CST-236 ECommerce Store App
    Version:   1.0
Module name:  Registered.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description:
   This is a small page to verify to the user that they have successfully registered.
-->

<!-- header -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php';?>

<div class="message">
	<h2>You have been registered. Thank you for signing up <?php //user name here?>.</h2>
	<a href="/cst236-storeapp/index.php">Click Here</a> to visit the store.
</div>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_footer.php'?>