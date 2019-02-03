<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';
include 'includes1/modaldetails.php';
?>
<?php
if (isset($_GET['id'])) {
	$id = $_GET["id"];
}
$sql = "select * from brand where cat_id='$id'";
$sqlresult = mysqli_query($db, $sql);
?>
<div class="container">
<div class="col-md-3">
    <div class="panel panel-default sidebar">
        <div class="panel-heading">
            <div class="panel-title">
                Categories
            </div>
        </div>
        <div class="panel-body">
            <?php
while ($row = mysqli_fetch_assoc($sqlresult)) {
	?>
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="<?=$row['id']?>"><?=$row['brand_name'];?></a>
                        </li>

                    </ul>
                <?php }?>
        </div>
    </div>
</div>
    <div class="col-md-9">
        <div class="panel-main">
            <div class="panel panel-default">
                <?php
$catsql = "select * from categories where id= $id";
$catdb = mysqli_query($db, $catsql);
while ($row2 = mysqli_fetch_assoc($catdb)) {
	?>
                <div class="panel-heading">
                    <p><?=$row2['category']?></p>
                </div>
                <div class="panel-body">
                    <?php
$prosql = "select * from product where cat= $id";
	$prodb = mysqli_query($db, $prosql);
	while ($row3 = mysqli_fetch_assoc($prodb)) {?>
                    <div class="col-md-3 ">
                        <div class="product">
                            <h4><?=$row3['title'];?></h4>
                            <img src="img/<?=$row3['image'];?>" alt="<?=$row3['title'];?>"
                                 class="img-responsive">
                            <p class="Price"><b>Price:</b> $<?=$row3['price'];?></p>
                            <a href="details.php?id=<?=$row3['id'];?>" class="btn btn-success">
                                Details
                            </a>
                            <a href="#" class="btn btn-primary">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Add Cart
                            </a>
                        </div>
                    </div>
                    <?php }?>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
    </div>



<?php include 'includes1/footer.php';?>
