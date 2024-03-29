<?php
	include 'include/header.php';
	include 'include/validate.php';

   //query to fill the select dropdown
   $select_coupon_query = "SELECT couponId, amount, startDate, endDate FROM tbl_Coupon where active = 'Y'";
   $select_coupon_result = $dbconn->query("$select_coupon_query");

    // the conditional below validates that the form
    // was really submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$delete = $_POST['deletecoupon'];
		$delete_query = "UPDATE tbl_Coupon SET active = 'N' where couponId=$delete";
		if( $dbconn->query("$delete_query") ) {
			ok_message("Coupon deleted!");
		} else {
			error_message("Something went wrong 1");
		}
	}
?>
<html>
<head>
<title>Delete A Mama G's Coupon</title>
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
<h3>Delete A Mama G's Coupon</h3></br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="deletecoupon">
<select name="deletecoupon">
<option value="00">Select Coupon</option></br>
<?php 
   while( $row = mysqli_fetch_array($select_coupon_result) ) {
       $couponid = $row['couponId'];
       $amount = $row['amount'];
       $startdate = $row['startDate'];
       $enddate = $row['endDate'];
       $select_link_query = "SELECT productId FROM tbl_ProductCoupon WHERE couponId='$couponid'";
       $select_link_result = $dbconn->query("$select_link_query");
       while( $row = mysqli_fetch_array($select_link_result) ) {
           $productid = $row['productId'];
            $select_product_query = "SELECT name FROM tbl_Product WHERE productId='$productid'";
            $select_product_result = $dbconn->query("$select_product_query");
            while( $row = mysqli_fetch_array($select_product_result) ) {
                $pname = $row['name'];
                echo '<option value="' . $couponid . '">' . $pname . ' - $' . $amount . ' off</option>';
            }
       }
    }
?>
</select><br/><br/>
<input class="btn btn-primary" type="submit" value="Delete Coupon">
</form>
<br/>
<p style="color: red">Note: Deleting a coupon is permanent!</p>
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
