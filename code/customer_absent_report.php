<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	$today_long = date("l, F j Y");
	$today_short = date("Y-m-d");

	$absent_query = "SELECT CustomerLastVisit_v.nameFirst,CustomerLastVisit_v.nameLast,CustomerLastVisit_v.lastseen, tbl_Customer.phoneNumber,tbl_Customer.email FROM CustomerLastVisit_v INNER JOIN tbl_Customer ON CustomerLastVisit_v.customerId=tbl_Customer.customerId ORDER BY CustomerLastVisit_v.lastseen ASC";
	$absent_query_result = $dbconn->query("$absent_query");

?>
<html>
<head>
<title>Customer Absent Report</title>
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="col-md-10 col-md-offset-1 material-animated-card">
<center>
<h3>Customer Absent Report For <?php echo $today_long; ?></h3>
<?php
	$num_rows = mysqli_num_rows($absent_query_result);
	if( $num_rows == 0 ) {
		error_message("No absent customers. Hooray!");
	} else {
		echo '<table class="table">';
		echo '<tr><th>Customer Name</th><th>Phone Number</th><th>Email Address</th><th>Last Seen</th><th>Days Ago</th></tr>';
		while( $row = mysqli_fetch_array($absent_query_result) ) {
			$fname = $row['nameFirst'];
			$lname = $row['nameLast'];
			$phone = $row['phoneNumber'];
			$email = $row['email'];
			$lastseen = $row['lastseen'];
			$datelast = date_create("$lastseen");
			$datenow = date_create("$today_short");
			$days = date_diff($datenow,$datelast);
			echo '<tr><td>' . $fname . ' ' . $lname . '</th><th>' . $phone . "</th><th><a href='mailto:$email'>" . $email .'</a></th><th>'. $lastseen . '</th><th>' . $days->format('%a') . '</th></tr>';
		}
		echo '</table>';
	}
?>
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
