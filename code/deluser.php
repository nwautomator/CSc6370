<?php
	include 'include/header.php';
	include 'include/validate.php';

    //don't allow non-admin users
    //to see this page 
    if( !$role) {
        header("Location: main.php");
    }   
	
	//get the current user
	$current_user = $_COOKIE['login'];

	//query to fill the select dropdown - omit
	//the currently logged in user
	$select_query = "SELECT * FROM tbl_Employee WHERE NOT logonName='$current_user' ORDER BY nameLast";
	$select_result = $dbconn->query("$select_query");

    // the conditional below validates that the form
    // was really submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$delete = $_POST['deleteuser'];
		$delete_query = "DELETE FROM tbl_Employee WHERE employeeId=$delete";
		if( $dbconn->query("$delete_query") ) {
			ok_message("User deleted!");
			//refresh the page
			header("Location: deluser.php");
		} else {
			error_message("Something went wrong");
		}
	}
?>
<html>
<head>
<title>Delete a user from Mama G's</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<center>
<h2>Delete a user from Mama G's</h2></br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="deleteuser">
<select name="deleteuser">
<option value="00">Select user</option></br>
<?php 
	while( $row = mysqli_fetch_array($select_result) ) {
		$userid = $row['employeeId'];
		$fname = $row['nameFirst'];
		$lname = $row['nameLast'];
		echo '<option value="' . $userid . '">' . $fname . ' ' . $lname . '</option>'; 
	}
?>
</select><br/><br/>
<input class="btn btn-primary" type="submit" value="Delete User">
</form>
Note:<br/>
Deleting a user is permanant!
</center>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/prettify/prettify.js"></script>
	
</body>
</html>
