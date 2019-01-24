<?php require_once 'core/init.php';
 include 'includes1/head.php';
 include 'includes1/navbar.php';
 include 'includes1/newsbar.php';
 include 'includes1/carosal.php';
 include 'includes1/modaldetails.php';
 $conn= new Database;
$sql="select * from product where featured=1";
$featured=$conn->getall($sql);
?>



</body>
</html>
