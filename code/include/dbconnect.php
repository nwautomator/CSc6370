<?php 
    //Connect to the DB
	$dbconn = new mysqli("localhost","mama_tester","test1234", "mama");

	if($dbconn->connect_error) {
		$dbconn = new mysqli("127.0.0.1","mama_tester","test1234", "mama");
		if($dbconn->connect_error) {
			die('Problem connecting to db: (' . $dbconn->connect_errorno . ')'
						. $dbconn->connect_error);
		}
	}
?>
