<?php
	include 'include/header.php';
	include 'include/validate.php';

	//first, grab the value from the dropdown
	//menu
	if(isset($_POST['selectcoupon']) ) {
		$selectcoupon = $_POST['selectcoupon'];
		$select_coupon_query = "SELECT * FROM tbl_Coupon where couponId='$selectcoupon'";
		$select_coupon_result = $dbconn->query("$select_coupon_query");
		while( $row = mysqli_fetch_array($select_coupon_result) ) {
			$couponamount = $row['amount'];
			$sdate = $row['startDate'];
			$edate = $row['endDate'];
		}

		//can't figure out a better way to pass the selected
		//coupon to the edit code, so set a cookie! Lame hack.
		setcookie('editcoupon',$selectcoupon,time() + 3600);
	}

    // the conditional below validates that the form
    // was really submitted.
    if ( isset($_POST['editcoupon']) ) {
		$selectcoupon = $_COOKIE['editcoupon'];
        //get values from the form
        $amount = $_POST['amount'];
        $startdate = $_POST['sdate'];
        $enddate = $_POST['edate'];
		//validate form and add to the DB
		//if validation is successful

       	if( !validate_discount($amount) ) {
            error_message("Can't create zero value coupon!");
            $valid_discount = 0;
        } else {
            $valid_discount = 1;
		}

        if( !validate_cost($amount) ) { 
            error_message("Check entry for amount<br/>");
            $valid_amount = 0;
        } else {
            $valid_amount = 1;
        }   
			
        if( !validate_date($startdate) ) { 
            error_message("Check entry for start date<br/>");
            $valid_startdate = 0;
        } else {
            $valid_startdate = 1;
        }   
        
        if( !validate_date($enddate) ) { 
            error_message("Check entry for end date<br/>");
            $valid_enddate = 0;
        } else {
            $valid_enddate = 1;
        }   

		// we should be validated at this point
		if($valid_discount && $valid_amount && $valid_startdate && $valid_enddate) {
			$update_query = "UPDATE tbl_Coupon SET amount='$amount', startDate='$startdate',endDate='$enddate' WHERE couponId='$selectcoupon'";

			//run the query and report the result.
			if( $dbconn->query("$update_query") ) {
				ok_message("Coupon updated!");
			} else {
				error_message("Something went wrong");
			}
		} else {
			error_message("Form didn't validate. Try again.<br/>");
		}
	}
?>
<html>
<head>
<title>Edit Existing Mama G's Coupon</title>
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
<h3>Edit Existing Mama G's Coupon</h3></br>
<?php
   //query to fill the select dropdown
   $select_coupon_query = "SELECT * FROM tbl_Coupon";
   $select_coupon_result = $dbconn->query("$select_coupon_query");
?>
<form method="post" name="selectcoupon">
<select name="selectcoupon" onChange="this.form.submit()">
<option value="00">Select Coupon</option>
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
				if( $_POST['selectcoupon'] === $productid ) {
    	    		echo '<option selected value="' . $couponid . '">' . $pname . ' - $' . $amount . ' off</option>'; 
				} else {
    	    		echo '<option value="' . $couponid . '">' . $pname . ' - $' . $amount . ' off</option>'; 
				}
			}
	   }
    }   
?>
</select><br/><br/>
</form>
<form method="post">
<table class="table-condensed">
<tr><th>Amount:</th><td><input class="form-control" name="amount" type="text" id="amount" size="8" maxlength="10" <?php if(isset($_POST['selectcoupon']) ) { echo 'value="' . $couponamount .'"'; }?>/></td></tr>
<tr><th>Start Date:</th><td><input class="form-control" name="sdate" type="text" readonly id="sdate" size="9" maxlength="10" <?php if(isset($_POST['selectcoupon']) ) { echo 'value="' . $sdate .'"'; }?>/></td><td><a href="#" onclick="cal1x.select(document.forms[1].sdate,'anchor_sdate','yyyy-MM-dd'); return false;" name="anchor_sdate" id="anchor_sdate">select</a></td></tr>
<tr><th>End Date:</th><td><input class="form-control" name="edate" type="text" readonly id="edate" size="9" maxlength="10" <?php if(isset($_POST['selectcoupon']) ) { echo 'value="' . $edate .'"'; }?>/></td><td><a href="#" onclick="cal1x.select(document.forms[1].edate,'anchor_edate','yyyy-MM-dd'); return false;" name="anchor_edate" id="anchor_edate">select</a></td></tr>
</table><br/>
<input class="btn btn-primary" type="submit" name="editcoupon" value="Edit Coupon">
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
