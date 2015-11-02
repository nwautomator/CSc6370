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
			error_message("<h2>Invalid credentials. Try again.</h2>");
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
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>

<title>Log in to Mama G's Customer Loyalty Tracker</title>
<body>
<center>
<h3>Login:</h3><br/><br/>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="login">
<table>
<tr><td>Username:</td></tr>
<tr><td><input name="username" type="text" class="form-control" id="username"/></td></tr>
<tr><td>Password:</td></tr>
<tr><td><input name="password" type="password" class="form-control" id="password"/></td></tr>
</table></br>
<input type="submit" class="btn btn-lg btn-primary" value="Login">
</form>
</center>
</body>
</html>
