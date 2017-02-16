<div id="page_content" class="inner-gray-bg">
  <div id="page_content_inner">
		<h3 class="heading_b uk-margin-bottom">
      <?php echo $this->lang->line('new_organization'); ?>
    </h3>
    <style>
      .parsley-email{
        color:red;
      }
    </style>
<form action="" id="form_validation" class="uk-form-stacked newOrg" name="organization" method="post" enctype="multipart/form-data">
<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                  <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?> 
                <input type="hidden" id="org_plans" name="org_plans" value="1" />
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                              <div class="parsley-row">
                                <label for="fullname"><?php echo $this->lang->line('organization_name'); ?><span class="req">*</span></label>
                                <input type="text" required name="org_name" class="md-input" value="<?php echo set_value('org_name');?>" style="width: 95%;" 
                                  data-parsley-error-message="<?php echo $this->lang->line('organization_name_req'); ?>"
                                />
                                <?php echo "<div style='color:red'>".form_error('org_name')."</div>"; ?>
                              </div>
                            <div class="parsley-row">
                              <!-- <label for="countries"><?php echo $this->lang->line('select_country'); ?> <span class="req">*</span></label> -->
                        <!-- data-md-selectize -->
                              <select class="chosen_select" id="" required data-placeholder="Select Countries..." name="countries" onchange="countrychange(this.value);" data-parsley-error-message="<?php echo $this->lang->line('country_req'); ?>"  data-parsley-errors-container="#error_country" >
                                  <option value="">Select Countries</option>
                                  <?php 
                                  foreach($countries as $key=>$value){ ?>
                                      <option value="<?php echo $value['loc_id']; ?>" 
                                      <?php 
                                          if((isset($_POST['countries']) && $value['loc_id'] == $_POST['countries'])){
                                                  echo 'selected';
                                          }?> > <?php echo $value['country_name']; ?>
                                      </option>
                                  <?php } ?>
                              </select>
                              <?php echo "<div style='color:red'>".form_error('countries')."</div>"; ?>
                              <div id="error_country"></div>
                            </div>
                            <br/>
                            <div class="parsley-row">
                              <!-- <label for="domain">
                                <?php echo $this->lang->line('select_industry'); ?> <span class="req">*</span>
                              </label> -->
                              <span id="domain">
                               <!--  <?php echo $domains_list; ?> -->
                                <select class="chosen_select" data-placeholder="Select Industry..." required name="domain" data-parsley-error-message="<?php echo $this->lang->line('industry_req'); ?>" data-parsley-errors-container="#error_domain" >
                                  <!-- <?php echo $domains_list; ?> -->
                                 <option value="">Select Industry</option>
                                </select>
                              </span>
                              <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                              <div id="error_domain"></div>
                          </div>

                        </div>
                        <div class="uk-width-medium-1-2">
                          <div class="">
                              <label>Organization Logo</label>
                          </div>
                          <div class="uk-form-file" style=";">
                             <p>Click to upload image</p>
                             <img src="" class="org_logo"/>
                          	 <input type="file" name="org_logo" id="org_logo">
                      		</div>
                          <span class="uk-form-help-block">Image Should be (500 X 300)</span>
                      			
                        </div>
                    </div>
                  </div>
              </div>
              <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">User Info</h3>
                        
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                 <label>First Name <span class="req">*</span></label>
                                 <input type="text" class="md-input" id="usr_name" name="usr_name" required data-parsley-error-message="<?php echo $this->lang->line('first_name_req'); ?>" value="<?php echo set_value('usr_name');?>" />
                                 <?php echo "<div style='color:red'>".form_error('usr_name')."</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Last Name <span class="req">*</span></label>
                                <input type="text" class="md-input" id="usr_lname" name="usr_lname" required data-parsley-error-message="<?php echo $this->lang->line('last_name_req'); ?>" value="<?php echo set_value('usr_lname');?>" />
                                <?php echo "<div style='color:red'>".form_error('usr_lname')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                              <label>Email <span class="req">*</span></label>
                              <input type="email" class="md-input" id="usr_email" required name="usr_email" data-parsley-email value="<?php echo set_value('usr_email');?>" data-parsley-error-message="<?php echo $this->lang->line('email_req'); ?>"/>
                              <?php echo "<div style='color:red'>".form_error('usr_email')."</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                              <label>Phone <span class="req">*</span></label>
                              <input id="kUI_masked_phone" type="text" id ="usr_phone" class="uk-form-width-medium md-input" name="usr_phone" required value="<?php echo set_value('usr_phone');?>"  data-parsley-error-message="<?php echo $this->lang->line('phone_req'); ?>" />
                              <span class="uk-form-help-block">(000)000-0000</span>
                              <?php echo "<div style='color:red'>".form_error('usr_phone')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    
                  <!--     <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                      
                        </div>
                
                    </div>
              </div>
            </div>

            <div class="md-card">
              <div class="md-card-content"> -->
                <h3 class="heading_a">Location</h3>
		      		<div class="uk-grid" data-uk-grid-margin>
		      			<div class="uk-width-medium-1-2">
                  <div class="parsley-row">
				      		<label>Location Name <span class="req">*</span></label>
				      		<input type="text" class="md-input" name="location_name[]" required value="<?php echo set_value('location_name[]');?>" data-parsley-error-message="<?php echo $this->lang->line('location_name_req'); ?>" />
				      		<?php echo "<div style='color:red'>".form_error('location_name[]')."</div>"; ?>
                  </div>
			      		</div>
			      		
			      		<div class="uk-width-medium-1-2">
                  <div class="parsley-row">
				      		<label>Address <span class="req">*</span></label>
				      		<input type="text" class="md-input" name="address[]" required value="<?php echo set_value('address[]');?>" data-parsley-error-message="<?php echo $this->lang->line('address_req'); ?>"/>
				      		<?php echo "<div style='color:red'>".form_error('address[]')."</div>"; ?>
			      		</div>
                </div>
			      	</div>
		      		<div class="uk-grid" data-uk-grid-margin>
			      		<div class="uk-width-medium-1-2">
                  <div class="parsley-row">
				      		<label>City <span class="req">*</span></label>
				      		<input type="text" class="md-input" name="city[]" required value="<?php echo set_value('city[]');?>" data-parsley-error-message="<?php echo $this->lang->line('city_req'); ?>"/>
				      		<?php echo "<div style='color:red'>".form_error('city[]')."</div>"; ?>
			      		</div>
		      		  </div>
                <div class="uk-width-medium-1-2">
                  <div class="parsley-row">
                  <label>State <span class="req">*</span></label>
                  <input type="text" class="md-input" name="state[]" required value="<?php echo set_value('state[]');?>" data-parsley-error-message="<?php echo $this->lang->line('state_req'); ?>" />
                  <?php echo "<div style='color:red'>".form_error('state[]')."</div>"; ?>
                </div>
                </div>
			      </div>
		      		<div class="uk-grid" data-uk-grid-margin>
  			      		<div class="uk-width-medium-1-2">
                    <div class="parsley-row">
    				      		<label>Zip Code <span class="req">*</span></label>
    				      		<input type="number" class="md-input" name="zip[]" required value="<?php echo set_value('zip[]');?>" data-parsley-error-message="<?php echo $this->lang->line('zipcode_req'); ?>" />
    				      		<?php echo "<div style='color:red'>".form_error('zip[]')."</div>"; ?>
                    </div>
  			      		</div>
                  <div class="uk-width-medium-1-2">
                     <label for="" class="inline-label">Apply Default Settings</label>
                        <div class="parsley-row">
                          <span class="icheck-inline">
                            <input type="radio" required name="default" id="radio_demo_inline_1" data-md-icheck value="1" data-parsley-error-message="<?php echo $this->lang->line('default_setting_req'); ?>" data-parsley-errors-container="#error-container"  />
                            <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                          </span>
                          <span class="icheck-inline">
                            <input type="radio" required name="default" id="radio_demo_inline_2" data-md-icheck value="0" data-parsley-error-message="<?php echo $this->lang->line('default_setting_req'); ?>" data-parsley-errors-container="#error-container"  />
                            <label for="radio_demo_inline_2" class="inline-label">No</label>
                          </span>
                          <div id="error-container"></div>
                        </div>
                  </div>
		      		</div>
            </div>
             <div class="md-card">
                <div class="md-card-content">
                  <h3 class="heading_a">Choose Subscription type</h3>
                  <span class="uk-form-help-block">By Default Standard plan</span>
                  <br/>
                  <div class="plan_container">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-4">
                        </div>
                        <div class="uk-width-medium-1-4">
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
                                            <h6>Unlimited</h6>
                                            <p>Submissions</p>
                                        </li>
                                    </ul>
                                    <div class="uk-text-center customs" id="custom">
                                        <div id="standard" data-plan="1" class="md-btn md-btn-small plan">
                                          <b>Check out</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="uk-width-medium-1-4">
                            <div class="professional-plan">
                                <div class="md-card md-card-hover-img">
                                    <div class="md-card-head uk-text-center uk-position-relative">
                                        <h2 class="green-bg">Enterprise</h2>
                                    </div>
                                    <ul class="md-card-content plan-list">
                                        <li>
                                            <h6> - </h6>
                                            <p>Users</p>
                                        </li>
                                        <li>
                                            <h6> - </h6>
                                            <p>Jobsites</p>
                                        </li>
                                        <li>
                                            <h6>Unlimited</h6>
                                            <p>Forms</p>
                                        </li>
                                        <li>
                                            <h6>Unlimited</h6>
                                            <p>Submissions</p>
                                        </li>
                                    </ul>
                                    <div class="uk-text-center customs" id="custom">
                                        <div id="professional_plan" data-plan="" class="md-btn md-btn-small plan">
                                          <b>Check out</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="uk-width-medium-1-4">
                            <input type="hidden" class="new_plan" name="new_plan" />
                          </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="uk-grid" data-uk-grid-margin >
                  <div class="uk-width-medium-1-2" style="float:right;">
                    <input type="submit" class="md-btn md-btn-primary uk-center" style="float:right;" name="Create" value="Create">
                  </div>
                  <div class="uk-width-medium-1-2">
                      <a class="md-btn md-btn-danger uk-center" href="<?php echo base_url() ?>organization">
                            <?php echo $this->lang->line('cancel'); ?>
                      </a>
                  </div>
              </div>
            </div>

        </form>    
      </div>
  </div>
