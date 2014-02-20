<?php 
include_once 'products-data.php'; ?>
  <div class="col-md-2">
    <a href="products-add.php" class="btn btn-block btn-sm">Add Product</a>  
  </div>
  <div class="col-md-10">
    <?php
    if(isset($products) && count($products)>0)
    {
    ?>
    <table class="table products-table">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Image</th>
          <th>Product Description</th>
          <th>Category</th>
          <th class="text-center">Price</th>
          <th class="text-center">Quantity</th>
          <th class="text-center"> </th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($products as $product) {
        ?>
          <tr>
            <td><?php echo $product->pd_name ?></td>
            <td><img src="../img/uploads/<?php echo $product->pd_image ?>" alt="<?php echo $product->pd_name ?>" style="max-width:140px;"></td>
            <td><?php echo $product->pd_description ?></td>
            <td><?php echo $product->cat_name ?></td>
            <td class="text-center"> <?php echo $product->pd_price ?> &euro;</td>
            <td class="text-center"><?php echo $product->pd_qty ?></td>
            <td class="text-center"><a href="products-data.php?delete=<?php echo $product->pd_id ?>">Delete</a></td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    <?php
    } else { 
    ?>
      <div class="alert"><strong>Didn't find any products, please add some.</strong></div>
    <?php
    }
    ?>
  </div>