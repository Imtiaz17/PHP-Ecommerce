<?php
require_once 'core/db.php';
include 'includes1/head.php';
include 'includes1/navbar.php';
include 'includes1/catbar.php';
include 'includes1/newsbar.php';
?>
<br>
<div class="container">
  <div id="updatemsg"></div>
  <div id="deletemsg"></div>
  <div class="row">
    <div class="panel panel-info">
    <div class="panel-heading text-center" style="font-size: 30px; font-weight: bold;">Cart Cheakout</div>
    <div class="panel-body">
      <div class="row">
        <b>
        <div class="col-md-2">Action</div>
        <div class="col-md-2">Product Image</div>
        <div class="col-md-2">Product Name</div>
        <div class="col-md-2">Quantity</div>
        <div class="col-md-2">Price</div>
        <div class="col-md-2">Sub Total</div>
      </b>
      </div>
      <br>
      <div id="cheakout"></div>
    </div>
  </div>
  </div>
</div>










<script type="text/javascript" src="main.js"></script>
