<div id="page_content" class="inner-gray-bg">
        <div id="page_content_inner">
<form action="" id="form_validation" class="uk-form-stacked" name="organization" method="post" enctype="multipart/form-data">


           <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                  <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?> 



            <div class="md-card" >
                <div class="md-card-content">
                	<h3 class="heading_a uk-margin-bottom">
                    Organization Details
                  </h3>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                        	<div class="parsley-row">
                              <label for="fullname"><?php echo $this->lang->line('organization_name'); ?><span class="req">*</span></label>
                                <input type="text" name="org_name" class="md-input" value="<?php if(ISSET($_POST['org_name'])){ echo set_value('org_name'); } else{ echo $result['org_name']; }?>" data-parsley-error-message="<?php echo $this->lang->line('organization_name_req'); ?>"/>
                                <?php echo "<div style='color:red'>".form_error('org_name')."</div>"; ?>
                            </div>
                            <div class="parsley-row">
                                <label for="fullname"><?php echo $this->lang->line('country'); ?> <span class="req">*</span></label>
                                    <input type="text" disabled="disabled" name="countries" class="md-input" value="<?php if(ISSET($_POST['countries'])){ echo set_value('countries'); } else{ echo $result['country_name']; }?>" />
                                  <?php echo "<div style='color:red'>".form_error('countries')."</div>"; ?>
                            </div>
                            <div class="parsley-row">
                                <label for="fullname"><?php echo $this->lang->line('domain'); ?><span class="req">*</span></label>
                                    <input type="text" disabled="disabled" name="domain" class="md-input" value="<?php if(ISSET($_POST['domain'])){ echo set_value('domain'); } else{ echo $result['domain_name']; }?>" />
                                    <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                          <label>
                              Organization Logo
                          </label>
                        	<div class="parsley-row">
                            <?php if($result['org_logo']!=""){ ?>
                                <?php if(file_exists(LOGOS_IMAGE_PATH.$result['org_logo'])){ ?>
                                  <img src="<?php echo base_url().'uploads/logos/'.$result['org_logo']; ?>" height="200" width="200" class="profile_image">
                                  <input type="hidden" name="org_logo" value="<?php echo $result['org_logo']; ?>" />
                                <?php } else { ?>
                                  <div class="uk-form-file md-btn md-btn-primary">
                                    <p>Click to upload image</p>
                                    <img class="org_logo" height="300" width="500" />
                                    <input id="org_logo" type="file" name="org_logo">
                                  </div>
                                <?php } 
                            } else{ ?>
                                  <div class="uk-form-file md-btn md-btn-primary">
                                    <p>Click to upload image</p>
                                    <img class="org_logo" height="300" width="500" />
                                    <input id="org_logo" type="file" name="org_logo">
                                  </div>
                            <?php } ?>
                                <span class="uk-form-help-block">Image Should be (500 X 300)</span>
                            </div>
                            <?php if(1 == 0){ ?>                            
                            <div class="parsley-row">
                                <!--<label for="country[]"><?php echo $this->lang->line('select_country'); ?><span class="req">*</span></label>-->
                              <!--   <select id="" required class="chosen_select country_change" data-placeholder=" Select Countries" name="countries" onchange="countrychange(this.value);">
                                <option value=" ">Select Country</option>
                                  <?php 

                                  foreach($countries as $key=>$value){ ?>
                                    <option value="<?php echo $value['loc_id']; ?>" 
                                    <?php
                                         if(isset($_POST['countries'])){
                                            if($value['loc_id'] === $_POST['countries']){
                                                echo 'selected';
                                            }

                                        }else{ 
                                      if($value['loc_id'] === $result['country']){ 
                                          echo 'selected';
                                      }

                                    }?> > <?php echo $value['country_name']; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                                <?php echo "<div style='color:red'>".form_error('country')."</div>"; ?>
                            </div>
                            <div class="parsley-row"> -->
                                    <!--<label for="domain"><?php echo $this->lang->line('select_industry'); ?><span class="req">*</span></label>-->
                                    <!-- <span id="domain">
                                    <select id="" required class="domain_change chosen_select" data-placeholder=" Select Domain" name="domain">
                                    <option value=" ">Select Industry</option>
                                      <?php 
                                      foreach($domain as $key=>$value){ ?>
                                        <option value="<?php echo $value['domain_id']; ?>" 
                                        <?php
                                             if(isset($_POST['domain'])){
                                                if($value['domain_id'] === $_POST['domain']){
                                                    echo 'selected';
                                                }

                                            }else{ 
                                          if($value['domain_id'] === $result['domain_id']){ 
                                              echo 'selected';
                                          }

                                        }?> > <?php echo $value['domain_name']; ?>
                                        </option>
                                      <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                                    </span>
                                </div> -->
                            
                        </div>
                      <?php } ?>
                    </div>
                </div>
                </div>
                <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a"><?php echo $this->lang->line('location'); ?></h3>
                    <br/>
                    <div class="location_container" >
                    <?php if(isset($_POST['address'])) {
      				foreach($_POST['address'] as $count)
					{ ?>
					<div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<input type="hidden" name="loc_id[]" value="<?php echo set_value('loc_id[]'); ?>" />
                    	<div class="uk-width-medium-1-2">
				      		<label><?php echo $this->lang->line('location_name'); ?></label>
				      		<input type="text" class="md-input" name="location_name[]" value="<?php echo set_value('location_name[]');?>" />
				      		<?php echo "<div style='color:red'>".form_error('location_name[]')."</div>"; ?>
			      		</div>
			      		
                        <div class="uk-width-medium-1-2">
                                 <label><?php echo $this->lang->line('address'); ?></label>
                                 <input type="text" class="md-input" name="address[]" value="<?php echo set_value('address[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('address[]')."</div>"; ?>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                   <label><?php echo $this->lang->line('city'); ?></label>
                                   <input type="text" class="md-input" name="city[]" value="<?php echo set_value('city[]');?>" />
                                   <?php echo "<div style='color:red'>".form_error('city[]')."</div>"; ?>
                        </div>
                    
                    	   <div class="uk-width-medium-1-2">
                                 <label><?php echo $this->lang->line('state'); ?></label>
                                 <input type="text" class="md-input" name="state[]" value="<?php echo set_value('state[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('state[]')."</div>"; ?>
                        </div>

                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        
                    
                        <div class="uk-width-medium-1-2">
                                 <label><?php echo $this->lang->line('zip_code'); ?></label>
                                 <input type="text" class="md-input" name="zip[]" value="<?php echo set_value('zip[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('zip[]')."</div>"; ?>
                        </div>

                        <div class="uk-width-medium-1-2" style="float:right;">
                      	<input type="submit" class="uk-form-file md-btn md-btn-primary" style="float:right;" name="Create" value="<?php echo $this->lang->line('update'); ?>">
                </div>

                    </div>
                  
                    </div>
                    <?php }
      		} else{
              ?>
<div>
		      		<div class="uk-grid" data-uk-grid-margin>
		      			<input type="hidden" name="loc_id[]" value="<?php echo $result['loc_id'];?>" />
		      			<div class="uk-width-medium-1-2">
				      		<label><?php echo $this->lang->line('location_name'); ?></label>
				      		<input type="text" class="md-input" name="location_name[]" value="<?php echo $result['location_name'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('location_name[]')."</div>"; ?>
			      		</div>
			      		
			      		<div class="uk-width-medium-1-2">
				      		<label><?php echo $this->lang->line('address'); ?></label>
				      		<input type="text" class="md-input" name="address[]" value="<?php echo $result['address'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('address[]')."</div>"; ?>
			      		</div>
			      	</div>
			      	<div class="uk-grid" data-uk-grid-margin>
			      		<div class="uk-width-medium-1-2">
				      		<label><?php echo $this->lang->line('city'); ?></label>
				      		<input type="text" class="md-input" name="city[]" value="<?php echo $result['city'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('city[]')."</div>"; ?>
			      		</div>
			      		
                <div class="uk-width-medium-1-2">
                  <label><?php echo $this->lang->line('state'); ?></label>
                  <input type="text" class="md-input" name="state[]" value="<?php echo $result['state'];?>" />
                  <?php echo "<div style='color:red'>".form_error('state[]')."</div>"; ?>
                </div>

			      	</div>
			      	<div class="uk-grid" data-uk-grid-margin>
			      		<div class="uk-width-medium-1-2">
				      		<label><?php echo $this->lang->line('zip_code'); ?></label>
				      		<input type="text" class="md-input" name="zip[]" value="<?php echo $result['zip_code'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('zip[]')."</div>"; ?>
			      		</div>
              </div>
            </div>
      	<?php } //} ?>
      		
      		</div>
                </div>
            </div>

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Subscription Plan</h3>
                    <br>
                    <div class="plan_container">
                      <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-4" style="margin:0 auto;">
                            <?php if($result['org_plan'] == 1) { ?>
                            <div class="standard-plan">
                                <div class="md-card md-card-hover-img">
                                    <div class="md-card-head uk-text-center uk-position-relative">
                                        <h2 class="gray-bg">Standard</h2>
                                        <p> </p>
                                    </div>
                                    <ul class="md-card-content">
                                        <li>
                                            <h6>5</h6>
                                            <p>Users</p>
                                        </li>
                                        <li>
                                            <h6>3</h6>
                                            <p>Jobsites</p>
                                        </li>
                                        <li>
                                            <h6>Unlimited</h6>
                                            <p>Forms</p>
                                        </li>
                                        <li>
                                            <h6> - </h6>
                                            <p>Submissions</p>
                                        </li>
                                    </ul>
                                    <!-- <div class="md-btn md-btn-small uk-text-center customs" id="custom">
                                        <div id="standard" data-plan="1" class="plan">
                                          <b>Check out</b>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <?php } ?>
                          </div>
                          <div class="uk-width-medium-1-4" style="margin:0 auto;">
                            <?php if($result['org_plan'] != 1){ ?>
                            <div class="professional-plan">
                                <div class="md-card md-card-hover-img">
                                    <div class="md-card-head uk-text-center uk-position-relative">
                                        <h2 class="green-bg">Enterprise</h2>
                                    </div>
                                    <ul class="md-card-content plan-list">
                                        <li>
                                            <h6> <?php echo $plan_users; ?> </h6>
                                            <p>Users</p>
                                        </li>
                                        <li>
                                            <h6> <?php echo $plan_jobsites; ?> </h6>
                                            <p>Jobsites</p>
                                        </li>
                                        <li>
                                            <h6> Unlimited </h6>
                                            <p>Forms</p>
                                        </li>
                                        <li>
                                            <h6> - </h6>
                                            <p>Submissions</p>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                            <?php } ?>
                          </div>
                          <!-- <div class="md-btn md-btn-small uk-text-center customs" id="custom">
                                    <div id="professional_plan" data-plan="" class="plan">
                                      <b>Check out</b>
                                    </div>
                                </div> -->
                          <!--<div class="uk-width-medium-1-4">
                            <input type="hidden" class="new_plan" name="new_plan" />
                          </div>-->
                        </div>
		      		
      				</div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2" style="float:right;">
                      <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="Create" value="<?php echo $this->lang->line('update'); ?>">
                </div>
               <div class="uk-width-medium-1-2">
                    <a href="<?php echo base_url(); ?>organization" class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?></a>
              </div>
                

              </div>
           
	
        </form>    

        </div>
    </div>
