<?php 
include_once 'orders-data.php'; ?>
  <div class="col-md-12">
    <?php
    if(isset($orders) && count($orders)>0)
    {
    ?>
    <form class="" action="orders-data.php" method="POST">  
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
          foreach ($orders as $orders) {
        ?>
          <tr>
            <td><input type="hidden" name="od_id" value="<?php echo $orders->od_id; ?>"><?php echo $orders->od_id; ?></td>
            <td><?php echo $orders->od_date; ?></td>
            <td><?php echo $orders->products; ?></td>
            <td>
                <select name="od_status" id="od_status">
                  <option value="<?php echo $orders->od_status; ?>"><?php echo $orders->od_status; ?></option>
                  <?php
                    $tmp = array();
                    for($i=0;$i<count($statuses);$i++){
                        if(strcmp($orders->od_status, $statuses[$i])!==0){
                            $tmp[]=$statuses[$i]; 
                        }
                    }
                    foreach ($tmp as $status) {
                        echo '<option value='.$status.'>'.$status.'</option>';
                    }
                  ?>
                </select>
            </td>
            <td><?php echo $orders->od_name; ?></td>
            <td><?php echo $orders->od_address . '<br>' . $orders->od_city . ' ' . $orders->od_postal_code; ?></td>
            <td><?php echo $orders->od_cost ?> &euro;</td>
            <!--<td><a href="orders-data.php?update=<?php// echo $orders->od_id ?>&status=<?php ?>">Update</a></td>-->
            <td><input type="submit" value="Update"></td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    </form>      
    <?php
    } else { 
    ?>
      <div class="alert"><strong>Didn't find any orders, please add some.</strong></div>
    <?php
    }
    ?>
  </div>