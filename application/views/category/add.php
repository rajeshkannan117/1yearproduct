<div id="page_content">
    <div id="page_content_inner">

        <h3 class="heading_b uk-margin-bottom"><?php if($cat_id!='' && !empty($cat_depart)) { echo $this->lang->line('edit'); }else { echo $this->lang->line('new'); } echo $this->lang->line('category'); ?></h3>
        <?php
        if ($this->session->flashdata('SucMessage') != '') {
            ?>
            <div class="uk-alert uk-alert-success" data-uk-alert="">
                <a href="#" class="uk-alert-close uk-close"></a>
                <?php
                echo $this->session->flashdata('SucMessage');
                ?>
            </div> <?php
        }
        ?>  <form action="" id="form_validation" class="uk-form-stacked" name="category" method="post" novalidate>     
            <div class="md-card">
                <div class="md-card-content large-padding">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" class="">
                                    <?php echo $this->lang->line('category_name'); ?> <span style='color:red'>*</span>
                                </label>
                                <input type="text" class="md-input" id="cat_name" name="cat_name" value="<?php echo $cat_name; ?>" data-parsley-error-message="<?php echo $this->lang->line('category_name_req'); ?>" data-parsley-trigger="change" required  />
<?php echo "<div style='color:red'>" . form_error('cat_name') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="hobbies" class=""><?php echo $this->lang->line('category_desc'); ?></label>
                                <textarea name="cat_desc" class="md-input"><?php echo $cat_desc; ?></textarea>
<?php echo "<div style='color:red'>" . form_error('cat_desc') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>
                    
                    <input type="hidden" name="depart_previopus" value="<?php echo $cat_depart_pre; ?>" >
                    <input type="hidden" name="cate_id" value="<?php echo $cat_id; ?>" >
                    
                    <input type="hidden" name="org_id" value="<?php echo $org_id; ?>" >
<?php if($org_id==1){ ?>                     
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="countries"><?php echo $this->lang->line('select_ur_industry'); ?> <span class="req">*</span></label>
                                <select name="domain[]" class="domain_change" required id="multiselect_domain" multiple="multiple" data-placeholder="Select Industry..." data-parsley-error-message="<?php echo $this->lang->line('industry_req'); ?>">
                                    <?php foreach ($domain as $key => $value) { ?>
                                        <option value="<?php echo $value['domain_id']; ?>" <?php if(in_array($value['domain_id'], $category_domain)){ ?> selected="selected" <?php } ?>  >
                                            <?php echo $value['domain_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                
<?php echo "<div style='color:red'>" . form_error('domain') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>
<?php } ?> 
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="department"><?php echo $this->lang->line('select_department'); ?> <span class="req">*</span></label>
                                <span id="department">
                                    <select required id="multiselect_department" multiple="multiple" data-placeholder="Select Department..." class="department" name="department[]" data-parsley-error-message="<?php echo $this->lang->line('department_req'); ?>">
                                        <?php if(!empty($department)){ ?>
                                            
                                            <?php foreach ($department as $key => $val) { ?>
                                        <option value="<?php echo $val['dept_id']; ?>" <?php if(in_array($val['dept_id'], $cat_depart)){ ?> selected="selected" <?php } ?>  >
                                            <?php echo $val['dept_name']; ?>
                                        </option>
                                    <?php } ?>
                                            
                                      <?php  } ?>
                                        
                                        
                                    </select>
                                </span>
<?php echo "<div style='color:red'>" . form_error('domain') . "</div>"; ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>
<!--                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="parent" class="">Select Parent</label>
                            <select name="parent" required data-md-selectize>
                                <?php //foreach ($parent as $key => $value) { ?>
                                    <option value="<?php //echo $value['cat_id']; ?>"
                                    <?php
                                   // if (ISSET($_POST['parent']) && $_POST['parent'] == $value['cat_id']) {
                                   //     echo 'selected';
                                    //}
                                    ?>
                                            ><?php //echo $value['category_name']; ?></option>
<?php //} ?>
                            </select>
                        </div>
                        <div class="uk-width-medium-1-2"></div>
                    </div>-->

                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <button type="submit"   style="float:right;"class="md-btn md-btn-primary"><?php echo $this->lang->line('save'); ?> </button>
                        </div>
                        <div class="uk-width-1-2">
                            <a href="<?php echo base_url(); ?>category" class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?> </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>  

    </div>
</div>


