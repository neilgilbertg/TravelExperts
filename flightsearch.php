<!--
	Module name: Flight Search
	Author: Neil
	Description: This function is a completely optional function. This will accompany the database changes implemented. The whole focus of this is to allow customers to also book individual flights. This also have a fully functional search bar that will sort out flight booking search results. 
-->
<!DOCTYPE html>
<html>
<head>
	<title>Book a fight</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
     <?php require("bootstrap.php") ?>
    <script src="js/jquery.redirect.js"></script>
</head>
<body>
	<?php include "include/navbar.php"?>
	<section id="packageMenu" class="container-fluid">
		<h2 class="display-4">Search for flight booking</h2>
		<div>
			<!--The search bar function allows user to search booking flights-->
			<div class="col bg-light py-2">
			<form action="include/flightdisplay.php" target="displayPort" method="post">
				<label>From:
					<input type="text" id="from" name="from" size="30vw"></label>
				<label>Destination:
					<input type="text" id="destination" name="destination" size="30vw">
				</label>
				<label>When:
					<input type="date" id="date" name="date">
				</label>
				<label>Days
					<input type="number" name="days">
				</label>
				<div class="d-flex flex-row-reverse">
					<input type="submit" class="p-2 bg-info btn btn-primary" value="Search">
				</div>
			</form>
			</div>
			<table id="heads" name="heads" class="table">
				<!--Create headers for items-->
				<thead class="thead">
					<tr class="d-flex">
						<th style="width: 20vw;">Destination</th>
						<th style="width: 7vw;">Region</th>
						<th style="width: 9vw;">Fly From</th>
						<th style="width: 9vw;">Plane No</th>
						<th style="width: 13vw;">Departure Date</th>
						<th style="width: 14vw;">Return Date</th>
						<th style="width: 15vw;">Ticket Price</th>
						<th style="width: 9vw;"></th>
					</tr>
				</thead>
			</table>
			<!--The results of the search are separated into the include/flightdisplay.php the search bar is communicating to this php to send to flightdisplay.php to display search and modify results-->
			<iframe name="displayPort" id="displayPackages" src="include/flightdisplay.php" style="height: 80vh; width: 96.5vw;"></iframe>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
	<script type="text/javascript">
		//Getting values to send to the Iframe to display results
		var dateControl = document.querySelector('input[type="date"]');
		var dateNow = new Date();

		var YearNow = dateNow.getFullYear();
		var MonthNow = dateNow.getMonth()+1;
		var DateNow = dateNow.getDate();

		//Modifying date to meet database date format
		if(MonthNow<10){MonthNow='0'+MonthNow;}
		if(DateNow<10){DateNow='0'+DateNow;}

		dateControl.value = YearNow+"-"+MonthNow+"-"+DateNow;

		//VerifyUserForBook is used to verify if user is logged in, will stop user from proceeding to the ConfirmOrder.php if they are not logged in and also warns them to login or register
      	function verifyUserForBook($userId, $departPlnId, $returnPlnId){
    	    //console.log($userId);
        	if($userId!="")
          	{
          	  //alert("Logged in");
           	 	//EDIT THIS IF DIRECTORY IS CHANGED
           	 	//console.log($userId+" : "+$departPlnId+" : "+$returnPlnId);
           	 	$.redirect("confirmOrder.php",
           	   	{
            	    'userId': $userId,
            	    'departPlnId': $departPlnId,
            	    'returnPlnId': $returnPlnId
              	}
              	);
            	//window.location.href = "http://localhost/WebsiteProject/sqlact/addbooking.php";
          	}
          	//This will stop user from going to confirmOrder.php and also adds cookies that will alow redirection to confirmOrder.php when user logs in and confirmOrder gets filled up with the currently selected flight
        	else
          	{
          		clearLastViewProduct()
            	document.cookie = "departPlnId="+$departPlnId;
            	document.cookie = "returnPlnId="+$returnPlnId;
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
        //This hide header acccording to screen size: intended is if higher than tablet resolution it shows column legend outside the display
        if(window.outerHeight<=575){if(window.outerWidth<=425){$("#heads").hide();}}
        $(window).resize(function(){
        	if(window.outerHeight<=575){if(window.outerWidth<=425){$("#heads").hide();}}
    	});
	</script>
</body>
</html>
