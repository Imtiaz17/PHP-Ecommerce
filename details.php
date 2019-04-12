<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';

?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];
}
$sql = "select * from product where id='$id'";
$sqlresult = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($sqlresult)
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="productMain" class="row">
                <div class="col-md-6">
                    <div class="ui">
                        <img height="300px" width="500px" id="zoom" src="img/<?=$row['image'];?>"  alt="<?=$row3['title'];?>"
                             class="img-responsive">
                    </div>
                </div>
                <div class="prodetails col-md-6">
                    <div class="dheader">
                            <p class="text-center"><?=$row['title']?></p>
                        </div>
                       
                                    <div class="row">
                                        <div class="col-md-4">
                                            
                                        </div>
                                        <div class="proprice col-md-7">
                                            <p name='price' >BDT: <?=$row['price']?></p>
                                        </div>
                                    </div>
                               
                        <div class="detailsbody">
                            <form action="details.php" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for="qty" class="qty col-md-5 control-label"> Quantity</label>
                                    <div class="col-md-4">
                                        <select name="product_qty" id="qty" class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="size col-md-5 control-label">Size</label>
                                    <div class="col-md-4">
                                        <select name="product_size" class="allsize form-control">
                                            <option disabled selected value>Select a Size</option>
                                            <option>Small</option>
                                            <option>Medium</option>
                                            <option>Large</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-4">

                                <button id="dproduct" pid="<?=$row['id']?>" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-shopping-cart" ></span> Add to cart
                                </button>
                            </div>
                            </form>
                        </div>
                       
                    </div>

                     <div class="share">
                            <h3>Share</h3>
                            <div class="social">
                                <a href="#" class="fa fa-facebook"></a>
                                <a href="#" class="fa fa-twitter"></a>
                                <a href="#" class="fa fa-google"></a>
                                <a href="#" class="fa fa-linkedin"></a>
                                <a href="#" class="fa fa-instagram"></a>
                               
                        </div>
                        </div>
                </div>
                </div>
                </div>
          <hr>
          <div class="proinfo">
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Description</a></li>
 
    <li><a data-toggle="tab" href="#menu2">Review</a></li>
    <li><a data-toggle="tab" href="#menu3">Shipping & Delivery</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3><?=$row['title']?></h3>
      <p><?=$row['description']?></p>
    </div>
   
    <div id="menu2" class="tab-pane fade">
      
<div class="row">
    <div class="col-md-4">
        <h2 class="text-center">Reviews</h2>
<p class="text-center">There are no reviews yet.</p> 
    </div>   
    <div class="col-md-8">

<h3 class="text-center">BE THE FIRST TO REVIEW </h3>
<p class="text-center">
Your email address will not be published. Required fields are marked *.</p>
<form class="form-horizontal" action="/action_page.php">
    <div class="form-group">
      <label class="control-label col-sm-2" for="review">Your review :</label>
      <div class="col-sm-10">
       <textarea rows="4" cols="50" class="form-control" id="review"  name="review"></textarea>
       
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Your Name:</label>
      <div class="col-sm-4">          
        <input type="text" class="form-control" id="name" = name="name">
      </div>
      <label class="control-label col-sm-2" for="email">Your Email:</label>
      <div class="col-sm-4">          
        <input type="email" class="form-control" id="email" name="email">
      </div>
      </div>
      <div class="col-md-12 col-md-offset-10"> <input type="submit" class="btn btn-default" name="submit"></div>
     
  </form>
  </div>   
</div>
    </div>
    <div id="menu3" class="tab-pane fade">
    <img src="img/shipping.jpg" class="shipimg">
    <p class="shiptext">Vestibulum curae torquent diam diam commodo parturient penatibus nunc dui adipiscing convallis bulum parturient suspendisse parturient a.Parturient in parturient scelerisque nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat net
    <br> <br>
    Vestibulum parturient suspendisse parturient a.Parturient in parturient scelerisque nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat netus.
    <br>  <br>
    Scelerisque adipiscing bibendum sem vestibulum et in a a a purus lectus faucibus lobortis tincidunt purus lectus nisl class eros.Condimentum a et ullamcorper dictumst mus et tristique elementum nam inceptos hac vestibulum amet elit

</p>
    </div>
  </div>
  </div>


        



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
                    <a href="details.php?id=<?=$product['id'];?>" class="btn btn-success">
                        Details
                    </a>
                    <button id="product" pid="<?=$product['id']?>" class="btn btn-primary">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Add Cart
                    </button>
                </div>
            </div>
        <?php }?>
    </div>
</div>


<?php include 'includes1/footer.php';?>
<script type="text/javascript">
    $('#zoom').elevateZoom({
    zoomType: "inner",
    zoomWindowFadeIn: 500,
    zoomWindowFadeOut: 750
   }); 

</script>


<script type="text/javascript" src="main.js"></script>
