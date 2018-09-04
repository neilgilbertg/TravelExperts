  <!-- robert clements-->
  <!-- this is used to check for what method it used and if login was pressed or register was pressed -->
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['login'])) { //user logging in
      require("ServerSideRegister/loginVerify.php");
    }
    elseif (isset($_POST['register'])) { //user registering
      header("location:customer_registration.php");
    }
    elseif (isset($_POST['logout'])){ //user logout
      require("ServerSideRegister/logout.php");
    }
  }
  // var_dump($_SESSION); //used to check if the session is cleared after logged in



?>




<!-- robert clements-->
    <!--Chris Earle- the modal html code along with js to close on click outside modal-->
<!-- The Modal -->
<div id="loginModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- modal header -->
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- modal body -->
    <form method="post">
    <div class="modal-body">
      <div class="form-group">
        <!-- <label for="username">Username:</label> -->
        <input type="text" class="form-control" placeholder="Enter Email" name="username">

        <div id="username_msg"></div>

        <br/>
      </div>
      <div class="form-group">
        <!-- <label for="password">Password:</label> -->
        <input type="password" class="form-control" placeholder="Enter Password" name="password">

        <div id="password_msg"></div>

        <br/>
      </div>
        <button class="btn btn-primary" type="submit" name="login">Login</button>
        <!-- <button type="submit" class="btn btn-primary" name="logout">Logout</button> -->
        <!--we can remove the remember me later, might be lots of work-->
        <!-- <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label> -->
        <!--we can remove the forgot password later, might be lots of work-->
        <!-- <div class="container" style="background-color:#f1f1f1">
            <button class="buttons" type="button" onclick="document.getElementById('loginModal').style.display='none'" class="cancelbtn">Cancel</button> -->
            <span class="psw">Forgot <a href="ServerSideRegister\emailFormReset.php">password?</a></span>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
    </div>
    </form>

</div>
</div>
</div>

<script>
  // $('#loginModal').modal('toggle');
//   $(document).ready(function(){
//     $("#myBtn").click(function(){
//         $("#myModal").modal({show: true});
//     });
// });
    // // Get the modal
    // var modal = document.getElementById('loginModal');
    //
    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }
</script>
