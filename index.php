<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';
include 'includes1/carosal.php';
include 'includes1/modaldetails.php';
$sql = "select * from product where featured=1";
$featured = mysqli_query($db,$sql);
?>
<!--Featured product show-->
<div class="container">
  <div class="head">
    <h3 class="text-center">Hot sales !!</h3>
  </div>
</div>

<div class="container">
  <div class="row">
    <?php while ($product = mysqli_fetch_assoc($featured)) { ?>
      <div class="col-md-3 ">
        <div class="fp">
          <h4><?= $product['title']; ?></h4>
          <img class="img-thumb" src="img/<?= $product['image']; ?>" alt="<?= $product['title']; ?>">
          <p class="list-price text-danger"> Previous Price <s>$<?= $product['pp']; ?></s></p>
          <p class="Price"> <b>Now </b> $<?= $product['price']; ?></p>
          <a href="details.php?id=<?=$product['id'];?>"  class="btn btn-success">
            Details
          </a>
          <button id="product" pid="<?=$product['id']?>" class="btn btn-primary">
            <span class="glyphicon glyphicon-shopping-cart"></span> Add Cart
          </button>
        </div>
      </div>

    <?php } ?>

  </div>
</div>
<!--Featured product end-->
<div class="container">
  <div class="allcat">
    <h3 class="text-center">Products Category</h3>
  </div>
</div>
<!--Category wise product show-->
<?php
$catsql = "select * from categories where parent=0";
$catrun = mysqli_query($db,$catsql);
  while ($catchild = mysqli_fetch_assoc($catrun)) {
    ?>
    <div class="container">
      <div class="panel panel-default sidebar">
        <div class="panel-heading">
          <div class="panel-title title">
            <p><?= $catchild['category']; ?></p>
          </div>
        </div>
        <div class="panel-body">
          <div class="row ">
            <div class="col-md-2 ">
              <?php
              $parentid = $catchild['id'];
              $childsql = "select * from categories where parent='$parentid'";
              $childrun = mysqli_query($db,$childsql);
              // $childfetch = mysqli_fetch_assoc($childrun);
              // var_dump($childfetch);
                while ($childfetch = mysqli_fetch_assoc($childrun)) { ?>

                  <ul class="nav nav-pills nav-stacked category">
                    <li>
                      <a href="shop.php?id=<?= $childfetch['id']; ?>"><?= $childfetch['category']; ?></a>
                    </li>

                  </ul>
                <?php }?>
            </div>
            <div class="col-md-10">
              <?php
              $childrun = mysqli_query($db,$childsql);
              while ($childfetch = mysqli_fetch_assoc($childrun)){
              $childid=$childfetch['id'];
              $childbox = "select * from product where cat='$childid'";
              $childresult = mysqli_query($db,$childbox);
              while ($getchild = mysqli_fetch_assoc($childresult)){?>
                  <div class="col-md-3 ">
                    <div class="product">
                      <h4><?= $getchild['title']; ?></h4>
                      <img src="img/<?= $getchild['image']; ?>" alt="<?= $getchild['title']; ?>"
                      class="img-responsive">
                      <p class="Price"> <b>Price:</b> $<?= $getchild['price']; ?></p>
                      <a href="details.php?id=<?=$getchild['id'];?>" class="btn btn-success">
                        Details
                      </a>
                      <button id="product" pid="<?=$getchild['id']?>" class="btn btn-primary">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Add Cart 
                      </button>
                    </div>
                  </div>
                <?php } }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <!--Category wise product end-->

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript" src="main.js"></script>

    <script type="text/javascript">
    $(document).ready(function () {
      $('.carosal').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      });
    });
  </script>

</body>
</html>
