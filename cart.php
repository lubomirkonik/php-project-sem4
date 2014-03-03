<?php
session_start();
if(isset($_GET['clear'])) 
{
  if ($_GET[clear]) 
  {
    unset($_SESSION['CART']);
    $_SESSION['MSGS'] = array('Your cart has been emptied.');
    session_write_close();
    header("location: cart.php");
    exit();
  }
}

if ( isset($_GET['del']) ) 
{
  foreach($_SESSION['CART'] as $cart_item_ID => $cart_item)
  {
      if($cart_item['pd_id'] == $_GET['del']){
        unset($_SESSION['CART'][$cart_item_ID]);
        $_SESSION['MSGS'] = array('Item removed from your cart.');
        session_write_close();
        header("location: cart.php");
        exit();
      }
  }
}

if(isset($_GET['add']) )
{
  //Include database connection details
  require_once('config.php');
  $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
  if (!$link) {
    die("Cannot access db.");
  }

  $db = mysql_select_db(DB_DATABASE);
  if(!$db) {
    die("Unable to select database");
  }
  $product;
  $res = mysql_query("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
            FROM `tbl_product`
            INNER JOIN `tbl_category`
            ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
            WHERE `pd_id`=".$_GET['add']." LIMIT 1");

  $product = mysql_fetch_assoc($res);

  if(!isset( $_SESSION['CART']) ) $_SESSION['CART'] = array();

  if(!in_array($product, $_SESSION['CART']))
  {
    array_push($_SESSION['CART'], $product );
    $_SESSION['MSGS'] = array('Item added to your cart.');
    session_write_close();
    header("location: cart.php");
    exit();
  }
  else
  {
    $_SESSION['ERR_MSGS'] = array('Item is already added to your cart.');
    session_write_close();
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
          $_SESSION['total'] += $item['pd_price'];
          ?>
          <tr>
            <td><?php echo $item['pd_name'] ?></td>
            <td><?php echo $item['pd_description'] ?  $item['pd_description'] : '<span>No description</span>'; ?></td>
            <td class="text-center"><?php echo $item['cat_name'] ?></td>
            <td class="text-center"> <?php echo sprintf('%01.2f', $item['pd_price']); ?> &euro;</td>
            <td class="text-center"><a href="cart.php?del=<?php echo $item['pd_id'] ?>">Remove</a></td>
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
    } else {
      echo '<div class="alert"><strong>Please, add something to your cart.</strong></div>';
    }
    ?>
  </div>
</div>
<?php
include 'includes/footer.php';
?>