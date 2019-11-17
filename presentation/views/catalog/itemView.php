<!-- 
Project name: CST-236 ecommerce store app Milestone2
    Version:   1.0
Module name:  itemView.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description: This file displays a single item in the catalog.
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/cst236-storeapp/utility/_header.php'; 
    include $_SERVER['DOCUMENT_ROOT'] . '/cst236-storeapp/presentation/handlers/itemViewHandler.php';
?>		

<div class="message">
	<!-- message -->
	<h2>Catalog</h2>
	
	<!-- warning message if any -->
	<?php
        //warning messages here
    ?>
</div>

<?php 
if(!isset($product)){
    echo "<h1>No Product Match!</h1>";
}
else {
    echo "<div>";
        echo "<p>Item ID:" . $product['ID'] . "</p><br><hr>"; 
        echo "<h1>" . $product['PRODUCT_NAME'] . "</h1><br>";
        echo "<p>Description: " . $product['DESCRIPTION'] . "</p><br>";
        echo "<p>Price per item: $" . $product['PRICE'] . "</p><br>";
    echo "</div>";
}

?>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/cst236-storeapp/utility/_footer.php'?>
