<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}
require_once '../core/db.php ';
include 'includes/head.php';
include 'includes/navbar.php';

$sql = "SELECT * FROM categories where parent=0";
$pquery = $db->query($sql);



$id=$_GET['edit'];
echo $id;
//Edit

$brandid = "select * from brand where cat_id ='$id'";


$getData = $db->query($brandid);
$row = mysqli_fetch_assoc($getData);

$brandn=$row['brand_name'];
$catid=$row['cat_id'];

$catquery="select * from categories where id='$catid'";
$catparent=$db->query($catquery);
$catfetch=mysqli_fetch_assoc($catparent);
$parent=$catfetch['category'];
$parentid=$catfetch['id'];




//edit
if (isset($_POST['submit'])) {
    $id=$_GET['edit'];
    $category = $_POST['cat'];
    $brand = $_POST['brand'];
    if ($brand == '') {
        $error = 'you must enter a brand';
    } else {
        $sqlform = "select * from brand where brand_name='$brand' and cat_id = '$category'";
        $fresult = $db->query($sqlform);
        $count = mysqli_num_rows($fresult);
        if ($count > 0) {
            $error = $brand . ' already exists';
        }
        else {
            $addsql = "update brand set brand_name='$brand', cat_id='$category' where id='$id'";
            mysqli_query($db,$addsql);
            header('Location:nbrand.php');




        }

    }

}

$cat_value = '';
$parent_value = 0;
if (isset($_GET['edit'])) {
    $brand_value = $brandn;
    $parent_value = $parent;
}

?>


<?php if (isset($error)) {
    echo "<h4 style='color:red'>" . $error . "</h4>";
} ?>
<?php if (isset($_GET['msg'])) {
    echo "<h3  style='color:green' >" . $_GET['msg'] . "</h3>";
} ?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <legend> Update Brand</legend>
            <form class="form" action="bedit.php" method="post">
                <div class="form-group">
                    <label for="cat">Parent</label>
                    <select class="form-control" id="cat" name="cat">
                        <option value="0"<?= (($parent_value== 0) ? ' selected="selected"' : ''); ?>>Parent</option>
                            <?php while ($category = mysqli_fetch_assoc($pquery)) { ?>
                                <option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand"  class="form-control" value="<?=$brand_value;?>" >
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success"
                           value="Update Brand">
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <legend>All category</legend>
            <table class="table table-bordered">
                <thead>
                <th>Category</th>
                <th>Brand</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php $psql = "SELECT * FROM categories where parent=0";
                $cquery = $db->query($psql);
                while ($fcategory = mysqli_fetch_assoc($cquery)) { ?>
                    <tr class="bg-primary">
                        <td><?= $fcategory['category'];?></td>
                        <td>Brand</td>
                        <td>
                            <a href="bedit.php?edit=<?= $fcategory['id']; ?>"
                               class="btn btn-xs btn-default"><span
                                    class="glyphicon glyphicon-pencil"></span></a>
                            <a href="bedit.php?delete=<?= $fcategory['id']; ?>"
                               class="btn btn-xs btn-default"><span
                                    class="glyphicon glyphicon-remove-sign"></span></a>
                        </td>
                    </tr>
                    <?php
                    $catid = (int)$fcategory['id'];
                    $catsql = "select * from brand where cat_id='$catid'";
                    $catresult = $db->query($catsql);
                    while ($fbrand = mysqli_fetch_assoc($catresult)) { ?>
                        <tr>
                            <td><?= $fcategory['category']; ?></td>
                            <td><?= $fbrand['brand_name']; ?></td>

                            <td>
                                <a href="bedit.php?edit=<?= $fbrand['id']; ?>"
                                   class="btn btn-xs btn-default"><span
                                        class="glyphicon glyphicon-pencil"></span></a>
                                <a href="bedit.php?delete=<?= $fbrand['id']; ?>"
                                   class="btn btn-xs btn-default"><span
                                        class="glyphicon glyphicon-remove-sign"></span></a>
                            </td>
                        </tr>
                    <?php } ?><?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
