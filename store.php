<?php
session_start();
include 'includes/header.php';
include 'includes/nav.php';
?>
<?php
//database connection
require_once 'includes/dbManager.php';
$dbManager = dbManager::getInstance();

$products = array();

//implementation of search functionality
if ( isset($_GET['search']) ) 
{
  $keyword = trim($_GET['search']);
  $products = $dbManager->selectQuery("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
          FROM `tbl_product`
          INNER JOIN `tbl_category`
          ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
          WHERE `pd_name` LIKE '%".$keyword."%'
  		  AND `tbl_product`.`pd_id` <> " . PLACEHOLDER_PROD_ID . "
          ORDER BY `pd_id` DESC");
}
//implementation of filtering products by category
elseif ( isset($_GET['category']) ) 
{
  $category = trim($_GET['category']);
  $products = $dbManager->selectQuery("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
          FROM `tbl_product`
          INNER JOIN `tbl_category`
          ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
          WHERE `tbl_product`.`cat_id`=".$category."
          ORDER BY `pd_id` DESC");
}

//if neither search nor category were used, display all products
else
{
  $products = $dbManager->selectQuery("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
          FROM `tbl_product`
          INNER JOIN `tbl_category`
          ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
  		  WHERE `tbl_product`.`pd_id` <> " . PLACEHOLDER_PROD_ID . "
          ORDER BY `pd_id` DESC");
}
?>
<div id="main">
    <header class="container">
      <h3 class="page-header">Store</h3>
    </header>
    <div class="container">
      <div class="row">
        <?php if (count($products) > 0) { ?>
          <?php
            foreach ($products as $product) {
          ?>
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
              <img src="img/uploads/<?php echo $product->pd_image ?>" alt="<?php echo $product->pd_name ?>">
              <div class="caption">
                 <h4 class="text-center">
                     <abbr title="<?php echo $product->pd_name ?>" ><?php echo trim_text($product->pd_name); ?></abbr>
                     <small>&nbsp;<?php echo $product->pd_price ?> &euro;</small>
                 </h4>
                 <p class="text-center"><a href="product.php?id=<?php echo $product->pd_id; ?>" class="btn">View</a> <a href="cart.php?add=<?php echo $product->pd_id; ?>" class="btn">Add to cart</a></p>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        <?php 
        } else {
        ?>
        <div class="alert" style="padding-left: 15px"><strong>No products found!</strong></div>
        <?php
        } 
        ?>
      </div>
    </div>
  </div>
<?php
include 'includes/footer.php';
?>

<?php
/**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string
 */
function trim_text($input, $length = 12, $ellipses = false, $strip_html = false) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    //find last space within length
//    $last_space = strrpos(substr($input, 0, $length), ' ');
//    $trimmed_text = substr($input, 0, $last_space);

    $trimmed_text = substr($input, 0, $length);
  
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}
?>