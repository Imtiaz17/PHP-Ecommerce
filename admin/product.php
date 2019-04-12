<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}
include '../core/db.php ';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


//$db= new Database();
$query = "select * from product order by id";
$read = $db->query($query);

if (isset($_GET['featured'])) {
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featuredsql = "update product set featured='$featured' where id='$id'";
    $db->query($featuredsql);
    echo "<script>window.location='product.php'</script>";
}
if (isset($_GET['delete'])) {
    $did=(int)$_GET['delete'];
    $dquery="delete from product where id='$did'";
    $result= $db->query($dquery);
    echo "<script>window.location='product.php'</script>";
}

?>
<?php if (isset($_GET['msg'])) {
    echo "<h3  style='color:green' >" . $_GET['msg'] . "</h3>";
} ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Prodcuts</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <a href="addproduct.php" class="btn btn-success pull-right" id=" add-product" style="margin-bottom: 10px;">ADD PRODUCT</a>
                    <table class="table table-hover">
                        <tr>
                            <th>Action</th>
                            <th>Product</th>
                            <th>Previous Price</th>
                            <th>Price</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Featured</th>
                            <th>Description</th>

                        </tr>

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
                                    <a href="update.php?edit=<?= $row['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp
                                    <a href="product.php?delete=<?= $row['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                                </td>
                                <td><?= $row['title']; ?></td>
                                <td><?= $row['pp']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['brand']; ?></td>
                                <td><?= $category; ?></td>
                                <td><a href="product.php?featured=<?= (($row['featured'] == 0) ? '1' : '0'); ?>& id=<?= $row['id']; ?>" class="btn btn-xs btn-default">
                                        <span class="glyphicon glyphicon-<?= (($row['featured'] == 1) ? 'minus' : 'plus'); ?>"></span>
                                    </a> &nbsp<?= (($row['featured'] == 1) ? 'Featured product' : ''); ?></td>
                                <td><?php echo substr($row ['description'],0,30); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'includes/footer.php';
?>
