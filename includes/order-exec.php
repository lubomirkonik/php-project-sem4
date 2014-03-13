<?php
	//Start session
	session_start();
	
	//database connection
	require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'dbManager.php');
	$dbManager = dbManager::getInstance();

	$user_id = $_SESSION['SESS_USER_ID'];
	$od_date = date('Y-m-d');
	$od_name = $_POST['name'];
	$od_address = $_POST['address'];
	$od_city = $_POST['city'];
	$od_postal_code = $_POST['postal_code'];
	$od_cost = $_SESSION['total'];

	//adding order into db
	$qry = "INSERT INTO `tbl_order` ( `user_id`, `od_date`, `od_status`, `od_name`, `od_address`, `od_city`, `od_postal_code`, `od_cost`)
			VALUES
				( ".$user_id.", '".$od_date."', 'New', '".$od_name."', '".$od_address."', '".$od_city."', '".$od_postal_code."', '".$od_cost."');
			";

	$od_id = $dbManager->query($qry);

	//adding contents of the cart into the db
	if($od_id){
		foreach($_SESSION['CART'] as $cart_item_ID => $cart_item)
		{
			$qry = "INSERT INTO `tbl_order_item` (`od_id`, `pd_id`, `od_qty`) VALUES (" . $od_id . ", ".$cart_item->pd_id .", 1);";
			$result = $dbManager->query($qry);
	
			$qry = "UPDATE `tbl_product` SET `tbl_product`.`pd_qty` = `tbl_product`.`pd_qty` - 1 WHERE pd_id=".$cart_item->pd_id;
			$result = $dbManager->query($qry);
		}
	}

	//Check whether the query was successful or not
	if($result !== false) {
		unset($_SESSION['CART']);
		$_SESSION['MSGS'] = array('Your order has been placed.');
		session_write_close();
		header("location: ../profile.php");
		exit();
	} else {
		die("Query failed: ".mysql_error());
	}
?>