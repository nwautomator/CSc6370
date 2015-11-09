<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	//display last 10 sales
	$latest_sales_query = "select CustomerSales_v.nameLast, CustomerSales_v.nameFirst, tbl_Product.name,CustomerSales_v.saleDate from CustomerSales_v inner join tbl_SaleProduct on CustomerSales_v.saleId = tbl_SaleProduct.saleId inner join tbl_Product on tbl_SaleProduct.productId = tbl_Product.productId order by CustomerSales_v.saleDate desc limit 10";
	$latest_sales_query_result = $dbconn->query("$latest_sales_query");
?>
<html>
<head>
<title>Mama G's Main Page</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="col-md-10 col-md-offset-1 material-animated-card">
<center>
<h3>Last 10 Sales Summary:</h3>
<table class="table">
<tr><th>Customer</th><th>Product Name</th><th>Purchase Date</th><th>Coupon Used?</th></tr>
<?php
	// test for an empty table  
   $num_rows = mysqli_num_rows($latest_sales_query_result);
	if($num_rows == 0) {
		error_message("No Sales Found!");
	} else {
		while( $row = mysqli_fetch_array($latest_sales_query_result) ) {
			$lname = $row['nameLast'];
			$fname = $row['nameFirst'];
            $productname = $row['name'];
            $saledate = $row['saleDate'];
			$couponused = ($row['couponId'] >= 1) ? "Yes": "No"; //just make it a boolean

			echo '<tr><td>' . $fname . ' ' . $lname . '</td><td>' . $productname . '</td><td>' . $saledate . '</td><td>' . $couponused . '</td></tr>';
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
