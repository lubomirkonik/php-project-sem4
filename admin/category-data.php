<?php 
if(!isset($_SESSION)) session_start();
//database connection
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'dbManager.php');
$dbManager = dbManager::getInstance();

//get all the categories
$categories = $dbManager->selectQuery("SELECT count(`tbl_product`.`cat_id`) as `product_count`,`tbl_category`.*
					FROM `tbl_category`
					LEFT JOIN `tbl_product`
					ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
					WHERE `tbl_category`.`cat_id` <> " . PLACEHOLDER_CAT_ID . "
					GROUP BY `tbl_category`.`cat_id`;");

//handle new category request
if(is_array($_POST) && count($_POST) > 0) {
	$catname = $_POST['catname'];
	$catdesc = htmlspecialchars($_POST['catdesc']);

	if($catname == '') {
		$errmsg_arr[] = 'Category name missing';
		$errflag = true;
	}

	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: category-add.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO `tbl_category` ( `cat_name`, `cat_description`)
			VALUES ('".$catname."', '".$catdesc."');";
	$result = $dbManager->query($qry);
	//Check whether the query was successful or not
	if($result) {
		$_SESSION['MSGS'] = array('Changes were successful.');
		session_write_close();
		header("location: index.php");
		exit();
	}else {
		die("Query failed: ".mysql_error());
	}
}
//handle delete request
if(is_array($_GET) && count($_GET) > 0 && isset($_GET['delete'])) {
	$catid = $_GET['delete'];

	$qry = "DELETE FROM `tbl_category`
			WHERE cat_id=".$catid;
	$result = $dbManager->query($qry);
	//Check whether the query was successful or not
	if($result) {
		$_SESSION['MSGS'] = array('Changes were successful.');
		session_write_close();
		header("location: index.php");
		exit();
	}else {
		$_SESSION['ERRMSG_ARR'] = array('Changes didn\'t happen. Possible reasons include category still containing products, or database not being up.');
		session_write_close();
		header("location: index.php");
		exit();
	}
}
?>