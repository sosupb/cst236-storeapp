<?php
/**
 * This is a partial file to display a list of products in the catalog
 */

$itemNumber = 1;

echo "<section class='catalogTableWrapper'>";
echo "<div class='catalogRow'>";
foreach ($products as $product) {
    echo "<span class='card'><button onclick=\"window.location.href='itemView.php?ItemID=" . $product['ID'] . "';\">";
        //echo "<img src='' alt='' style='width:100%'>";
        echo "<h1>" . $product['PRODUCT_NAME'] . "</h1>";
        echo "<p class='price'>$" . $product['PRICE'] . "</p>";
        echo "<p><b>Desrciption</b><br>" . $product['DESCRIPTION'] . "</p></button>";
        echo "<p><button onclick=\"window.location.href='catalog.php?CatalogPage=" . $page . "&AddToCart=" . $product['ID'] . "';\">Add to Cart</button></p>";
    echo "</span>";
    $itemNumber++;
    if($itemNumber == 6) {
        echo "</div><div>";
    }
}
echo "</div>";
echo "</section>";

?>