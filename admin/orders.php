<?php 
include_once 'orders-data.php'; ?>
  <div class="col-md-12">
    <?php
    if(isset($orders) && count($orders)>0)
    {
    ?>
    <table class="table products-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Products</th>
          <th>Status</th>
          <th>Name</th>
          <th>Address</th>
          <th>Cost</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($orders as $order) {
        ?>
          <form action="orders-data.php" method="POST">
          <tr>
            <td><input type="hidden" name="od_id" value="<?php echo $order->od_id; ?>" ><?php echo $order->od_id; ?></td>
            <td><?php echo $order->od_date; ?></td>
            <td><?php echo $order->products; ?></td>
            <td>
                <select name="od_status" id="od_status">
                  <option value="<?php echo $order->od_status; ?>"><?php echo $order->od_status; ?></option>
                  <?php
                    $tmp = array();
                    for ($i=0; $i < count($statuses); $i++) {
                        if (strcmp($order->od_status, $statuses[$i]) !== 0){
                            $tmp[] = $statuses[$i]; 
                        }
                    }
                    foreach ($tmp as $status) {
                        echo '<option value="'.$status.'">'.$status.'</option>';
                    }
                  ?>
                </select>
            </td>
            <td><?php echo $order->od_name; ?></td>
            <td><?php echo $order->od_address . '<br>' . $order->od_city . ' ' . $order->od_postal_code; ?></td>
            <td><?php echo $order->od_cost ?> &euro;</td>
            <td><input class="input-submit" type="submit" value="Update" ></td>
          </tr>
          </form>
        <?php
          }
        ?>
      </tbody>
    </table>
    <?php
    } else { 
    ?>
      <div class="alert"><strong>Didn't find any orders, please add some.</strong></div>
    <?php
    }
    ?>
  </div>