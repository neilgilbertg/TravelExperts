<!--
	Module name: confirmOrder
	Author: Neil, Styling: Robert
	Description: The main function of this page is all required information for a booking and also presents additional options that is required to fully input the booking inside the DB 
-->
<!DOCTYPE html>
<html>
<head>
	<title>Confirm Order</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/home_style.css" rel="stylesheet" type="text/css">
		<?php require("bootstrap.php")?>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/jquery.redirect.js"></script>
</head>
<body>
	<div class="content">
	<?php include "include/navbar.php"; ?>
	<?php
			$dbinst = mysqli_connect("localhost","root","","travelexperts");
			if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}
	?>
	<section class="container">
		<h2 class="sectHead mt-2">Confirm your Booking</h2>
		<!--ENCAPSULATE THIS IN A PHP TAG FOR INTERACTION-->
		<div name="packageInfo" class="packageStyling">
		<?php
			$currentPackage="";
			if(isset($_POST['packageId'])){
				$currentPackage =$_POST['packageId'];
				$result = mysqli_query($dbinst, "SELECT * FROM packages WHERE PackageId='".$currentPackage."'");
				$row = mysqli_fetch_assoc($result);
				?>
					<table class="table">
						<tbody>
							<tr>
								<th scope="row">Package</th>
								<td><?php echo $row['PkgName'] ?></td>
							</tr>
							<tr>
								<th scope="row">Start Date</th>
								<td><?php echo $row['PkgStartDate'] ?></td>
							</tr>
							<tr>
								<th scope="row">End Date</th>
								<td><?php echo $row['PkgEndDate'] ?></td>
							</tr>
							<tr>
								<th scope="row">Price</th>
								<td><i class="fas fa-dollar-sign"></i> <?php echo $row['PkgBasePrice'] ?></td>
							</tr>
						</tbody>
					</table>
				<?php
				$departPlnId = $row['DeparturePlnId'];
				$returnPlnId = $row['ReturnPlnId'];
			}else{
				$departPlnId = $_POST['departPlnId'];
				$returnPlnId = $_POST['returnPlnId'];
			}
		?>
		</div>
		<!--ENCAPSULATE THIS IN A PHP TAG FOR INTERACTION-->
			<?php
			// query for departure flgiht info
				$result = mysqli_query($dbinst, "SELECT * FROM flightstable WHERE FlightId='".$departPlnId."'");
				$rowDeparture = mysqli_fetch_assoc($result);
			// query for return flight info
				$result = mysqli_query($dbinst, "SELECT * FROM flightstable WHERE FlightId='".$returnPlnId."'");
				$rowReturn = mysqli_fetch_assoc($result);
			?>
		<h2>Flight Information</h2>
		<table class="table">
			<thead>
				<th scope="col"></th>
				<th scope="col">Departure Information</th>
				<th scope="col">Return Information</th>
			</thead>
			<tbody>
				<tr>
					<th scope="row">Plane No</th>
					<td><?php echo $rowDeparture['FltPlaneNo'] ?></td>
					<td><?php echo $rowReturn['FltPlaneNo'] ?></td>
				</tr>
				<tr>
					<th scope="row">Departure/Retrun Date</th>
					<td><?php echo $rowDeparture['FltReturn'] ?></td>
					<td><?php echo $rowReturn['FltReturn'] ?></td>
				</tr>
				<tr>
					<th scope="row">Flight Path</th>
					<td><?php echo  $rowDeparture['FltLocation'] . " - " . $rowDeparture['FltDestination'] ?></td>
					<td><?php echo  $rowDeparture['FltDestination'] . " - " . $rowDeparture['FltLocation'] ?></td>
				</tr>
				<tr>
					<th scope="row">Price</th>
					<td><i class="fas fa-dollar-sign"></i> <?php echo $rowDeparture['FltTicketPrice'] ?></td>
					<td><i class="fas fa-dollar-sign"></i> <?php echo $rowReturn['FltTicketPrice'] ?></td>
				</tr>
			</tbody>
		</table>
	<article class="bookingModifiers">
		<h3 class="onerow">Options</h3>
		<div class="bookingModifiersForm">
			<div class="d-flex flex-row">
				<div class="align-self-center">
					<label class="mr-3 lead">How Many People</label>
				</div>
				<div class="input-group w-25">
					<input class="form-control" type="number" id="TravelerCount" name="TravelerCount" value="1" min="1" cols="1">
				</div>
			</div>
			<br/>
			<div class="lead">
				Class
			</div>
			<table class="table">
				<tr>
					<td><label><input type="radio" class="classCk" name="class" value="DLX" onchange="classSelected('DLX')">Delux</input></label></td>
					<td><label><input type="radio" class="classCk" name="class" value="ECN" onchange="classSelected('ECN')">Economy</input></label></td>
					<td><label><input type="radio" class="classCk" name="class" value="SNG" onchange="classSelected('SNG')">Single</input></label></td>
				</tr>
				<tr>
					<td><label><input type="radio" class="classCk" name="class" value="FST" onchange="classSelected('FST')">First Class</input></label></td>
					<td><label><input type="radio" class="classCk" name="class" value="BSN" onchange="classSelected('BSN')">Business</input></label></td>
					<td><label><input type="radio" class="classCk" name="class" value="DBL" onchange="classSelected('DBL')">Double</input></label></td>
				</tr>
				<tr>
					<td><label><input type="radio" class="classCk" name="class" value="INT" onchange="classSelected('INT')">Interior</input></label></td>
					<td><label><input type="radio" class="classCk" name="class" value="OCNV" onchange="classSelected('OCNV')">Ocean View</input></label></td>
				</tr>
			</table>
		</div>
		<div class="bookingClass">
			<p id="classInfo"></p>
			<input type="button" class="btn btn-success mb-3" id="finishbooking" name="finishbooking" value="Finish Booking"
			onclick="sendToAddBooking(
				`<?php echo $_POST['userId'];?>`,
				`<?php echo $currentPackage;?>`,
				`<?php echo $departPlnId;?>`,
				`<?php echo $returnPlnId?>`
			)" >
		</div>
	</section>
	</article>
</div>
	<?php include "include/footer.php"; ?>
	<script type="text/javascript">
    	document.cookie = "lastViewedBooking=;";
    	document.cookie = "departPlnId=;";
    	document.cookie = "returnPlnId=;";
    	function sendToAddBooking($userId, $packageId, $DeparturePlnId, $ReturnPlnId){
  			var TravelerCount = $('#TravelerCount').val();
  			var ClassId = $(".classCk:checked").val();
  			//alert($userId+"\n"+$packageId+"\n"+$DeparturePlnId+"\n"+
  			//	$ReturnPlnId+"\n"+TravelerCount+"\n"+ClassId);
  			$.redirect("sqlact/addbooking.php",
              {
                'userId': $userId,
                'packageId': $packageId,
                'DeparturePlnId': $DeparturePlnId,
                'ReturnPlnId': $ReturnPlnId,
                'TravelerCount': TravelerCount,
                'ClassId': ClassId
              }
              );
  		}
  		function classSelected($classId)
  		{
  			$('#finishbooking').show();
  			$constructClassDesc = "";
  			if($classId=="DLX"){
  				$constructClassDesc+="Delux Class<br/>"+
  				"<ul>"+
  					"<li>You will enjoy our standard quality service.</li>"+
  					"<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>"+
  					"<li>Interdum et malesuada fames ac ante ipsum primis in faucibus.</li>"+
  					"<li>Nunc non tortor elementum, sollicitudin erat in, elementum elit.</li>"+
  				"<ul>";
  			}
  			if($classId=="ECN"){
  				$constructClassDesc+="Economy Class<br/>"+
  				"<ul>"+
  					"<li>You will enjoy our budget level services.</li>"+
  					"<li>Sed tempor, augue vel elementum ultrices, ante sem fringilla dui, sit amet tristique lacus lorem a nisi.</li>"+
  					"<li>Quisque placerat dolor vel elit hendrerit tristique nec a justo.</li>"+
  					"<li>Aliquam placerat nisi tincidunt dictum cursus.</li>"+
  				"<ul>";
  			}
  			if($classId=="SNG"){
  				$constructClassDesc+="Single Class<br/>"+
  				"<ul>"+
  					"<li>Have all the fun in the world ALONE.</li>"+
  					"<li>Ut mollis, sem vitae bibendum interdum, magna est convallis sem, at tincidunt eros urna sed dui.</li>"+
  					"<li>Pellentesque feugiat tempus ex ut aliquet.</li>"+
  					"<li>Vivamus sollicitudin in massa at ullamcorper.</li>"+
  				"<ul>";
  			}
  			if($classId=="FST"){
  				$constructClassDesc+="First Class<br/>"+
  				"<ul>"+
  					"<li>Enjoy a luxurious flight in our top quality plane suites.</li>"+
  					"<li>Etiam vitae diam at ipsum aliquam euismod facilisis dapibus dolor.</li>"+
  					"<li>Ut ut dolor et libero facilisis congue.</li>"+
  					"<li>Vestibulum vulputate elementum turpis, sit amet gravida metus ullamcorper ac.</li>"+
  				"<ul>";
  			}
  			if($classId=="BSN"){
  				$constructClassDesc+="Business Class<br/>"+
  				"<ul>"+
  					"<li>Ride a plane that'll keep you connected to your boss.</li>"+
  					"<li>Interdum et malesuada fames ac ante ipsum primis in faucibus.</li>"+
  					"<li>Quisque malesuada nibh ut tincidunt sodales.</li>"+
  					"<li>Phasellus varius ut dolor nec imperdiet.</li>"+
  				"<ul>";
  			}
  			if($classId=="DBL"){
  				$constructClassDesc+="Double Class<br/>"+
  				"<ul>"+
  					"<li>Going abroad for a honeymoon or vacation with your partner? WE GOT YOU.</li>"+
  					"<li>Cras egestas odio eu mauris efficitur commodo.</li>"+
  					"<li>Aenean facilisis risus at ipsum mattis finibus.</li>"+
  					"<li>In tellus eros, dapibus in tempus eu, aliquam et sapien.</li>"+
  				"<ul>";
  			}
  			if($classId=="INT"){
  				$constructClassDesc+="Interior Class<br/>"+
  				"<ul>"+
  					"<li>Fly with our employees and see how we work.</li>"+
  					"<li>Phasellus varius rhoncus erat, ac cursus turpis maximus et.</li>"+
  					"<li>Maecenas facilisis quam eget condimentum congue.</li>"+
  					"<li>Integer pretium faucibus diam at ultricies.</li>"+
  				"<ul>";
  			}
  			if($classId=="OCNV"){
  				$constructClassDesc+="Ocean View Class<br/>"+
  				"<ul>"+
  					"<li>TRAVEL BY BOAT. Ride your buoyancy effective planes.</li>"+
  					"<li>Nulla iaculis pretium augue, vel cursus lorem.</li>"+
  					"<li>Pellentesque accumsan velit sit amet lectus egestas, sed tincidunt nisi vulputate.</li>"+
  					"<li>Sed aliquet elementum metus, et pretium risus efficitur vestibulum.</li>"+
  				"<ul>";
  			}

  			$('#classInfo').html($constructClassDesc);
  		}
  	function getCookie(cname) {
    	var name = cname + "=";
    	var decodedCookie = decodeURIComponent(document.cookie);
    	var ca = decodedCookie.split(';');
    	for(var i = 0; i <ca.length; i++) {
          	var c = ca[i];
          	while (c.charAt(0) == ' ') {
             	c = c.substring(1);
          	}
          	if (c.indexOf(name) == 0) {
             	return c.substring(name.length, c.length);
          	}
       	}
      	return "";
    }
  	</script>
</body>
</html>