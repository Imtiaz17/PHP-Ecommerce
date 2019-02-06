<?php

require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
if (isset($_SESSION['id'])){
	header("Location: index.php");
}
if (isset($_POST['submit'])) {
  $email=$_POST['email'];
  $pass=$_POST['pass'];
$sql="select * from user where email='$email' and pass='$pass'";
$dbsql=mysqli_query($db,$sql);
$cheak=mysqli_num_rows($dbsql);

if ($cheak>0) {
  while ($row=mysqli_fetch_assoc($dbsql)) {
    $_SESSION['id']=$row['user_id'];
  }
  header("Location:index.php");

}
else {
  echo "<script type='text/javascript'>
    alert('Wrong Credential..!!!')
  </script>";

}
}


?>
<div class="container">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div class="panel panel-default sidebar">
      <div class="panel-heading">
        <div class="panel-title title">
          Welcome to E-Bazar! Please Log-In
        </div>
      </div>
      <div class="panel-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-md-4">
              <label for="email">E-mail Address:</label>
              </div>
              <div class="col-md-6">
              <input type="text"class="form-control" name="email" id="email"  required>
            </div>
            </div>
          <br>
          <div class="row">
            <div class="col-md-4">
              <label for="pass">Password:</label>
              </div>
                <div class="col-md-6">
              <input type="password" name="pass" id="pass" class="form-control" required>
                </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-4">
              <input type="submit" class="sign form-control " name="submit" value="Login" required>
            </div>
            <div class="col-md-4"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
