<?php 
//session_start();
if(!isset($_SESSION)) session_start();

$user_id = $_SESSION['SESS_USER_ID'];

//database connection
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'dbManager.php');
$dbManager = dbManager::getInstance();

//getting user data from db
$user = $dbManager->selectQuery("SELECT * FROM tbl_user WHERE user_id=".$user_id." LIMIT 1");
$user = $user[0];

//getting order data from db
$orders = $dbManager->selectQuery("SELECT `tbl_order`.*,GROUP_CONCAT(`pd_name` SEPARATOR ', ') as `products`
						FROM `tbl_order`,`tbl_order_item`, `tbl_product`
						WHERE `tbl_order`.`od_id` = `tbl_order_item`.`od_id` 
						AND `tbl_product`.`pd_id` = `tbl_order_item`.`pd_id`
						AND user_id=".$user_id." GROUP BY `od_id`");

//handling requests for profile changes
if(is_array($_POST) && count($_POST) > 0) {
	//password change
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	if( strlen($password) < 6 ) {
		$errmsg_arr[] = 'Password is too short';
		$errflag = true;
	}

	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ./../profile.php");
		exit();
	}
	//Create INSERT query
	$qry = "UPDATE tbl_user SET password='".md5($_POST['password'])."', updated_at='".date("Y-m-d H:i:s")."' WHERE user_id=$user_id";
	$result = $dbManager->query($qry);
	//Check whether the query was successful or not
	if($result) {
		$_SESSION['MSGS'] = array('Your password was changed successfully.');
		session_write_close();
		header("location: ..\\profile.php");
		exit();
	}else {
		die("Query failed: ".mysql_error());
	}
}
?>