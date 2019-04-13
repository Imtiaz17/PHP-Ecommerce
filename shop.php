<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';

?>

<?php
if (isset($_GET['id'])) {
	$id = $_GET["id"];
}
$sql = "select * from brand where cat_id='$id'";
$sqlresult = mysqli_query($db, $sql);
?>
<div class="container">
	<div class="col-md-3">
	<div class="panel panel-default sidebar">
			<div class="panel-heading">
				<div class="panel-title">
					Price
				</div>
			</div>
			<div class="panel-body">
     <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="100000" />
                    <p id="price_show">1000 - 100000</p>
                    <div id="price_range"></div>
                </div> 
                </div> 
		<div class="panel panel-default sidebar">
			<div class="panel-heading">
				<div class="panel-title">
					Categories
				</div>
			</div>
			<div class="panel-body">
				<?php
				while ($row = mysqli_fetch_assoc($sqlresult)) {?>
					<div class="list-group-item checkbox">
						<label> <input type="checkbox" class="common_selector brand" value="<?=$row['brand_name']?>"><?=$row['brand_name']?></label>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel-main">
			<div class="panel panel-default">
				<?php
				$catsql = "select * from categories where id= $id";
				$catdb = mysqli_query($db, $catsql);
				while ($row2 = mysqli_fetch_assoc($catdb)) {
					?>
					<div class="panel-heading">
						<p><?=$row2['category']?></p>
					</div>
					<div class="panel-body">
						<div class="row filter_data">

						</div>

					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>


<?php include 'includes1/footer.php';?>
<script type="text/javascript" src="main.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	filter_data();
	function filter_data()
	{
		$('.filter_data').html('<div id="loading"style=""></div>');
		var action='action';
		var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
		var brand=get_filter('brand');
		 var id = <?php echo $_GET['id']; ?>;
		 console.log(id);
		$.ajax({
			url: 'action.php',
			type: 'POST',
			data: {action: action,brand: brand,id: id, minimum_price:minimum_price, maximum_price:maximum_price},
			success:function(data)
			{
				$('.filter_data').html(data);
			}
		});

	}
	function get_filter(class_name) {
		var filter=[];
		$('.'+class_name+':checked').each(function() {
			filter.push($(this).val());
		});
        return filter;
	}
	$('.common_selector').click(function() {
		filter_data();
	});
	$('#price_range').slider({
        range:true,
        min:1000,
        max:100000,
        values:[1000, 100000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
        });
});
</script>
