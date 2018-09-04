<!--
	Module name: Package
	Author: Neil
	Description: This function is a required feature. Main function of this page is to display packages and allow user to choose a package to book 
-->
<!DOCTYPE html>
<html>
<head>
	<title>Vacation Packages</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
  	<?php require("bootstrap.php") ?>
    <script src="js/jquery.redirect.js"></script>
	<link rel="stylesheet" href="css/footer.css">
</head>
<body>
	<div class="content">
	<?php include "include/navbar.php"?>
	<section id="packageMenu">
		<h1 class="display-4 ml-2">Our Travel Packages</h1>
		<?php
			$dbinst = mysqli_connect("localhost","root","","travelexperts");
			if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}
			$result = mysqli_query($dbinst, "SELECT * FROM packages");
			?>
				<div class="container-fluid">
			<?php

			//Constructing booking items
			while ($row=mysqli_fetch_assoc($result))
				{
					// print_r($row); // used to see array for each package
					//Change image according to package name
					//Improvement possible: Database data type BLOB can store images might be a great idea to use that instead
					if($row['PkgName']=="Caribbean Tour"){$image="carribean.jpeg";}
					else if($row['PkgName']=="Polynesian Paradise"){$image="polynesia.jpeg";}
					else if($row['PkgName']=="Asian Expedition"){$image="asianhiking.jpeg";}
					else if($row['PkgName']=="European Vacation"){$image="europevac.jpeg";}
          	//echo $_SESSION['userId'];
					?>
						<div class="row mb-3">
							<div class="col bg-light py-2">
								<?php
								?> <h4> <?php echo $row['PkgName'] . "<br>" ?> </h4> <?php
								?>
									<div class="d-flex">
										<!--Add a quote for a package according to package name-->
										<img class="img-fluid d-none d-md-block" alt="Responsive image"  src="images/flightpackagepics/<?php echo $image ?>"></img>
										<?php if($row['PkgName']=="Caribbean Tour"){
											?>
											<blockquote class="blockquote align-self-center ml-3">
												<p class="font-italic">"The water is so blue and the atmosphere is energitic. Jason my agent made sure everything was in place"</p>
												<footer class="blockquote-footer">Janet</footer>
											</blockquote>
											<?php
										}
										else if($row['PkgName']=="Polynesian Paradise"){
												?>
												<blockquote class="blockquote align-self-center ml-3">
													<p class="font-italic">"The agents at Travel Expert are so freindly. They put together a really great package"</p>
													<footer class="blockquote-footer">Bill</footer>
												</blockquote>
												<?php
										}
										else if($row['PkgName']=="Asian Expedition"){
											?>
											<blockquote class="blockquote align-self-center ml-3">
												<p class="font-italic">"I would book with Travel Experts again and again. By far the best vacation I have ever done "</p>
												<footer class="blockquote-footer">Neil</footer>
											</blockquote>
											<?php
										}
										else if($row['PkgName']=="European Vacation"){
											?>
											<blockquote class="blockquote align-self-center ml-3">
												<p class="font-italic">"So much history in ever city. I learnt so much from the tours. Thanks Travel Experts. Give Dennis he is the best"</p>
												<footer class="blockquote-footer">Cindy</footer>
											</blockquote>
											<?php
										} ?>
									</div>
								<?php
								//Package information constructed here
								?> <p class="lead"> <?php echo $row['PkgDesc'] . "<br>"; ?> </p> <?php
								?>
								<!--Package date is constructed here-->
								<div class="d-flex">
									<div class="">
										<!--Reformating date-->
										Start Date: <?php  $formatDate = date_create($row['PkgStartDate']);
										echo $row['PkgStartDate']= date_format($formatDate, "Y-m-d") ?>
									</div>
									<div class="ml-4">
										<!--Reformating date-->
										End Date: <?php $formatDate = date_create($row['PkgEndDate']);
										echo $row['PkgEndDate']= date_format($formatDate, "Y-m-d"); ?>
									</div>
								</div>
								<div class="d-flex justify-content-between">
									<!--Package price is constructed here with a proper dollar symbol-->
									<h5 class="align-self-center">
										Price: <i class="fas fa-dollar-sign"></i> <?php echo number_format($row['PkgBasePrice'],2);  ?>
									</h5>
									<!--Book button constructed here and passing values needed to user verification-->
									<button type="button" id="BookNow" class="btn btn-primary" name="button" onclick="
										verifyUserForPackage(
										<?php
											$userId="";
											if($_SESSION && isset($_SESSION['userId'])){$userId=$_SESSION['userId'];}
											echo "'".$userId."'";
										?>,
										<?php echo "'".$row['PackageId']."'"; ?>
										);
									">Book Now</button>
								</div>
							</div>
						</div>
					<?php
				}
        //verifyUserForPackage(\"".$userId."\");
		?>
		</div>
	</section>
</div>
	<?php
      //echo $_SESSION['userId'];
      include "include/footer.php"; ?>

  	<script type="text/javascript">
    //VerifyUserForBook is used to verify if user is logged in, will stop user from proceeding to the ConfirmOrder.php if they are not logged in and also warns them to login or register
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
    //This will stop user from going to confirmOrder.php and also adds cookies that will alow redirection to confirmOrder.php when user logs in and confirmOrder gets filled up with the currently selected flight
        else
          {
          	clearLastViewProduct()
            document.cookie = "lastViewedBooking="+$packageId;
            alert("Please log in or register for new user");
            $("#loginModal").modal('show');
          }
      }
      //This will clear the cookie that is used for login redirection so it would not cause errors
      function clearLastViewProduct(){
			document.cookie = "lastViewedBooking=;";
    		document.cookie = "departPlnId=;";
    		document.cookie = "returnPlnId=;";
        }
  	</script>
</body>
</html>
