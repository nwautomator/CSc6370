<?php
	include 'include/header.php';
	include 'include/validate.php';

	//query to fill in the product dropdown
	$product_query = "SELECT productId,name,price from tbl_Product WHERE inventoryAmount > 0";
	$product_query_result = $dbconn->query("$product_query");

    if (isset($_POST['selectproduct'])) {
		$selectproduct = $_POST['selectproduct'];
        //can't figure out a better way to pass the selected
        //product to the coupon form, so set a cookie! Lame hack.
        setcookie('selectproduct',$selectproduct,time() + 3600);
	}
    // the conditional below validates that the form
    // was really submitted.
    if (isset($_POST['addcoupon'])) {
		$selectproduct = $_COOKIE['selectproduct'];

		//get values from the form
                $name = $_POST['name'];
		$amount = $_POST['amount'];
		$sdate = $_POST['sdate'];
		$edate = $_POST['edate'];
		//validation
		if( !validate_discount($amount) ) {
			error_message("Can't create zero value coupon!");
			$valid_discount = 0;
        } else {
            $valid_discount = 1;
        }   

        if( !validate_text($name) ) { 
            error_message("Name can't be blank!");
            $valid_name = 0;
        } else {
            $valid_name = 1;
        } 
  
        if( !validate_cost($amount) ) { 
            error_message("Amount can't be blank!");
            $valid_amount = 0;
        } else {
            $valid_amount = 1;
        }   

        if( !validate_date($sdate) ) { 
            error_message("Start date can't be blank!");
            $valid_sdate = 0;
        } else {
            $valid_sdate = 1;
        }   

        if( !validate_date($edate) ) { 
            error_message("End date can't be blank!");
            $valid_edate = 0;
        } else {
            $valid_edate = 1;
        }   

		if( $valid_name && $valid_discount && $valid_amount && $valid_sdate && $valid_edate ) {
			//add it!
			$addcoupon_query = "call couponAdd( '$name', '$amount', '$sdate', '$edate' )";
			if( $dbconn->query("$addcoupon_query") ) {
				//Now, link the coupon the the product in the tbl_ProductCoupon table
				$addcoupon_id_query = "SELECT MAX(couponId) as lastcoupon from tbl_Coupon";
				$addcoupon_id_query_result = $dbconn->query("$addcoupon_id_query");
				while( $row = mysqli_fetch_array($addcoupon_id_query_result) ) {
					$coupon_id = $row['lastcoupon'];
				}
				$link_coupon_query = "call productCouponAdd( '$coupon_id', '$selectproduct' )";
				if( $dbconn->query("$link_coupon_query") ) {
					ok_message("New Coupon Added!");
				} else {
					error_message("Something went wrong, yo");
				}
			} else {
				error_message("Something went wrong, homie");
			}
		} else {
			error_message("Form failed validation. Try again.");
		}
	}
?>
<html>
<head>
<title>Add a new Coupon</title>
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
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
<h3>Add a new Coupon</h3>

<form method="post" name="selectproduct">
<select name="selectproduct" onChange="this.form.submit()">
<option value="00">Select Product</option></br>
<?php 
    while( $row = mysqli_fetch_array($product_query_result) ) { 
        $productid = $row['productId'];
        $productname = $row['name'];
		$productprice = $row['price'];
		if( $_POST['selectproduct'] === $productid ) {
        	echo '<option selected value="' . $productid . '">' . $productname . ' - ($' . $productprice. ')' . '</option>'; 
		} else {
        	echo '<option value="' . $productid . '">' . $productname . ' - ($' . $productprice. ')' . '</option>'; 
		}
    }   
?>
</select><br/><br/>
</form>
<form method="post">
<table class="table-condensed">
<tr><th>Name:</th><td><input class="form-control" name="name" type="text" id="name" size="15" maxlength="30"/></td></tr>
<tr><th>Amount:</th><td><input class="form-control" name="amount" type="text" id="amount" size="8" maxlength="10"/></td></tr>
<tr><th>Start Date:</th><td><input class="form-control" name="sdate" type="text" readonly id="sdate" size="9" maxlength="10"/></td><td><a href="#" onclick="cal1x.select(document.forms[1].sdate,'anchor_sdate','yyyy-MM-dd'); return false;" name="anchor_sdate" id="anchor_sdate">select</a></td></tr>
<tr><th>End Date:</th><td><input class="form-control" name="edate" type="text" readonly id="edate" size="9" maxlength="10"/></td><td><a href="#" onclick="cal1x.select(document.forms[1].edate,'anchor_edate','yyyy-MM-dd'); return false;" name="anchor_edate" id="anchor_edate">select</a></td></tr>
</table><br/>
<input class="btn btn-primary" type="submit" name="addcoupon" value="Add Coupon">
<input class="btn btn-primary" type="reset" value="Clear Entry"><br/><br/>
</form>
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
