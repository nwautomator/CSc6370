<?php
	include 'include/header.php';
	include 'include/validate.php';
	include 'include/dbconnect.php';

	// this is up here so the date text box
	// can show the selected date even after
	// the form was submitted
	if (isset($_POST['salesdate'])) {
		$salesdate = $_POST['sdate'];
	}
?>
<html>
<head>
<title>Sales Report</title>
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <!-- Script for choosing dates -->
    <script src="js/CalendarPopup.js"></script>
    <script language="JavaScript" id="jscal1x">
    <!-- var cal1x = new CalendarPopup("testdiv1"); -->
    var cal1x = new CalendarPopup();
    </script>
</head>
<body>
<div class="container">
<div class="col-md-10 col-md-offset-1 material-animated-card">
<center>
<h3>Sales Summary Report By Date:</h3>
<form method="post">
<table class="table-bordered">
<tr><td>Select a date: </td><td style="white-space: nowrap"><input class="form-control" name="sdate" type="text" id="sdate" size="10" maxlength="10" <?php if(isset($_POST['salesdate']) ) { echo 'value="' . $salesdate .'"'; }?>readonly/></td><td><a href="#" onclick="cal1x.select(document.forms[0].sdate,'anchor_sdate','yyyy-MM-dd'); return false;" name="anchor_sdate" id="anchor_sdate">select</a></td></tr>
</table><br/>
<input class="btn btn-primary" name="salesdate" type="submit" value="Generate Report"/>`
</form>
<?php
	if (isset($_POST['salesdate'])) {
		$itemstotal = 0;
		$salestotal = 0;
		$salesdate = $_POST['sdate'];
	$sales_query = "select ProductSales_v.amount,ProductSales_v.productTotal,ProductSales_v.name,tbl_Product.inventoryAmount from ProductSales_v inner join tbl_Product on ProductSales_v.productId=tbl_Product.productId where ProductSales_v.saleDate = '$salesdate'";
	$sales_query_result = $dbconn->query("$sales_query");
   	$num_rows = mysqli_num_rows($sales_query_result);
	if( $num_rows == 0 ) {
		error_message("No Sales Reported for $salesdate!");
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
