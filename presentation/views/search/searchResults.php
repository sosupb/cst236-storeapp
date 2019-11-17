<!-- 
Project name: CST-236 ecommerce store app Milestone2
    Version:   1.0
Module name:  searchResults.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description: This file is used to display the different types of information to the user after a search.
 -->

<!-- header -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/cst236-storeapp/utility/_header.php';?>		

<div class="message">
	<!-- message -->
	<h2>
		<?php
		    $numResults = 0;
		    if($_GET['searchType'] == 'firstName' && isset($users)) {
		        $numResults = count($users);
		    }
		    else if($_GET['searchType'] == 'productName' && isset($products)) {
		        $numResults = count($products);
		    }
	        echo "Search found " . $numResults . " results.";
	    ?>
	</h2>
	
	<!-- warning message if any -->
	<?php
        //warning messages here
    ?>
</div>

<?php
    echo "<div class='message'><a href='/cst236-storeapp/presentation/views/search/search.php'>Click Here </a> to return to search!</div><br>";
    
    if($_GET['searchType'] == 'firstName' && isset($users)) {
        include '_displayUserResults.php';
    }
    else if($_GET['searchType'] == 'productName' && isset($products))
    {
        include '_displayProductResults.php';
    }
?>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/cst236-storeapp/utility/_footer.php'?>