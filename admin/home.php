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
			
		</div>
	
<?php
include 'includes/footer.php';
?>
