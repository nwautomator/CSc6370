<?php 
    //Connect to the DB
	$dbconn = new mysqli("localhost","f15g03dbwebuser","RECm_qI{@oyT", "f15g03db");

	if($dbconn->connect_error) {
		$dbconn = new mysqli("127.0.0.1","f15g03dbwebuser","RECm_qI{@oyT", "f15g03db");
		if($dbconn->connect_error) {
			die('Problem connecting to db: (' . $dbconn->connect_errorno . ')'
						. $dbconn->connect_error);
		}
	}
?>
