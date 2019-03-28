<?php
require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';

if(isset($_GET['c_id'])){

  $userid = $_GET['c_id'];

}

$status = "pending";
$invoice_no = mt_rand();
$select_cart = "select * from cart where u_id='$userid'";
$run_cart = mysqli_query($db,$select_cart);
while($row_cart = mysqli_fetch_assoc($run_cart)){
  $pro_id = $row_cart['p_id'];
  $pro_qty = $row_cart['quantity'];
  $pro_price=$row_cart['price'];
  $get_products = "select * from product where id='$pro_id'";
  $run_products = mysqli_query($db,$get_products);
  while($row_products = mysqli_fetch_assoc($run_products)){
    $pro_total= $pro_price*$pro_qty;
    $p_id=$row_products['id'];

    $insert_customer_order = "insert into orders (c_id,p_id, amount,invoice_no,qty,date,status) values ('$userid','$p_id','$pro_total','$invoice_no','$pro_qty',NOW(),'$status')";

    $run_customer_order = mysqli_query($db,$insert_customer_order);
    $delete_cart = "delete from cart where u_id='$userid'";
    
    $run_delete = mysqli_query($db,$delete_cart);

    echo "<script>alert('Your orders has been submitted, Thanks')</script>";

    echo "<script>window.open('index.php','_self')</script>";
  }
}


?>
