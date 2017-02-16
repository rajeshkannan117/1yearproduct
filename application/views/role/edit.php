<div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('edit_role'); ?></h3>
    <form action="" id="form_validation" class="uk-form-stacked" name="department" method="post" enctype="multipart/form-data">  
            <div class="md-card">
                <div class="md-card-content">
                    <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                    <div class="uk-alert uk-alert-success" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                          <?php echo $this->session->flashdata('SucMessage');  ?>
                    </div> <?php } ?>  
                    <div class="uk-grid" data-uk-grid-margin>
                        <input type="hidden" name="role_id" value="<?php echo $result->role_id; ?>" />
                        <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="rolename" style="top:-2px !important;"><?php echo $this->lang->line('role_name'); ?><span class="req">*</span></label>
                                    <input type="text" name="role_name" data-parsley-trigger="change" required class="md-input" value="<?php if(ISSET($_POST['role_name'])){ echo set_value('role_name'); }else{echo trim($result->role_name);}
                                        ?>" data-parsley-error-message="<?php echo $this->lang->line('role_name_req'); ?>"/>
                            <?php echo "<div style='color:red'>".form_error('role_name')."</div>"; ?>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2"></div>
                    </div>
                     <div class="uk-grid" data-uk-grid-margin>
                          <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="roledesc"><?php echo $this->lang->line('role_desc'); ?></label>
                                    <textarea name="role_desc" class="md-input"><?php if(ISSET($_POST['role_desc']))
                                                { echo set_value('role_desc'); }
                                                else{
                                                     echo trim($result->role_desc);
                                                }
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('role_desc')."</div>"; ?>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2"></div>
                    </div>
                     <!-- <div class="uk-grid" data-uk-grid-margin>
                          <div class="uk-width-medium-1-2">
                                    <label for="roledesc"><?php echo $this->lang->line('status'); ?></label>
                                     <div class="parsley-row">
                                      <span class="icheck-inline">
                                <input type="radio" name="status" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  
                                        if(ISSET($_POST['status'])){
                                            if($_POST['status'] == 1) {
                                                echo 'checked';
                                        }
                                        }else{
                                            if($result->status == 1) {
                                              echo 'checked';
                                          }
                                        } 
                                     ?>  />
                                <label for="radio_demo_inline_1" class="inline-label"><?php echo $this->lang->line('active'); ?></label>
                            </span>
                            <span class="icheck-inline">
                                <input type="radio" name="status" id="radio_demo_inline_2" data-md-icheck value="0" <?php 
                                    if(ISSET($_POST['status'])){
                                        if($_POST['status'] == 0) {
                                                echo 'checked';
                                        }
                                        }else{
                                            if($result->status == 0) {
                                              echo 'checked';
                                          }
                                        } 
                                    ?>
                                />
                                <label for="radio_demo_inline_2" class="inline-label"><?php echo $this->lang->line('inactive'); ?></label>
                            </span>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2"></div>
                    </div> -->
                    <input type="hidden" name ="status" value="1" />
                </div>
            </div>
             <div class="md-card">
                <div class="md-card-content large-padding">
                    <h2>  <?php echo $this->lang->line('permission'); ?>   </h2>
                    <div class="uk-grid" data-uk-grid-margin>
                         <div class="uk-width-1-2">
                    <?php if($this->session->userdata('org_id') == '1'){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                       <b> <?php echo $this->lang->line('country'); ?> </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="create" <?php if($result->country['create']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('create'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="read" <?php if($result->country['read']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('view'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="update" <?php if($result->country['update']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('update'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="delete" <?php if($result->country['delete']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('delete'); ?>
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div> -->
                        </div>
                        
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                       <b> <?php echo $this->lang->line('domain'); ?> </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="create" <?php if($result->domain['create']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('create'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="read" <?php if($result->domain['read']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('view'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="update" <?php if($result->domain['update']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('update'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="delete" <?php if($result->domain['delete']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('delete'); ?>
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div> -->
                        </div>
                        
                    </div>
                    <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                       <b style="float:left"> <?php echo $this->lang->line('location'); ?> </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                               <span class="icheck-inline">
                                    <input type="checkbox" name="location[]" id="location_permission" data-md-icheck  value ="create" <?php if($result->location['create']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('create'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="location[]" id="location_permission" data-md-icheck  value ="read" <?php if($result->location['read']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('view'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="location[]" id="location_permission" data-md-icheck  value ="update" <?php if($result->location['update']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('update'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="location[]" id="location_permission" data-md-icheck  value ="delete" <?php if($result->location['delete']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('delete'); ?>
                                    </label>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                       <b style="float:left"> <?php echo $this->lang->line('department'); ?> </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="create" <?php if($result->department['create']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('create'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="read" <?php if($result->department['read']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('view'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="update" <?php if($result->department['update']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('update'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="delete" <?php if($result->department['delete']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('delete'); ?>
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div> -->
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                        <b><?php echo $this->lang->line('category'); ?> </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="create" <?php if($result->category['create']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('create'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="read" <?php if($result->category['read']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('view'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="update" <?php if($result->category['update']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('update'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="delete" <?php if($result->category['delete']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('delete'); ?>
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div> -->
                        </div>
                       
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                       <b> <?php echo $this->lang->line('roles'); ?> </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="create" <?php if($result->role['create']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('create'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="read" <?php if($result->role['read']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('view'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="update" <?php if($result->role['update']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('update'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="delete" <?php if($result->role['delete']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('delete'); ?>
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div> -->
                        </div>
                        
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                        <b><?php echo $this->lang->line('users'); ?> </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="create" <?php if($result->user['create']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('create'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="read" <?php if($result->user['read']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('view'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="update" <?php if($result->user['update']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('update'); ?>
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="delete" <?php if($result->user['delete']){ echo 'checked'; } ?>/>
                                    <label class="inline-label">
                                        <?php echo $this->lang->line('delete'); ?>
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div> -->
                        </div>
                        
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                            <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> <b><?php echo $this->lang->line('forms'); ?></b></label>
                                </div>
                                <div class="uk-width-8-10">
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="create" <?php if($result->forms['create']){ echo 'checked'; } ?> />
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('create'); ?>
                                        </label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="read" <?php if($result->forms['read']){ echo 'checked'; } ?>/>
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('view'); ?>
                                        </label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="update" <?php if($result->forms['update']){ echo 'checked'; } ?>/>
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('update'); ?>
                                        </label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="delete" <?php if($result->forms['delete']){ echo 'checked'; } ?> />
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('delete'); ?>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                            <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"><span> <b><?php echo $this->lang->line('reviews'); ?></b></span></label>
                                </div>
                                <div class="uk-width-8-10">
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="reviews[]" value="create" data-switchery <?php if($result->review['create']){ echo 'checked'; } ?> id="switch_demo_1" />
                                        <!-- <label for="switch_demo_1" class="inline-label">
                                            <?php echo $this->lang->line('reviews'); ?>
                                        </label> -->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($this->session->userdata('org_id') == '1'){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                        <b style="float:left"><?php echo $this->lang->line('organization'); ?></b> 
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="create" <?php if($result->organizations['create']){ echo 'checked'; } ?> />
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('create'); ?>
                                        </label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="read" <?php if($result->organizations['read']){ echo 'checked'; } ?>/>
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('view'); ?>
                                        </label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="update" <?php if($result->organizations['update']){ echo 'checked'; } ?>/>
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('update'); ?>
                                        </label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="delete" <?php if($result->organizations['delete']){ echo 'checked'; } ?>/>
                                        <label class="inline-label">
                                            <?php echo $this->lang->line('delete'); ?>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                        <div class="uk-width-1-2">
                            <h4 class="heading_c uk-margin-small-bottom"><?php echo $this->lang->line('permission_info'); ?></h4>
                            <ul class="md-list">
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;"><?php echo $this->lang->line('create'); ?></span>
                                        <span class="uk-text-small uk-text-muted"><?php echo $this->lang->line('create_desc'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;"><?php echo $this->lang->line('view'); ?></span>
                                        <span class="uk-text-small uk-text-muted"><?php echo $this->lang->line('view_desc'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;"><?php echo $this->lang->line('update'); ?></span>
                                        <span class="uk-text-small uk-text-muted"><?php echo $this->lang->line('update_desc'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;"><?php echo $this->lang->line('delete'); ?></span>
                                        <span class="uk-text-small uk-text-muted"><?php echo $this->lang->line('delete_desc'); ?></span>
                                    </div>
                                </li>
                            </ul>
                            <input type="hidden" name="org_id" value="<?php echo $this->session->userdata('org_id'); ?>">
                        </div>
                        </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="save" value="<?php echo $this->lang->line('save'); ?>">

                        </div>
                        <div class="uk-width-medium-1-2">
                                 <a href="<?php echo base_url(); ?>role" class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?></a>
                        </div>
                    </div>

                </div>
            </div>

    </form>
</div>
</div>