<?php
require_once 'core/db.php';
$sql = "select * from categories where parent=0";
$result = mysqli_query($db,$sql);
$sql2 = "select * from product where featured=1";
$featured = mysqli_query($db,$sql2);
?>

<nav class="main-menu">
    <ul>
        <?php while ($parent = $result->fetch_assoc()) { ?>
        <li><a href="#"><?= $parent['category'] ?></a>
            <ul>
                <?php $parent_id = (int)$parent['id'];
                $sql2 = "select * from categories where parent='$parent_id'";
                $cresult = mysqli_query($db,$sql2);
                if ($cresult){
                while ($child = $cresult->fetch_assoc()) { ?>
                <li><a href=""><?= $child['category'] ?></a>
                    <?php } ?>
            </ul>
          <?php } }?>
        </li>
      </li>
      <li> <a href="#" id="cart"> <span class="glyphicon glyphicon-shopping-cart"></span> Cart </a>
    <ul>
       <li>
         <div class="aa panel panel-danger">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-3">SL.NO</div>
              <div class="col-md-3">Product Name</div>
              <div class="col-md-3">Product Image</div>
              <div class="col-md-3">Price</div>
            </div>
          </div>
          <div class="panel-body">
            <div id="cart_product">


            </div>
          </div>
          <div class="panel-footer">
            <a href="cheakout.php" class="btn btn-info"> Go to cheakout</a>
          </div>
        </div>
       </li>
    </ul>
    </ul>
</nav>
