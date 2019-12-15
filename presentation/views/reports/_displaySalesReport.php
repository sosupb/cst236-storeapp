<?php
/**
 * This is a partial file to display a sales report
 */

echo "<section class=''>";
echo "<div class=''>";
foreach($ordersList as $order) {
    echo $order['PRODUCT_NAME'] . "<br>";
}
echo "</div>";
echo "</section>";

?>