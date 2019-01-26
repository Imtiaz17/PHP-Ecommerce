<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}
require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navbar.php';
include 'includes/footer.php';
$conn = new Database();
$bsql = "SELECT * FROM brand ORDER BY brand";
$csql = "SELECT * FROM categories where parent=0 order by category";
$bquery = $conn->getall($bsql);
$cquery = $conn->getall($csql);


if (isset($_POST['submit'])) {
    $name = sanitize($_POST['title']);
    $pprice = sanitize($_POST['pp']);
    $price = sanitize($_POST['price']);;
    $brand = sanitize($_POST['brand']);
    $cat = sanitize($_POST['child']);
    $description = sanitize($_POST['description']);
    //image
    $allowed = array('jpg', 'jpeg', 'png');
    $pro_image = $_FILES['image']['name'];
    $pro_temp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $div = explode('.', $pro_image);
    $file_ext = strtolower(end($div));

    if ($name == '' || $price == '' || $brand == '' || $cat == '' || $description == '') {
        $error = " Field  must not be empty";

    }
    if ($file_size > 1024) {
        $error = " File size must be less then 1 mb";
    }
    if (in_array($file_ext, $allowed) === false) {
        $error = " Only jpg,jpeg,png file supported ";
    } else {
        move_uploaded_file($pro_temp, "../img/$pro_image");
        $dbinsert = "INSERT INTO product (title,pp,price,brand,cat,image,description) VALUES ('$name','$pprice','$price','$brand','$cat','$pro_image','$description') ";
        $create = $conn->insert($dbinsert);
        header('Location:product.php');
    }


} ?>

<?php if (isset($error)) {
    echo "<h4 style='color:red'>" . $error . "</h4>";
} ?>
<h2 class="text-center">Add a new product</h2>
<a href="addproduct.php" class="btn btn-default pull-right id=" product" style="margin-top: -30px;" >Cancel</a>
<hr>

<form action="addproduct.php" method="post" enctype="multipart/form-data">
    <div class="form-group">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Title</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Brand</b></h4>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="brand">
                            <option value="">Select Brand</option>
                            <?php while ($brandresult = mysqli_fetch_assoc($bquery)) : ?>
                                <option value="<?= $brandresult['brand']; ?>"><?= $brandresult['brand']; ?></option>
                            <?php endwhile; ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Category</b></h4>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="cat" id="cat">
                            <option value=""<?= ((isset($_POST['cat']) && $_POST['cat'] == '') ? 'selected' : ''); ?> ></option>
                            <?php while ($catresult = mysqli_fetch_assoc($cquery)) : ?>
                                <option value="<?= $catresult['id']; ?>"<?= ((isset($_POST['category']) && $_POST['category'] == $catresult['id']) ? 'selected' : ''); ?>><?= $catresult['category']; ?></option>
                            <?php endwhile; ?>

                        </select>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Sub-catgory</b></h4>
                    </div>
                    <div class="col-md-6">
                        <label for="child"></label>
                        <select id="child" name="child" class="form-control"></select>
                    </div>
                </div>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Previous Price</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="pp" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Price</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="price" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>


        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Image</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4><b>Description</b></h4>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="5" name="description" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <input type="submit" name="submit" value="Add product" class="form-control  btn btn-success pull-right">
            </div>
        </div>


    </div>
</form>
<script>
    function get_child_options() {
        let parentID = jQuery('#cat').val();
        jQuery.ajax({
            url: "ajax.php",
            type: 'POST',
            data: {parentID: parentID},
            success: function (data) {
                jQuery('#child').html(data);
            }


        });
    }


    jQuery('select[name="cat"]').change(get_child_options);


</script>
