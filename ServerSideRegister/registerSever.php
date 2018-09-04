<?php
// robert clements
require 'dbconnect.php'; //connecting to database

//this is only to start the session if not yet started -Chris
if(!isset($_SESSION))
{
    session_start();
}
//end Chris

// print_r($_POST); //used to see reuslts of $_POST

$_SESSION['email'] = $_POST['email'];
$_SESSION['firstname'] = $_POST['first_name'];
$_SESSION['lastname'] = $_POST['last_name'];


// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['first_name']);
$last_name = $mysqli->escape_string($_POST['last_name']);
$country = $mysqli->escape_string($_POST['country']);
$state = $mysqli->escape_string($_POST['state']);
$province = $mysqli->escape_string($_POST['province']);
$city = $mysqli->escape_string($_POST['city']);
$postal_code = $mysqli->escape_string($_POST['postal_code']);
$zip_code = $mysqli->escape_string($_POST['zip_code']);
$address = $mysqli->escape_string($_POST['address']);
$phone = $mysqli->escape_string($_POST['phone']);
$bus_phone = $mysqli->escape_string($_POST['bus_phone']);
$email = $mysqli->escape_string($_POST['email']);
$username = $mysqli->escape_string($_POST['username']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string( password_hash($_POST['password'], PASSWORD_BCRYPT) );
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
// echo $password; //used for debugging found out that database email column did not have long enough length to store whole password

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM customers WHERE CustEmail='$email'") or die($mysqli->error);
// print_r($result); //used to see results of qurry
// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'User with this email already exists! register error';
    //header("location:ServerSideRegister/error.php");
    //include("ServerSideRegister/error.php");
    header("customer_registration.php");
}
else { // Email doesn't already exist in a database, proceed...
  //making keys corrisponding with column headings in database
  $makeKey="CustFirstname, CustLastName, CustAddress, CustCity, CustProv, CustPostal, CustCountry, CustHomePhone, CustBusPhone, CustEmail, CustUsername, CustPassword, EmailHash";

  $sql = "INSERT INTO customers ($makeKey)"."VALUES('$first_name','$last_name','$address','$city','$province','$postal_code','$country','$phone','$bus_phone','$email','$username','$password', '$hash')";
  // print_r($sql); //used to see if inserting right things
    if ($mysqli->query($sql) ){
      $_SESSION['active'] = 0; //0 until user activates their account with verify.php
      $_SESSION['logged_in'] = true; // So we know the user has logged in
      $_SESSION['message'] =
      "Confirmation link has been sent to $email, please verify your account by clicking on the link in the message!";
     // Send registration confirmation link (verify.php)
        $to=$email;
        // echo $to; //see if email is in right form
        $subject = 'Account Verification (travelexperts.com )';
        $message_body='Hello '.$first_name.',
        Thank you for signing up!
        Please click this link to activate your account:
        http://localhost/websiteproject/serversideregister/verifyUser.php?email='.$email.'&hash='.$hash;
        mail($to, $subject, $message_body);
        header("customer_registration.php"); //changed this from contact_us -Chris
        }
        else {
          $_SESSION['message'] = 'Registration failed!';
          header("customer_registration.php"); //changed this - Chris
        }
      }
// robert clements
?>
