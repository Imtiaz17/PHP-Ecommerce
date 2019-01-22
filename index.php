<?php require_once 'core/init.php';
 include 'includes1/head.php';
 include 'includes1/navbar.php';
 include 'includes1/newsbar.php';
 include 'includes1/carosal.php';
 include 'includes1/lsb.php';
 include 'includes1/modaldetails.php';
$sql="select * from product where featured=1";
$featured=$conn->getall($sql);


?>
  <div class="col-md-9">
    <div class="row">
      <h2 class="text-center">Feature Products</h2>
      <?php while ($product=mysqli_fetch_assoc($featured)):?>
      <div class="col-md-3"  >
        <h4><?=$product['title'];?></h4>

        <img src="<?=$product['image'];?>" alt="<?=$product['title'];?>"  class="img-thumb"/>
        <p class="list-price text-danger"> List Price: <s>$<?=$product['list_price'];?></s></p>
        <p class="Price">Our price: $<?=$product['price'];?></p>
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details">Details</button>

      </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
