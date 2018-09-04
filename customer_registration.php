<html>
    <!--Chris Earle, Robert did bootstrap styling for this page-->
    <!--this is the customer registration page-->
	<head>
		<title>Customer Registration</title>
  	<link rel="stylesheet" href="css/default.css">
		<?php require("bootstrap.php") ?>
		<link rel="stylesheet" href="css/footer.css">
    	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<?php
		//start Robert
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if (isset($_POST['submit'])) { //user logging in
				require("ServerSideRegister/registerSever.php");
				// require $_SERVER["DOCUMENT_ROOT"] . '/WebsiteProject/ServerSideRegister/registerSever.php';
			}
			else{
			}
		}
		// var_dump($_SESSION); //used to check if the session is cleared after logged in
		//end Robert
	?>

	<!--Chris to end of file except for bootstrap styling-->
	<!--img tags are for the validation icon that are not displayed by default see customer_registration.js-->
	<!--all image tags belong to class="checker" for easily reseting the icons on the form-->
	<!--oninput is for validation onkeypress is for auto formating in the input field see customer_registration.js-->
	<!--province and state select options created by loop in customer_registration.js-->
	<body>
		<div class="contents">
		<?php include("include/navbar.php"); ?>

		<div class="container mt-3">
		<form id="customer_data" method="post">
			<div class="row">
				<div class="form_group col-sm-6">
					<label for="first_name">First Name:</label>
					<input class="form-control" id="first_name" type="text" name="first_name" maxlength="25" oninput="fname_oninput()" onfocus="fname_focus()" onblur="fname_blur()"/>
			    <img id="fname_pass"  style="display:none" src="icons/checked.png">
				</div>
				<div class="form-group col-sm-6">
					<label class="field" for="phone">Phone Number:</label>
					<input class="form-control" id="phone" type="text" name="phone" maxlength="13" oninput="phone_oninput()" onkeypress="autophone_format()" onfocus="phone_focus()" onblur="phone_blur()"/>
					<img class="checker" id="phone_pass"  style="display:none" src="icons/checked.png">
					<div id="phone_note" style="display:inline;display:none">123-456-7890 area code included</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label class="field" for="last_name">Last Name:</label>
					<input class="form-control" id="last_name" type="text" name="last_name"  maxlength="25" oninput="lname_oninput()" onfocus="lname_focus()" onblur="lname_blur()"/>
					<img class="checker" id="lname_pass"  style="display:none" src="icons/checked.png">
				</div>
				<div class="form-group col-sm-6">
					<label class="field" for="bus_phone">Business Phone:</label>
					<input class="form-control" id="bus_phone" type="text" name="bus_phone"  maxlength="13" oninput="bus_phone_oninput()" onkeypress="busphone_format()" onfocus="bus_phone_focus()" onblur="bus_phone_blur()"/>
					<img class="checker" id="bus_phone_pass"  style="display:none" src="icons/checked.png">
					<div id="bus_phone_note" style="display:inline;display:none">if the same as your home phone, enter home phone</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<!--country select, changes province/state and postalcode/zip see customer_registration.js-->
					<!--only for US and Canada-->
					<label class="field" for="country">Country:</label>
					<select id="country" class="form-control" name="country" onchange="country_onchange()">
						<option value=""></option>
						<option value="Canada">Canada</option>
						<option value="United States">United States</option>
					</select>
					<img class="checker" id="country_pass"  style="display:none" src="icons/checked.png">
				</div>
				<div class="form-group col-sm-6">
					<label class="field" for="email">Email:</label>
					<input class="form-control" id="email" type="text" name="email" maxlength="50" oninput="email_oninput()" onfocus="email_focus()" onblur="email_blur()"/>
					<img class="checker" id="email_pass"  style="display:none" src="icons/checked.png">
					<div id="email_note" style="display:inline;display:none">123-456-7890 area code included</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6" id="state_toggle" style="display:none">
					<label class="field" for="state">State:</label>
					<select id="state" class="form-control" name="state" onchange="state_onchange()">
						<option></option>
					</select>
					<img class="checker" id="state_pass"  style="display:none" src="icons/checked.png">
				</div>
				<div class="form-group col-sm-6" id="province_toggle" style="display:none">
					<label class="field" for="province">Province:</label>
					<select id="province" class="form-control" name="province" onchange="province_onchange()">
						<option></option>
					</select>
					<img class="checker" id="province_pass"  style="display:none" src="icons/checked.png">
				</div>
				<div class="form-group col-sm-6">
					<label class="field" for="conf_email">Confirm Email:</label>
					<input class="form-control" id="conf_email" type="text" maxlength="50" name="conf_email" oninput="conf_email_oninput()" onfocus="conf_email_focus()" onblur="conf_email_blur()"/>
					<img class="checker" id="conf_email_pass"  style="display:none" src="icons/checked.png">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label class="field" for="city">City:</label>
					<input class="form-control "id="city" type="text" name="city" maxlength="50" oninput="city_oninput()" onfocus="city_focus()" onblur="city_blur()"/>
					<img class="checker" id="city_pass"  style="display:none" src="icons/checked.png">
				</div>
				<div class="form-group col-sm-6">
					<label class="field" for="username">Username:</label>
					<input class="form-control" id="username" type="text" name="username" maxlength="20" oninput="username_oninput()" onkeyup="username_unique(this)" onfocus="username_focus()" onblur="username_blur()"/>
					<img class="checker" id="username_pass"  style="display:none" src="icons/checked.png">
					<div id="username_note" style="display:inline;display:none">please enter a username at least five characters long</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6" id="pcode_toggle">
					<label class="field" for="postal_code">Postal Code:</label>
					<input class="form-control" id="postal_code" type="text" name="postal_code" maxlength="7" oninput="pcode_oninput()" onkeypress="pcode_format()" onfocus="pcode_focus()" onblur="pcode_blur()"/>
					<img class="checker" id="pcode_pass"  style="display:none" src="icons/checked.png">
					<div id="pcode_note" style="display:inline;display:none">A1B 2C3</div>
				</div>
				<div class="form-group col-sm-6" id="zip_toggle" style="display:none">
					<label class="field" for="zip_code">Zip Code:</label>
					<input class="form-control" id="zip_code" type="text" name="zip_code" maxlength="5" oninput="zip_code_oninput()" onfocus="zip_code_focus()" onblur="zip_code_blur()"/>
					<img class="checker" id="zip_code_pass"  style="display:none" src="icons/checked.png">
					<div id="zip_code_note" style="display:inline;display:none">12345</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="field" for="password">Password:</label>
					<input class="form-control" id="password" type="password" name="password"  maxlength="20" oninput="password_oninput()" onfocus="password_focus()" onblur="password_blur()"/>
					<img class="checker" id="password_pass"  style="display:none" src="icons/checked.png">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label class="field" for="address">Address:</label>
					<input class="form-control" id="address" type="text" name="address" maxlength="75" oninput="address_oninput()" onfocus="address_focus()" onblur="address_blur()"/>
					<img class="checker" id="address_pass"  style="display:none" src="icons/checked.png">
				</div>
				<div class="form-group col-sm-6">
					<label class="field" for="conf_password">Confirm Password:</label>
					<input class="form-control" id="conf_password" type="password" name="conf_password"  maxlength="20" oninput="conf_password_oninput()" onfocus="conf_password_focus()" onblur="conf_password_blur()"/>
					<img class="checker" id="conf_password_pass"  style="display:none" src="icons/checked.png">
				</div>
			</div>
				<div id="password_checklist" style="display:none">
					<div class="formline">
						<b>at least eight characters long</b>
						<img class="checker" id="eightchar_pass"  style="display:none" src="icons/checked.png">
					</div>
					<div class="formline">
						<b>at least one lowercase letter</b>
						<img class="checker" id="lower_pass"  style="display:none" src="icons/checked.png">
					</div>
					<div class="formline">
						<b>at least one uppercase letter</b>
						<img class="checker" id="upper_pass"  style="display:none" src="icons/checked.png">
					</div>
					<div class="formline">
						<b>at least one number</b>
						<img class="checker" id="num_pass"  style="display:none" src="icons/checked.png">
					</div>
					<div class="formline">
						<b>at least one special character !@#$%^*_&</b>
						<img class="checker" id="special_pass"  style="display:none" src="icons/checked.png">
					</div>
				</div>
			<br/>
			<br/>
				<button class="btn btn-primary btn-lg" id="submit" name="submit" value="submit">Submit</button>
				<button class="btn btn-primary btn-lg" id="clear" name="reset" value="reset">Reset</button>
				<div>
					<?php
						//need to check that it is set because it's always being set
						if(isset($_SESSION['message'])){
							echo $_SESSION['message'];
							?>
								<script type="text/javascript">
									//load at the bottom of the page if a message needs to be displayed
									document.body.scrollTop = document.body.scrollHeight;
								</script>
							<?php
						}else{
						}unset($_SESSION['message']); //so the session variable will not reappear when reloading page
					?>
				</div>
		</form>
	</div>
	</div>
		<?php include "include/footer.php" ?>
		<!--also put in a modal creator script here.  nevermind done with bootstrap-->
		<!--this script handles user side validation, generating select options, submit and reset functionality and autoformatting input fields-->
		<script type="text/javascript" src="js/customer_registration.js"></script>
	</body>
	<!--end Chris-->
</html>
