<?php
session_start();
if (!isset($_SESSION['id'])) {
header("Location: admin.php?msg=".urlencode('You are not an Admin! Please Log in'));
exit();
}
require_once '../core/db.php';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"><?php if (isset($_GET['msg'])) {
			echo "<h3 style='color:green; width: auto' class='form-control ' >".$_GET['msg']."</h3>";} ?>
		</div>
		<div class="col-md-6">
			<marquee scrollamount="5" behavior="scroll" width="100%">
				<h3 style="text-shadow: 0 0 3px #FF0000;">Welcome "<strong>
					<?php echo  $_SESSION['bid']; ?>
				</strong>" To The Admin Panel Of All In One</h3>
			</marquee>
		</div>
		<div class="col-md-3"></div>
	</div>
	<?php include 'includes/dashboard-header.php';?>
	<div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Orders</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                	<table class="table table-hover">
                		<?php 
                		$ordersql="select * from orders where status=0";
                		$result = mysqli_query($db, $ordersql);
                		$row = mysqli_fetch_assoc($result);
                		$pid=$row['p_id'];
                		$psql="select * from product where id ='$pid'";
                		$presult = mysqli_query($db, $psql);
                		$prow = mysqli_fetch_assoc($presult);
                		$image=$prow['image'];



                		?>
                        <tr>                        
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Amount</th>
                            <th>Invoice No</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Action</th>

                        </tr>

                        <tbody>
                        	<?php while ($row = mysqli_fetch_assoc($result)):
                      $pid=$row['p_id'];
                		$psql="select * from product where id ='$pid'";
                		$presult = mysqli_query($db, $psql);
                		$prow = mysqli_fetch_assoc($presult);
                		$image=$prow['image'];?>
                        		<tr>
                        	<td><?= $prow['title']; ?></td>
                        	<td><img src='../img/<?=$image?>' width='80px' height='80px'></td>
                        	<td><?= $row['amount']; ?></td>
                        	<td><?= $row['invoice_no']; ?></td>
                        	<td><?= $row['qty']; ?></td>
                        	<td><?= $row['date']; ?></td>
                        	<td></td>
                        </tr>
                        	 <?php endwhile; ?>
                        	 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
	
<?php
include 'includes/footer.php';
?>
