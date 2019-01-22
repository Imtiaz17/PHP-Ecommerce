<?php
function display_error($errors)
{
	$display='<ul class="bg-danger">';
	foreach ($errors as $error) {
		$display.='<li class="text-danger">'.$error.'</li>';
	}
	$display.='</ul>';
	return $display;
}
function display_err($imtiaz)
{
	$display='<ul class="bg-success">';
	foreach ($imtiaz as $err) {
		$display.='<li class="text-success">'.$err.'</li>';
	}
	$display.='</ul>';
	return $display;
}
function sanitize ($dirty)
{
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
function money($number){
	return number_format($number).'TK';
}