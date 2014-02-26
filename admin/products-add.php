<?php
session_start();
include_once 'category-data.php';
if(!isset($_SESSION['SESS_USER_ID']) || (trim($_SESSION['SESS_USER_ID']) == '')) {
	header("location: ../access-denied.php");
	exit();
}
if(intval($_SESSION['SESS_IS_ADMIN']) !== 1)
{
	header("location: ../access-denied.php");
	exit();
} 
?>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div id="main">
	<div class="container">
            <h2>Add Product</h2><a href="index.php" class="btn btn-xs">Back</a>
	<hr>
        <?php
        if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
          ?>
          <div class="alert">
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
        <form class="form-horizontal" action="products-data.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="category" class="control-label col-md-3">Category</label>
                  <div class="col-md-6">
                    <select class="form-control" name="category" id="category">
                      <option value="">----</option>
                      <?php
                        foreach ($categories as $category) {
                          echo '<option value="'.$category->cat_id.'">'.$category->cat_name.'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="proname" class="control-label col-md-3">Product name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="proname" id="proname">
                  </div>
                </div>
                <div class="form-group">
                  <label for="proimage" class="control-label col-md-3">Product Image</label>
                  <div class="col-md-6">
                    <input type="file" class="form-control" name="proimage" id="proimage">
                  </div>
                </div>
                <div class="form-group">
                  <label for="prodesc" class="control-label col-md-3">Product Description</label>
                  <div class="col-md-6">
                  <textarea type="text" class="form-control" name="prodesc" id="prodesc" rows="6"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="price" class="control-label col-md-3">Price</label>
                  <div class="col-md-6 input-group">
                    <input type="number" placeholder="00,00" class="form-control" name="price" id="price" pattern="[0-9]+(\\,[0-9][0-9]?)?">
                    <span class="input-group-addon">&euro;</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="quantity" class="control-label col-md-3">Quantity</label>
                  <div class="col-md-6">
                    <input type="number" placeholder="0" class="form-control" name="quantity" id="quantity">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <button type="submit" class="btn col-md-3">Add</button>
                  </div>  
                </div>
          </form>
        </div>
</div>        
</body>
</html>
