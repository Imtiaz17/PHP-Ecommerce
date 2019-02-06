<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
if (isset($_SESSION['id'])){
	header("Location: index.php");
}
if (isset($_POST['submit'])) {
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $mobile=$_POST['mobile'];
  $pass=$_POST['pass'];
  $cpass=$_POST['cpass'];
  $user_id=uniqid();

 if ($pass==$cpass) {
   $query="insert into user (user_id,fname,lname,email,mobile,pass,cpass) values ('$user_id','$fname','$lname','$email','$mobile','$pass','$cpass')";
   $dbquery=mysqli_query($db,$query);
   if ($dbquery) {
     header("Location:login.php");
   }
   else {
     echo "<script type='text/javascript'>
       alert('Registration Failed');
     </script>";
     exit();
   }
 }
 else {
   echo "<script type='text/javascript'>
     alert('Password shuld be match')
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
          Welcome to E-Bazar! Please Sign-up
        </div>
      </div>
      <div class="panel-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-md-6">
              <label for="fname">First Name:</label>
              <input type="text" name="fname" id="fname" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="lname">Last Name:</label>
              <input type="text" name="lname" id="lname" class="form-control" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="email">E-mail Address:</label>
              <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="mno">Mobile No:</label>
              <input type="text" name="mobile" id="mno" class="form-control" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="pass">Password:</label>
              <input type="password" name="pass" id="pass" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="cpas">Confirm Password:</label>
              <input type="password" name="cpass" id="cpass" class="form-control" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <input type="submit" class="sign form-control " name="submit" value="Signup" required>
            </div>

            <div class="col-md-4"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
