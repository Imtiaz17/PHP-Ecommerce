<?php
require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';
$sid = $_SESSION['id'];
$user="select * from user where id=$sid";
$run_user = mysqli_query($db,$user);
$row_user = mysqli_fetch_array($run_user);
$user_id = $row_user['id'];


?>
<br>
<div class="container">
  <div class="row">
  	<div class="col-md-3"></div>
  	<div class="col-md-6">
    <div class="panel panel-info">
    <div class="panel-heading text-center" style="font-size: 30px; font-weight: bold;">Select Payment Option</div>
    <div class="panel-body">
      <div class="row">
      	<img src="img/cash.png"  width="30%" height="20%" style="float: left">
      	<a href="order.php?c_id=<?php echo $user_id ?>"> <h3>Place Order</h3> </a>

      </div>
      <div class="row">
      	<img src="img/card.png" width="30%" height="20%" style="float: left">
      	<a href=""> <h3>Coming soon......</h3> </a>

      </div>

    </div>
  </div>
  </div>
  <div class="col-md-3"></div>

  </div>

</div>
