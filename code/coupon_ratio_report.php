<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';
	$today_long = date("l, F j Y");

	$coupon_ratio_query = "select distinct tbl_ProductCoupon.productId,count(tbl_ProductCoupon.couponId) as couponsissued,count(tbl_SaleProduct.couponId) as couponsused from tbl_ProductCoupon left join tbl_SaleProduct on tbl_ProductCoupon.productId=tbl_SaleProduct.productId group by tbl_ProductCoupon.couponId";
	$coupon_ratio_query_result = $dbconn->query("$coupon_ratio_query");

?>
<html>
<head>
<title>Coupon Ratio Report</title>
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
<h3>Coupon Ratio Report For <?php print $today_long; ?></h3>
<?php
    $num_rows = mysqli_num_rows($coupon_ratio_query_result);
    if( $num_rows == 0 ) {
        error_message("No Coupons Issued!");
    } else {
        echo '<table class="table">';
        echo '<tr><th>Product Name</th><th>Coupons Issued</th><th>Coupons Used</th><th>Ratio</th><th>Inventory Remaining</th></tr>';
        while( $row = mysqli_fetch_array($coupon_ratio_query_result) ) {
            $productid = $row['productId'];
            $couponsissued = $row['couponsissued'];
            $couponsused = $row['couponsused'];
			$couponratio = $couponsused / $couponsissued;
			$format = "%3.1f";

			$product_query = "SELECT name,inventoryAmount FROM tbl_Product WHERE productId='$productid'";
			$product_query_result = $dbconn->query("$product_query");
			while( $row = mysqli_fetch_array($product_query_result) ) {
				$productname = $row['name'];
				$inventory = $row['inventoryAmount'];
            	echo '<tr><td>' . $productname . '</td><td>' . $couponsissued . '</td><td>' . $couponsused . '</td><td>';
				printf($format, $couponratio);
				echo '%</td><td>'. $inventory . '</td></tr>';
			}
        }
        //$format = "<tr><th>Totals:</th><td>%3.0f</td><td>$%5.2f</td><td></td></tr>";
        //printf($format,$itemstotal,$salestotal);
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
