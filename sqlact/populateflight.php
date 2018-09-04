<?php
	$flightStart = "2018-06-02 00:00:00";
	//$flightmove = date("Y-m-d H:i:s");
	$flightlocation = "Calgary";
	$flightdestination = array(
	"Vancouver, Canada"=>"NA", "Athens, Greece"=>"MED","Cairo, Egypt"=>"MEAST",
	"Calcutta, India"=>"MEAST", "Cape Town, South Africa"=>"AFR", "Edmonton, Canada"=>"NA", 
	"Grande Prairie, Canada"=>"NA", "Hong Kong, China"=>"ASIA", "Houston, Canada"=>"NA", 
	"London, England"=>"EU", "Montreal, Canada"=>"NA", "Paris, France"=>"EU", 
	"Rio de Janeiro, Brazil"=>"SA", "Sydney, Australia"=>"ANZ", "Toronto, Canada"=>"NA", 
	"Victoria, Canada"=>"NA", "Winnipeg, Canada"=>"NA", "Tokyo, Japan"=>"ASIA", 
	"Bangkok, China"=>"ASIA", "Manila, Philippines"=>"ASIA", "Pyongyang, North Korea"=>"ASIA", "Moscow, Russia"=>"ASIA"
	);
	$flightprices = array(310.00,550.00,550.00,560.00,470.00,600.00,
		310.00,310.00,550.00,310.00,490.00,310.00,470.00,470.00,600.00,310.00,
		310.00,310.00,540.00,560.00,570.00,1000.00,570.00);

	$startingId = 40001;
	$stratingPlaneNo = 1001;

	$sqlcommand = "INSERT INTO flightstable VALUES(";
	$rowvalues = "";

	$dbinst = mysqli_connect("localhost","root","","travelexperts");
	if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}

	$pindex = 0;
	foreach ($flightdestination as $key => $value) {
		for ($i=0; $i<15 ; $i++) {
			$rowvalues = "";
			//Setting rowvalues for FLIGHTID and FLTPLANENO
			$rowvalues .= "'".$startingId."', '".$stratingPlaneNo."', ";
			//Setting rowvalues for FLTDEPART and FLTRETURN
			$rowvalues .= "'".$flightStart."', ";
			$flightStart = date("Y-m-d H:i:s", strtotime("$flightStart +3 day"));
			$rowvalues .= "'".$flightStart."', ";
			//Setting rowvalues for FLRLCOATION, FLTDESTINATION, and REGIONID
			$rowvalues .= "'".$flightlocation."', '".$key."', '".$value."', ";
			//Setting rowvalues for FLTTICKETPRICE
			$rowvalues .= "'".$flightprices[$pindex]."'";

			echo $sqlcommand.$rowvalues.");<br/>";
			//Command to add to database
			$result = mysqli_query($dbinst,$sqlcommand.$rowvalues.")");
			$startingId++;$stratingPlaneNo++;		
		}
		$flightStart = "2018-06-02 00:00:00";
		$pindex++;
	}
	mysqli_close($dbinst);
?>