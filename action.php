<?php
session_start();
include'core/db.php';

if (isset($_POST["action"])) {
$query="select * from product where cat=id ";
}

if (isset($_POST["brand"])) {
	$brand_filter = implode(',',$_POST['brand']);
	$query="select * from product where brand IN ('$brand_filter')";

$dbquery=mysqli_query($db,$query);
	$count =mysqli_num_rows($dbquery);
	 $output = '';
	if ($count>0) {
		while ($bf=mysqli_fetch_assoc($dbquery))
		{

			$output.='<div class="col-md-3 ">
                        <div class="product">
                         <h3>'.$bf["title"].'</h3>
                         <img src="img/'. $bf['image'] .'" class="img-responsive" >
                            <p class="Price"><b>Price:</b>'.$bf["price"].' </p>
                            <a href="details.php?id='.$bf['id'].'" class="btn btn-success">
                                Details
                            </a>
                              <button id="product" pid='.$bf["id"].' class="btn btn-primary">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Add Cart
                            </button>
                           
                        </div>
                    </div>';

                }
            }
            else
		 {
		  $output = '<h3>No Data Found</h3>';
		 }
		 echo $output;
        }

// 1.add product in to cart

if (isset($_POST['add'])) {
	if (isset($_SESSION['id'])) {
	$pid=$_POST['p_id'];
	$user_id=$_SESSION['id'];
	$sql="select * from cart where p_id='$pid' and u_id='$user_id'";
	$dbquery=mysqli_query($db,$sql);
	$count =mysqli_num_rows($dbquery);
	if ($count>0) {
		echo "Product has been added coninue shopping....";
	}
	else
	{
		$sql2="select * from product where id='$pid'";
		$dbquery2=mysqli_query($db,$sql2);
		$row=mysqli_fetch_assoc($dbquery2);
		$id=$row['id'];
		$name=$row['title'];
		$image=$row['image'];
		$price=$row['price'];
		$sql3="INSERT INTO cart  (p_id,u_id,p_title,p_image,quantity,price,total)VALUES('$id','$user_id','$name','$image',1,'$price','$price')";
		if (mysqli_query($db,$sql3)) {
			echo "Product has been added to cart";
		}

}
	}
	else {
		echo"Please login to add" ;

	}
}
// 2.cheakout page load from db
if (isset($_POST["get_cart"])|| isset($_POST['cheakout'])){
	if (isset($_SESSION['id'])) {
	$user_id=$_SESSION['id'];
	$sql4="select * from cart where u_id='$user_id'";
	$dbquery3=mysqli_query($db,$sql4);
	$count2=mysqli_num_rows($dbquery3);
	if ($count2>0) {
		$no=1;
		$total_amt=0;

		 while ($row2=mysqli_fetch_assoc($dbquery3)) {
			 $cartid=$row2['id'];
			 $cart_pid=$row2['p_id'];
		 	$cart_name=$row2['p_title'];
			$cart_img=$row2['p_image'];
			$cart_pr=$row2['price'];
			$cart_qty=$row2['quantity'];
			$cart_total=$cart_qty*$cart_pr;
			$cart_sub=$row2['total'];
			$total_amt=$cart_sub+$total_amt;
			if (isset($_POST["get_cart"])) {
				echo "
				<div class='row'>
						<div class='col-md-3'>$no</div>
						<div class='col-md-3'>$cart_name</div>
						<div class='col-md-3'><img src='img/$cart_img' width='60px' height='50px'></div>
						<div class='col-md-3'>$cart_pr</div>
					</div>";
					$no=$no+1;

			}
			else{
				echo "
				<div class='row'>
	        <div class='col-md-2'>
	          <div class='btn-group'>
	            <a href='#' remove='$cart_pid' class='btn btn-danger remove'> <span class='glyphicon glyphicon-trash'></span> </a>
            <a href='#' update='$cart_pid' class='btn btn-primary update'> <span class='glyphicon glyphicon-ok-sign'></span> </a>
	          </div>
	        </div>
	        <div class='col-md-2'> <img src='img/$cart_img' width='60px' height='50px'> </div>
	        <div class='col-md-2'>$cart_name</div>
					<div class='col-md-2'> <input type='text' class='form-control qty' pid='$cart_pid' id='qty-$cart_pid' value='$cart_qty' > </div>
	        <div class='col-md-2'> <input type='text' class='form-control ' pid='$cart_pid' id='price-$cart_pid' value='$cart_pr'disabled> </div>
	        <div class='col-md-2'> <input type='text' class='form-control ' pid='$cart_pid' id='total-$cart_pid' value='$cart_total' disabled> </div>
	      </div>";
			}

		 }
		 if ( isset($_POST['cheakout'])) {
			 echo "<div class='row'>
			     <div class='col-md-10'></div>
			     <div class='col-md-2'>
			       <b>Total Amount=$total_amt</b>
			     </div>
			   </div>";

		 }
	 }
	}
}



//3. Cart count
if (isset($_POST["cart_count"])) {
	if (isset($_SESSION['id'])) {
	$user_id=$_SESSION['id'];
	$cartsql="select * from cart where u_id='$user_id'";
	$dbcart=mysqli_query($db,$cartsql);
	echo mysqli_num_rows($dbcart) ;

}
}



//4. remove product from cart

if (isset($_POST['removeproduct'])) {
	$removeid= $_POST['removeid'];
	$userid=$_SESSION['id'];
	$sql5="delete from cart where p_id='$removeid' and u_id='$userid'";
	$dbquery4=mysqli_query($db,$sql5);
	if ($dbquery4) {
		echo "<div class='alert alert-danger'>
		<strong>Success!</strong> product has been removed.
	</div>";
	}

}

//5. update product from cart

if (isset($_POST['updateproduct'])) {
	$updateid= $_POST['updateid'];
	$upprice=$_POST['price'];
	$upqty=$_POST['qty'];
	$uptotal=$_POST['total'];
	$userid=$_SESSION['id'];
	$sql6="update cart set quantity='$upqty', price='$upprice', total='$uptotal' where p_id='$updateid' and u_id='$userid'";
	$dbquery5=mysqli_query($db,$sql6);
	if ($dbquery5) {
		echo "<div class='alert alert-success'>
    <strong>Success!</strong> Cart is updated.
  </div>";
	}

}

?>
