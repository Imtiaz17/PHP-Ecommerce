<div class="modal fade details " tabindex="-1" role="dialog" id="details">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" >Pant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
         <div class="row"> 
          <div class="col-md-6">
        <img src="images/Pant.jpg" class="details img-responsive">    
          </div>
          <div class="col-md-6">
          <h3> <label>Details</label></h3>
          <p>This Is a awesome jeans ....................!!!!!!!!!!!!!!!</p>
          <hr>
          <p>Price : 500Tk</p>
         <p> Brand : Levis </p>
         <form action="addcart.php" method="post">
           <div class="form-group">
            <div class="row"> 
             <div class="col-md-3"> 
              <label>Quantity</label>
            </div>
            <div class="col-md-6">
              <input type="number" class="form-control" id="Quantity" name="Quantity"  min="1" max="5"></div>
           </div>
           </div>

            <div class="form-group">
               <div class="row"> 
             <div class="col-md-3"> 
              <label>Size</label>
            </div>
            <div class="col-md-6">
              <select name="Size"  id="Size" class="form-control">
                <option value="select"> select</option>
                 <option value="28">28</option>
                  <option value="32">32</option>
                   <option value="34">34</option>
              </select></div>
              </div>
           </div>
            </form> 
       </div>
        </div>
       </div>
     

      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">CLose</button>
        <button  class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span></button>
      </div>
    </div>
  </div>
   </div>
</div>