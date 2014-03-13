<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once(__DIR__.'/../config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//database connection
	require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'dbManager.php');
	$dbManager = dbManager::getInstance();
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$username = clean($_POST['username']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($username == '') {
		$errmsg_arr[] = 'Please provide a username.';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Please enter the password.';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../login.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM tbl_user WHERE user_name='$username' AND password='".md5($_POST['password'])."'";
	$member = $dbManager->selectQuery($qry);

	//Check whether the query was successful or not
	if($member !== false) {
		if(count($member) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = $member[0];
			$_SESSION['SESS_USER_ID'] = $member->user_id;
			$_SESSION['SESS_USERNAME'] = $member->user_name;
			$_SESSION['SESS_IS_ADMIN'] = $member->user_is_admin;
			session_write_close();
			header("location: ../index.php");
			exit();
		}else {
			//Login failed
			$_SESSION['ERRMSG_ARR'] = array('Incorrect username or password. Please try again.');
			session_write_close();
			header("location: ../login.php");
			exit();
		}
	}else {
		die("Query failed: ".mysql_error());
	}
?>