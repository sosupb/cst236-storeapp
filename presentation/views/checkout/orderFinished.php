<!-- 
Project name: CST-236 ecommerce store app Milestone5
    Version:   1.0
Module name:  index.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/7/2019
Description: This page displays information to the user after checkout telling them if it was successfull or failed.
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/finalizeOrderHandler.php';
?>		

<div class="message">
	<!-- message -->
	<h2><?php echo $pageTitle; ?></h2>
	<?php
        //warning messages here
        echo $pageError;
    ?>
</div>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT']. '/utility/_footer.php'?>