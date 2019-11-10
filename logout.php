<!--
Project name: CST-236 ECommerce Store App
    Version:   1.0
Module name:  logout.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description:
    This is a small file to handle logging out the user and returning them to the Main Menu
-->

<!-- header -->
<?php include 'include/header.php'; ?>

<?php
    session_start();
    session_destroy();
    header("Location: index.php");
    exit();
?>

<!-- footer -->
<?php include 'include/footer.php'?>