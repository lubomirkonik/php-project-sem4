<?php
session_start();
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
	<script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>
<div id="main">
	<div class="container">
	<h2>Administration</h2><a href="../" class="btn btn-xs">Back to site</a>
	<hr>
	<?php
      if( isset($_SESSION['MSGS']) && is_array($_SESSION['MSGS']) && count($_SESSION['MSGS']) >0 ) {
          ?>
          <div class="alert">
            <ul class="list-unstyled">
              <?php 
              foreach ($_SESSION['MSGS'] as $msg) {
                echo '<li><strong>'.$msg.'</strong></li>';
              }
              ?>
            </ul>
          </div>
        <?php
        unset($_SESSION['MSGS']);
      }
    ?>
    <?php
      if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
          ?>
          <div class="alert">
            Please fix the following errors and try again.
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
        <ul class="nav nav-pills" id="tabs">
	  <li class="active"><a data-toggle="tab" href="#category">Categories</a></li>
	  <li><a data-toggle="tab" href="#products">Products</a></li>
	  <li><a data-toggle="tab" href="#orders">Orders</a></li>
	</ul>

	<div class="tab-content" style="padding-top: 20px;">
	  <div class="row tab-pane in active" id="category">
	  	<?php include_once 'category.php'; ?>
	  </div>
	  <div class="row tab-pane" id="products">
	  	<?php include_once 'products.php'; ?>
	  </div>
	  <div class="tab-pane" id="orders">
	  	<?php include_once 'orders.php'; ?>
	  </div>
	</div>
	<script>
	  $(function () {
	    //$('#tabs a:last').tab('show')
	  })
	</script>
	</div>
</div>
</body>
</html>