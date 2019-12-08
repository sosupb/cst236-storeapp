<!-- 
Project name: CST-236 ecommerce store app Milestone5
    Version:   1.0
Module name:  chekout.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/7/2019
Description: This file builds the initial checkout page when a user would like to buy some products.
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/checkoutHandler.php'; 
?>		

<div class="message">
	<!-- message -->
	<h2><?php echo $checkoutTitle; ?></h2>
	<!-- warning message if any -->
	<div class="error">
	<?php
        //warning messages here
        echo $checkoutError;
    ?>
    </div>
</div>

<?php
    if($page == 1) {
        include_once "_creditCardForm.php";
    }
    else if($page == 2) {
        include_once "_displayShippingForm.php";
    }else if($page == 3) {
        echo "<div style=\"text-align: center;\">";
        echo "Payment: " . $card->getSafeNumber() . "<br>";
        echo "Ship To: " . $address->getFirstName() . " at " . $address->getAddressLineOne() . "<br>";
        echo "<button class=\"cartButton\" onclick=\"submitOrder()\">Submit Order</button>";
        echo "</div>";
    }
    echo "<br>";
    include_once "_displayOrderList.php" 
?>

<script>
	function submitOrder() {
		if(confirm("Sending your order information!")) {
			window.location.href = "/presentation/views/checkout/orderFinished.php";
		}
	}
</script>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT']. '/utility/_footer.php'?>