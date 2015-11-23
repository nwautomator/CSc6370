<?php
	include 'include/header.php';
	include 'include/validate.php';
   
	//don't allow non-admin users
	//to see this page 
	if( !$role) {
        header("Location: main.php");
    }   

    // the conditional below validates that the form
    // was really submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//validate form and add to the DB
		//if validation is successful
		//make sure the password was typed correctly
		if( $_POST['password'] != $_POST['confirmpassword'] ) {
			error_message("Passwords do not match!");
		} else {
			if( !validate_name(htmlspecialchars($_POST['firstname'])) ) {
				error_message("Check entry for first name");
				$valid_fname = 0;
			} else {
				$firstname = htmlspecialchars($_POST['firstname']);
				$valid_fname = 1;
			}
			if( !validate_name(htmlspecialchars($_POST['lastname'])) ) {
				error_message("Check entry for last name");
				$valid_lname = 0;
			} else {
				$lastname = htmlspecialchars($_POST['lastname']);
				$valid_lname = 1;
			}
			if( !validate_text(1,htmlspecialchars($_POST['logonname'])) ) {
				error_message("Check entry for logon username");
				$valid_logon = 0;
			} else {
				$username = htmlspecialchars($_POST['logonname']);
				$valid_logon = 1;
			}
			if( !validate_password(htmlspecialchars($_POST['password'])) ) {
				error_message("Check entry for password");
				$valid_password = 0;
			} else {
				$password = htmlspecialchars($_POST['password']);
				$valid_password = 1;
			}
			if( !validate_date(htmlspecialchars($_POST['hiredate'])) ) {
				error_message("Check entry for hire date");
				$valid_hiredate = 0;
			} else {
				$hiredate = htmlspecialchars($_POST['hiredate']);
				$valid_hiredate = 1;
			}
			// we should be validated at this point
			if($valid_fname && $valid_lname && $valid_logon && $valid_password && $valid_hiredate) {
				//hash the password
				$password = md5($password); 
				$admin = $_POST['role'];
				$add_query = "call employeeAdd('$username', '$password', '$firstname', '$lastname', '$admin', '$hiredate')";

				//run the query and report the result.
				if( $dbconn->query("$add_query") ) {
					ok_message("User added!");
				} else {
					error_message("Something went wrong");
				}
			} else {
				error_message("Form didn't validate. Try again.");
			}
		}
	}
?>
<html>
<head>
<title>Add a new Mama G's user</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/starter-template.css" rel="stylesheet">
    <!-- Script for choosing dates -->
    <script src="js/CalendarPopup.js"></script>
    <script language="JavaScript" id="jscal1x">
    <!-- var cal1x = new CalendarPopup("testdiv1"); -->
    var cal1x = new CalendarPopup();
    </script>
</head>
<body>
<div class="container">
<div class="col-md-10 col-md-offset-1 material-animated-card">
<?php printmessages(); ?>
<center>
<h3>Add a new Mama G's user</h3></br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="login">
<table class="table-condensed">
<tr><td>First name:</td><td><input class="form-control" name="firstname" type="text" id="firstname"/></td></tr>
<tr><td>Last name:</td><td><input class="form-control" name="lastname" type="text" id="lastname"/></td></tr>
<tr><td>Logon Username:</td><td><input class="form-control" name="logonname" type="text" id="logonname"/></td></tr>
<tr><td>Role:</td><td><select name="role"><option value="N">User</option><option value="Y">Admin</option></select></td></tr>
<tr><td>Password:</td><td><input class="form-control" name="password" type="password" id="password"/></td></tr>
<tr><td>Confirm password:</td><td><input class="form-control" name="confirmpassword" type="password" id="confirmpassword"/></td></tr>
<tr><td>Hire Date:</td><td><input class="form-control" name="hiredate" type="text" id="hiredate" size="9" maxlength="10" readonly/></td><td><a href="#" onclick="cal1x.select(document.forms[0].hiredate,'anchor_hiredate','yyyy-MM-dd'); return false;" name="anchor_hiredate" id="anchor_hiredate">select</a></td></tr>
</table><br/></br>
<input class="btn btn-primary" type="submit" value="Add User">
<input class="btn btn-primary" type="reset" value="Clear Entry"><br/><br/>
<p style="font-weight: bold; text-align: left">
Guidelines:<br/>
* First name must begin with a capital letter and be alphanumeric only<br/>
* Last name must begin with a capital letter and be alphanumeric only<br/>
* Logon username should be the first letter of the first name and last name (e.g. bsmith for user Bob Smith)<br/>
* Passwords must be at least 8 characters and must contain at least one
uppercase character, one lowercase character, and one number
</p>
</center>
</div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/prettify/prettify.js"></script>

</body>
</html>
