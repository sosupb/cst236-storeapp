<!-- 
Project name: CST-236 ecommerce store app Milestone1
    Version:   1.0
Module name:  index.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description: This file is the main menu page for the whole store. It will contain links to the different parts of the site such as login and registration.
 -->

<!-- header -->
<?php include 'utility/_header.php'; ?>		

<div class="message">
	<!-- Home page message -->
	<h2><?php if($_SESSION['User_ID'] != -1){echo "Welcome to your Home page " . $_SESSION['UserName'];} else { echo "Home Page";}?></h2>
	<p><?php echo $_SERVER['DOCUMENT_ROOT'];?>
	<!-- warning message if any -->
	<?php
        //warning messages here
    ?>
</div>

<!-- footer -->
<?php include 'utility/_footer.php'?>