<?php
/**
 * This is a partial file to display a list of products
 */

?>
<section class="searchFormWrapper">
    <table class="searchResultList">
    	<thead>
    		<tr>
        		<th>ID</th>
        		<th>Product Name</th>
        		<th>Description</th>
        		<th>Price</th>
    		</tr>
    	</thead>
    	
        <?php
            foreach($products as $product) {
                echo "<tr onclick=\"window.location.href='../views/catalog/itemView.php?ItemID=" . $product['ID'] . "';\">";
                echo "<td>" . $product['ID'] . "</td>" . "<td>" . $product['PRODUCT_NAME'] . "</td>" . "<td>" . $product['DESCRIPTION'] . "</td>". "<td>" . $product['PRICE'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</section>