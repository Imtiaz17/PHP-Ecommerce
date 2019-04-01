
<?php
require_once 'core/db.php';
$sql = "select * from categories where parent=0";
$result = mysqli_query($db,$sql);
$sql2 = "select * from product where featured=1";
$featured = mysqli_query($db,$sql2);
?>

<nav class="main-menu">
    <ul>
        <?php while ($parent = mysqli_fetch_assoc($result)) { ?>
        <li class="first"><a class="first" href="#"><?= $parent['category'] ?></a>
            <ul class="subcat">
                <?php $parent_id = (int)$parent['id'];
                $sql2 = "select * from categories where parent='$parent_id'";
                $cresult = mysqli_query($db,$sql2);             
                while ($child = mysqli_fetch_assoc($cresult)) { ?>
                <li><a href=""><?= $child['category'] ?></a></li>
                    <?php } ?>   
            </ul>
             </li>

            <?php }?>

      <li class="second"> <a href="#" id="cart"> Cart <span class="badge">0</span></a>
    <ul>
       <li>
         <div class="aa panel panel-info">
          <div class="panel-heading">
            <div class="col row">
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
          <div class="footer">
            <a href="cheakout.php" class="btn btn-info">Check</a>
          </div>
        </div>
       </li>
    </ul>
  </li>
      </ul>
</nav>

