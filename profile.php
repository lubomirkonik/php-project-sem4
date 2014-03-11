<?php
require_once 'auth.php';
include 'includes/header.php';
include 'includes/nav.php';
include 'includes/profile-data.php';
?>
<div id="main">
    <div class="container signin-profile">
      <div class="row">
        <div class="col-md-5">
          <h4>User credentials</h4>
          <!-- form for changing user data. -->
          <form class="form-horizontal" action="includes/profile-data.php" method="POST">
            <div class="form-group">
              <label for="inputEmail1" class="control-label col-md-4">Username</label>
              <div class="col-md-8">
                <input type="text" value="<?php echo $user['user_name'] ?>" class="form-control" disabled name="username" id="inputEmail1">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Email</label>
              <div class="controls col-md-8">
                <input type="email" value="<?php echo $user['user_email'] ?>" class="form-control" disabled name="email">
              </div>
            </div>
            <p>Change password</p>
            <?php
              //displaying any error messages if errors occur
	          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
	              ?>
	              <div>
	                <ul class="list-unstyled">
	                  <?php 
	                  foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
	                    echo '<li><strong style="color: red">'.$msg.'</strong></li>';
	                  }
	                  ?>
	                </ul>
	              </div>
	            <?php
	            unset($_SESSION['ERRMSG_ARR']);
	          }
	        ?>
            <div class="form-group">
              <label class="control-label col-md-4">Password</label>
              <div class="controls col-md-8">
                <input type="password" class="form-control" name="password">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Confirm Password</label>
              <div class="controls col-md-8">
                <input type="password" class="form-control" name="cpassword">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4"></label>
              <div class="controls col-md-8">
                <button type="submit" class="btn">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-7">
          <h4>Orders</h4>
          <?php
          //displaying user's orders
          if(isset($orders))
          {
          ?>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Order Date</th>
                <th>Products</th>
                <th>Order Status</th>
                <th>Order Cost</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($orders as $order) {
                  switch ($order->od_status) {
                    case 'New':
                      $status = '<span><strong>New</strong></span>';
                      break;
                    case 'Shipped':
                      $status = '<span><strong>Shipped</strong></span>';
                      break;
                    case 'Completed':
                      $status = '<span><strong>Completed</strong></span>';
                      break;
                    case 'Cancelled':
                      $status = '<span><strong>Cancelled</strong></span>';
                      break;
                    default:
                      $status = '<span><strong>Processing</strong></span>';
                      break;
                  }
                ?>
                  <tr>
                    <td><?php echo $order->od_id ?></td>
                    <td><?php echo $order->od_date ?></td>
                    <td><?php echo $order->products ?></td>
                    <td><?php echo $status ?></td>
                    <td> <?php echo sprintf('%01.2f', $order->od_cost); ?> &euro;</td>
                  </tr>
                <?php
                }
              ?>
            </tbody>
          </table>
          <?php
          }
          else { ?>
            <div class="alert"><strong>We didn't find any order placed by you.</strong></div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>