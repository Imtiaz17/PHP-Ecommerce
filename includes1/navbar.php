<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">E-Bazazr.com</a>
    </div>
    </div>
      <div class=" col-md-4" >
    <form class="navbar-form " action="/action_page.php">
      <div class="form-group">
        <input type="text" class=" form-control" style="width:300px;" placeholder="Search" name="search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
    <div class="bt col-md-4">
        <?php if ($_SESSION['user_id'] !="") {?>
     <a href="login.php" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span> Login</a></button>
       <a href="signup.php" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
       <?php } else {?>
         <a href="#" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> My profile </a>
         <a href="signout.php" class="btn btn-info"><span class="glyphicon glyphicon-log-out"></span> Signout </a>
         <?php } ?>
  </div>



  </div>
  </div>
</nav>
