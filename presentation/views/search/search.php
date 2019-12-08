<!-- 
Project name: CST-236 ecommerce store app Milestone2
    Version:   1.0
Module name:  search.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description: This file is the search page for the whole store. It allows you to search for differnt products based on a search parameter.
 -->

<!-- header -->
<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php'; 
?>

<div class="message">
	<!-- message -->
	<h2><?php if($_SESSION['User_ID'] != -1){echo "Please enter a search parameter. ";} else { echo "Search";}?></h2>
	
	<!-- warning message if any -->
	<?php
        //warning messages here
    ?>
</div>
<section class="searchFormWrapper">
    <form action="../../handlers/searchHandler.php" method="GET">
    	<label for="searchType">Search Type:</label><br>
    		<select id="searchType" name="searchType">
    			<?php 
    			//add in options for an admin search
    			if(isset($_SESSION['User'])) {

    			    $user = unserialize($_SESSION['User']);
    			    if($user->getRole() == 4) {
    			        
    			         echo "<option value='firstName'>Users First Name</option>";
    			    }
    			}
    			?>   			
    			<option value="productName">Product Name</option>
    		</select><br><br>
    	<label for="searchField">Search:</label><br>
    		<input id="searchField"type="text" name="name"></input><br>
    	<hr/>
    	<input type="submit" value="Search"></input>
    </form>
</section>


<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_footer.php'?>