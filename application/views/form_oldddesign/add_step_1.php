 <?php //print_r($_POST);
 $org_id = $this->session->userdata('org_id');
 ?>
 <div id="page_content">
        <div id="page_content_inner">
    <form name="new_form" action ="" method ="post" id="form_validation" class="uk-form-stacked" novalidate>
            <div class="md-card">
                <div class="md-card-content">
                <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
                    <h3 class="heading_a">New Forms</h3>
                    <?php if($org_id == 1){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2 uk-container-center">
                            <div class="parsley-row">
                                <label>Select an organization<span class="errors" style="color:crimson;">*</span></label>
                                <select data-md-selectize required name="organization" id="form_org">
                                     <option value="">Choose Organization</option>
                                    <?php foreach($organizations as $key=>$value){
                                            if($value['id'] != '1'){
                                        ?>
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
                                <input type="text" class="md-input" id="form_name" name="form_name" value="<?php echo set_value('form_name'); ?>" data-parsley-trigger="change" required  />
                                 <?php  echo "<div style='color:red'>" . form_error('form_name') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Form Code  <span class="errors" style="color:crimson;" >*</span></label>
                                <input type="text" class="md-input" id="form_code" name="form_code" value="<?php echo set_value('form_code'); ?>" data-parsley-trigger="change" required  />
                                 <?php  echo "<div style='color:red'>" . form_error('form_code') . "</div>"; ?>
                            </div>
                        </div>
                    </div>
                     <div class="uk-grid" data-uk-grid-margin>
                        <!--<div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Columns<span class="errors" style="color:crimson;">*</span></label>
                                <input type="number" class="md-input" id="form_column" name="form_column" min="1" max="3" value="<?php echo set_value('form_column'); ?>" required />
                                 <?php  echo "<div style='color:red'>" . form_error('form_column') . "</div>"; ?>
                            </div>
                        </div>-->
                       
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
                                            <option value="<?php echo $key; ?>" 
                                            <?php 
                                                if(isset($_POST['categories'])){
                                                    if($key==$_POST['categories']){
                                                        echo 'selected';
                                                    }
                                                }
                                                 ?> > <?php echo $value; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('categories[]')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row org_users">
                                <label>Select Users : <span class="errors" style="color:crimson;">*</span></label><br/>
                                <select id="multiselect_users" name="users[]" required multiple="multiple" data-placeholder="Select Users..." name="users[]">
                                    <?php foreach($users as $key=>$value) { 
                                        if($value['id'] != $user_id){
                                        ?>
                                    <option value="<?php echo $value['id']; ?>"
                                    <?php if(isset($_POST['users'])){
                                           if(in_array($value['id'],$_POST['users'])){
                                            echo 'selected';
                                           }
                                    }
                                    ?>
                                    ><?php echo $value['firstname']; ?></option>
                                    <?php } } ?>
                                </select>
                                   <!-- <span class="icheck-inline">
                                        <input type="radio" name="assign_to" id="assign_to_user" required value="user" />
                                        <label for="assign_to_user" class="inline-label">User</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="assign_to" id="assign_to_dept"value="dept" />
                                        <label for="assign_to_dept" class="inline-label">Department</label>
                                    </span>
                                 <?php  echo "<div style='color:red'>" . form_error('assign_to') . "</div>"; ?>-->
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Response To : <span class="errors" style="color:crimson;">*</span></label>
                                <input type="email" class="md-input" id="response_email" name="response_email" value="<?php echo set_value('response_email'); ?>" data-parsley-trigger="change" required  />
                                 <?php  echo "<div style='color:red'>" . form_error('response_email') . "</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <!--<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row" id="lists">
                                    
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>-->
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Form Description </label>
                                <textarea name="form_desc"  class="md-input"><?php if(ISSET($_POST['form_desc']))
                                                { echo set_value('form_desc'); }
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('form_desc')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                    	<input type="hidden" name="step" value="1" />
                        <div class="uk-width-1-2">
                            <button type="submit"   style="float:right;"class="md-btn md-btn-primary">Save</button>
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
