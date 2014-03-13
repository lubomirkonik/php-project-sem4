<?php
require_once 'auth.php';
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
  <header class="container">
    <h3 class="page-header">Order</h3>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-sm-6">
      <!-- display items in cart -->
        <?php if( count($_SESSION['CART']) > 0 )  { ?>
        <h4>Review Order Items</h4>
    	<div class="table-responsive">
            <table class="table products-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th class="text-center">Price</th>
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
                    <td class="text-center"><?php echo sprintf('%01.2f', $item->pd_price); ?></td>
                    <td class="text-center"><a href="cart.php?del=<?php echo $item->pd_id ?>">Remove</a></td>
                  </tr>
                  <?php
                }
                ?>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                    <h4 class="text-right">Total:</h4>
                  </td>
                  <td class="text-center">
                    <?php echo sprintf('%01.2f', $_SESSION['total']); ?>
                  </td>
                </tr>
            </tbody>
           </table>
    	</div>
	    <?php 
	    } // check count of cart
	    else
	    {
	      echo '<div class="alert"><strong>Please, add something to your cart.</strong></div>';
	    }
	    ?>
      </div>
      <div class="col-md-5 col-sm-6">
        <h4>Order Details</h4>
        <form id="oform" class="form-horizontal" action="includes/order-exec.php" method="POST">
          <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name" id="name">
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-sm-4 control-label">Address</label>
            <div class="col-sm-8">
              <textarea class="form-control" name="address" id="address"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="city" class="col-sm-4 control-label">City</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="city" id="city">
            </div>
          </div>
          <div class="form-group">
            <label for="postal_code" class="col-sm-4 control-label">PIN Code</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="postal_code" id="postal_code">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
              <button class="btn">Order &amp; Checkout<br></button>
            </div>  
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- script checking if necessary fields were filled by user -->
<script>
    $('#oform').submit(function(e){
      $('.alert').remove();
      var name = $('#name').val();
      var address = $('#address').val();
      var city = $('#city').val();
      var postal_code = $('#postal_code').val();
      if(name == '' || address == '' || city=='' || postal_code=='' )
      {
        $('<h4 class="alert" style="color:red">Please fill all fields</h4>').hide().insertBefore('#oform');
        $('.alert').fadeIn();
        return false;
      }
      else
      {
        return true;
      }
    });
</script>
<?php
include 'includes/footer.php';
?>