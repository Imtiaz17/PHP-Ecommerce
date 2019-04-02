<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';
include 'includes1/carosal.php';


$sql = "select * from product where featured=1";
$featured = mysqli_query($db,$sql);
?>

<div class="container">
    <div class="panel panel-default sidebar">
        <div class="panel-heading">
            <h4 class="text-left">Featured Products</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php while ($product = mysqli_fetch_assoc($featured)) { ?>
                    <div class="col-md-3 wrap">
                        <div class="product">
                            <img src="img/<?= $product['image']; ?> " alt="<?= $product['title']; ?>" height="200" width="200">
                            <div class="text-center">
                                <h4><?= $product['title']; ?></h4>
                                <p class="list-price text-danger"> Previous Price <s>$<?= $product['pp']; ?></s></p>
                                <p class="Price"> <b>Now </b> $<?= $product['price']; ?></p>
                            </div>
                            <div class="button text-center">
                                <a href="details.php?id=<?=$product['id'];?>"   class="btn btn-success">
                                    Details  <span class="glyphicon glyphicon-eye-open">
                                </a>
                                <button id="product" pid="<?=$product['id']?>" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>



<!--Category wise product show-->
<?php
$catsql = "select * from categories where parent=0";
$catrun = mysqli_query($db,$catsql);
while ($catchild = mysqli_fetch_assoc($catrun)) {?>
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
                                <div class="col-md-3 wrap">
                                    <div class="product">
                                        <img src="img/<?= $getchild['image']; ?>"alt="<?= $getchild['title'];?>" height="200" width="200">
                                        <div class="text-center">
                                            <h3><?= $getchild['title']; ?></h3>
                                            <p> <b>Price:</b> $<?= $getchild['price']; ?></p>
                                        </div>
                                        <div class="button text-center">
                                            <a href="details.php?id=<?=$getchild['id'];?>" class="btn btn-primary">
                                                Details
                                            </a>
                                            <button id="product" pid="<?=$getchild['id']?>" class="btn btn-success">
                                                <span class="glyphicon glyphicon-shopping-cart"></span> Add Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php } }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include 'includes1/footer.php';?>

    
