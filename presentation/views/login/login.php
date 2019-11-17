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
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; ?>

<!-- setup for login attempts and link to loginHandler -->
<?php
   if(!isset($_SESSION['loginAttempts'])){
      $_SESSION['loginAttempts'] = 10;
   }
?>
	
<section class="loginFormWrapper">
<!-- Login Form -->
    <form action="/presentation/handlers/loginHandler.php" method="POST" class="loginForm">
            <div class="message">
            	<h2>Please type your username and password to Login</h2>
            </div>
    		<p class="error"><?php if(isset($loginMessageErr)) {echo $loginMessageErr;} ?></p>
    		<label for="username">User Name:</label>
    		<input id="username" type="text" maxlength="50" name="LoginUserName" value="" <?php if($_SESSION['loginAttempts'] == 0){echo "disabled";}?>/>
    		<span class="error"><?php if(isset($userNameErr)) {echo $userNameErr;} ?></span>	
    		<br/><br/>
    		<label for="password">Password:</label>
    		<input id="password" type="password" maxlength="50" name="LoginPassword" <?php if($_SESSION['loginAttempts'] == 0){echo "disabled";}?>/>
    		<span class="error"><?php if(isset($passwordErr)) {echo $passwordErr;} ?></span>	
    		<br/><br/>
    		<input type="submit" name="Login"/>
    </form>
    
    <!-- Registration Form -->
    <form action="/presentation/handlers/registrationHandler.php" method="POST" class="loginForm">
    	<div class="message">
        	<h2>Not a member? Sign up here!</h2>
        </div>
        <p class="error"><?php if(isset($regMessageErr)) {echo $regMessageErr;} ?></p>		
    	<label for="username">UserName:</label><br/>
    		<input id="username" type="text" name="RegUserName" maxlength="50" value=""/>
    		<span class="error">* <?php if(isset($userNameRegErr)) {echo $userNameRegErr;} ?></span>				
    		<br/><br/>
    	<label for="password">Password:</label><br/>
    		<input id="password" type="password" name="RegPassword" maxlength="50" placeholder="Password must be 8 characters long and contain atleast one number"/>	
    		<span class="error">* <?php if(isset($passwordRegErr)) {echo $passwordRegErr;} ?></span>			
    		<br/><br/>
    	<label for="reenterpassword">Re-Enter Password:</label><br/>
    		<input id="reneterpassword" type="password" name="RegPassword2" maxlength="50" placeholder="Please re-enter password"/>
    		<span class="error">* <?php if(isset($password2RegErr)) {echo $password2RegErr;} ?></span>
    		<br/><br/>
    	<input type="submit" name="Sign Up"/>
    </form>
</section>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_footer.php'?>