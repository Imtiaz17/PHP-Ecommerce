<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}
include '../core/db.php ';
include 'includes/head.php';
include 'includes/navbar.php';


//$db= new Database();
$query = "select * from product";
$read = $db->query($query);

if (isset($_GET['featured'])) {
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featuredsql = "update product set featured='$featured' where id='$id'";
    $read = $db->query($featuredsql);
    header('Location: product.php');
}
//if (isset($_GET['delete'])) {
//	$did=$_GET['delete'];
//	$query="delete from product where id=$did";
//	$result= $db->delete($query);
//}

?>
<center><h1>Add Product</h1></center>
<hr>
<?php if (isset($_GET['msg'])) {
    echo "<h3  style='color:green' >" . $_GET['msg'] . "</h3>";
} ?>
<a href="addproduct.php" class="btn btn-success pull-right id="
   add-product" style="margin-bottom: 10px;">ADD PRODUCT</a>
<div class="clearfix"></div>

<table class="table table-bordered table-condensed table-striped">
    <thead>
    <th>Action</th>
    <th>Product</th>
    <th>Price</th>
    <th>List Price</th>
    <th>Brand</th>
    <th>Category</th>
    <th>Featured</th>
    <th>Description</th>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($read)):
        $child = $row['cat'];
        $chilsql = " select * from categories where id='$child'";
        $catresult = $db->query($chilsql);
        $catfetch = mysqli_fetch_assoc($catresult);
        $parentid = $catfetch['parent'];
        $parentsql = "select * from categories where id='$parentid'";
        $parentresult = $db->query($parentsql);
        $parentfetch = mysqli_fetch_assoc($parentresult);
        $category = $parentfetch['category'] . '-' . $catfetch['category'];
        ?>
        <tr>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-xs btn-default"><span
                            class="glyphicon glyphicon-pencil"></span></a> &nbsp
                <a href="product.php?delete=<?= $row['id']; ?>" class="btn btn-xs btn-default"><span
                            class="glyphicon glyphicon-remove-sign"></span></a>
            </td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['price']; ?></td>
            <td><?= $row['list_price']; ?></td>
            <?php $brand_id=$row['brand'];
            $brandsql="select * from brand where id ='$brand_id'";
            $brandresult=$db->query($brandsql);
            $brandfetch=mysqli_fetch_assoc($brandresult);
            ?>
            <td><?= $brandfetch['brand']; ?></td>
            <td><?= $category; ?></td>
            <td><a href="product.php?featured=<?= (($row['featured'] == 0) ? '1' : '0'); ?>& id=<?= $row['id']; ?>"
                   class="btn btn-xs btn-default"><span
                            class="glyphicon glyphicon-<?= (($row['featured'] == 1) ? 'minus' : 'plus'); ?>"></span></a>
                &nbsp<?= (($row['featured'] == 1) ? 'Featured product' : ''); ?></td>
            <td><?= $row['description']; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>









<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<body>
<p> &nbsp; </p>
Text Changing - 
<p> &nbsp; </p>
<section>
<div class="row">
    <span class="col-lg-6 col-md-6 col-xs-6">
    <div class="row text-center">
    <button class='btn btn-info pushme'>PUSH ME</button>
    </div>
    <div class="row">
    </div>
    </span>
</div>



</section>
</body>
$(document).ready(function(){

 
    $(".pushme").click(function () {
       $(this).text("sucess");
       $(this).addClass("btn-success");
       $(this).removeClass("btn-info");
    });
    
    


});