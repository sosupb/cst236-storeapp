<?php
/**
 * This is a partial file to display a list of products during checkout
 */

?>
<section class="searchFormWrapper">
    <table class="cartList">
    	<thead>
    		<tr>
        		<th>Product Name</th>
        		<th>Price /unit</th>
        		<th>Quantity</th>
        		<th>Subtotal</th>
    		</tr>
    	</thead>
    	
        <?php
            foreach($products as $product) {
                echo "<tr>";
                echo "<td>" . $product['PRODUCT_NAME'] . "</td>" . 
                     "<td>" . sprintf('$%01.2f', $product['PRICE']) . "</td>" .
                     "<td>" . $product['QUANTITY'] . "</td>" .
                     "<td>" . sprintf('$%01.2f', $product['SUBTOTAL']) . "</td>";
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td style=\"visibility: hidden;\"></td>";
            echo "<td style=\"visibility: hidden;\"></td>";
            echo "<th>Total</th>";
            echo "<td>" . $cart->getTotal() . "</td>";
            echo "</tr>";
        ?>
    </table>
</section>