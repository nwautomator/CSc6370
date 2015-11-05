<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';
	$today = date('Y-m-d');
?>
<html>
<head>
<title>Coupon Report</title>
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
<h3>Mama G's Available Coupons</h3>
<?php
	$coupon_query = "SELECT * FROM tbl_Coupon";
	$coupon_query_result = $dbconn->query("$coupon_query");
   	$num_rows = mysqli_num_rows($coupon_query_result);
	if( $num_rows == 0 ) {
		error_message("No coupons have been created.");
	} else {
		echo '<table class="table">';
		echo '<tr><th>Product</th><th>Retail Price</th><th>Coupon Amount</th><th>Start Date</th><th>End Date</th><th>Expired?</th></tr>';
		while( $row = mysqli_fetch_array($coupon_query_result) ) {
			$coupon_id = $row['couponId'];
			$amount = $row['amount'];
			$startdate = $row['startDate'];
			$enddate = $row['endDate'];
			$expired = ($enddate < $today) ? "<p style='color: red'>YES</p>": "<p style='color: green'>NO</p>";
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
					echo '<tr><td>' . $pname . '</td><td>$' . $pprice . '</td><td>$' . $amount . '</td><td>' . $startdate . '</td><td>' . $enddate . '</td><td>' . $expired . '</td></tr>';
				}
			}
		}
		echo '</table>';
	}
?>
<p style="color: red">NOTE: Expired coupons will only be accepted on an individual case basis!</p>
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
