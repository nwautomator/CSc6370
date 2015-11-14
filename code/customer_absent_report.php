<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	$today_long = date("l, F j Y");
	$today_short = date("Y-m-d");

    if( isset($_POST['absentrange']) ) {
        $absentrange = $_POST['absentrange'];
	    $absent_query = "SELECT nameFirst, nameLast, lastseen, phoneNumber, email FROM CustomerLastVisit_v WHERE lastseen <= curdate() - interval $absentrange day ORDER BY lastseen ASC";
	    $absent_query_result = $dbconn->query("$absent_query");
    } else {
        $absentrange = 90;
	    $absent_query = "SELECT nameFirst, nameLast, lastseen, phoneNumber, email FROM CustomerLastVisit_v WHERE lastseen <= curdate() - interval 90 day ORDER BY lastseen ASC";
	    $absent_query_result = $dbconn->query("$absent_query");
    }

?>
<html>
<head>
<title>Customer Absent Report</title>
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="col-md-10 col-md-offset-1 material-animated-card">
<?php printmessages(); ?>
<center>
<h3>Customer Absent Report For <?php echo $today_long; ?></h3>
<form method="post" name="absentrange">
<select name="absentrange" onChange="this.form.submit()">
<option value="00">Select Range</option></br>
<option value="7">7 days</option></br>
<option value="14">14 days</option></br>
<option value="30">30 days</option></br>
<option value="45">45 days</option></br>
<option value="60">60 days</option></br>
<option value="90">90 days</option></br>
</select><br/><br/>
</form>
<h4>Customers last seen more than <?php echo $absentrange; ?> day(s) ago</h4>
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
