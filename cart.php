<?php
session_start();
//clearing the cart
if(isset($_GET['clear'])) 
{
  if ($_GET[clear]) 
  {
    unset($_SESSION['CART']);
    $_SESSION['MSGS'] = array('Your cart has been emptied.');
    session_write_close();
    //redirecting after the the request is done
    header("location: cart.php");
    exit();
  }
}

//removing items from the cart
if ( isset($_GET['del']) ) 
{
  foreach($_SESSION['CART'] as $cart_item_ID => $cart_item)
  {
      if($cart_item->pd_id == $_GET['del']){
        unset($_SESSION['CART'][$cart_item_ID]);
        $_SESSION['MSGS'] = array('Item removed from your cart.');
        session_write_close();
        //redirecting after the the request is done
        header("location: cart.php");
        exit();
      }
  }
}

//adding items into cart
if(isset($_GET['add']) )
{
  //database connection
  require_once 'includes/dbManager.php';
  $dbManager = dbManager::getInstance();
  $product = $dbManager->selectQuery(
  		  	"SELECT `tbl_product`.*,`tbl_category`.`cat_name`
            FROM `tbl_product`
            INNER JOIN `tbl_category`
            ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
            WHERE `pd_id`=".$_GET['add']." LIMIT 1");
  $product = $product[0];
  
  //only allow adding to cart if the product is in stock
  if($product->pd_qty != 0)
  {
	  if(!isset( $_SESSION['CART']) ) $_SESSION['CART'] = array();
	
	  if(!in_array($product, $_SESSION['CART']))
	  {
	    array_push($_SESSION['CART'], $product );
	    $_SESSION['MSGS'] = array('Item added to your cart.');
	    session_write_close();
	    //redirecting after the the request is done
	    header("location: cart.php");
	    exit();
	  }
	  else
	  {
	  	//adding error message if necessary
	    $_SESSION['ERR_MSGS'] = array('Item is already added to your cart.');
	    session_write_close();
	    //redirecting after the the request is done
	    header("location: cart.php");
	    exit();
	  }
  }else{
  	//adding error message if necessary
  	$_SESSION['ERR_MSGS'] = array('Item out of stock.');
  	session_write_close();
  	//redirecting after the the request is done
  	header("location: cart.php");
  	exit();
  }
}// if GET is there
?>
<?php
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
  <header class="container">
    <h3 class="page-header">Cart</h3>
  </header>
  <div class="container">
  <!-- displaying cart contents -->
    <?php if( isset( $_SESSION['CART']) && count($_SESSION['CART']) > 0 )  { ?>
    <div class="table-responsive">
      <table class="table products-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th class="text-center">Category</th>
          <th width="100" class="text-center">Price</th>
          <th class="text-center"> </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $_SESSION['total'] = 0;
        foreach ($_SESSION['CART'] as $item) {
          $_SESSION['total'] += $item->pd_price;
          ?>
          <tr>
            <td><?php echo $item->pd_name ?></td>
            <td><?php echo $item->pd_description ?  trim_text($item->pd_description) : '<span>No description</span>'; ?></td>
            <td class="text-center"><?php echo $item->cat_name ?></td>
            <td class="text-center"> <?php echo sprintf('%01.2f', $item->pd_price); ?> &euro;</td>
            <td class="text-center"><a href="cart.php?del=<?php echo $item->pd_id ?>">Remove</a></td>
          </tr>
          <?php
        }
        ?>
        <tr>
          <td colspan="3"></td>
          <td>
            <h4>Total:</h4>
          </td>
          <td colspan="2">
          <!-- cart total cost -->
            <?php echo sprintf('%01.2f', $_SESSION['total']); ?> &euro;
          </td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="pull-right">
      <a href="cart.php?clear=true" class="btn">Clear Cart</a> 
      <a href="order.php" class="btn">Place Order</a>     
    </div>
    <?php 
    //message on empty cart
    } else {
      echo '<div class="alert"><strong>Please, add something to your cart.</strong></div>';
    }
    ?>
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
function trim_text($input, $length = 450, $ellipses = true, $strip_html = false) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    $trimmed_text = substr($input, 0, $length);
  
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}
?>