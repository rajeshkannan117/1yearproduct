<style>
  .parsley-custom-error-message{
    color:red;
  }
</style>
<div id="page_content">
    <div id="page_content_inner">

        <form action="" id="form_validation" class="uk-form-stacked" name="organization" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a"><?php echo $this->lang->line('new_user'); ?> </h3>
                        
                    <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                    <div class="uk-alert uk-alert-success" data-uk-alert="">
                	   <a href="#" class="uk-alert-close uk-close"></a>
                        <?php echo $this->session->flashdata('SucMessage');  ?>
                    </div> <?php } ?>  
                    <?php if($org_id ==1){?>  
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
			 					<label for="val_select" ><?php echo $this->lang->line('organization'); ?>  <span class="required">*</span></label>
                                    <select id="val_select" name="org_id" class="org_change" required data-md-selectize onchange="org_change(this.value);">
                                        <option value=""> Select </option>
										<?php foreach($org as $org_det) {?>
                                   			<option <?php if(set_value('org_id') == $org_det['id']) { ?>selected= "selected"<?php } ?> value="<?php echo $org_det['id']; ?>"><?php echo $org_det['org_name']; ?></option>
                                       	<?php } ?>
                                    </select>
				 				<?php echo "<div style='color:red'>" . form_error('org_id') . "</div>"; ?>
                                </div>
                                
                        </div>
                         <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('location'); ?>  <span class="required">*</span></label>
                                <div id="location">
                                    <select id="multiselect_location" name="location_id[]" multiple ="multiple" class="location_id"  placeholder="Select location...">
                                        <?php foreach($location as $key=>$value) { ?>
                                            <option <?php if(set_value('location_id') == $value['location_id'] || $value['headbranch']) { ?>selected= "selected"<?php } ?> value="<?php echo $value['location_id']; ?>"><?php echo $value['location']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 <label><?php echo $this->lang->line('country'); ?> </label>
                                 <span id="details">
                                 <input type="text" class="md-input" name="location" value="<?php echo set_value('location');?>" disabled/>
                                 <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                                 </span>
                        </div>

                        <div class="uk-width-medium-1-2">
                            <label><?php echo $this->lang->line('domain'); ?> </label>
                             <span id="domain">
                             <input type="text" class="md-input" name="domain" value="<?php echo set_value('domain');?>" disabled/>
                             <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                             </span>
                        </div>
                    </div>
            <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 <label><?php echo $this->lang->line('first_name'); ?><span class="req">*</span> </label>
                                 <input type="text" class="md-input" id="usr_firstname" name="usr_firstname" value="<?php echo set_value('usr_firstname');?>" required  data-parsley-error-message="<?php echo $this->lang->line('first_name_req'); ?>"  />
                                 <?php echo "<div style='color:red'>".form_error('usr_firstname')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label><?php echo $this->lang->line('last_name'); ?><span class="req">*</span> </label>
                            <input type="text" class="md-input" id="usr_lastname" name="usr_lastname" value="<?php echo set_value('usr_lastname');?>" required data-parsley-error-message="<?php echo $this->lang->line('last_name_req'); ?>" />
                            <?php echo "<div style='color:red'>".form_error('usr_lastname')."</div>"; ?>
                        </div>
                    </div>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label><?php echo $this->lang->line('email'); ?><span class="req">*</span> </label>
                            <input type="email" class="md-input" id="usr_email" name="usr_email" value="<?php echo set_value('usr_email');?>" required data-parsley-error-message="<?php echo $this->lang->line('email_req'); ?>"/>
                            <?php echo "<div style='color:red'>".form_error('usr_email')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label><?php echo $this->lang->line('phone'); ?><span class="req">*</span> </label>
                            <input id="kUI_masked_phone" type="text" id ="usr_phone" class="uk-form-width-medium md-input" name="usr_phone" required value="<?php echo set_value('usr_phone');?>" data-parsley-error-message="<?php echo $this->lang->line('phone_req'); ?>"/>
                              <span class="uk-form-help-block">(000)000-0000</span>
                            <?php echo "<div style='color:red'>".form_error('usr_phone')."</div>"; ?>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="department">
                                    <?php echo $this->lang->line('select_department'); ?><span class="req">*</span></label>
                                <span id="department">
                                    <select id="multiselect_departments" class="chosen_select" required multiple="multiple" data-parsley-error-message="<?php echo $this->lang->line('department_req'); ?>" data-placeholder="Select Department..." name="department[]">
                                    <?php 
                                     foreach($dept as $key=>$value) { ?>
                                        <option value="<?php echo $value['dept_id']; ?>"
                                        <?php 
                                            if(ISSET($_POST['department'])){
                                              if(in_array($value['dept_id'],$_POST['department']))
                                              {   echo 'selected'; }
                                            }
                                       ?>><?php echo $value['dept_name']; ?></option>
                                    <?php } ?>
                                        
                                    </select>
                                </span>
                                    <?php echo "<div style='color:red'>".form_error('department')."</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">

                                <label for="val_select" > <?php echo $this->lang->line('select_role'); ?><span class="req">*</span></label>
                                  <div id="role">
                                    <select id="val_select" name="role_id" class="chosen_select org_change" required data-parsley-error-message="<?php echo $this->lang->line('role_req'); ?>" data-parsley-errors-container="#error-container" >
                                        <option value=""> Select </option>
                                        <?php foreach($role as $role_det) {?>
                                            <option <?php if(ISSET($_POST['role_id'])){ 
                                            if($_POST['role_id'] == $role_det['role_id']){ ?>   selected= "selected"
                                            <?php 
                                                } 
                                            } ?> value="<?php echo $role_det['role_id']; ?>"><?php echo $role_det['role_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php echo "<div style='color:red'>" . form_error('role_id') . "</div>"; ?>
                                    <div id="error-container"></div>
                                 </div>
                                </div>
                                
                        </div>
                    </div>
                    <?php if($org_id != 1){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('location'); ?>  <span class="req">*</span></label>
                                <div id="location">
                                <select id="multiselect_locations"  name="location_id[]" multiple ="multiple" class="location_id chosen_select md-input" required  placeholder="Select location..." data-parsley-error-message="Jobsite is required">
                                    <?php foreach($location as $key=>$value) { ?>
                                        <option <?php if(isset($_POST['location_id'])){
                                                if($_POST['location_id'] == $value['location_id']){ ?>
                                            selected= "selected"
                                        <?php } }else if($value['headbranch']) { ?>
                                            selected= "selected"
                                        <?php } ?> value="<?php echo $value['location_id']; ?>"><?php echo $value['location']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
		                  <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="Create" value="<?php echo $this->lang->line('save'); ?> ">
		      			</div>
		      			<div class="uk-width-medium-1-2" style="">
		                  <a class="md-btn md-btn-danger" href="<?php echo base_url() ?>users">
                            <?php echo $this->lang->line('cancel'); ?> 
                           </a>
		      			</div>
                    </div>
                </div>
            </div>
	
        </form>    

        </div>
    </div>

  
