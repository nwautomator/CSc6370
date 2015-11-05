<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	$today_long = date("l, F j Y");
	$today_short = date("Y-m-d");
?>
<html>
<head>
<title>Sales Report</title>
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
<h3>Sales Summary Report for <?php print $today_long; ?>:</h3>
<?php
	$sales_query = "select ProductSales_v.amount,ProductSales_v.productTotal,ProductSales_v.name,tbl_Product.inventoryAmount from ProductSales_v inner join tbl_Product on ProductSales_v.productId=tbl_Product.productId where DATE(ProductSales_v.saleDate) = DATE($today_short)";
	$sales_query_result = $dbconn->query("$sales_query");
   	$num_rows = mysqli_num_rows($sales_query_result);
	if( $num_rows == 0 ) {
		error_message("No Sales Reported Today!");
	} else {
		echo '<table class="table">';
		echo '<tr><th>Product Name</th><th>Amount Sold</th><th>Sale Total</th><th>Inventory Remaining</th></tr>';
		while( $row = mysqli_fetch_array($sales_query_result) ) {
			$pname = $row['name'];
			$amount_sold = $row['amount'];
			$itemstotal = $itemstotal + $amount_sold;
			$sale_total = $row['productTotal'];
			$salestotal = $salestotal + $sale_total;
			$inventory = $row['inventoryAmount'];

			echo '<tr><td>' . $pname . '</td><td>' . $amount_sold . '</td><td>$' . $sale_total . '</td><td>' . $inventory . '</td></tr>';
		}
		$format = "<tr><th>Totals:</th><td>%3.0f</td><td>$%5.2f</td><td></td></tr>";
		printf($format,$itemstotal,$salestotal);
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
