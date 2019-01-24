
<?php
require_once 'core/init.php';
$conn= new Database;
$sql= "select * from categories where parent=0";
$result=$conn->getall($sql);
?>

<nav class="main-menu">
    <ul>
        <?php if ($result) { ?>
        <?php while ($parent = $result->fetch_assoc()) { ?>
        <li><a href="#"><?=$parent['category']?></a>
            <ul>
                <?php $parent_id = (int)$parent['id'];
                $sql2 = "select * from categories where parent='$parent_id'";
                $cresult = $conn->getall($sql2);
                if ($cresult){
                while ($child = $cresult->fetch_assoc()) { ?>
                <li><a href="#"><?=$child['category']?></a>
                <?php }?>
            </ul>
            <?php } ?><?php } ?><?php } else { ?>
                <p>Data is not available </p>
            <?php } ?>
        </li>


    </ul>
</nav>
<div class="main-content">

    <h1>Hello this is imtiaz</h1>
</div>