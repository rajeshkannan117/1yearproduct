
<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom"><?php if ($dept_id != '' && !empty($dept_domain)) { echo $this->lang->line('edit'); } else { echo $this->lang->line('new');  } echo $this->lang->line('department'); ?> </h3>
        <form action="" id="form_validation" class="uk-form-stacked" name="domain" method="post" <?php if ($org_id != 1 && $this->session->userdata('user_id') != 1) { ?>  <?php } ?> enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                    <?php if ($this->session->flashdata('SucMessage') != '') { ?>
                        <div class="uk-alert uk-alert-success" data-uk-alert="">
                            <a href="#" class="uk-alert-close uk-close"></a>
                            <?php echo $this->session->flashdata('SucMessage'); ?>
                        </div> <?php } ?>  

                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="domainname"><?php echo $this->lang->line('dept_name'); ?><span class="req">*</span></label>
                                <input type="text" name="dept_name" id="dept_name" class="md-input" value="<?php echo $dept_name; ?>" data-parsley-error-message="<?php echo $this->lang->line('department_name_req'); ?>" data-parsley-trigger="change" required />
                                <?php echo "<div style='color:red'>" . form_error('dept_name') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>                    
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="domainname desc"><?php echo $this->lang->line('dept_desc'); ?></label>
                                <textarea name="dept_desc"  class="md-input"><?php echo $dept_desc; ?></textarea>
                                <?php echo "<div style='color:red'>" . form_error('dept_desc') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <!--                    
                    <input type="text" id="dept_id" name="deleted_domain" value="<?php //echo $dept_domain_all;   ?>" />
                    <input type="text" id="dept_id" name="added_domain" value="<?php // echo $dept_domain_all;   ?>" />
                    -->
                    <input type="hidden" id="previous_domain" name="previous_domain" value="<?php echo $dept_domain_all; ?>" />
                    <input type="hidden" id="dept_id" name="dept_id" value="<?php echo $dept_id; ?>" />
                    <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />

                    <?php if($org_id == 1){ ?>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="domain"><?php echo $this->lang->line('select_ur_industry'); ?><span class="req">*</span></label>
                                <span id="domains">

                                    <select id="multiselects" multiple="multiple" required class="domain_department chosen_select" data-parsley-error-message="<?php echo $this->lang->line('industry_req'); ?>" data-placeholder="Select your industry..." name="domain[]">

                                        <?php foreach ($domain as $key => $value) { ?>
                                            <option value="<?php echo $value['domain_id']; ?>" <?php if (in_array($value['domain_id'], $dept_domain) || ($org_id != 1 && $value['default'] == '1' && $dept_id == '')) { ?> selected="selected" <?php } ?> >
                                                <?php echo $value['domain_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                </span>
                                <?php echo "<div style='color:red'>" . form_error('domain') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <?php } else{ ?>
                        <input type="hidden" name="domain[]" value="<?php echo $hidden_domain; ?>" />
                     <?php } ?>
                    <?php if ($org_id != 1) { ?>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row parsley-row org_users">
                                    <label>Users</label><br/>
                                    <div id="users">
                                        <select id="multiselect_userss" class="chosen_select" name="users[]" multiple="multiple" data-placeholder="Select Users...">
                                        <?php 
                                        foreach($users as $key=>$value) { 
                                            ?>
                                            <option value="<?php echo $value['id']; ?>"
                                        <?php
                                        if(is_array($dept_users)){
                                            if(in_array($value['id'], $dept_users)){
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
                                        ?> >
                                            <?php echo $value['name']; ?>
                                            </option>
                                        <?php } 
                                        ?>
                                        </select>
                                        <?php 
                                        echo "<div style='color:red'>" . form_error('users') . "</div>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                            </div>
                        </div>
                    <?php } ?>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="save" value="<?php echo $this->lang->line('save'); ?>">

                        </div>
                        <div class="uk-width-medium-1-2">
                            <a href="<?php echo base_url(); ?>department" class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?></a>
                        </div>
                    </div>

                </div>
            </div>

        </form>
        <script type="text/javascript">
            function cascade_domain(obj) {
                $("#multiselect_domain").prop('disabled', 'false');
                //console.log($(obj).val());
            }
        </script>
    </div>
</div>
  
