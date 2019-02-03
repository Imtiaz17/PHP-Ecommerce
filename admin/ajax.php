<?php
$db = mysqli_connect("localhost", "root", "", "aio");
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $sql = "select * from admin where username='$username'";
    $query = mysqli_query($db, $sql);
    if (mysqli_num_rows($query) > 0) {
        echo '<span class="text-danger">Username not availble</span> ';
    } else {
        echo '<span class="text-success">Available</span> ';

    }
    exit();

} else {
    echo "No Data available";
}


if(isset($_POST["catid"]) && !empty($_POST["catid"])){

    //Get all state data
    $cat = $_POST['catid'];
    $sqldb = "SELECT * FROM categories WHERE parent='$cat'";
    $querydb = mysqli_query($db, $sqldb);
  if (mysqli_num_rows($querydb) > 0) {
        echo '<option value="">Select Subcategory</option>';
        while($row = mysqli_fetch_assoc($querydb)){
            echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
        }
    }else{
        echo '<option value="">Subcategory not available</option>';
    }
}
//get brand option load


if(isset($_POST["subcatid"]) && !empty($_POST["subcatid"])){

    //Get all state data
    $cat = $_POST['subcatid'];
    $sqldb = "SELECT * FROM brand WHERE cat_id='$cat'";
    $querydb = mysqli_query($db, $sqldb);
    if (mysqli_num_rows($querydb) > 0) {
        echo '<option value="">Select Brand</option>';
        while($row = mysqli_fetch_assoc($querydb)){
            echo '<option value="'.$row['brand_name'].'">'.$row['brand_name'].'</option>';
        }
    }else{
        echo '<option value="">Brand not available</option>';
    }
}











