<?php
//Start session
session_start();
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
  <div class="container signin-profile">
      <form method="POST" action="includes/login-exec.php" accept-charset="UTF-8" class="form-signin">
        <h3 class="form-signin-heading">Please sign in</h3>
        <?php
        //displaying any error messages if errors occur
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
        <input type="text" name="username" class="form-control" placeholder="Username" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <button class="btn" type="submit">Sign in</button>
        <p></p>
      <p>Haven't registered? Please go <a href="register.php" class="btn btn-xs">Register</a></p>
      </form>
    </div>
</div>
<?php
include 'includes/footer.php';
?>