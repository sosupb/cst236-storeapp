<?php
/**
 * This is a partial file to display a sales report
 */
?>
<section class='repotTableWrapper'>
		<table class='reportTable'>
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Cost/Unit</th>
					<th>Qunatity</th>
					<th>Order Subtotal</th>
					<th>Order ID</th>
					<th>Order Total</th>
					<th>Order Date</th>
				</tr>
			</thead>
			<?php
            foreach($ordersList as $order) {
                echo "<tr>";
                echo "<td>" . $order['PRODUCT_NAME'] . "</td>" . 
                     "<td>" . sprintf('$%01.2f', $order['PRICE']) . "</td>" .
                     "<td>" . $order['QUANTITY'] . "</td>" .
                     "<td>" . sprintf('$%01.2f', $order['SUBTOTAL']) . "</td>" .
                     "<td>" . $order['ID'] . "</td>" .
                     "<td>" . sprintf('$%01.2f', $order['TOTAL']) . "</td>" .
                     "<td>" . $order['ORDER_DATE'] . "</td>";
                echo "</tr>";
            }
            /*echo "<tr>"; //replace later for a Total sold field
            echo "<td style=\"visibility: hidden;\"></td>";
            echo "<td style=\"visibility: hidden;\"></td>";
            echo "<th>Total</th>";
            echo "<td>" . $orderList->getTotal() . "</td>";
            echo "</tr>";*/
        ?>
		</table>
</section>

