<?php
session_start();
//authentication, denying access if no user is logged in or if the user is not admin and redirecting to proper page
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
            <h2>Add Category</h2><a href="index.php" class="btn btn-xs">Back</a>
	<hr>
        <?php
        //adding error message if necessary
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
          <!-- form for adding categories, on submit redirects to category-data.php where the add request is handled -->
          <form class="form-horizontal" action="category-data.php" method="POST">
                <div class="form-group">
                  <label for="catname" class="control-label col-md-3">Category name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="catname" id="catname">
                  </div>
                </div>
                <div class="form-group">
                  <label for="catdesc" class="control-label col-md-3">Category description</label>
                  <div class="col-md-6">
                      <textarea type="text" class="form-control" name="catdesc" id="catdesc" rows="6"></textarea>
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

