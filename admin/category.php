<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}
require_once '../core/db.php ';
include 'includes/head.php';
include 'includes/navbar.php';

$sql = "SELECT * FROM categories where parent=0";
$pquery = mysqli_query($db,$sql);
$sql2 = "select * from categories where parent=0";
$squery = mysqli_query($db,$sql2);
//process form


//delete
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "delete from categories where id ='$delete_id'";
    $edit_result = $conn->catdelete($sql);
}
//edit
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit = (int)$_GET['edit'];
    $edit_id = sanitize($edit);
    $sql2 = "select * from categories where id='$edit_id'";
    $edit_result = mysqli_query($db,$sql2);
    $dbcat = mysqli_fetch_assoc($edit_result);

}
//add
if (isset($_POST['add'])) {
    $parent = $_POST['parent'];
    $category = $_POST['category'];


    if ($category == "") {
        $error = 'you must enter a category';
    } else {
        $sqlform = "select * from categories where category='$category' and parent = '$parent'";
        $fresult = mysqli_query($db,$sqlform);
        $count = mysqli_num_rows($fresult);
        if ($count > 0) {
            $error = $category . ' already exists';
        } else {
            if (isset($_GET['edit'])) {
                $upsql = "UPDATE categories SET category ='$category', parent='$parent' WHERE id ='$edit_id'";
                $up = mysqli_query($db,$upsql);
            } else {
                $addsql = "insert into categories (category, parent) values ('$category','$parent')";
                $final = mysqli_query($db,$addsql);
                header('Location: category.php');
            }

        }

    }
}
$cat_value = '';
$parent_value = 0;
if (isset($_GET['edit'])) {
    $cat_value = $dbcat['category'];
    $parent_value = $dbcat['parent'];
}
?>
<?php if (isset($error)) {
    echo "<h4 style='color:red'>" . $error . "</h4>";
} ?>
<?php if (isset($_GET['msg'])) {
    echo "<h3  style='color:green' >" . $_GET['msg'] . "</h3>";
}?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <legend><?= ((isset($_GET['edit'])) ? 'Edit' : 'Add ') ?> a category</legend>
            <form class="form" action="category.php<?= ((isset($_GET['edit'])) ? '?edit=' . $edit_id : ''); ?>"
                  method="post">
                <div class="form-group">
                    <label for="parent">Parent</label>
                    <select class="form-control" id="parent" name="parent">
                        <option value="0"<?= (($parent_value == 0) ? ' selected="selected"' : ''); ?>>Parent</option>
                            <?php while ($parent = mysqli_fetch_assoc($squery)) { ?>
                                <option value="<?= $parent['id']; ?>"<?= (($parent_value == $parent['id']) ? ' selected="selected"' : ''); ?>><?= $parent['category']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">category</label>
                    <input type="text" class="form-control" name="category" id="cat" value="<?= $cat_value ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="add" class="btn btn-success"
                           value=<?= ((isset($_GET['edit'])) ? 'Edit' : 'Add') ?>   " a category">
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <legend>All category</legend>
            <table class="table table-bordered">
                <thead>
                <th>Category</th>
                <th>Parent</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php while ($parent = mysqli_fetch_assoc($pquery)) { ?>
                        <tr class="bg-primary">
                            <td><?= $parent['category'] ?></td>
                            <td>parent</td>
                            <td>
                                <a href="category.php?edit=<?= $parent['id']; ?>" class="btn btn-xs btn-default"><span
                                            class="glyphicon glyphicon-pencil"></span></a>
                                <a href="category.php?delete=<?= $parent['id']; ?>" class="btn btn-xs btn-default"><span
                                            class="glyphicon glyphicon-remove-sign"></span></a>
                            </td>
                        </tr>
                        <?php $parent_id = (int)$parent['id'];
                        $sql2 = "select * from categories where parent='$parent_id'";
                        $cresult = mysqli_query($db,$sql2);
                        while ($child = mysqli_fetch_assoc($cresult)) { ?>
                            <tr>
                                <td><?= $child['category'] ;?></td>
                                <td><?= $parent['category']; ?></td>
                                <td>
                                    <a href="category.php?edit=<?= $child['id']; ?>"
                                       class="btn btn-xs btn-default"><span
                                                class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="category.php?delete=<?= $child['id']; ?>"
                                       class="btn btn-xs btn-default"><span
                                                class="glyphicon glyphicon-remove-sign"></span></a>
                                </td>
                            </tr>
                        <?php } } ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
