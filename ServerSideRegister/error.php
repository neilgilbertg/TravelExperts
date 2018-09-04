<?php
// robert clements
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
    <?php
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];
    else:
        //header( "location: ../contact_us.php" );
    endif;
    ?>
    </p>
    <a href="../contact_us.php"><button class="button button-block"/>Home</button></a>
    <!-- robert clements -->
</div>
</body>
</html>
