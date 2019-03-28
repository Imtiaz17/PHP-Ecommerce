<?php
session_start();
if (!isset($_SESSION['id'])){
	header("Location: admin.php");
}
require_once '../core/init.php'; 
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';
 $conn= new Database();


 if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$query="select * from admin where id ='$id'";
	$getCon=$conn->getall($query);
	$getdata=mysqli_fetch_assoc($getCon);

}

?>
<?php 

   	if ( isset($_POST['update'])) {
	$name=sanitize($_POST['name']);
	$username=sanitize($_POST['username']);;
	$email=sanitize($_POST['email']);
	$pass=sanitize($_POST['pass']);
	if ($name==''|| $username==''|| $email==''|| $pass=='') {
		$error=" <div class='alert alert-danger' ><strong>Error!</strong> Field must not be empty ! </div>";
		
	}else
	{
	$dbupdate="update admin set name='$name',username='$username',email='$email',password='$pass'  where id ='$id'"; 
	$update=$conn->adminupdate($dbupdate);
   
}

   	}
   
   	?>
<div class="container">
<div class="panel panel-default">
	<div class="panel-heading">
	<h4>Admin Profile <span class="pull-right"> <a class="btn btn-primary"  href="http://localhost/php-ecommerce/admin/home.php">Back</a></span></h4>
		</div>
	<?php if (isset($error)) {
	echo "<h4 style='color:red'>".$error."</h4>";
} ?>
		<div class="panel-body" style="max-width: 600px; margin: 0 auto">
			<form action="" method="POST">
				<div class="form-group"> 
					<label for="name"> Name</label>
					<input type="text" id="name" name="name" class="form-control" value="<?=$getdata['name'];?>">

				</div>
				<div class="form-group"> 
					<label for="username"> User Name</label>
					<input type="text" id="username" name="username" class="form-control"value="<?=$getdata['username'];?>">

				</div>
				<div class="form-group"> 
					<label for="email"> Email Address</label>
					<input type="text" id="email" name="email" class="form-control" value="<?=$getdata['email'];?>">

				</div>
				
				<div class="form-group"> 
					<label for="pass"> Password</label>
					<input type="text" id="pass" name="pass" class="form-control" value="<?=$getdata['password'];?>">

				</div>
				<input type="submit" name="update" value="Update" class="form-control  btn btn-success">
			</form>
		</div>
	</div>
</div>