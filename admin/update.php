<?php
session_start();
if (!isset($_SESSION['id'])){
    header("Location: admin.php");
}
require_once '../core/init.php';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$conn = new Database();

$bsql="SELECT * FROM brand ORDER BY brand";
$csql="SELECT * FROM categories where parent=0";
$bquery = $conn->getall($bsql);
$cquery = $conn->getall($csql);

if(isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM product WHERE id='$id'";
    $getData = $conn->getall($query);
    $produc = $getData->fetch_assoc();

    $proname = $produc['title'];
    $proprice = $produc['price'];
    $prolistprice = $produc['pp'];
    $probrand = $produc['brand'];

    $proimage = $produc['image'];
    $prodescription = $produc['description'];

    $cat = $produc['cat'];
    $getcat = "select * from categories where id='$cat'";
    $getcatt = $conn->getall($getcat);
    $catpro = $getcatt->fetch_assoc();
    $parent = $catpro['parent'];
    $procat = $catpro['category'];
    $sub = "select * from categories where parent='$parent'";
    $subb = $conn->getall($sub);
    $subfetch = $subb->fetch_assoc();
    $brandid = $subfetch['id'];
    $getbrand = "select * from brand where cat_id='$brandid'";
    $getbrandd = $conn->getall($getbrand);


    $subcat = $catpro['category'];
    $parentsql = "select * from categories where id ='$parent'";
    $parentsqll = $conn->getall($parentsql);

    $catpro = $parentsqll->fetch_assoc();


    if (isset($_POST['submit'])) {
        $title = $_POST['name'];
        $brand = $_POST['brand'];
        $category = $_POST['cat'];
        $price = $_POST['price'];
        $pp = $_POST['preprice'];
        $description = $_POST['description'];
        $pro_image = $_FILES['image']['name'];
        $pro_temp = $_FILES['image']['tmp_name'];

        if ($title == '' || $price == '' || $brand == '' || $category == '' || $pp == '' || $price == '' || $description == '') {
            $error = " Field  must not be empty";
        } else {
            if (is_uploaded_file($pro_temp)) {
                move_uploaded_file($pro_temp, "../images/$pro_image");
                $dbupdate = "update  product set title='$title',pp='$pp',price='$price',brand='$brand',cat='$category',image='$pro_image',description= '$description' where id='$id'";
                $update = $conn->productupdate($dbupdate);

            } else {
                $dbup = "update  product set title='$title',pp='$pp',price='$price',brand='$brand',cat='$category',description= '$description' where id='$id'";
                $update = $conn->productupdate($dbupdate);
                var_dump($update);
            }
        }

    }
}
?>
    <section class="content">
        <div class="col-md-12">
            <div class="box box-primary">
                <?php if (isset($error)) {
                    echo "<h4 style='color:red'>".$error."</h4>";
                } ?>
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Product</h3>
                </div>
                <div class="box-body">
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h4><b>Title</b></h4>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="name" class="form-control" value="<?=$proname;?>">
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
                                            <label for="cat">Category</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control"  name="cat" id="cat">
                                                <option value="<?=$procat;?>"><?=$procat;?></option>
                                                <?php

                                                while ($row=$cquery->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['category'];?>"><?php echo $row['category']?></option>"
                                                <?php }	?>

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
                                            <label for="subcat">Sub- Category</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select id="subcat" name="subcat" class="form-control">
                                                <option value="<?php if (isset($subcat) ? ' selected="selected"' : ''); ?>"> <?=$subcat?>  </option>
                                                <?php while (  $subfetch=$subb->fetch_assoc()) { ?>
                                                    <option value="<?= $subfetch['category']; ?>"> <?= $subfetch['category']; ?></option>
                                                <?php } ?>
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
                                            <h4><b>Brand</b></h4>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control"  name="brand" id="brand">
                                                <option value="<?php if (isset($probrand) ? ' selected="selected"' : ''); ?>"> <?=$probrand?>  </option>
                                                <?php
                                                while ( $brandfetch=$getbrandd->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $brandfetch['brand_name'];?>"><?php echo $brandfetch['brand_name']?></option>";
                                                <?php }	?>

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
                                            <input type="text" name="price" class="form-control" value="<?=$proprice?>">
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
                                            <input type="text" name="preprice" class="form-control" value="<?=$prolistprice?>">
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
                                            <h4><b>Image</b></h4>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" name="image" id="image" class="form-control">
                                            <img src="../images/<?= $proimage; ?>" alt="img" style="width:100px; height: 100px;">
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
                                            <textarea rows="5" name="description" class="form-control"><?=$prodescription;?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <input type="submit" name="submit" value="update Product " class="form-control  btn btn-success pull-right">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $('#cat').on('change', function () {//change function on country to display all state
                let subcat = $(this).val();
                if (subcat) {
                    $.ajax({
                        method: 'POST',
                        url: 'ajax.php',
                        data: 'subcat=' + subcat,
                        success: function (html) {
                            $('#subcat').html(html);
                        }
                    });
                } else {
                    $('#subcat').html('<option value="">Select category first</option>');

                }
            });
            //    Get brand option
            $('#subcat').on('change', function () {//change function on country to display all state
                let subcatid = $(this).val();
                if (subcatid) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajax.php',
                        data: 'subcatid=' + subcatid,
                        success: function (html) {
                            $('#brand').html(html);
                        }
                    });
                } else {
                    $('#brand').html('<option value="">Select Brand first</option>');
                }
            });
        });

    </script>
<?php
include 'includes/footer.php';
?>