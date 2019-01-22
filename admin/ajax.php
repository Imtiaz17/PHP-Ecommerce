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
?>
<?php
require_once '../core/db.php';
$parentID=(int)$_POST['parentID'];
$childresult=$db->query("select * from categories where parent='$parentID'");
ob_start();
?>
<option value=""></option>
<?php while ($child=mysqli_fetch_assoc($childresult)):?>
    <option value="<?=$child['id'];?>"><?=$child['category'];?></option>
<?php endwhile;?>

<?php echo ob_get_clean();  ?>









