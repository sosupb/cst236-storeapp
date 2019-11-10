


<?php
include_once 'myFunctions.php';

require_once 'User.php';
require_once 'Address.php';

// define error message variables and set to empty values
$userNameErr = $firstNameErr = $lastNameErr = $passwordErr = $password2Err = "";
$mainMessageErr = "* required fields";

$user = new User("", "");
$address = new Address("", "", "", "", "", "", "", "", "");

// define variable to determine if we are ready to insert into the database
$ready = FALSE;

//check each of the required fields and populate thier error message as necessary.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ready = TRUE; //we have been through the form at least once.
    
    //check for empty fields
        
    $address = new Address($_POST["FirstName"], $_POST["LastName"], $_POST["MiddleName"], $_POST["Address1"], $_POST["Address2"], $_POST["City"], $_POST["State"], $_POST["Zipcode"], $_POST["Country"]);
    
    if (empty($address->getFirstName())) {
        $firstNameErr = "You must enter a first name!";
        $ready = FALSE;
    }
    
    if (empty($address->getLastName())) {
        $lastNameErr = "You must enter a last name!";
        $ready = FALSE;
    }
}

//runs only if all fields that are required have been filled out
if($ready) {
    
    //create connection to our database
    $db = dbOpen();
    //check if we have a connection
    
    //address is entered and ready for database
        
    //any duplicate queries go here
    $user = unserialize($_SESSION['User']);
    $user->setAddress($address);
    $name = $user->getName();
    $password = $user->getPassword();
    $role = 1;
    $firstName = $address->getFirstName();
    $middleName = $address->getMiddleName();
    $lastName = $address->getLastName();
    $address1 = $address->getAddressLineOne();
    $address2 = $address->getAddressLineTwo();
    $city = $address->getCity();
    $state = $address->getState();
    $zipCode = $address->getPostalCode();
    $country = $address->getCountry();
    
    echo $user->getName();
    
    //set up insert query parameter for user
    $query = "INSERT INTO `users` (USER_NAME, PASSWORD, ROLE) VALUES (?, ?, ?)";
    
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $name, $password, $role);
    
    $stmt->execute();

    if ($stmt->affected_rows > 0) { //successful entry
        $_SESSION["User"] = serialize($user);
        $loginQuery = mysqli_query($db, "SELECT * FROM `users` WHERE USER_NAME LIKE '" . $user->getName() . "'" . " AND PASSWORD LIKE BINARY '" . $user->getPassword() . "'");
        $_SESSION['User_ID'] = mysqli_fetch_object($loginQuery)->USER_ID;
        
        //insert parameters for address
        $query = "INSERT INTO `address` (USER_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME,
                                       ADDRESS_1, ADDRESS_2, CITY, STATE, ZIPCODE, COUNTRY) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssssssssss', $_SESSION["User_ID"], $firstName, $middleName,$lastName, $address1, $address2, $city, $state, $zipCode, $country);
        
        $stmt->execute();
        
        
        if ($stmt->affected_rows > 0) { //successful entry
            $db->close();
            $_SESSION['UserName'] = $user->getName();
            header("Location: registered.php");
            
        } else { //there was and error
            $db->close();
            $mainMessageErr = "An error has occurred. You were not regester.";
        }
        
    } else {
        echo $user->getName();
        $db->close();
        $mainMessageErr = "An error has occurred. You were not regester.";
    }
}

?>