<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';
?>
<html>
<head>
<title>User Report</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<br/>
<br/>
<center>
<h2>Mama G's Current Users</h2>
<?php
	$user_query = "SELECT nameFirst,nameLast,hireDate,logonName,admin FROM tbl_Employee";
	$user_query_result = $dbconn->query("$user_query");
   	$num_rows = mysqli_num_rows($user_query_result);
	if( $num_rows == 0 ) {
		error_message("Holy moly, no users in system!!");
	} else {
		echo '<table border="1" cellpadding="10">';
		echo '<tr><th>First Name</th><th>Last Name</th><th>Logon Username</th><th>Hire Date</th><th>Role</th></tr>';
		while( $row = mysqli_fetch_array($user_query_result) ) {
			$fname = $row['nameFirst'];
			$lname = $row['nameLast'];
			$hireDate = $row['hireDate'];
			$logonName = $row['logonName'];
			$role = ($row['admin'] === 'Y') ? "Admin": "User";
			echo '<tr><td>' . $fname . '</td><td>' . $lname . '</td><td>' . $logonName . '</td><td>' . $hireDate . '</td><td>' . $role . '</td></tr>';
		}
		echo '</table>';
	}
?>
</center>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/prettify/prettify.js"></script>
	
</body>

</html>
