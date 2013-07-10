<?php
session_start();

	$min_password_length = 6;

	//Can detect an empty field two ways:
	//
	// 1) if (! isset($_POST["first_name"]) )
	// 2) if ( $_POST["first_name"] == false )
	//
	// Is one better than the other? For now, assume we
	// should avoid calling a function (for efficiency)
	if ( $_POST["first_name"] == false )
	{
		$error_message[] = "The First Name field is empty!";
	}
	if ( $_POST["last_name"] == false )
	{
		$error_message[] = "The Last Name field is empty!";
	}
	if ( $_POST["email"] == false )
	{
		$error_message[] = "The Email field is empty!";
	}
	if ( $_POST["birth_date"] == false )
	{
		$error_message[] = "The Birth Date field is empty!";
	}
	if ( $_POST["password"] == false )
	{
		$error_message[] = "The password field is empty!";
	}

	//Maybe this should be refactored into one function,
	//called twice?
	if ( preg_match("#[\d]#", $_POST["first_name"]) )
	{
		$error_message[] = "First name is invalid!";
	}
	if ( preg_match("#[\d]#", $_POST["last_name"]) )
	{
		$error_message[] = "Last name is invalid!";
	}

	//validate email
	if(! (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) )
	{
		$error_message[] =  "Invalid email!";
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
		$error_message[] =  "The password should be more than 6 characters!";
	}

	//validate password = confrim_password
	if (! ($_POST["password"] == $_POST["confirm_password"]) )
	{
		$error_message[] =  "The password fields do not match!";
	}

	$_SESSION["errors"] = $error_message;
	//$_SESSION["birth_date"] = $birth_date;
	header("location: index.php");

?>