 <html>
<head>
      <title>Travel Agency</title>
      <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/default.css">
      <?php require("bootstrap.php") ?>
      <link rel="stylesheet" type="text/css" href="css/home_style.css" />
      <link rel="stylesheet" href="css/footer.css">
    <script src="js/jquery.redirect.js"></script>
</head>
  <body>
    <div class=content>
    <?php
      include("include/navbar.php");
    ?>
    <div class="jumbotron rounded-0">
      <div id="jumboInfo">
        <h1 class="display-4 text-center font-weight-bold">Travel Experts</h1>
        <h5 class="text-center">Your Experts in Travel!<h5>
      </div>
    </div>
    <div class="container-fluid">
      <h4>Who we are</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>

    <br>
    <div class="container w-50">

    <h2 class="text-center">Popular Packages</h2>

 <!-- Brijesh  start-->

    <div id="myCarousel" class="carousel slide mb-3" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active" onclick="
                    verifyUserForPackage(
                    <?php
                      $userId="";
                      if($_SESSION && isset($_SESSION['userId'])){$userId=$_SESSION['userId'];}
                      echo "'".$userId."'";
                    ?>,
                    <?php echo "'2'"; ?>
                    );
                  ">
        <img class="d-block img-fluid w-100" src="images\flightpackagepics\boraboraMed.jpeg" alt="First slide">
          <div class="carousel-caption d-none d-sm-block">
            <h3 class="text-dark font-weight-bold"> Polynesian Paradise </h3>
            <h4 class="text-dark font-weight-bold"> 8 Night 9 days... only $3000 </4>
          </div>
      </div>
    <div class="carousel-item" onclick="
                    verifyUserForPackage(
                    <?php
                      $userId="";
                      if($_SESSION && isset($_SESSION['userId'])){$userId=$_SESSION['userId'];}
                      echo "'".$userId."'";
                    ?>,
                    <?php echo "'4'"; ?>
                    );
                  ">
      <img class="d-block img-fluid w-100" src="images\flightpackagepics\euroMed.jpeg" alt="Third slide">
         <div class="carousel-caption d-none d-sm-block">
            <h3> European Vacation </h3>
            <h4> 14 Night 15 days... only $3000 </4>
          </div>
    </div>
   </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
      </a>
  </div>
</div>
</div>
  <footer>
    <?php
      include("include/footer.php");
    ?>
  </footer>

  <script type="text/javascript">
      function verifyUserForPackage($userId, $packageId){
        //console.log($userId);
        if($userId!="")
          {
            //alert("Logged in");
            //EDIT THIS IF DIRECTORY IS CHANGED
            $.redirect("confirmOrder.php",
              {
                'userId': $userId,
                'packageId': $packageId
              }
              );
              //window.location.href = "http://localhost/WebsiteProject/sqlact/addbooking.php";

          }
        else
          {
            clearLastViewProduct()
            document.cookie = "lastViewedBooking="+$packageId;
            alert("Please log in or register for new user");
            $("#loginModal").modal('show');
          }
      }
      function clearLastViewProduct(){
      document.cookie = "lastViewedBooking=;";
        document.cookie = "departPlnId=;";
        document.cookie = "returnPlnId=;";
        }
    </script>

</body>
</html>  <!-- /Brijesh end -->
