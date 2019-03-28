<?php
session_start();

require_once '../core/db.php';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>User List</h4>
	</div>
	<div class="panel-body">
		<table class="table  table-striped">
			<th width="20%">Serial</th>
			<th width="20%">Name</th>
			<th width="20%">Username</th>
			<th width="20%">Email</th>
			<th width="20%">Action</th>
			<?php  
			$sql="select * from admin order by id" ;
			$query=mysqli_query($db,$sql);
			while ($result=mysqli_fetch_assoc($query)): ?>
				<tr>
					<td><?=$result['id'] ;?></td>
					<td><?=$result['name'] ;?></td>
					<td><?=$result['username'] ;?></td>
					<td><?=$result['email'] ;?></td>
					<?php if ($_SESSION['id']==$result['id']){?> 
						<td> <a  class="btn btn-primary" href="adminprofile.php?id=<?= $result['id']; ?>">Update Profile</a></td>
					<?php }?>

				</tr>
			<?php endwhile ;?>

		</table>
	</div>

</div>
	
<?php
include 'includes/footer.php';
?>