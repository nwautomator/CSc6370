<?php
	include 'include/header.php';
	include 'include/validate.php';

	//Get current logged in user
	$current_user = $_COOKIE['login'];
	$user_query = "SELECT nameFirst,nameLast FROM tbl_Employee WHERE logonName='$current_user'";
	$user_query_result = $dbconn->query("$user_query");
	while( $row = mysqli_fetch_array($user_query_result) ) {
		$fname = $row['nameFirst'];
		$lname = $row['nameLast'];
	}

    // the conditional below validates that the form
    // was really submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//make sure the password was typed correctly
		if( $_POST['newpassword'] != $_POST['confirmpassword'] ) {
			error_message("Passwords do not match!");
		} else {
			// check that the old password entered matches
			// what's in the DB
			$passwd_query = "SELECT password FROM tbl_Employee WHERE logonName='$current_user'";
			$passwd_query_result = $dbconn->query("$passwd_query");
			while( $row = mysqli_fetch_array($passwd_query_result) ) {
				$password = $row['password'];
			}
			//hash the old password before checking it against
			//the hashed one in the database
			$oldpassword = $_POST['oldpassword'];
			$oldpassword = md5($oldpassword);
			if( $oldpassword != $password ) {
				error_message("Old password does not match records!");
			} else {
				if( !validate_password(htmlspecialchars($_POST['newpassword'])) ) {
					error_message("Check entry for new password");
				} else {
					$newpassword = htmlspecialchars($_POST['newpassword']);
				}
			
				// we should be validated at this point
				//hash the password
				$newpassword = md5($newpassword); 
				$change_query = "UPDATE tbl_Employee SET password='$newpassword' WHERE logonName='$current_user'";

			//run the query and report the result.
			if( $dbconn->query("$change_query") ) {
				ok_message("Password Changed!");
			} else {
				error_message("Something went wrong");
			}
		}
	}
}
?>
<html>
<head>
<title>Change Password</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<center>
<h2>Change Password for <?php print "$fname $lname"; ?></h2></br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="login">
<table>
<tr><td>Old Password:</td><td><input class="form-control" name="oldpassword" type="password" id="oldpassword"/></td></tr>
<tr><td>New Password:</td><td><input class="form-control" name="newpassword" type="password" id="newpassword"/></td></tr>
<tr><td>Confirm new password:</td><td><input class="form-control" name="confirmpassword" type="password" id="confirmpassword"/></td></tr>
</table><br/></br>
<input class="btn btn-primary" type="submit" value="Change Password">
<input class="btn btn-primary" type="reset" value="Clear Entry"><br/><br/>
Guidelines:<br/>
* Passwords must be at least 8 characters and must contain at least one
uppercase character, one lowercase character, and one number
</center>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/prettify/prettify.js"></script>

</body>
</html>
