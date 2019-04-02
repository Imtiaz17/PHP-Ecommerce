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
                        <img src="img/<?=$row['image'];?>" alt="<?=$row3['title'];?>"
                             class="img-responsive">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default sidebar">
                        <div class="panel-heading">
                            <h3 class="text-center"><?=$row['title']?><h3>
                        </div>
                        <div class="panel-body">
                            <form action="details.php" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for="" class="col-md-5 control-label">Products Quantity</label>
                                    <div class="col-md-7">
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
                                    <label class="col-md-5 control-label">Product Size</label>
                                    <div class="col-md-7">
                                        <select name="product_size" class="form-control">
                                            <option disabled selected value>Select a Size</option>
                                            <option>Small</option>
                                            <option>Medium</option>
                                            <option>Large</option>
                                        </select>
                                    </div>
                                </div>
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
                                <button id="dproduct" pid="<?=$row['id']?>" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-shopping-cart" ></span> Add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details panel panel-info ">
                <div class="panel-heading">
                    <h3 class="text-left"> Product Details</h3>
                </div>
                <div class="panel-body">
                    <div class="description row">
                        <p><?=$row['description']?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
<script type="text/javascript" src="main.js"></script>
