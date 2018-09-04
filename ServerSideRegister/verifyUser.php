<?php
// Robert Clements
  require "dbconnect.php";
  session_start();

  // Make sure email and hash variables aren't empty
  if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
  {
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);
    echo $email;
    echo $hash;
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("SELECT * FROM customers WHERE CustEmail='$email' AND EmailHash='$hash' AND Active='0'");
    print_r($result);
    if ( $result->num_rows == 0 )
    {
      $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

      header("location: error.php");
    }
    else {
      $_SESSION['message'] = "Your account has been activated!";

    // Set the user status to active (active = 1)
      $mysqli->query("UPDATE customers SET Active='1' WHERE CustEmail='$email'") or die($mysqli->error);
      $_SESSION['active'] = 1;

        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: error.php");
}
// robert clements
?>
