<!--
Project name: CST-236 ECommerce Store App
    Version:   1.0
Module name:  RegistrationFormPage2.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description:
   This is the second page for a users registration. I asks for their name and address information. It also requires that First Name, Last Name and E-mail 1 be entered 
   with information before the registration can continue.
   
   This file requires:
        registrationHandler.php
-->


<!-- header -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php';?>

<div class="message">
	<h2>Please fill out the form to finish registering</h2>
</div>
	
<section class='searchFormWrapper'>				
    <!-- Registration Form -->
    <form action="registrationHandler2.php" method="POST" class="loginForm" style="margin: auto">
    	<p align="right"><span class="error"><?php if(isset($regMessageErr)) {echo $regMessageErr;}?></span></p>
    	<br/>
    	
    	<label for="firstname">First Name:</label><br/>
    		<input id="firstname" type="text" name="FirstName" maxlength="100" value="<?php if(isset($address)){ echo $address->getFirstName();}?>"/>
    		<span class="error">* <?php if(isset($firstNameErr)) {echo $firstNameErr;}?></span>
    		<br/><br/>
    	<label for="middlename">Middle Name:</label><br/>
    		<input id="middlename" type="text" name="MiddleName" maxlength="100" value="<?php if(isset($address)){ echo $address->getMiddleName();}?>"/>
    		<br/><br/>
    	<label for="lastname">Last Name:</label><br/>
    		<input id="lastname" type="text" name="LastName" maxlength="100" value="<?php if(isset($address)){ echo $address->getLastName();}?>"/>
    		<span class="error">* <?php if(isset($lastNameErr)) {echo $lastNameErr;}?></span>
    		<br/><br/>
    	<label for="address1">Address 1:</label><br/>
    		<input id="address1" type="text" name="Address1" maxlength="100" value="<?php if(isset($address)){ echo $address->getAddressLineOne();}?>"/>
    		<br/><br/>
    	<label for="address2">Address 2:</label><br/>
    		<input id="address2" type="text" name="Address2" maxlength="100" value="<?php if(isset($address)){ echo $address->getAddressLineTwo();}?>"/>
    		<br/><br/>
    	<label for="city">City:</label><br/>
    		<input id="city" type="text" name="City" maxlength="100" value="<?php if(isset($address)){ echo $address->getCity();}?>"/>
    		<br/><br/>
    	<label for="state">State:</label><br/>
    		<select id="state" name="State">
    			<option>--</option>
    			<option value="AL">Alabama</option>
    			<option value="AK">Alaska</option>
    			<option value="AZ">Arizona</option>
    			<option value="AR">Arkansas</option>
    			<option value="CA">California</option>
    			<option value="CO">Colorado</option>
    			<option value="CT">Connecticut</option>
    			<option value="DE">Delaware</option>
    			<option value="DC">District Of Columbia</option>
    			<option value="FL">Florida</option>
    			<option value="GA">Georgia</option>
    			<option value="HI">Hawaii</option>
    			<option value="ID">Idaho</option>
    			<option value="IL">Illinois</option>
    			<option value="IN">Indiana</option>
    			<option value="IA">Iowa</option>
    			<option value="KS">Kansas</option>
    			<option value="KY">Kentucky</option>
    			<option value="LA">Louisiana</option>
    			<option value="ME">Maine</option>
    			<option value="MD">Maryland</option>
    			<option value="MA">Massachusetts</option>
    			<option value="MI">Michigan</option>
    			<option value="MN">Minnesota</option>
    			<option value="MS">Mississippi</option>
    			<option value="MO">Missouri</option>
    			<option value="MT">Montana</option>
    			<option value="NE">Nebraska</option>
    			<option value="NV">Nevada</option>
    			<option value="NH">New Hampshire</option>
    			<option value="NJ">New Jersey</option>
    			<option value="NM">New Mexico</option>
    			<option value="NY">New York</option>
    			<option value="NC">North Carolina</option>
    			<option value="ND">North Dakota</option>
    			<option value="OH">Ohio</option>
    			<option value="OK">Oklahoma</option>
    			<option value="OR">Oregon</option>
    			<option value="PA">Pennsylvania</option>
    			<option value="RI">Rhode Island</option>
    			<option value="SC">South Carolina</option>
    			<option value="SD">South Dakota</option>
    			<option value="TN">Tennessee</option>
    			<option value="TX">Texas</option>
    			<option value="UT">Utah</option>
    			<option value="VT">Vermont</option>
    			<option value="VA">Virginia</option>
    			<option value="WA">Washington</option>
    			<option value="WV">West Virginia</option>
    			<option value="WI">Wisconsin</option>
    			<option value="WY">Wyoming</option>
    		</select>
    		<br/><br/>
    	<label for="zipcode">Zipcode:</label><br/>
    		<input id="zipcode" type="text" name="Zipcode" maxlength="12" value="<?php if(isset($address)){ echo $address->getPostalCode();}?>"/>
    		<br/><br/>
    	<label for="country">Country:</label><br/>
    		<input id="country" type="text" name="Country" maxlength="100" value="<?php if(isset($address)){ echo $address->getCountry();}?>"/>
    		<br/><br/>
    	<hr/>
    	<input type="submit" name="Submit"/>
    </form>
</section>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_footer.php'?>
