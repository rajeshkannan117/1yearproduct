<div style="text-align:right;">
	<a href="<?php echo base_url();?>organization/logout">Logout</a>
</div>

<?php if($ErrorMessages!='')
			{?>
		<div class="alert alert-danger">
		<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
		<?php echo $ErrorMessages;  ?>
	        </div> <!-- /.alert -->
                <?php } ?>
                
                <?php if ($this->session->flashdata('SucMessage')!='') { ?>
			<div class="alert alert-success">
			<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
			<?php echo $this->session->flashdata('SucMessage');  ?>
		        </div> <!-- /.alert -->
                <?php } ?>

<form action="" name="organization" method="post" enctype="multipart/form-data">
     
        <div class="row">       
		<div class="form-group col-sm-12">
                  <label for="name">Organization Name <span class='mandatory' >*</span></label>
                  <input type="text" id="org_name" name="org_name" value="<?php echo set_value('org_name');?>"> 
        </div>
        </div>
              
       	<div class="row"> 
                <div class="form-group col-sm-6">
                  <label for="name">Logo <span class='mandatory' >*</span></label>
                  <input type="file" id="org_logo" name="org_logo"> 
        		</div>
      	</div>
      	
      	<div class="location_container">
      		
      		<?php if(isset($_POST['address'])) {
      				foreach($_POST['address'] as $count)
					{ ?>
	      		<div class="new_container">
		      		<div>
			      		<label for="name">Address <span class='mandatory' >*</span></label>
			      		<input type="text" id="address" name="address[]" value="<?php echo set_value('address[]');?>">
		      		</div>
		      		<div >
			      		<label for="name">City <span class='mandatory' >*</span></label>
			      		<input type="text" id="city" name="city[]" value="<?php echo set_value('city[]');?>">
		      		</div>
		      		<div>
			      		<label for="name">State <span class='mandatory' >*</span></label>
			      		<input type="text" id="state" name="state[]" value="<?php echo set_value('state[]');?>">
		      		</div>
		      		<div>
			      		<label for="name">Country <span class='mandatory' >*</span></label>
			      		<input type="text" id="country" name="country[]" value="<?php echo set_value('country[]');?>">
		      		</div>
		      		<div>
			      		<label for="name">Zip Code <span class='mandatory' >*</span></label>
			      		<input type="text" id="zip" name="zip[]" value="<?php echo set_value('zip[]');?>">
		      		</div>
		      		
		      		<div class="col-sm-1"><a class="remove_field"><i class="fa fa-trash-o"></i>Remove</a></div>
	      		</div>
					
      		<?php }
      		} else{?>
      		
	      	<div class="new_container"> 
	                <div>
	                  <label for="name">Address <span class='mandatory' >*</span></label>
	                  <input type="text" id="address" name="address[]" value="<?php echo set_value('address[]');?>"> 
	        		</div>
	        		<div >
	                  <label for="name">City <span class='mandatory' >*</span></label>
	                  <input type="text" id="city" name="city[]" value="<?php echo set_value('city[]');?>"> 
	        		</div>
	        		<div>
	                  <label for="name">State <span class='mandatory' >*</span></label>
	                  <input type="text" id="state" name="state[]" value="<?php echo set_value('state[]');?>"> 
	        		</div>
	        		<div>
	                  <label for="name">Country <span class='mandatory' >*</span></label>
	                  <input type="text" id="country" name="country[]" value="<?php echo set_value('country[]');?>"> 
	        		</div>
	        		<div>
	                  <label for="name">Zip Code <span class='mandatory' >*</span></label>
	                  <input type="text" id="zip" name="zip[]" value="<?php echo set_value('zip[]');?>"> 
	        		</div>
	        		
	      	</div>
	      	<?php } ?>
      	</div>
      	
      	<a class="add_location_button"> + Add New Location </a>
      	
      	<div>
      		<h3>User Info</h3>
      		<div>
	                  <label for="usr_name">User Name <span class='mandatory' >*</span></label>
	                  <input type="text" id="usr_name" name="usr_name" value="<?php echo set_value('usr_name');?>"> 
	        </div>
	        <div>
	                  <label for="usr_email">Email <span class='mandatory' >*</span></label>
	                  <input type="text" id="usr_email" name="usr_email" value="<?php echo set_value('usr_email');?>"> 
	        </div>
	        <div>
	                  <label for="usr_phone">Phone <span class='mandatory' >*</span></label>
	                  <input type="text" id="usr_phone" name="usr_phone" value="<?php echo set_value('usr_phone');?>"> 
	        </div>
	        <div>
	                  <label for="usr_psw">Password <span class='mandatory' >*</span></label>
	                  <input type="text" id="usr_psw" name="usr_psw" value="<?php echo set_value('usr_psw');?>"> 
	        </div>
      	</div>
      	         
     	<div> 
		      <div>
		                  <input type="submit" class="btn btn-secondary pull-right" name="Create" value="Create" onclick="return showNoFile();">
		      </div>
     	</div>
</form>

<style>
	.new_container{ border:1px solid #ccc; padding:10px; margin:10px; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
		$(document).ready(function() {
		    var wrapper         = $(".location_container"); //Fields wrapper
		    var add_button      = $(".add_location_button"); //Add button ID

		    var cont = '<div class="new_container"><div><label for="name">Address <span class="mandatory" >*</span></label><input type="text" id="address" name="address[]" value=""></div><div><label for="name">City <span class="mandatory">*</span></label><input type="text" id="city" name="city[]" value=""></div><div><label for="name">State <span class="mandatory">*</span></label><input type="text" id="state" name="state[]" value=""></div><div><label for="name">Country <span class="mandatory">*</span></label><input type="text" id="country" name="country[]" value=""></div><div><label for="name">Zip Code <span class="mandatory">*</span></label><input type="text" id="zip" name="zip[]" value=""></div><div class="col-sm-1" style="text-align:right;"><a class="remove_field"><i class="fa fa-trash-o"></i>Remove</a></div></div>';
		    
		    var x = 1; //initlal text box count
		    
		    $(add_button).click(function(e){ //on add input button click
		    	
		        e.preventDefault();
		       
		            x++; //text box increment
		            $(wrapper).append(cont); //add input box

		           datepick();
		    });		

		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent().parent().remove(); x--;
		    });
		       
		});
</script>