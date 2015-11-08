<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	$today_long = date("l, F j Y");

	$frequent_buyer_query = "select tbl_Customer.nameFirst,tbl_Customer.nameLast, ProductSales_v.customerId,count(ProductSales_v.customerId) as purchasecount,ProductSales_v.saleDate from tbl_Customer inner join ProductSales_v on tbl_Customer.customerId=ProductSales_v.customerId group by ProductSales_v.customerId order by count(ProductSales_v.customerId) desc,ProductSales_v.saleDate desc";
	$frequent_buyer_query_result = $dbconn->query("$frequent_buyer_query");
?>
<html>
<head>
<title>Frequent Buyer Report</title>
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
<h3>Frequent Buyer Report For <?php print $today_long;?></h3>
<?php
    $num_rows = mysqli_num_rows($frequent_buyer_query_result);
	if( $num_rows == 0 ) {
        error_message("Uh-oh, no frequent buyers!");
    } else {
		echo '<table class="table">';
        echo '<tr><th>Customer Name</th><th>Number of Purchases</th><th>Last Purchase Date</th></tr>';
        while( $row = mysqli_fetch_array($frequent_buyer_query_result) ) {
            $fname = $row['nameFirst'];
            $lname = $row['nameLast'];
            $purchasecount = $row['purchasecount'];
            $lastpurchase = $row['saleDate'];
			echo '<tr><td>' . $fname . ' ' . $lname . '</td><td>' . $purchasecount . '</td><td>' . $lastpurchase . '</td></tr>';
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
