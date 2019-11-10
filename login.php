<!--
Project name: CST-236 ECommerce Store App
    Version:   1.0
Module name:  login.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         11/9/2019
Description:
    This file builds the login form and displays all the appropriate error messages based on user input. It also gives the options for setting up a new user.
    This file requires:
        loginHandler.php
        registrationHandler.php
-->

<!-- header -->
<?php include 'include/header.php'; ?>

<!-- setup for login attempts and link to loginHandler -->
<?php
   if(!isset($_SESSION['loginAttempts'])){
      $_SESSION['loginAttempts'] = 10;
   }
   include 'include/loginHandler.php'; 
   include 'include/registrationHandler.php'; 
?>
	
<section class="formWrapper">
<!-- Login Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="message">
            	<h2>Please type you username and password to Login</h2>
            </div>
    		<p class="error"><?php echo $mainMessageErr; ?></p>
    		<label for="username">User Name:</label>
    		<input id="username" type="text" maxlength="50" name="LoginUserName" value="<?php echo $user->getName();?>" <?php if($_SESSION['loginAttempts'] == 0){echo "disabled";}?>/>
    		<span class="error"><?php echo $userNameErr;?></span>	
    		<br/><br/>
    		<label for="password">Password:</label>
    		<input id="password" type="password" maxlength="50" name="LoginPassword" <?php if($_SESSION['loginAttempts'] == 0){echo "disabled";}?>/>
    		<span class="error"><?php echo $passwordErr;?></span>	
    		<br/><br/>
    		<input type="submit" name="Login"/>
    </form>
    
    <!-- Registration Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> <!-- form continues to callback to itself to be able to check for errors -->
    	<div class="message">
        	<h2>If you are not a member already, sign up here</h2>
        </div>
    	<p align="right"><span class="error"><?php echo $mainMessageErr;?></span></p>
    	<br/>			
    	<label for="username">UserName:</label><br/>
    		<input id="username" type="text" name="RegUserName" maxlength="50" value="<?php echo $user->getName();?>"/>
    		<span class="error">* <?php echo $userNameErr;?></span>				
    		<br/><br/>
    	<label for="password">Password:</label><br/>
    		<input id="password" type="password" name="RegPassword" maxlength="50" placeholder="Password must be 8 characters long and contain atleast one number"/>	
    		<span class="error">* <?php echo $passwordErr;?></span>			
    		<br/><br/>
    	<label for="reenterpassword">Re-Enter Password:</label><br/>
    		<input id="reneterpassword" type="password" name="RegPassword2" maxlength="50" placeholder="Please re-enter password"/>
    		<span class="error">* <?php echo $password2Err;?></span>
    		<br/><br/>
    	<input type="submit" name="Sign Up"/>
    </form>
</section>

<!-- footer -->
<?php include 'include/footer.php'?>