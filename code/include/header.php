<?php
	//place stuff in here that should be
	//common to all pages.

    // is the user logged in?
    if( !isset($_COOKIE['login']) ) {
        header("Location: index.php");
    }
	
	//get the current user
	$current_user = $_COOKIE['login'];
	// if the user is an admin, display
	// the full menu
	include 'dbconnect.php';
	$admin_query = "SELECT admin FROM tbl_Employee WHERE logonName='$current_user'";
	$admin_query_result = $dbconn->query("$admin_query");
	while( $row = mysqli_fetch_array($admin_query_result) ) {
		$role = $row['admin'];
	}

//Function to change menu button clicked to active
function activeClass($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}


	
?>
<html>
<head>
 <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-dropdown.js"></script>
	<script src="js/jquery-1.7.1.min.js"></script>

</head>
<body>



		
<?php
	if($role === 'Y')
	{ 
?>
		
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
						<a class="navbar-brand">Mama G's Admin:</a>
					</div>
					<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li <?php activeClass('main') ?>><a href="main.php">Main Page</a></li>
						<li class="dropdown">
								<a href="salesreport.php">Sales Summary Report</a></li>
						<li class="dropdown">
								<a href=# data-toggle="dropdown" class="dropdown-toggle">Coupon Management
								<b class="caret"></b></a> 
							
							<ul class="dropdown-menu" role="menu">
								<li><a href="addcoupon.php">Add Coupon</a></li>
								<li><a href="editcoupon.php">Edit Coupon</a></li>
								<li><a href="delcoupon.php">Delete Coupon</a></li>
								<li><a href="viewcoupon.php">View Available Coupons</a></li>
							</ul>
						</li>
						<li class="dropdown">
								<a href=# data-toggle="dropdown" class="dropdown-toggle">Reports
								<b class="caret"></b></a> 
							
							<ul class="dropdown-menu" role="menu">
								<li><a href="generate_sales_report.php">Generate Sales Report</a></li>
								<li><a href="customer_absent_report.php">Customer Absent Report</a></li>
								<li><a href="frequent_buyer_report.php">Frequent Buyer Report</a></li>
								<li><a href="coupon_ratio_report.php">Coupon Ratio Report</a></li>
							</ul>
						</li>
                        <li class="dropdown">
                                <a href=# data-toggle="dropdown" class="dropdown-toggle">Users
                                <b class="caret"></b></a> 
    
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="adduser.php">Add Users</a></li>
                                <li><a href="edituser.php">Edit Users</a></li>
                                <li><a href="deluser.php">Delete Users</a></li>
                                <li><a href="viewuser.php">View Users</a></li>
                            </ul>
                        </li>
						<li <?php activeClass('password') ?>><a href="password.php" >Change Password</a></li>
						<li <?php activeClass('logout') ?>><a href="logout.php" >Logout</a></li>
					</ul>
					</div>
				</div>
			</div>
			
	<?php
	}
	 else{
	
	?>
		
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
						<a class="navbar-brand">Mama G's User:</a>
					</div>
					<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li <?php activeClass('main') ?>><a href="main.php">Main Page</a></li>
						<li class="dropdown">
								<a href="salesreport.php">Sales Summary Report</a></li>
						<li class="dropdown">
								<a href=# data-toggle="dropdown" class="dropdown-toggle">Coupon Management
								<b class="caret"></b></a> 
							
							<ul class="dropdown-menu" role="menu">
								<li><a href="addcoupon.php">Add Coupon</a></li>
								<li><a href="editcoupon.php">Edit Coupon</a></li>
								<li><a href="delcoupon.php">Delete Coupon</a></li>
								<li><a href="delcoupon.php">View Available Coupons</a></li>
							</ul>
						</li>
						<li class="dropdown">
								<a href=# data-toggle="dropdown" class="dropdown-toggle">Reports
								<b class="caret"></b></a> 
							
							<ul class="dropdown-menu" role="menu">
								<li><a href="generate_sales_report.php">Generate Sales Report</a></li>
								<li><a href="customer_absent_report.php">Customer Absent Report</a></li>
								<li><a href="frequent_buyer_report.php">Frequent Buyer Report</a></li>
								<li><a href="coupon_ratio_report.php">Coupon Ratio Report</a></li>
							</ul>
						</li>
						<li <?php activeClass('password') ?>><a href="password.php" >Change Password</a></li>
						<li <?php activeClass('logout') ?>><a href="logout.php" >Logout</a></li>
					</ul>
					</div>
				</div>
			</div>
	<?php
	}
	?>

 
</body>
</html>
