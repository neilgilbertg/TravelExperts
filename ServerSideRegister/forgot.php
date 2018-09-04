<?php
/* Reset your password form, sends reset.php password link */
require 'dbconnect.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $email = $mysqli->escape_string($_POST['email']);
    print_r($email);
    $result = $mysqli->query("SELECT * FROM customers WHERE CustEmail='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    {
        $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data

        $email = $user['CustEmail'];
        $hash = $user['EmailHash'];
        $first_name = $user['CustFirstName'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
        . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
        $to = $email;
        $subject = 'Password Reset Link ( travelexperts.com )';
        $message_body = '
        Hello '.$first_name.'You have requested password reset! Please click this link to reset your password:

        http://localhost/WebsiteProject/ServerSideRegister/reset.php?email='.$email.'&hash='.$hash;
        mail($to, $subject, $message_body);
        header("location: success.php");
  }
}
