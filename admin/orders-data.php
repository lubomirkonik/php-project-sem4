<?php
if(!isset($_SESSION)) session_start();

//database connection
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'dbManager.php');
$dbManager = dbManager::getInstance();

$statuses = array('New', 'Shipped', 'Completed', 'Cancelled');
//get all the categories
$orders = $dbManager->selectQuery("SELECT `tbl_order`.*,GROUP_CONCAT(`pd_name` SEPARATOR ', ')  as `products`
					FROM `tbl_order`,`tbl_order_item`, `tbl_product`
					WHERE `tbl_order`.`od_id` = `tbl_order_item`.`od_id` 
					AND `tbl_product`.`pd_id` = `tbl_order_item`.`pd_id`
					GROUP BY `od_id`");

// handle update order request
if(is_array($_POST) && count($_POST) > 0) {
//    echo $_POST['od_id'].' + '.$_POST['od_status'];
    $odid = $_POST['od_id'];
    $odstatus = $_POST['od_status'];
    
    //Create UPDATE query
    $qry = "UPDATE `tbl_order` SET `od_status`='".$odstatus."' "
            . "WHERE `od_id`='".$odid."';";
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
?>