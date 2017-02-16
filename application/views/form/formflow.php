 <?php //print_r($_POST);
 $org_id = $this->session->userdata('org_id');
 ?>
 <div id="page_content">
    <div id="page_content_inner">
        <form name="new_form" action ="" method ="post" id="form_validation" class="uk-form-stacked" novalidate>
            <div class="md-card">
                <div class="md-card-content">
                <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
                <input type="hidden" id="org_id" name="form_flow" value="form_flow" />
                <input type="hidden" id="hierarchy_id" name="hierarchy_id" value="<?php echo $hierarchy_id; ?>" />
                 <input type="hidden" id="hierarchy_id" name="form_id" value="<?php echo $form_id; ?>" />
                    <h3 class="heading_a"></h3>
                    <?php if($org_id == 1){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2 uk-container-center">
                            <div class="parsley-row">
                                <label>Select an organization<span class="errors" style="color:crimson;">*</span></label>
                                <br/>
                                <select required name="organization" id="form_org">
                                     <option value="">Choose Organization</option>
                                    <?php foreach($organizations as $key=>$value){
                                        ?>
                                        <option value="<?php echo $value['id'] ?>"
                                        <?php 
                                            if(isset($_POST['organization'])){ 
                                                if($_POST['organization'] === $value['id']){
                                                    echo 'selected';
                                                }
                                            }else{
                                                if($hierarchy_id){
                                                    if($form_org_id == $value['id']){
                                                        echo 'selected';
                                                    }
                                                }
                                            } 
                                        ?> ><?php echo $value['org_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo "<div style='color:red'>".form_error('organization')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin id="assign_to" style="display: none">
                        <div class="uk-width-medium-1-2">
                            <span class="icheck-inline">
                                <input type="radio" name="assign_to" id="assign_to_user" checked ="true" required value="user" />
                                <label for="assign_to_user" class="inline-label">User</label>
                            </span>
                            <span class="icheck-inline">
                                <input type="radio" name="assign_to" id="assign_to_dept"value="dept" />
                                <label for="assign_to_dept" class="inline-label">Department</label>
                            </span>
                        <?php  echo "<div style='color:red'>" . form_error('assign_to') . "</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2" id="lists">
                            <div id="user" style="">
                                <label for="val_select" >Select users to assign form <span class="req">*</span></label><br/>
                                <select id="assign_user" name="user[]" multiple ="multiple" class="assign_user" required  placeholder="Select Users...">
                                    <?php foreach($users as $key=>$value){ ?>
                                        <option value="<?php echo $value['id']; ?>">
                                            <?php echo $value['firstname'].' '.$value['lastname']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- <div id="department" style="display:none;">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1">

                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin id="exclude_users">
                        <div class="uk-width-medium-1-2">
                            <div id="user" class="org_users">
                            <?php if($hierarchy_id) { ?>
                            <label for="val_select" >Select users to assign form <span class="req">*</span></label><br/>
                            <select id="assign_user" name="users[]" multiple ="multiple" class="assign_user" required  placeholder="Select Users...">
                                <?php foreach($org_users as $key=>$value){ ?>
                                    <option value="<?php echo $value['id']; ?>"
                                    <?php if(in_array($value['id'], $formusers)){
                                        echo 'selected';
                                    } ?> >
                                        <?php echo $value['firstname'].' '.$value['lastname']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                            <?php echo "<div style='color:red'>".form_error('users[]')."</div>"; ?>
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
                                <?php echo "<div style='color:red'>".form_error('categories')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="uk-grid" data-uk-grid-margin>
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
                        <div class="uk-width-medium-1-2">
                            
                        </div>
                    </div> -->
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>Response To : <span class="errors" style="color:crimson;">*</span></label>
                                <input type="email" class="md-input" id="response_email" name="response_email" value="<?php echo set_value('response_email'); ?>" data-parsley-trigger="change" required  />
                                 <?php  echo "<div style='color:red'>" . form_error('response_email') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
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
