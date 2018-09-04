<?php
  // Robert Clements
  // this is being used to connect to the database
  $mysqli = new mysqli("localhost","root","","travelexperts");
    //check if connection is succesful
    if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }
 ?>
