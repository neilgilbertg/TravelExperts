<!DOCTYPE html>
<!-- robert -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <!-- normilize css file being lodaing in -->
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <!-- bootstrap being loading in -->
    <?php require("bootstrap.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/contactUs.css" />
    <link rel="stylesheet" href="css/footer.css">
  </head>
  <body>
    <div class="content">
    <?php include("include/navbar.php") ?>
    <!-- jumbotron is holding the image and contact us wordds at top of page -->
      <div class="jumbotron rounded-0">
        <div id="jumboInfo">
          <h1 class="display-3 text-center">Contact US</h1>
          <p class="lead text-center">We would love to hear from you!</p>
        </div>
      </div>
  <!-- this is the form container holdign the contact us form i commented this out becasue i am displaying the agencies locations and assoastied agents-->
  <!-- <div class="container-fluid">
      <form>
      row for first and last name
        <div class="row">

        colum for first name
          <div class="col-sm-6">
            <div class="form-group">
              <label for="fname">First Name</label>
              <input class="form-control" type="text" name="fname" placeholder="Your name..">
            </div>
          </div>

          column for last name
          <div class="col-sm-6">
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input class="form-control" type="text" name="lname" placeholder="Your last name..">
            </div>
          </div>
        </div>

        row for email and phone number
        <div class="row">

        column for email
          <div class="col-sm-6">
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" type="emal" name="email" placeholder="Your email..">
            </div>
          </div>

          column or phone number
          <div class="col-sm-6">
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input class="form-control" type="tel" name="phone" placeholder="Your last name..">
            </div>
          </div>
        </div>

        column for text box
          <div class="form-group">
          <label for="info">Message</label>
              <textarea class="form-control" name="info" rows="4" maxlength="2000" cols="80"></textarea>
            </div>

            submit button
        <div class="form-group">
          <input class="btn btn-primary btn-lg" type="submit" value="Submit">
        </div>
    </form>
  </div> -->
  <!-- this is the container holding the address of the company and google maps -->

  <!-- this is a row to hold the contact info of each office -->
  <div class="container-fluid">
    <?php include("agenciesContact.php") ?>
  </div>  
    <!-- i inlcude the footer here which is a styled bootstrap footer, i will update that later -->
  </div>
    <?php include("include/footer.php")  ?>
  </body>
<!-- robert   -->
</html>
