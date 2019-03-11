<?php require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';
include 'includes1/modaldetails.php';
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
        var brand=get_filter('brand');
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {action:action,brand:brand},
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
                return filter;
            });
        }   
        $('.common_selector').click(function() {
            filter_data();
        }); 
    });



</script>