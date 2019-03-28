<?php
session_start();
if (!isset($_SESSION['id'])) {
	header("Location: admin.php");
}

require_once '../core/db.php';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$bsql = "SELECT * FROM brand ORDER BY brand";
$csql = "SELECT * FROM categories where parent=0 order by category";
$bquery = mysqli_query($db, $bsql);
$cquery = mysqli_query($db, $csql);

if (isset($_POST['submit'])) {
	$name = $_POST['title'];
	$pprice = $_POST['pp'];
	$price = $_POST['price'];
	$brand = $_POST['brand'];
	$cat = $_POST['subcat'];
	$description = $_POST['des'];
	$size=$_POST['size'];
	$size = implode(",", $size);
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
    if ($file_size>2024) {
        $error = " File size must be less then 1 mb";
    }
	if (in_array($file_ext, $allowed) === false) {
		$error = " Only jpg,jpeg,png file supported ";
	} else {
		move_uploaded_file($pro_temp, "../img/$pro_image");
		$dbinsert = "INSERT INTO product (title,pp,price,brand,cat,size,image,description) values ('$name','$pprice','$price','$brand','$cat','$size','$pro_image','$description') ";
		$create = mysqli_query($db, $dbinsert);
        echo "<script>window.location='product.php'</script>";
	}

}?>

<?php if (isset($error)) {
	echo "<h4 style='color:red'>" . $error . "</h4>";
}?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Add Product</h3>
				</div>
				<form action="addproduct.php" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label for="title">Title</label></div>
								<div class="col-md-4"><input type="text" id="title" name="title" class="form-control"></div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="cat">Category</label></div>
										<div class="col-md-6">
											<select class="form-control" name="cat" id="cat">
												<option value=""<?=((isset($_POST['cat']) && $_POST['cat'] == '') ? 'selected' : '');?> selected="true" disabled="disabled" >
													Select Category
												</option>
												<?php while ($catresult = mysqli_fetch_assoc($cquery)): ?>
													<option value="<?=$catresult['id'];?>"<?=((isset($_POST['category']) && $_POST['category'] == $catresult['id']) ? 'selected' : '');?>><?=$catresult['category'];?></option>
												<?php endwhile;?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="subcat">Sub- Category</label></div>
										<div class="col-md-6">
											<select id="subcat" name="subcat" class="form-control"></select>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="brand">Brand</label></div>
										<div class="col-md-6">
											<select id="brand" name="brand" class="form-control"></select>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="pp">Previous Price</label></div>
										<div class="col-md-6">
											<input type="text" name="pp" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="price">Price</label></div>
										<div class="col-md-6">
											<input type="text" id="price" name="price" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="size">Size</label></div>
										<div class="col-md-6">
											<input type="checkbox"  name="size[]"  value="XL"> XL
											<input type="checkbox"  name="size[]"  value="L"> L
											<input type="checkbox"  name="size[]"  value="M"> M
										</div>
									</div>
								</div>
							</div>
							<br>
							<br>
							<div class="row">
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="image">Image</label></div>
										<div class="col-md-6">
											<input type="file" name="image" id="image" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-3"><label for="des">Description</label></div>
										<div class="col-md-6">
											<textarea rows="5"  id="des" name="des" class="form-control"></textarea>
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
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
$(document).ready(function () {
	$('#cat').on('change', function () {//change function on country to display all state
		let catid = $(this).val();
		if (catid) {
			$.ajax({
				method: 'POST',
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
