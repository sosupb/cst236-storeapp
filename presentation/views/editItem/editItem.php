<!-- 
Project name: CST-236 ecommerce store app Milestone3
    Version:   1.0
Module name:  editItem.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/24/2019
Description: This page in the application is designed to allow an admin to edit a products information.
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
?>		

<div class="message">
	<!--  message -->
	<h2>Editing Product for Product ID:
	<?php 
	if(isset($viewedItem)){ 
	    if($viewedItem->getId() < 0) {
	        echo "New Product";
	    } 
	    else {
	        echo $viewedItem->getId();
	    }
	}?></h2>
	
	<!-- warning message if any -->
	<h2><?php echo $itemErrMessage;?></h2>

</div>

<?php 
if(!isset($viewedItem)){
    echo "<h1>No Product Match!</h1>";
}
else {
?>

<section class='searchFormWrapper'>				
    <!-- Product Form -->
    <form action="/presentation/handlers/editItemHandler.php" method="POST" class="loginForm" style="margin: auto">
    		<input type="hidden" name="ID" value="<?php echo $viewedItem->getId(); ?>"/>
    	<label for="name">Product Name:</label><br/>
    		<input id="name" type="text" name="Name" maxlength="100" value="<?php echo $viewedItem->getName(); ?>"/>
    		<span class="error">* <?php if(isset($itemNameErr)) {echo $itemNameErr;}?></span>
    		<br/><br/>
    	<label for="description">Description:</label><br/>
    		<input id="description" type="text" name="Description" maxlength="300" value="<?php echo $viewedItem->getDescription()?>"/>	
    		<br/><br/>
    	<label for="price">Price:</label><br/>
    		<input id="price" type="number" name="Price" step="any" min="0.01" value="<?php echo $viewedItem->getPrice(); ?>"/>
    		<span class="error">* <?php if(isset($itemPriceErr)) {echo $itemPriceErr;}?></span>
    		<br/><br/>
    	<hr/>
    	<input type="submit" name="Submit"/>
    		<br/>
    	<?php if($viewedItem->getId() > -1) { ?>
    	<div class="warning">
    		<button type="button" onclick=" deleteProduct(confirm('Are you sure you would like to delete this product?'))">Delete Product</button>
    	</div>
    	<?php } ?>
    </form>  
</section>

<script>
function deleteProduct(result) {
	if(result){
		window.location.href = "/presentation/views/editItem/productDeleted.php?ItemID=<?php echo $viewedItem->getId();?>";
	}
}
</script>

<?php }?>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT']. '/utility/_footer.php'?>
