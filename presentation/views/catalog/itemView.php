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
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/itemViewHandler.php';
?>		

<div class="message">
	<!-- message -->
	<h2>Catalog</h2>
	
	<!-- warning message if any -->
	<?php
        echo $mainMessage;
    ?>
</div>

<?php 
if(!isset($product)){
    echo "<h1>No Product Match!</h1>";
}
else {
    echo "<div style=\"padding: 10px; \">";
        echo "<p>Item ID:" . $product['ID'] . "</p><br><hr>"; 
        echo "<h1>" . $product['PRODUCT_NAME'] . "</h1><br>";
        echo "<p>Description: " . $product['DESCRIPTION'] . "</p><br>";
        echo "<p>Price per item: $" . $product['PRICE'] . "</p><br>";
        echo "<button class=\"cartButton\" onclick=\" window.location.href='/presentation/views/catalog/itemView.php?ItemID=" . $product['ID'] . "&AddToCart=" . $product['ID'] . "';\">Add To Cart</button><br>";
        if($adminStatus){
            echo "<button onclick=\" window.location.href='/presentation/handlers/editItemHandler.php?ItemID=" . $product['ID'] . "'\">Edit Product</button>";
        }
    echo "</div>";
}

?>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_footer.php'?>
