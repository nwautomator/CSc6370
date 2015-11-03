<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	//display last 10 sales
	$pj_display_query = "SELECT id,name,starttime,endtime FROM project ORDER BY starttime";
	$pj_display_query_result = $dbconn->query("$pj_display_query");
?>
<html>
<head>
<title>Mama G's Main Page</title>
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
<h4>Last 10 Sales Summary:</h4>
<table class="table">
<tr><th>Customer</th><th>Product Name</th><th>Purchase Date</th></tr>
<?php
	// test for an empty table  
   $num_rows = mysqli_num_rows($pj_display_query_result);
	if($num_rows == 0) {
		error_message("No Sales Found!");
	} else {
		while( $row = mysqli_fetch_array($pj_display_query_result) ) {
			$pj_id = $row['id'];
			$pj_name = $row['name'];
            $pj_sdate = $row['starttime'];
            $pj_edate = $row['endtime'];

			//Convert dates to friendly format
			$new_sdate = new DateTime($pj_sdate);
        	$pj_sdate = $new_sdate->format('m/d/Y');
        	$new_edate = new DateTime($pj_edate);
        	$pj_edate = $new_edate->format('m/d/Y');

			echo '<tr><td><a href="projectdetail.php?id=' . $pj_id . '">' . $pj_name . '</td><td>' . $pj_sdate . '</td><td>' . $pj_edate . '</td></tr>';
		}
	}
?>
</table>
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
