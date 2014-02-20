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
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($orders as $orders) {
        ?>
          <tr>
            <td><?php echo $orders->od_id; ?></td>
            <td><?php echo $orders->od_date; ?></td>
            <td><?php echo $orders->products; ?></td>
            <td><?php echo $orders->od_status; ?></td>
            <td><?php echo $orders->od_name; ?></td>
            <td><?php echo $orders->od_address . '<br>' . $orders->od_city . ' ' . $orders->od_postal_code; ?></td>
            <td class="text-center"><?php echo $orders->od_cost ?> &euro;</td>
          </tr>
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