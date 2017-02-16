 <?php 
    $dept_access = $this->session->userdata('menu');
    $org_id = $this->session->userdata('org_id');
  ?>
<div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom">Edit Department</h3>
	<form action="" id="form_validation" class="uk-form-stacked" name="department" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                	<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                	<div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                  		  <?php echo $this->session->flashdata('SucMessage');  ?>
                	</div> <?php } ?>  
                    <?php //print_r($result); exit; ?>  
                    <div class="uk-grid" data-uk-grid-margin>
                        <input type="hidden" name="dept_id" value="<?php echo $result['department'][0]['dept_id']; ?>" />
                        <input type="hidden" name="org_id" value="<?php echo $org_id; ?>" />
                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="departmentname">Department Name <span class="req">*</span></label>
                                    <input type="text" name="dept_name" class="md-input" value="<?php if(ISSET($_POST['dept_name']))
                                                { echo set_value('dept_name'); }
                                                else{
                                                   echo $result['department'][0]['dept_name'];
                                                }
                                        ?>" data-parsley-trigger="change" required  />
                            <?php echo "<div style='color:red'>".form_error('dept_name')."</div>"; ?>
                                </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                     <div class="uk-grid" data-uk-grid-margin>
                          <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="departmentname desc">Department Name Descriptions </label>
                                    <textarea name="dept_desc" cols="10" rows="2" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-validation-threshold="10" data-parsley-minlength-message = "Come on! You need to enter at least a 20 caracters long comment.."  class="md-input"><?php if(ISSET($_POST['dept_desc']))
                                                { echo set_value('dept_desc'); }
                                                else{
                                                     echo $result['department'][0]['dept_desc'];
                                                }
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('dept_desc')."</div>"; ?>
                                </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>

                    <?php f(!$org_id){ ?>
                     <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="countries">Select Countries <span class="req">*</span></label>
                                    <select data-md-selectize id="" required class="editcountry_change" data-placeholder=" Select Countries" name="countries">
                                    <option value=" ">Select Country</option>
                                    	<?php 
                                    	foreach($countries['country'] as $key=>$value){ ?>
                                    		<option value="<?php echo $value['loc_id']; ?>" 
                                    		<?php
                                             if(isset($_POST['countries'])){
                                                if($value['loc_id'] === $_POST['countries']){
                                                    echo 'selected';
                                                }

                                            }else{ 
                                    			if($value['loc_id'] === $result['department'][0]['country_id']){ 
                                    					echo 'selected';
                                    			}

                                    		}?> > <?php echo $value['country_name']; ?>
                                    		</option>
                                    	<?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('countries')."</div>"; ?>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                         <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="domain">Select Domains <span class="req">*</span></label>
                                <span id="domains">
                                    <select data-md-selectize id="" required class="domain_change" data-placeholder="Select Domain..." name="domain">
                                        <?php 

                                        foreach($result['domain'] as $key=>$value){ ?>
                                            <option value="<?php echo $value['domain_id']; ?>"
                                                <?php 
                                                if(isset($_POST['domain'])){
                                                    if($value['domain_id'] == $_POST['domain']){
                                                        echo 'selected';
                                                    }
                                                }else{
                                                if($value['domain_id'] == $result['selected_domain']){
                                                    echo 'selected';
                                                    }
                                                } ?>>
                                                <?php echo $value['domain_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </span>
                                    <?php echo "<div style='color:red'>".form_error('domain[]')."</div>"; ?>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <?php } ?>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                <label for="" class="inline-label">Set Status</label>
                                <div class="parsley-row">
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" id="radio_demo_inline_1" data-md-icheck value="1" <?php  
                                        if(ISSET($_POST['status'])){
                                            if($_POST['status'] == 1) {
                                                echo 'checked';
                                        }
                                        }else{
                                            if($result['department'][0]['status'] == 1) {
                                              echo 'checked';
                                          }
                                        } 
                                     ?> />
                                        <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" id="radio_demo_inline_2" data-md-icheck value="0"<?php  
                                        if(ISSET($_POST['status'])){
                                            if($_POST['status'] == 0) {
                                                echo 'checked';
                                        }
                                        }else{
                                            if($result['department'][0]['status'] == 0) {
                                              echo 'checked';
                                          }
                                        } 
                                     ?> />
                                        <label for="radio_demo_inline_2" class="inline-label">No</label>
                                    </span>
                            </div>
                        </div>
                         <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <?php if ($org_id != 1) { ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row org_users">
                                <label><?php echo $this->lang->line('users'); ?></label><br/>
                                <div id="users">
                                <select id="multiselect_users" name="users[]" multiple="multiple" data-placeholder="Select Users...">
                                    <?php foreach($users as $key=>$value) { 
                                        ?>
                                    <option value="<?php echo $value['id']; ?>"
                                        <?php
                                            if(is_array($dept_user)){
                                                if(in_array($value['id'], $dept_user)){
                                                    echo 'selected';
                                                }
                                            }else{
                                                if(isset($_POST['users'])){
                                                   if(in_array($value['id'],$_POST['users'])){
                                                    echo 'selected';
                                                   }
                                                }else if($value['id'] === $user_id){
                                                    echo 'selected';
                                                }
                                            }
                                        ?>
                                    >
                                        <?php echo $value['name']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                    		<input type="submit" class="md-btn md-btn-primary" style="float:right;" name="save" value="Save">

                    	</div>
                    	<div class="uk-width-medium-1-2">
                    			 <a href="<?php echo base_url(); ?>department" class="md-btn md-btn-danger">Cancel</a>
                    	</div>
                    </div>

                </div>
            </div>

	</form>
</div>
</div>