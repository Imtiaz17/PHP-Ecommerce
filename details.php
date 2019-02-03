<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';
include 'includes1/modaldetails.php';
?>
<?php
if (isset($_GET['id'])) {
	echo $id = $_GET["id"];
}
$sql = "select * from product where id='$id'";
$sqlresult = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($sqlresult)
?>
<div class="container">
 <div class="row">
  <div class="col-md-3">
    <div class="panel panel-default sidebar">
      <div class="panel-heading">
        <div class="panel-title">
          Categories
        </div>
      </div>
      <div class="panel-body">

        </ul>

    </div>
  </div>
</div>
<div class="col-md-9"><!-- col-md-9 Begin -->
 <div id="productMain" class="row"><!-- row Begin -->
   <div class="col-md-6"><!-- col-sm-6 Begin -->
    <div class="ui"><!-- #mainImage Begin -->
      <img src="img/<?=$row['image'];?>" alt="<?=$row3['title'];?>"
      class="img-responsive">
    </div><!-- mainImage Finish -->
  </div><!-- col-sm-6 Finish -->

  <div class="col-md-6"><!-- col-md-6 Begin -->
   <div class="panel panel-default sidebar">

    <div class="panel-heading">
     <h4 class="text-center"><?=$row['title']?><h4>
     </div>
     <div class="panel-body">

       <form action="details.php" class="form-horizontal" method="post"><!-- form-horizontal Begin -->
         <div class="form-group"><!-- form-group Begin -->
           <label for="" class="col-md-5 control-label">Products Quantity</label>

           <div class="col-md-7"><!-- col-md-7 Begin -->
            <select name="product_qty" id="" class="form-control"><!-- select Begin -->
             <option>1</option>
             <option>2</option>
             <option>3</option>
             <option>4</option>
             <option>5</option>
           </select><!-- select Finish -->

         </div><!-- col-md-7 Finish -->

       </div><!-- form-group Finish -->

       <div class="form-group"><!-- form-group Begin -->
         <label class="col-md-5 control-label">Product Size</label>

         <div class="col-md-7"><!-- col-md-7 Begin -->

           <select name="product_size" class="form-control"><!-- form-control Begin -->

             <option disabled selected value>Select a Size</option>
             <option>Small</option>
             <option>Medium</option>
             <option>Large</option>

           </select><!-- form-control Finish -->

         </div><!-- col-md-7 Finish -->
       </div><!-- form-group Finish -->
       <div class="form-group">
         <div class="row">
           <div class="col-md-5">
            <label  for="price" class="col-md-12 control-label">Prize</label>
          </div>
          <div class="col-md-7">
            <p name='price' >BDT <?=$row['price']?></p>
          </div>
        </div>
      </div>


      <p class="text-center buttons"><button class="btn btn-primary i fa fa-shopping-cart"> Add to cart</button></p>




    </form><!-- form-horizontal Finish -->


  </div><!-- box Finish -->

</div><!-- panel default finish -->




</div><!-- Row finish -->



</div><!-- Row finish -->
<div class="box" id="details"><!-- box Begin -->

 <h2>Product Details</h2>

 <div class="panel panel-default">
  <div class="panel-body">
    <p><?=$row['description']?></p>

  </div>
</div>
</div>
</div><!-- Row finish -->

</div><!-- Row finish -->






</div><!-- box Finish -->


<div class="container">
  <hr>
  <div class="header">
    <h2 class="text-center">Product you may be like</h2>
  </div>
  <br>

  <div class="row">
   <?php
$prosql = "SELECT * FROM product Orders LIMIT 2";
$prodb = mysqli_query($db, $prosql);
while ($product = mysqli_fetch_assoc($prodb)) {?>
     <div class="col-md-3 ">
      <div class="fp">
        <h4><?=$product['title'];?></h4>
        <img class="img-thumb" src="img/<?=$product['image'];?>" alt="<?=$product['title'];?>">
        <p class="Price">$<?=$product['price'];?></p>
        <a href="#" class="btn btn-success">
          Details
        </a>
        <a href="#" class="btn btn-primary">
          <span class="glyphicon glyphicon-shopping-cart"></span> Add Cart
        </a>
      </div>
    </div>
  <?php }?>
</div>
</div><!-- col-md-3 col-sm-6 center-responsive Finish -->






<?php include 'includes1/footer.php';?>