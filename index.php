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


<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.carosal').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,


    });
    });
</script>

</body>
</html>
