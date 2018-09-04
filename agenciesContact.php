<?php
// robert code
  require("ServerSideRegister\dbconnect.php");//database connection page

    //query to grab items from database
    $grabAgency = "SELECT AgencyId, AgncyAddress, AgncyCity, AgncyProv, AgncyPostal, AgncyCountry, AgncyPhone, Agncyfax FROM agencies";
    // $array = mysqli_fetch_assoc($grabAgency);
    // print_r($array); //this was used to see what was on the array
    // echo "<div class='row'>";
    if($result = mysqli_query($mysqli, $grabAgency)){
      // print_r($result);//used to see if query worked
      echo '<div class="row">';
      while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="col-md-6">
        <?php
        if($row['AgencyId']==1){
          echo  "<h6>Travel Experts Calgary</h6>";
        }
        else{
          echo "<h6>Travel Experts Okotoks</h6>";
        }
          echo '<i class="fas fa-home"></i>' . $row["AgncyAddress"] . "<br>";
          echo $row["AgncyCity"] .", ". $row["AgncyProv"].", ". $row["AgncyCountry"] .", ".$row["AgncyPostal"] . "<br>";
          echo '<i class="fas fa-phone"></i>' . $row["AgncyPhone"] . "<br>";
          echo '<i class="fas fa-fax"></i>' . $row["Agncyfax"] . "<br>";
          getAgentInfo($row["AgencyId"],$row["AgncyCity"]);
        // print_r ($row); used to see if row is making array for each row
        ?>
        </div>
        <?php
      }
      echo "</div>";
      mysqli_free_result($result);
    }

    function getAgentInfo($agencyId,$agencyCity){

      require("ServerSideRegister\dbconnect.php");

       $grabAgents = "SELECT AgtFirstName, AgtLastName, AgtBusPhone, AgtEmail, AgtPosition FROM agents where AgencyId=$agencyId";

         $count=3;

      if($result = mysqli_query($mysqli, $grabAgents)){
        ?>
              <button type="button" class="btn btn-primary my-2" data-toggle="collapse" data-target="#collapse<?php echo $agencyId ?>" aria-expanded="true" aria-controls="collapse<?php echo $agencyId ?>">
                List of <?php echo $agencyCity ?> Agents <i class="fas fa-caret-down"></i>
              </button>
          <div id="collapse<?php echo $agencyId ?>" class="collapse" aria-labelledby="heading<?php echo $agencyId ?>" data-parent="#accordion">
            <div class="card-body">
        <?php
        // print_r($result);//used to see if query worked
        while($row = mysqli_fetch_assoc($result)){
          if($count%2==1){
            echo '<div class="row">';
          }

          echo '<div class="col-sm-6">';
          echo $row["AgtFirstName"] . " " . $row["AgtLastName"] . "<br>";
          echo '<i class="fas fa-phone"></i>' . $row["AgtBusPhone"] . "<br>";
          echo '<i class="far fa-envelope"></i>' . " " . $row["AgtEmail"] . "<br>" . "<br>";
          // print_r($row); //used to see if array for each row was made
          echo "</div>";
          // print_r($count);
          if($count%2==0){
            echo '</div>';
          }
          $count++;
        }
        ?>
              </div>
            </div>
          </div>
        <?php
     }
    }
     ?>
