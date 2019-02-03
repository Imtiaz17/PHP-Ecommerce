//addproduct
$("body").delegate("#product","click",function(event){
	event.preventDefault();
	var p_id=$(this).attr('pid');
	$.ajax({
		url: 'action.php',
		type: 'POST',
		data: {add:1,p_id:p_id},
		success: function (data) {
			alert(data);

		}
	})


})
//hover cart to see cart
$("#cart").hover(function (event) {
	event.preventDefault();
	$.ajax({
		url: 'action.php',
		type: 'POST',
		data: {get_cart:1},
		success: function (data) {
			$("#cart_product").html(data)

		}
	})
})


//cheakout page load
cheakout();
function cheakout()
{
	$.ajax({
		url: 'action.php',
		type: 'POST',
		data: {cheakout:1},
		success: function (data) {
			$("#cheakout").html(data)

		}
	})
}

//quantity wise price and total change
$("body").delegate(".qty","keyup",function () {
	var pid=$(this).attr("pid");
	var qty=$("#qty-"+pid).val();
	var price=$("#price-"+pid).val();
	var total= qty * price;
	$("#total-"+pid).val(total);
})

//remove product from cart
$("body").delegate(".remove","click", function(event){
	event.preventDefault();
	var pid=$(this).attr('remove');
	$.ajax({
		url: 'action.php',
		type: 'POST',
		data: {removeproduct:1, removeid:pid},
		success: function (data) {
				$("#deletemsg").html(data)
		cheakout();

		}
	})
})


//update product form cart
$("body").delegate(".update","click", function(event){
	event.preventDefault();
	var pid=$(this).attr('update');
	var qty=$("#qty-"+pid).val();
		var price=$("#price-"+pid).val();
		var total=	$("#total-"+pid).val();
	$.ajax({
		url: 'action.php',
		type: 'POST',
		data: {updateproduct:1, updateid:pid, qty:qty,price:price,total:total},
		success: function (data) {
				$("#updatemsg").html(data)
		cheakout();

		}
	})

})
