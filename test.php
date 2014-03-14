<?php
require_once 'includes/dbManager.php';
$dbManager = dbManager::getInstance();

$product = $dbManager->selectQuery(
  		  	"SELECT `tbl_product`.*,`tbl_category`.`cat_name`
            FROM `tbl_product`
            INNER JOIN `tbl_category`
            ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
            WHERE `pd_id`='3' LIMIT 1");
  $product = $product[0];
  
  echo "<pre>";
  print_r($product);
  echo "</pre";

?>