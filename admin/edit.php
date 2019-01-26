<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin.php");
}
require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navbar.php';
$conn = new Database();
$bsql = "SELECT * FROM brand ";
$csql = "SELECT * FROM categories where parent=0";
$bquery = $conn->getall($bsql);
$cquery = $conn->getall($csql);
//getid
$id = (int)$_GET['id'];

$query = "select * from product where id ='$id'";
$getData = $conn->getall($query);
$row = mysqli_fetch_assoc($getData);
$pro_title = $row['title'];
$pro_brand = $row['brand'];
$pro_price = $row['price'];
$pro_listprice = $row['list_price'];
$pro_image = $row['image'];
$pro_des = $row['description'];
$pro_brand = $row['brand'];
$pro_cat = $row['cat'];

$parentsql="select * from categories where id ='$pro_cat'";
$parentresult = $conn->getall($parentsql);
$parentfetch = mysqli_fetch_assoc($parentresult);
$parentid=$parentfetch['parent'];
$psql = "select * from categories where id='$parentid'";
$presult = $conn->getall($psql);
$pfetch =mysqli_fetch_assoc($presult);


$catsql = "select * from categories where id ='$pro_cat'";
$catr = $conn->getall($catsql);
$catf = mysqli_fetch_assoc($catr);



if (isset($_POST['submit'])) {
    $name = sanitize($_POST['title']);
    $price = sanitize($_POST['price']);
    $list_price = sanitize($_POST['list_price']);;
    $brand = sanitize($_POST['brand']);
    $cat = sanitize($_POST['child']);
    $description = sanitize($_POST['description']);
    $pro_image = $_FILES['image']['name'];
    $pro_temp = $_FILES['image']['tmp_name'];

    if ($name == '' || $price == '' || $brand == '' || $cat == '' || $description == '') {
        $error = " Field  must not be empty";
    } else {
        if (is_uploaded_file($pro_temp)) {
            move_uploaded_file($pro_temp, "../images/$pro_image");
            $dbinsert = "update  product set title='$name',price='$price',list_price='$list_price',brand='$brand',cat='$cat',image='$pro_image',description= '$description' where id='$id'";
            $update = $conn->update($dbinsert);
            header('Location:product.php');
        }
        else{
            $dbinsert = "update  product set title='$name',price='$price',list_price='$list_price',brand='$brand',cat='$cat',description= '$description' where id='$id'";
            $update = $conn->update($dbinsert);
            header('Location:product.php');
        }
    }


} ?>

<?php if (isset($error)) {
    echo "<h4 style='color:red'>" . $error . "</h4>";
} ?>
<h2 class="text-center">Add a new product</h2>
<a href="product.php" class="btn btn-default pull-right id=" product" style="margin-top: -30px;" >Cancel</a>
<hr>

<form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>Title</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="title" value="<?= $pro_title; ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>Brand</b></h4>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="brand">

                            <option value="<?= $pro_brand; ?>"><?= $pro_brand; ?></option>
                            <?php while ($brandresult = mysqli_fetch_assoc($bquery)) : ?>
                                <option value="<?= $brandresult['brand']; ?>"<?= ((isset($_POST['brand']) && $_POST['brand'] == $brandresult['id']) ? 'selected' : ''); ?>><?= $brandresult['brand']; ?></option>
                            <?php endwhile; ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>Category</b></h4>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="cat" id="cat">
                            <option value="<?= $pfetch['category']; ?>"><?= $pfetch['category']; ?></option>
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
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>Sub -Category</b></h4>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="child" id="child">
                            <option value="<?= $catf['id']; ?>"><?= $catf['category']; ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>Price</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="price" value="<?= $pro_price; ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>List Price</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="list_price" value="<?= $pro_listprice; ?>"
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>


        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>Image</b></h4>
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="image" id="image" class="form-control">
                        <img src="../images/<?= $pro_image; ?>" alt="img" style="width:100px; height: 100px;">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <h4><b>Description</b></h4>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="5" name="description" value="<?= $pro_des; ?>"
                                  class="form-control"><?= $pro_des; ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <input type="submit" name="submit" value="Update product"
                       class="form-control  btn btn-success pull-right">
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