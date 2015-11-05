<?php
	//this file has all the validation functions
	//needed for various input.
	function validate_discount($discount) {
		if( preg_match("/^[0]+\.[0]+$/",$discount) ) {
			return 0;
		} else {
			return 1;
		}
	}
	function validate_name($name) {
		// a name should begin with a capital
		// letter and have no numbers or special
		// characters - the form should enforce
		// any length limits.
		if( preg_match("/^[A-Z][a-z]+$/",$name) ) {
			return 1; 
		} else {
			return 0;
		}
	}
	function validate_email($email) {
		// a customer email address
		// should be of the form user@website.(com|net|org)
		if( preg_match("/^[a-z0-9_]+[.]*[a-z0-9_]*[@][a-z0-9_]+[.][a-z]{2,4}$/",$email) ) {
			return 1;
		} else {
			return 0;
		}
	}
	function validate_password($password) {
		//passwords should be 8 characters or 
		//longer and and must contain at least 
		//one lower case letter, one upper case 
		//letter and one digit
		if( preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password) ) {
			return 1;
		} else { 
			return 0;
		}
	}
	function validate_text($text) {
		//validate that the user typed *something*
		//into the text box
		if( preg_match("/^[a-zA-Z0-9]+.*$/", $text) ) {
			return 1;
		} else { 
			return 0;
		}
	}
	function validate_cost($cost) {
		//validate that the cost entered
		//is a valid currency structure:
		// e.g. 325.40, 900.00, 50.21, etc...
		if( preg_match("/^[0-9]+[.][0-9]{1,4}$/",$cost) ) {
			return 1;
		} else {
			return 0;
		}
	}
	function validate_date($date) {
		//validate that the date entered
		//conforms to yyyy-mm-dd
		if( preg_match("/^[0-9]{4}-[0-1][0-2]-[0-3][0-9]$/",$date) ) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function error_message($message) {
		$message = "<br/><br/><p style='color: red'>" . $message . "</p><br/>";
		print $message;
	}

	function ok_message($message) {
		$message = "<br/><br/><p style='color: green'>" . $message . "</p><br/>";
		print $message;
		//TODO: fix the sleep function
		//sleep(4);
	}
?>
