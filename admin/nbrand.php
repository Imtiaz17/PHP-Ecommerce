<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}
require_once '../core/db.php ';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


$sql2="SELECT * FROM categories where parent !=0";
$cd= mysqli_query($db,$sql2);







//Delete from database
if (isset($_GET['delete'])) {
    $did = (int)$_GET['delete'];
    $dquery = "delete from brand where id='$did'";
    $result = $db->query($dquery);
    header('Location: nbrand.php');
}

//
if (isset($_POST['add'])) {
    $category = $_POST['subcat'];
    $brand = $_POST['brand'];
    if ($brand == "") {
        $error = 'you must enter a brand';
    } else {
        $sqlform = "select * from brand where brand_name='$brand' and cat_id = '$subcat'";
        $fresult = $db->query($sqlform);
        $count = mysqli_num_rows($fresult);
        if ($count > 0) {
            $error = $brand . ' already exists';
        } else {
            $addsql = "insert into brand (brand_name,cat_id) values ('$brand','$category')";
            mysqli_query($db, $addsql);
            header('Location: nbrand.php');
        }

    }

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
            <legend> Add Brand</legend>
            <form class="form" action="nbrand.php" method="post">
                <div class="form-group">
                    <label for="cat">Category</label>
                    <select class="form-control" id="cat" name="cat">
                        <option value="0">Parent</option>
                        <?php
                        $sql = "SELECT * FROM categories where parent=0";
                        $cdb= mysqli_query($db,$sql);
                        while ($f=mysqli_fetch_assoc($cdb)){?>
                            <option value="<?= $f['id'] ?>"><?= $f['category'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subcat">Sub-category</label>
                    <select id="subcat" name="subcat" class="form-control">
                        <option value="">Select Subcategory</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" name="brand" id="brand">
                </div>
                <div class="form-group">
                    <input type="submit" name="add" class="btn btn-success"
                           value=" Add Brand">
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
                <?php
                while ($subfetch= mysqli_fetch_assoc($cd)) { ?>
                    <tr class="bg-primary">
                        <td><?= $subfetch['category']; ?></td>
                        <td>Brand</td>
                        <td>
                            <a href="bedit.php?edit=<?= $subfetch['id']; ?>"
                               class="btn btn-xs btn-default"><span
                                        class="glyphicon glyphicon-pencil"></span></a>
                            <a href="nbrand.php?delete=<?= $subfetch['id']; ?>"
                               class="btn btn-xs btn-default"><span
                                        class="glyphicon glyphicon-remove-sign"></span></a>
                        </td>
                    </tr>
                    <?php
                    $catid = (int)$subfetch['id'];
                    $catsql = "select * from brand where cat_id='$catid'";
                    $catresult = $db->query($catsql);
                    while ($fbrand = mysqli_fetch_assoc($catresult)) { ?>
                        <tr>
                            <td><?= $subfetch['category']; ?></td>
                            <td><?= $fbrand['brand_name']; ?></td>

                            <td>
                                <a href="bedit.php?edit=<?= $fbrand['id']; ?>"
                                   class="btn btn-xs btn-default"><span
                                            class="glyphicon glyphicon-pencil"></span></a>
                                <a href="nbrand.php?delete=<?= $fbrand['id']; ?>"
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

<script type="text/javascript">{
        $(document).ready(function () {
            $('#cat').on('change', function () {//change function on country to display all state
                let catid = $(this).val();
                if (catid) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajax.php',
                        data: 'catid=' + catid,
                        success: function (html) {
                            $('#subcat').html(html);
                        }
                    });
                } else {
                    $('#subcat').html('<option value="">Select category first</option>');

                }
            });
        })
    }

</script>
<?php
include 'includes/footer.php';
?>
