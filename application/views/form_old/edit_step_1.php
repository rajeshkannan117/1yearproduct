<?php
    $org_id = $this->session->userdata('org_id'); 
?>
 <div id="page_content">
        <div id="page_content_inner">
    <form name="new_form" action ="" method ="post" id="form_validation" class="uk-form-stacked" novalidate>
    <?php //print_r($details); exit; ?>
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Edit Form Details</h3>
                    <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
                    <?php if(!$org_id){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2 uk-container-center">
                            <div class="parsley-row">
                                <label>Select an organization<span class="errors" style="color:crimson;">*</span></label>
                                <select data-md-selectize required name="organization" id="form_org">
                                     <option value="">Choose Organization</option>
                                    <?php foreach($organizations as $key=>$value){ ?>
                                        <option value="<?php echo $value['id'] ?>"
                                        <?php 
                                            if(isset($_POST['organization'])){ 
                                                if($_POST['organization'] === $value['id']){
                                                    echo 'selected';
                                                }
                                            } 
                                        ?> ><?php echo $value['org_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Form Name  <span class="errors" style="color:crimson;">*</span></label>
                                <input type="text" class="md-input" id="form_name" name="form_name" value="<?php if(isset($_POST['form_name'])){ echo set_value('form_name'); } else{ echo $details->form_name; } ?>" data-parsley-trigger="change" required  />
                                 <?php  echo "<div style='color:red'>" . form_error('form_name') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Form Code  <span class="errors" style="color:crimson;" >*</span></label>
                                <input type="text" class="md-input" id="form_code" name="form_code" value="<?php if(isset($_POST['form_code'])){ echo set_value('form_code');}else{ echo $details->form_code;} ?>" data-parsley-trigger="change" readonly />
                                 <?php  echo "<div style='color:red'>" . form_error('form_code') . "</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <div class="parsley-row">
                                    <label>Columns</label>
                                    <input type="number" class="md-input" id="form_column" name="form_column" value="<?php if(isset($_POST['form_column'])){ echo set_value('form_column');} else{ echo $columns; } ?>" readonly />
                                    <?php  echo "<div style='color:red'>" . form_error('form_column') . "</div>"; ?>
                                </div>
                                <!--<label>Form Description </label>
                                <textarea name="form_desc" class="md-input"><?php if(ISSET($_POST['form_desc']))
                                                { echo set_value('form_desc'); }else{
                                                    echo $details->form_desc;
                                                }
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('form_desc')."</div>"; ?>-->
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                           <div class="parsley-row">
                                <label>Response To : <span class="errors" style="color:crimson;">*</span></label>
                                <input type="email" class="md-input" id="response_email" name="response_email" value="<?php if(isset($_POST['response_email'])){ echo set_value('response_email');}else{ echo $details->response_to;} ?>" data-parsley-trigger="change" required  />
                                 <?php  echo "<div style='color:red'>" . form_error('response_email') . "</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Form Type <span class="errors" style="color:crimson;">*</span></label>
                                <select data-md-selectize required data-placeholder="..." name="form_type">
                                    <option value="1" selected >General</option>
                                </select>
                                 <?php  echo "<div style='color:red'>" . form_error('form_type') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                           <div class="parsley-row org_category">
                                <label>Select Categories <span class="errors" style="color:crimson;">*</span></label>
                                <select id="" required data-md-selectize data-placeholder="Select Categories..." name="categories">
                                    <?php 
                                        foreach($categories as $key=>$value){ ?>
                                            <option value="<?php echo $value['cat_id']; ?>" 
                                            <?php 
                                                if(isset($_POST['categories'])){
                                                    if(in_array($value['cat_id'],$_POST['categories'])){
                                                        echo 'selected';
                                                    }
                                                }
                                                if(in_array($value['cat_id'],$sel_categories)){
                                                    echo 'selected';
                                                }
                                                 ?> > <?php echo $value['category_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('categories[]')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                     <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row">
                                <!--<label>Assign to users : <span class="errors" style="color:crimson;">*</span></label><br/>
                                    <span class="icheck-inline">
                                        <input type="radio" name="assign_to" id="assign_to_user" required value="user" <?php if(isset($_POST['assign_to'])){ echo set_value('response_email');}else{ echo $details->response_to;} ?> />
                                        <label for="assign_to_user" class="inline-label">User</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="assign_to" id="assign_to_dept"value="dept" />
                                        <label for="assign_to_dept" class="inline-label">Department</label>
                                    </span>-->
                                 <label>Select Users : <span class="errors" style="color:crimson;">*</span></label><br/>
                                <select id="multiselect_users" name="users[]" required multiple="multiple" data-placeholder="Select Users..." name="users[]">
                                    <?php 
                                    //print_r($users); exit;
                                    foreach($users as $key=>$value) { 
                                        if($value['id'] != $user_id){
                                        ?>
                                    <option value="<?php echo $value['id']; ?>" 
                                           <?php  if(isset($_POST['users'])){
                                                if(in_array($value['id'],$_POST['users'])){
                                                    echo ' selected';
                                                }
                                            }
                                            if(in_array($value['id'],$form_users)){
                                                echo ' selected';
                                            }
                                            ?>>  <?php echo $value['firstname']; ?>
                                    </option>
                                    <?php } } ?>
                                </select>
                                 <?php  echo "<div style='color:red'>" . form_error('assign_to') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row">
                                <label>Form Description </label>
                                <textarea name="form_desc" class="md-input"><?php if(ISSET($_POST['form_desc']))
                                                { echo set_value('form_desc'); }else{
                                                    echo $details->form_desc;
                                                }
                                        ?></textarea>
                                <?php echo "<div style='color:red'>".form_error('form_desc')."</div>"; ?>
                            <div class="uk-width-medium-1-2"></div>
                            </div>
                        </div>
                    </div>
                     <!--<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                        <?php if($default_option && $default_option === $details->form_id) { ?>
                             <label for="" class="inline-label">Default</label>
                                <div class="parsley-row">
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  if($details->default == 1) {
                                                echo 'checked';
                                            }
                                            if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                        echo 'checked';
                                                }
                                         ?>  />
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_2" data-md-icheck value="0" <?php  if($details->default == 0) {
                                                echo 'checked';
                                            }
                                            if(ISSET($_POST['default']) && $_POST['default'] == 0) {
                                                        echo 'checked';
                                                }
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                </div>
                                 <?php } else if(!$default_option) {  ?>
                                 <label for="" class="inline-label">Set Default</label>
                                 <div class="parsley-row">
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  
                                            if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                        echo 'checked';
                                                }
                                         ?>  />
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
                                <?php } ?>
                            </div>
                            <div class="uk-width-medium-1-2"></div>        
                        </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                <label for="" class="inline-label">Set Status</label>
                                <div class="parsley-row">
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  if($details->status == 1) {
                                                    echo 'checked';
                                                }
                                                if(ISSET($_POST['status']) && $_POST['status'] == 1) {
                                                        echo 'checked';
                                                }
                                             ?>  />
                                        <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                        if($details->status == 0){
                                                    echo 'checked';
                                                }
                                                if(ISSET($_POST['status']) && $_POST['status'] == 0) {
                                                        echo 'checked';
                                                }
                                             ?>
                                        />
                                        <label for="radio_demo_inline_2" class="inline-label">No</label>
                                    </span>
                                </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div> 
                    </div>-->
                    <!--<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Response To : <span class="errors" style="color:crimson;">*</span></label>
                                <input type="email" class="md-input" id="response_email" name="response_email" value="<?php if(isset($_POST['response_email'])){ echo set_value('response_email');}else{ echo $details->response_to;} ?>" data-parsley-trigger="change" required  />
                                 <?php  echo "<div style='color:red'>" . form_error('response_email') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Form Type <span class="errors" style="color:crimson;">*</span></label>
                                <select data-md-selectize required data-placeholder="..." name="form_type">
                                    <option value="1" selected >General</option>
                                </select>
                                 <?php  echo "<div style='color:red'>" . form_error('form_type') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row">
                                <label>Assign To : <span class="errors" style="color:crimson;">*</span></label><br/>
                                    <span class="icheck-inline">
                                        <input type="radio" name="assign_to" id="assign_to_user" required value="user" <?php if(isset($_POST['assign_to'])){ echo set_value('response_email');}else{ echo $details->response_to;} ?> />
                                        <label for="assign_to_user" class="inline-label">User</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="assign_to" id="assign_to_dept"value="dept" />
                                        <label for="assign_to_dept" class="inline-label">Department</label>
                                    </span>
                                 <?php  echo "<div style='color:red'>" . form_error('assign_to') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row" id="lists">
                                    
                                 <?php  echo "<div style='color:red'>" . form_error('assign_to') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>-->
                    <div class="uk-grid">
                    	<input type="hidden" name="step" value="1" />
                        <input type="hidden" name="form_id" value="<?php echo $form_id ;?>" />
                        <div class="uk-width-1-2">
                            <button type="submit"   style="float:right;"class="md-btn md-btn-primary">Update</button>
                        </div>
                         <div class="uk-width-1-2">
                             <a href="<?php echo base_url(); ?>form" class="md-btn md-btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>