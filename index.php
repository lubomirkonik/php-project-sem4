<?php
//Start session
session_start();
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
    <div class="container">
        <div class="carousel">
            <div class="carousel-caption">
                <img src="img/young-plants.jpg" alt="...">
            </div>
            <div class="carousel-caption">
              <h4>The New Young Plants</h4>
              Bring life to your home
            </div>
        </div>    
    </div>
    <hr />
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-xs-6 text-center">
                <a href="store.php?category=1"><img src="img/bonsai-tree-sm.jpg" alt="Bonsai Trees" title="Bonsai Trees"></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
                <a href="store.php?category=2"><img src="img/Sago-Palm-sm.jpg" alt="Palm Trees" title="Palm Trees"></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
                <a href="store.php?category=3"><img src="img/cactus-sm.jpg" alt="Cactus Plants" title="Cactus Plants"></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
                <a href="store.php?category=4"><img src="img/tropical-blueorchid-sm.jpg" alt="Flowering Tropicals" title="Flowering Tropicals"></a>
        </div>
      </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>