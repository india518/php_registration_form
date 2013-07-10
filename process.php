<?php
session_start();

	$min_password_length = 6;
	$password_empty = false;

	//Can detect an empty field two ways:
	//
	// 1) if (! isset($_POST["first_name"]) )
	// 2) if ( $_POST["first_name"] == false )
	//
	// Is one better than the other? For now, assume we
	// should avoid calling a function (for efficiency)
	if ( $_POST["first_name"] == false )
	{
		$_SESSION["errors"]["first_name"] = "The First Name field is empty!";
	}
	if ( $_POST["last_name"] == false )
	{
		$_SESSION["errors"]["last_name"] = "The Last Name field is empty!";
	}
	if ( $_POST["email"] == false )
	{
		$_SESSION["errors"]["email"] = "The Email field is empty!";
	}
	
	if ( $_POST["password"] == false )
	{
		$_SESSION["errors"]["password"] = "The password field is empty!";
		$password_empty = true;
	}

	//Maybe this should be refactored into one function,
	//called twice?
	if ( preg_match("#[\d]#", $_POST["first_name"]) )
	{
		$_SESSION["errors"]["first_name"] = "First name is invalid!";
		// Remember that you can't have a digit in an empty field!
	}
	if ( preg_match("#[\d]#", $_POST["last_name"]) )
	{
		$_SESSION["errors"]["last_name"] = "Last name is invalid!";
	}

	//validate email
	if(! (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) )
	{
		$_SESSION["errors"]["email"] =  "Invalid email!";
	}

	//validate birth_date
	// May come back to this - if we use the date picker,
	// this seems to validate itself before submission!
	// otherwise - use regex to check?
	if ( isset($_POST["birth_date"]) )
	{
		$birth_date = $_POST["birth_date"]; //for display purposes
	}

	//validate password length
	if ( strlen($_POST["password"]) <= $min_password_length )
	{
		if ( $password_empty == false ) //not set yet
		{
			$_SESSION["errors"]["password"] = "The password should be more than 6 characters!";
		} //else leave current "empty" message
	}

	//validate password = confirm_password
	if (! ($_POST["password"] == $_POST["confirm_password"]) )
	{
		$_SESSION["errors"]["confirm_password"] =  "The password fields do not match!";
	}

	if (! isset($_SESSION["errors"]) )
	{
		$_SESSION["success"] = "Thanks for submitting your information.";
	}

	//$_SESSION["birth_date"] = $birth_date;
	header("location: index.php");

?>