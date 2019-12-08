<?php
/**
 *
 * This file is used to display form for the user to enter in shipping information
 *
 **/
?>

<div class='searchForm'>
	<h3>Shipping Information</h3>
    <form action='/presentation/views/checkout/processCheckout.php?Page=3' method="POST">
    	<div>
    		<label for='oldAddress'>Use Address on File</label>
    		<input type='checkbox' id='oldAddress' name='OldAddress' checked value='yes'>
    	</div>
    	<div>
        	<div>
        		<label for='first'>First Name</label>
        		<input type='text' id='first' name='FirstName'>
        	</div>
        	<div>
        		<label for='last'>Last Name</label>
        		<input type='text' id='last' name='LastName'>
        	</div>
        	<div>
        		<label for='address'>Street Addres</label>
        		<input type='text' id='address' name='Address'>
        	</div>
        	<div>
        		<label for='city'>City</label>
        		<input type='text' id='city' name='City'>
        	</div>
        	<div>
        		<label for='state'>State</label>
        		<input type='text' id='state' name='State'>
        	</div>
        	<div>
        		<label for='zip'>Postal Code</label>
        		<input type='text' id='zip' name='Zip'>
        	</div>
        	<div>
        		<label for='country'>Country</label>
        		<input type='text' id='country' name='Country'>
        	</div>
    	</div>
    	<div style='text-align: center; padding: 4px;'>
    		<button type='submit' class='cartButton'>Confirm</button>
    	</div>
    </form>
</div>