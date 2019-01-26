<?php
require_once 'core/init.php';
$conn = new Database;
$sql = "select * from categories where parent=0";
$result = $conn->getall($sql);
$sql2 = "select * from product where featured=1";
$featured = $conn->getall($sql2);
?>

<nav class="main-menu">
    <ul>
        <?php if ($result) { ?>
        <?php while ($parent = $result->fetch_assoc()) { ?>
        <li><a href="#"><?= $parent['category'] ?></a>
            <ul>
                <?php $parent_id = (int)$parent['id'];
                $sql2 = "select * from categories where parent='$parent_id'";
                $cresult = $conn->getall($sql2);
                if ($cresult){
                while ($child = $cresult->fetch_assoc()) { ?>
                <li><a href=""><?= $child['category'] ?></a>
                    <?php } ?>
            </ul>
            <?php } ?><?php } ?><?php } else { ?>
                <p>Data is not available </p>
            <?php } ?>
        </li>


    </ul>
</nav>

<div class="carosal">
    <div class="item"><img src="img/e1.jpg" alt="">
        <div class="slider-contant">
            <div class="slider-titile"><h1>Welcome to e-Bazar </h1></div>
            <div class="slider-details"><h4>A digital ecommerce shopping mall</h4></div>
        </div>
    </div>
    <div class="item"><img src="img/e5.jpg" alt="">
        <div class="slider-contant">
            <div class="slider-titile"><h1>Buy & Sell Anything </h1></div>
            <div class="slider-details"><h4>Because we are trushworthy!</h4></div>
        </div>
    </div>

    <div class="item"><img src="img/e3.jpg" alt="">
        <div class="slider-contant">
            <div class="slider-titile"><h1>Best deals on every products</h1></div>
            <div class="slider-details"><h4> Customers are our pride!</h4></div>
        </div>
    </div>
</div>
<br>



