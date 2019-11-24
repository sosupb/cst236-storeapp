<!-- 
Project name: CST-236 ecommerce store app Milestone2
    Version:   1.0
Module name:  catalog.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/16/2019
Description: This file displays the items in the product catalog 10 at a time
 -->

<!-- header -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/catalogHandler.php';
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
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/views/catalog/_displayCatalogItems.php';
    
    
    echo "<div class='message'>";
    if(isset($maxPageNumber) && isset($page)){  //add navigation buttons at the bottom
        if($page == 1) {
            echo "<button onclick=\"window.location.href='catalog.php?CatalogPage=" . ($page + 1) . "';\">Next Page</button>";
        }
        elseif($page > 1 && $page < $maxPageNumber) {
            echo "<button onclick=\"window.location.href='catalog.php?CatalogPage=" . ($page - 1) . "';\">Previous Page</button>";
            echo "<button onclick=\"window.location.href='catalog.php?CatalogPage=" . ($page + 1) . "';\">Next Page</button>";
        }
        elseif ($page == $maxPageNumber){
            echo "<button onclick=\"window.location.href='catalog.php?CatalogPage=" . ($page - 1) . "';\">Previous Page</button>";
        }
    }
    
    if(isset($_SESSION['User'])) { //add create new product button for admins
        if(unserialize($_SESSION['User'])->getRole() == 4) {
            echo "<button onclick=\"window.location.href='/presentation/handlers/editItemHandler.php';\">Add New Product</button>";
        }
    }
    echo "</div>";
?>


<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_footer.php'?>