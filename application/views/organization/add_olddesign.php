

    <div id="page_content">
        <div id="page_content_inner">
		<h3 class="heading_b uk-margin-bottom">Add Organization</h3>

<form action="" id="form_validation" class="uk-form-stacked" name="organization" method="post" enctype="multipart/form-data">
<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                  <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?> 
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Organization</h3>
            
                <!--<?php if($ErrorMessages!='') {?>
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $ErrorMessages;  ?>
                </div> <?php } ?>  -->
                
                 
                            
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="fullname">Organization Name <span class="req">*</span></label>
                                    <input type="text" name="org_name" class="md-input" value="<?php echo set_value('org_name');?>" />
                                    <?php echo "<div style='color:red'>".form_error('org_name')."</div>"; ?>
                                </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                                  
                                   
                                   <div class="uk-form-file md-btn md-btn-primary">
                               	 	Logo
                                	<input id="form-file" type="file" name="org_logo">
                            		</div>
                            			Select Organization Logo...
                                  
                            		
                        </div>

                    </div>


              <div class="uk-grid" data-uk-grid-margin>

                <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="countries">Select Country <span class="req">*</span></label>
                                    <select data-md-selectize id="" required data-placeholder="Select Countries..." name="countries" onchange="countrychange(this.value);">
                                        <option value="-1">Select Countries</option>
                                        <?php 
                                        foreach($countries as $key=>$value){ ?>
                                            <option value="<?php echo $value['loc_id']; ?>" 
                                            <?php 
                                                if((isset($_POST['countries']) && $value['loc_id'] == $_POST['countries']) || ($value['default']==1)){
                                                   
                                                        echo 'selected';
                                                   
                                                }?> > <?php echo $value['country_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('countries')."</div>"; ?>
                                </div>
                        </div>


                        <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="domain">Select Domain <span class="req">*</span></label>
                                    <span id="domain">
                                        <?php echo $domains_list; ?>
                                    </span>
                                    <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                                </div>
                        </div>







                        </div>

                </div>
                </div>
                



                <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">User Info</h3>
                        
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 <label>First Name</label>
                                 <input type="text" class="md-input" id="usr_name" name="usr_name" value="<?php echo set_value('usr_name');?>" />
                                 <?php echo "<div style='color:red'>".form_error('usr_name')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                                <label>Last Name</label>
                                <input type="text" class="md-input" id="usr_lname" name="usr_lname" value="<?php echo set_value('usr_lname');?>" />
                                <?php echo "<div style='color:red'>".form_error('usr_lname')."</div>"; ?>
                        </div>
                    </div>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                        <label>Email</label>
                                        <input type="text" class="md-input" id="usr_email" name="usr_email" value="<?php echo set_value('usr_email');?>" />
                                        <?php echo "<div style='color:red'>".form_error('usr_email')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                                <label>Phone</label>
                                <input type="text" class="md-input" id="usr_phone" name="usr_phone" value="<?php echo set_value('usr_phone');?>" />
                                <?php echo "<div style='color:red'>".form_error('usr_phone')."</div>"; ?>
                        </div>
                    </div>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                      
                </div>
                
                    </div>
                </div>
            </div>




                <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Location</h3>
                    <div class="location_container" >
                    <?php if(isset($_POST['address'])) {
      				foreach($_POST['address'] as $count)
					{ ?>
					<div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
				      		<label>Location Name</label>
				      		<input type="text" class="md-input" name="location_name[]" value="<?php echo set_value('location_name[]');?>" />
				      		<?php echo "<div style='color:red'>".form_error('location_name[]')."</div>"; ?>
			      		</div>
                        <div class="uk-width-medium-1-2">
                                 <label>Address</label>
                                 <input type="text" class="md-input" name="address[]" value="<?php echo set_value('address[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('address[]')."</div>"; ?>
                        </div>
                   </div>
                   <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                   <label>City</label>
                                   <input type="text" class="md-input" name="city[]" value="<?php echo set_value('city[]');?>" />
                                   <?php echo "<div style='color:red'>".form_error('city[]')."</div>"; ?>
                        </div>
                    
                    	<!--<div class="uk-width-medium-1-2">
                                   <label>Country</label>
                                   <input type="text" class="md-input" name="country[]" value="<?php echo set_value('country[]');?>" />
                                   <?php echo "<div style='color:red'>".form_error('country[]')."</div>"; ?>
                        </div>-->

                        <div class="uk-width-medium-1-2">
                                 <label>state</label>
                                 <input type="text" class="md-input" name="state[]" value="<?php echo set_value('state[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('state[]')."</div>"; ?>
                        </div>
                   </div>
                   <div class="uk-grid" data-uk-grid-margin>
                        
                    
                        <div class="uk-width-medium-1-2">
                                 <label>Zip Code</label>
                                 <input type="text" class="md-input" name="zip[]" value="<?php echo set_value('zip[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('zip[]')."</div>"; ?>
                        </div>




                        <div class="uk-width-medium-1-2">
              <?php //if(!$default_option) { ?>
                         <label for="" class="inline-label">Set Default Settings</label>
                                <div class="parsley-row">
                                     <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"<?php  
                                             if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                        echo 'checked';
                                                }
                                         ?>/>
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                             if(ISSET($_POST['default']) && $_POST['default'] == 0) {
                                                        echo 'checked';
                                                }
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                </div>
                            <?php //} ?>
                        </div>

                    </div>



                    <div class="uk-grid" data-uk-grid-margin >

                        <div class="uk-width-medium-1-2" style="float:right;">
                      
                </div>


                            <div class="uk-width-medium-1-2" style="float:right;">
                      <input type="submit" class="uk-form-file md-btn md-btn-primary" style="float:right;" name="Create" value="Create" onclick="return showNoFile();">
                </div>
                             

                    </div>
                    
                    <!--<div class="remove_field" style="text-align: right;width: 92%;">+ Remove Location</div>
                    <hr style="border-top:1px #000 solid;">
                    </div>-->
                    <?php }
      		} else{?>
      		
		      		<div class="uk-grid" data-uk-grid-margin>
		      			<div class="uk-width-medium-1-2">
				      		<label>Location Name</label>
				      		<input type="text" class="md-input" name="location_name[]" value="<?php echo set_value('location_name[]');?>" />
				      		<?php echo "<div style='color:red'>".form_error('location_name[]')."</div>"; ?>
			      		</div>
			      		
			      		<div class="uk-width-medium-1-2">
				      		<label>Address</label>
				      		<input type="text" class="md-input" name="address[]" value="<?php echo set_value('address[]');?>" />
				      		<?php echo "<div style='color:red'>".form_error('address[]')."</div>"; ?>
			      		</div>
			      	</div>
		      		<div class="uk-grid" data-uk-grid-margin>
			      		<div class="uk-width-medium-1-2">
				      		<label>City</label>
				      		<input type="text" class="md-input" name="city[]" value="<?php echo set_value('city[]');?>" />
				      		<?php echo "<div style='color:red'>".form_error('city[]')."</div>"; ?>
			      		</div>
		      		
                <div class="uk-width-medium-1-2">
                  <label>state</label>
                  <input type="text" class="md-input" name="state[]" value="<?php echo set_value('state[]');?>" />
                  <?php echo "<div style='color:red'>".form_error('state[]')."</div>"; ?>
                </div>
			      </div>
		      		<div class="uk-grid" data-uk-grid-margin>
			      		
		      		
			      		<div class="uk-width-medium-1-2">
				      		<label>Zip Code</label>
				      		<input type="text" class="md-input" name="zip[]" value="<?php echo set_value('zip[]');?>" />
				      		<?php echo "<div style='color:red'>".form_error('zip[]')."</div>"; ?>
			      		</div>



                <div class="uk-width-medium-1-2">
              <?php //if(!$default_option) { ?>
                         <label for="" class="inline-label">Apply Default Settings</label>
                                <div class="parsley-row">
                                     <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"<?php  
                                            /* if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                        echo 'checked';
                                                }*/
                                         ?>/>
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                             /*if(ISSET($_POST['default']) && $_POST['default'] == 0) {
                                                        echo 'checked';
                                                }*/
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                </div>
                            <?php //} ?>
                        </div>



                
		      		</div>



              <div class="uk-grid" data-uk-grid-margin >

                        <div class="uk-width-medium-1-2" style="float:right;">
                      
                </div>


                            <div class="uk-width-medium-1-2" style="float:right;">
                      <input type="submit" class="uk-form-file md-btn md-btn-primary" style="float:right;" name="Create" value="Create" onclick="return showNoFile();">
                </div>
                             

                    </div>
		      		<!--<hr style="border-top:1px #000 solid;">-->
      	<?php } ?>
      		
      		</div>
                    <!--<div class="uk-grid" data-uk-grid-margin>
                        <a class="add_location_button"> + Add New Location </a>
                    </div>-->
                </div>
            </div>
                

            
            
	
        </form>    

        </div>
    </div>
