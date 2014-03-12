<?php
include_once 'category-data.php'; 
?>
  <div class="col-md-2">
    <a href="category-add.php" class="btn btn-block btn-sm">Add Category</a>
  </div>
  <div class="col-md-10">
    <?php
    //displaying categories if some exist
    if(isset($categories) && count($categories)>0)
    {
    ?>
    <table class="table">
      <thead>
        <tr>
          <th>Category Name</th>
          <th>Category Description</th>
          <th class="text-center">Products</th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($categories as $category) {
        ?>
          <tr>
            <td><?php echo $category->cat_name ?></td>
            <td><?php echo $category->cat_description ?></td>
            <td class="text-center"><?php echo $category->product_count ?></td>
            <td class="text-center"><a href="category-data.php?delete=<?php echo $category->cat_id ?>">Delete</a></td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    <?php
    }
    else { ?>
      <div class="alert"><strong>Didn't find any categories, please add some.</strong></div>
    <?php
    }
    ?>
  </div>