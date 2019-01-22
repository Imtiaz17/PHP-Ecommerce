<?php
$db=mysqli_connect("localhost", "root", "", "aio");
if (mysqli_connect_errno()){
    echo 'Database connection failed'. mysqli_connect_error();
    die();
}

?>