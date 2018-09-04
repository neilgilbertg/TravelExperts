<!--
	Module name: addbooking
	Author: Neil
	Description: This function is a required feature. Main function of this page is to compile all of the booking details required to creating a booking row and bookingdetails row and structures them into a SQL statement that executes them into the database 
-->
<?php
	$dbinst = mysqli_connect("localhost","root","","travelexperts");
			if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}
	echo $_POST['userId']."<br/>".
		$_POST['packageId']."<br/>".
		$_POST['DeparturePlnId']."<br/>".
		$_POST['ReturnPlnId']."<br/>".
		$_POST['TravelerCount']."<br/>".
		$_POST['ClassId']."<br/><br/>";

	///////CONSTRUCT BOOKINGS INSERT
	$sqlcommand = "INSERT INTO bookings ";
	$columns = "(";
	$values = " VALUES (";
	//Values for randomizing Booking no SUBJECT TO CHANGE
	$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');

	//BookingDate
	$columns .= "BookingDate, ";
	$values .= "'".date("Y-m-d h:m:s")."', ";

	//BookingNo
	shuffle($seed);
	$rand = '';
	foreach (array_rand($seed, 5) as $k){$rand.=$seed[$k];}
	$columns .= "BookingNo";
	$values .= "'".$rand."'";

	//TravelCount
	$columns .= ", TravelerCount";
	$values .= ", '".$_POST['TravelerCount']."'";

	//CustomerId
	$columns .= ", CustomerId";
	$values .= ", '".$_POST['userId']."'";

	//TripTypeId
	$columns .= ", TripTypeId";
	if($_POST['ClassId']=='BSN'){$values .= ", 'B'";}
	else if($_POST['TravelerCount']==1){$values .= ", 'L'";}
	else if($_POST['TravelerCount']>=2){$values .= ", 'G'";}

	//PackageId
	if(!empty($_POST['packageId']))
	{
		$columns .= ", PackageId)";
		$values .= ", '".$_POST['packageId']."')";
	}
	else
	{
		$columns .= ")";
		$values .= ")";
	}

	/////////Construct SQL Statement
	$sqlcommand .= $columns.$values;
	//echo $sqlcommand."<br/><br/>";
	$result = mysqli_query($dbinst, $sqlcommand);

	//mysqli_insert_id($dbinst);
	//////////Retrieving required info for BOOKINGINFO
	$bookingRow = mysqli_fetch_assoc(mysqli_query($dbinst, "SELECT * FROM bookings WHERE BookingId='".mysqli_insert_id($dbinst)."'"));
	$packageRow  = mysqli_fetch_assoc(mysqli_query($dbinst, "SELECT * FROM packages WHERE PackageId='".$bookingRow['PackageId']."'"));
	$departPlanRow = mysqli_fetch_assoc(mysqli_query($dbinst, "SELECT * FROM flightstable WHERE FlightId='".$_POST['DeparturePlnId']."'"));
	$returnPlanRow = mysqli_fetch_assoc(mysqli_query($dbinst, "SELECT * FROM flightstable WHERE FlightId='".$_POST['ReturnPlnId']."'"));
	//print_r($departPlanRow);
	
	//////////CONSTRUCTING BOOKINGINFO INSERT
	$sqlcommand = "INSERT INTO bookingdetails ";
	$columns = "(";
	$values = " VALUES (";
	//Values for randomizing ItineraryNo SUBJECT TO CHANGE
	$seed = str_split('0123456789');

	//ItineraryNo
	shuffle($seed);
	$rand = '';
	foreach (array_rand($seed, 5) as $k){$rand.=$seed[$k];}
	$columns .= "ItineraryNo";
	$values .= "'".$rand."'";

	//TripStart
	$columns .= ", TripStart";
	$values .= ", '".$departPlanRow['FltDepart']."'";

	//TripEnd
	$columns .= ", TripEnd";
	$values .= ", '".$returnPlanRow['FltReturn']."'";

	//Description
	$columns .= ", Description";
	$explodedDest =  explode(",", $departPlanRow['FltDestination']);
	$values .= ", '".$departPlanRow['FltLocation']."/".$explodedDest[0]."/".$returnPlanRow['FltLocation']."'";

	//Destination
	$columns .= ", Destination";
	$values .= ", '".$departPlanRow['FltDestination']."'";

	//BasePrice
	if(!empty($_POST['packageId']))
	{
		$columns .= ", BasePrice";
		$values .= ", '".$packageRow['PkgBasePrice']."'";
	}
	else
	{
		$columns .= ", BasePrice";
		$values .= ", '".($departPlanRow['FltTicketPrice']+$returnPlanRow['FltTicketPrice'])."'";
	}

	//AgencyCommission
	if(!empty($_POST['packageId']))
	{
		$columns .= ", AgencyCommission";
		$values .= ", '".$packageRow['PkgAgencyCommission']."'";
	}
	else
	{
		$columns .= ", AgencyCommission";
		$values .= ", '".($departPlanRow['FltTicketPrice']+$returnPlanRow['FltTicketPrice'])*0.05."'";
	}

	//BookingId
	$columns .= ", BookingId";
	$values .= ", '".$bookingRow['BookingId']."'";

	//RegionId
	$columns .= ", RegionId";
	$values .= ", '".$departPlanRow['RegionId']."'";

	//ClassId
	$columns .= ", ClassId";
	$values .= ", '".$_POST['ClassId']."'";

	//FeeId
	$columns .= ", FeeId";
	if($_POST['TravelerCount']==1){$values .= ", 'BK'";}
	else if($_POST['TravelerCount']>=2){$values .= ", 'GR'";}
	

	//ProductSupplierId SUBJECT TO CHANGE
	if(!empty($_POST['packageId']))
	{
		$columns .= ", ProductSupplierId";
		$supplierRow = mysqli_fetch_assoc(mysqli_query($dbinst, "SELECT * FROM packages_products_suppliers WHERE PackageId='".$bookingRow['PackageId']."'"));
		$values .= ", '".$supplierRow['ProductSupplierId']."'";
	}
	else
	{
		$columns .= ", ProductSupplierId";
		$values .= ", '3'";
	}
	//print_r($supplierRow);echo "<br/><br/>";
	
	//DeparturePlnId
	$columns .= ", DeparturePlnId";
	$values .= ", '".$departPlanRow['FlightId']."'";

	//ReturnPlnId
	$columns .= ", ReturnPlnId)";
	$values .= ", '".$returnPlanRow['FlightId']."')";

	//Compiling and return to packages 
	$sqlcommand .= $columns.$values;
	//echo $sqlcommand."<br/>";
	$result = mysqli_query($dbinst, $sqlcommand);
	header("Location: ../packages.php");//SUBJECT TO CHANGE

?>