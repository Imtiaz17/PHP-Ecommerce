<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}

require_once '../core/init.php ';
include 'includes/head.php';
include 'includes/navbar.php';
$conn = new Database();

$sql = "SELECT * FROM brand ORDER BY brand";
$pquery = $conn->getall($sql);
$csql = "SELECT * FROM categories where parent=0 order by category";
$cquery = $conn->getall($csql);


//delete brand
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "delete from brand where id ='$delete_id'";
    $edit_result = $conn->branddelete($sql);
    header('Location:brand.php');

}
//edit brand
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit = (int)$_GET['edit'];
    $edit_id = sanitize($edit);
    $sql2 = "select * from brand where id='$edit_id'";
    $edit_result = $conn->getall($sql2);
    $dbrand = mysqli_fetch_assoc($edit_result);
    $catid = $dbrand['cat_id'];
    $catsql = "select * from categories where id='$catid'";
    $catconn = $conn->getall($catsql);
    $catfetch = mysqli_fetch_assoc($catconn);


}
//add
if (isset($_POST['add'])) {


    if ($_POST['addbrand'] == "") {
        $error = 'you must enter a brand';
    } else {
        $brand = sanitize($_POST['addbrand']);
        $cf = sanitize($_POST['cat']);
        $sql = "SELECT * FROM brand WHERE brand='$brand'";
        $result = $conn->getall($sql);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $error = $brand . ' already exists';
        } else {
            if (isset($_GET['edit'])) {
                $upsql = "UPDATE brand SET brand_name ='$brand', cat_id='$cf' WHERE id ='$edit_id'";
                $up = $conn->brandupdate($upsql);
            } else {
                $addsql = "insert into brand (brand_name,cat_id) values ('$brand','$cf')";
                $final = $conn->brandinsert($addsql);
            }

        }

    }
}
?>
<?php if (isset($error)) {
    echo "<h4 style='color:red'>" . $error . "</h4>";
} ?>
<hr>
<?php if (isset($_GET['msg'])) {
    echo "<h3  style='color:green' >" . $_GET['msg'] . "</h3>";
} ?>
<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form class="form-inline" action="brand.php<?= ((isset($_GET['edit'])) ? '?edit=' . $edit_id : ''); ?>"
              method="post">
            <div class="form-group mx-sm-3" style="margin-left: 70px;">
                <?php $brand_value = '';
                $parentval = 0;
                if (isset($_GET['edit'])) {
                    $brand_value = $dbrand['brand_name'];
                    $parentval = $catfetch['category'];

                } else {
                    if (isset($_POST['brand'])) {
                        $brand_value = sanitize($_POST['brand']);
                    }
                } ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <label for="cat"><?= ((isset($_GET['edit'])) ? 'Edit' : 'Add'); ?> Category:</label>
                    <select class="form-control" name="cat" id="cat">
                        <option value="<=$catfetch['id']?>"><?= ((isset($_GET['edit'])) ? $parentval : 'Parent'); ?></option>
                        <?php while ($catresult = mysqli_fetch_assoc($cquery)) : ?>
                            <option value="<?= $catresult['id']; ?>"<?= (($parentval == $catresult['id']) ? ' selected="selected"' : ''); ?>><?= $catresult['category']; ?></option>
                        <?php endwhile; ?>

                    </select>

                </div>
                <br>
                <label for="brand"><?= ((isset($_GET['edit'])) ? 'Edit' : 'Add a'); ?> Brand:</label>
                <input type="text" class="form-control" name="addbrand" id="addbrand" placeholder="Add a brand"
                       value="<?= $brand_value; ?>">
                <?php if (isset($_GET['edit'])): ?>
                    <a href="brand.php" class="btn btn-default">Cancel</a>
                <?php endif; ?>

                <input type="submit" name="add" value="<?= ((isset($_GET['edit'])) ? 'Edit' : 'Add'); ?> Brand"
                       class="btn btn-success">
            </div>
            <br>
            <br>
        </form>

        <table class="table table-bordered table-striped table-condensed">
            <th>Edit</th>
            <th>Brand</th>
            <th>category</th>
            <th>Delete</th>
            <?php
            $sql = "SELECT * FROM brand";
            $pquery = $conn->getall($sql);
            if ($pquery){
            while ($row = $pquery->fetch_assoc()) {
                $catid = $row['cat_id'];
                $catsql = "select * from categories where id='$catid'";
                $catconn = $conn->getall($catsql);
                $catfetch = mysqli_fetch_assoc($catconn);

                ?>
                <tr>
                    <td><a href="brand.php?edit=<?= $row['id']; ?>" class="btn btn-xs btn-default"><span
                                    class="glyphicon glyphicon-pencil"></span></a></td>

                    <td> <?= $row['brand_name']; ?></td>
                    <td> <?= $catfetch['category']; ?></td>

                    <td><a href="brand.php?delete=<?= $row['id']; ?>" class="btn btn-xs btn-default"><span
                                    class="glyphicon glyphicon-remove-sign"></span></a></td>
                </tr>
            <?php } } else {?>
            <p>No data</p>
            <?php } ?>


        </table>
    </div>
</div>
