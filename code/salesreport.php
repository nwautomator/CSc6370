<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	$today_short = date("Y-m-d");
?>
<html>
<head>
<title>Sales Report</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<br/>
<br/>
<center>
<h1>Today's Sales Summary Report:</h1>
<?php
	$sales_query = "SELECT cashier_id,customer_id,saleTotal FROM tbl_Sale WHERE saleDate='$today'";
	$sales_query_result = $dbconn->query("$sales_query");
   	$num_rows = mysqli_num_rows($sales_query_result);
	if( $num_rows == 0 ) {
		error_message("No Sales Reported Today!");
	} else {
		echo '<table border="1" cellpadding="10">';
		echo '<tr><th>Product Name</th><th>Customer Name</th><th>Employee Name</th><th>Sale Amount</th></tr>';
		while( $row = mysqli_fetch_array($sales_query_result) ) {
			$cashier_id = $row['cashier_id'];
			$customer_id = $row['customer_id'];
			$sale_total = $row['saleTotal'];

			// do some cross-referencing of tables - these should probably be stored as views in the database
			$product_query = "SELECT name FROM tbl_Product where productId='$res_id' ORDER BY name";
			$product_query_result = $dbconn->query("$resource_query");
			$cashier_query = "SELECT name,description,cost FROM resources where id='$res_id' ORDER BY name";
			$cashier_query_result = $dbconn->query("$resource_query");
			while( $row_r = mysqli_fetch_array($resource_query_result) ) {
				$res_name = $row_r['name'];
				$res_desc = $row_r['description'];
				$res_cost = $row_r['cost'];
				$est_cost_tally = $res_cost * $est_cost;
				$sum = $sum + $est_cost_tally;
				echo '<tr><td>' . $res_name . '</td><td>' . $res_desc . '</td><td>$' . $est_cost_tally . '</td></tr>';
			}
		}
		echo '<tr><td colspan="2"><b>Estimated Total</td><td>$' . $sum . '</b></td></tr>';
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
