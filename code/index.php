<?php
	include 'include/auth.php';
	include 'include/validate.php';
	
	// the conditional below validates that the form
	// was really submitted.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// htmlspecialchars() is used to sanitize input
		// like the & symbol
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);

		if( !login($username,$password) ) {
			error_message("Invalid credentials. Try again.");
			//setcookie('login',$username,time() - 3600);
		} else {
			//cookie lasts for 24 hours
			setcookie('login',$username,time() + 86400);
			header("Location: main.php");
		}
	}
?>
<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>

<title>Log in to Mama G's Customer Loyalty Tracker</title>
<body>
<div class="container">
<div class="col-md-4 col-md-offset-4 material-animated-card">
<?php printmessages(); ?>
<center>
<h3 style="margin-top: 0">Login:</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="login">
	<div class="form-group">
		<label for="username">Username:</label>
		<input name="username" type="text" class="form-control" id="username" placeholder="sjobs"/>
	</div>
	<div class="form-group">
		<label for="password">Password:</label>
		<input name="password" type="password" class="form-control" id="password" placeholder="crazy111"/>
	</div>
	<input type="submit" class="btn btn-lg btn-primary" value="Login" style="width: 100%">
</form>
</center>
</div>
</div>
</body>
</html>
