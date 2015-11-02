<?php
	include 'include/header.php';
	include 'include/validate.php';

    //don't allow non-admin users
    //to see this page 
    if( !$role) {
        header("Location: main.php");
    }   
	
	//first, grab the value from the dropdown
	//menu
	if(isset($_POST['selectuser']) ) {
		$selectuser = $_POST['selectuser'];
		$select_fill_query = "SELECT nameFirst,nameLast,logonName,admin FROM tbl_Employee WHERE employeeId='$selectuser'";
		$select_fill_result = $dbconn->query("$select_fill_query");
		while( $row = mysqli_fetch_array($select_fill_result) ) {
			$first = $row['nameFirst'];
			$last = $row['nameLast'];
			$logonName = $row['logonName'];
			$user_role = $row['admin'];
		}
		//can't figure out a better way to pass the selected
		//user to the edit code, so set a cookie! Lame hack.
		setcookie('edituser',$selectuser,time() + 3600);
	}

    // the conditional below validates that the form
    // was really submitted.
    if ( isset($_POST['edituser']) ) {
		$selectuser = $_COOKIE['edituser'];
		//validate form and add to the DB
		//if validation is successful
        if( !validate_name(htmlspecialchars($_POST['firstname'])) ) { 
            error_message("Check entry for first name<br/>");
            $valid_fname = 0;
        } else {
            $firstname = htmlspecialchars($_POST['firstname']);
            $valid_fname = 1;
        }   
        if( !validate_name(htmlspecialchars($_POST['lastname'])) ) { 
            error_message("Check entry for last name<br/>");
            $valid_lname = 0;
        } else {
            $lastname = htmlspecialchars($_POST['lastname']);
            $valid_lname = 1;
        }   
        if( !validate_text(0,htmlspecialchars($_POST['logonName'])) ) { 
            error_message("Check entry for Logon Username<br/>");
            $valid_logonName = 0;
        } else {
            $logonName = htmlspecialchars($_POST['logonName']);
            $valid_logonName = 1;
        }   
		if( !empty($_POST['password']) ) {
			if( $_POST['password'] != $_POST['confirmpassword'] ) {
				error_message("Passwords do not match!");
				$valid_password = 0;
			}
			if( !validate_password(htmlspecialchars($_POST['password'])) ) {
				error_message("Check entry for password");
				$valid_password = 0;
			} else {
				$password = htmlspecialchars($_POST['password']);
				$valid_password = 1;
			}
		} else {
			//set the flag to 1 if not changing the password
			//no need to validate it
			$valid_password=1;
		}
		// no need to validate role. Just update it if needed
		$userrole = $_POST['role'];
			
		// we should be validated at this point
		if($valid_fname && $valid_lname && $valid_logonName && $valid_password) {
			if( !empty($_POST['password']) ) {
				//hash the password
				$password = md5($password); 
				$update_query = "UPDATE tbl_Employee SET nameFirst='$firstname', nameLast='$lastname',logonName='$logonName',password='$password', admin='$userrole' WHERE employeeId='$selectuser'";
			} else {
				$update_query = "UPDATE tbl_Employee SET nameFirst='$firstname', nameLast='$lastname',logonName='$logonName', admin='$userrole' WHERE employeeId='$selectuser'";
			}

			//run the query and report the result.
			if( $dbconn->query("$update_query") ) {
				ok_message("User updated!");
			} else {
				error_message("Something went wrong");
			}
		} else {
			error_message("Form didn't validate. Try again.<br/>");
		}
	}
?>
<html>
<head>
<title>Edit existing Mama G's user</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<center>
<h2>Edit existing Mama G's user</h2></br>
<?php
   //query to fill the select dropdown
   $select_query = "SELECT * FROM tbl_Employee ORDER BY nameLast";
   $select_result = $dbconn->query("$select_query");
?>
<form method="post" name="selectform">
<select name="selectuser" onChange="this.form.submit()">
<option value="00">Select user</option>
<?php 
    while( $row = mysqli_fetch_array($select_result) ) { 
        $userid = $row['employeeId'];
        $fname = $row['nameFirst'];
        $lname = $row['nameLast'];
		if( $_POST['selectuser'] == $userid ) {
	        echo '<option selected value="' . $userid . '">' . $fname . ' ' . $lname . '</option>'; 
		} else {
        	echo '<option value="' . $userid . '">' . $fname . ' ' . $lname . '</option>'; 
		}
    }   
?>
</select><br/><br/>
</form>
<form method="post">
<table>
<tr><td>First name:</td><td><input class="form-control"  name="firstname" type="text" id="firstname" <?php if(isset($_POST['selectuser']) ) { echo 'value="' . $first .'"'; }?>/></td></tr>
<tr><td>Last name:</td><td><input class="form-control"  name="lastname" type="text" id="lastname" <?php if(isset($_POST['selectuser']) ) { echo 'value="' . $last . '"';}?>/></td></tr>
<tr><td>Logon Username:</td><td><input class="form-control"  name="logonName" type="text" id="logonName" <?php if(isset($_POST['selectuser']) ) { echo 'value="' . $logonName . '"';}?>/></td></tr>
<tr><td>Role:</td><td><select name="role">
<?php
	if( isset($_POST['selectuser']) ) {
		if( $user_role === 'Y' ) { // user is admin
			echo '<option selected value="Y">Admin</option>';
			echo '<option value="N">User</option>';
		} else { //user is a grunt
			echo '<option value="N">User</option>';
			echo '<option value="Y">Admin</option>';
		}
	}
?>
</select>
</td></tr>
<tr><td>Password:</td><td><input class="form-control"  name="password" type="password" id="password"/></td></tr>
<tr><td>Confirm password:</td><td><input class="form-control"  name="confirmpassword" type="password" id="confirmpassword"/></td></tr>
</table><br/>
<input class="btn btn-primary" type="submit" name="edituser" value="Edit User">
<input class="btn btn-primary" type="reset" value="Clear Entry"><br/><br/>
</form>
Guidelines:<br/>
* First name must begin with a capital letter and be alphanumeric only<br/>
* Last name must begin with a capital letter and be alphanumeric only<br/>
* Email address can be in the form bob@company.com or bob.smith@company.com<br/>
* Passwords must be at least 8 characters and must contain at least one
uppercase character, one lowercase character, and one number<br/><br/><br/>
</center>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/prettify/prettify.js"></script>

</body>
</html>
