<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';
?>
<html>
<head>
<title>Coupon Report</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<br/>
<br/>
<center>
<h2>Mama G's Current Coupons</h2>
<?php
	$coupon_query = "SELECT * FROM tbl_Coupon";
	$coupon_query_result = $dbconn->query("$coupon_query");
   	$num_rows = mysqli_num_rows($coupon_query_result);
	if( $num_rows == 0 ) {
		error_message("No coupons have been created.");
	} else {
		echo '<table border="1" cellpadding="10">';
		echo '<tr><th>Product</th><th>Retail Price</th><th>Coupon Amount</th><th>Start Date</th><th>End Date</th></tr>';
		while( $row = mysqli_fetch_array($coupon_query_result) ) {
			$coupon_id = $row['couponId'];
			$amount = $row['amount'];
			$startdate = $row['startDate'];
			$enddate = $row['endDate'];
			//Now, link the coupon back to the product data
			$coupon_link_query = "SELECT productId FROM tbl_ProductCoupon WHERE couponId='$coupon_id'";
			$coupon_link_query_result = $dbconn->query("$coupon_link_query");
			while( $row = mysqli_fetch_array($coupon_link_query_result) ) {
				$product_id = $row['productId'];
				//Now, fetch the product associated with the coupon - note that you *could have >1
				//coupon for a product!
				$product_query = "SELECT name,price FROM tbl_Product WHERE productId='$product_id'";
				$product_query_result = $dbconn->query("$product_query");
				while( $row = mysqli_fetch_array($product_query_result) ) {
					$pname = $row['name'];
					$pprice = $row['price'];
					echo '<tr><td>' . $pname . '</td><td>' . $pprice . '</td><td>' . $amount . '</td><td>' . $startdate . '</td><td>' . $enddate . '</td></tr>';
				}
			}
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
