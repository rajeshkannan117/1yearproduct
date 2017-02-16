<div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">New Role</h3>
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
?>  
<form action="" id="form_validation" class="uk-form-stacked" name="roles" method="post" novalidate>    
            <div class="md-card">
                <div class="md-card-content large-padding">
                   <div class="uk-grid" data-uk-grid-margin>
                           <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="rolename">Role Name <span class="req">*</span></label>
                                    <input type="text" name="role_name" data-parsley-trigger="change" required class="md-input" value="<?php if(ISSET($_POST['role_name']))
                                                { echo $_POST['role_name']; }
                                        ?>" />
                                    <?php echo "<div style='color:red'>".form_error('role_name')."</div>"; ?>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2"></div>
                    </div>                    
                    <div class="uk-grid" data-uk-grid-margin>
                          <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="roledesc">Role Description </label>
                                    <textarea name="role_desc" class="md-input"><?php if(ISSET($_POST['role_desc']))
                                                { echo $_POST['role_desc']; }
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('role_desc')."</div>"; ?>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2"></div>
                    </div>
                </div>
            </div>
            <div class="md-card">
                <div class="md-card-content large-padding">
                    <h2>  Permissions  </h2>
                    <div class="uk-grid" data-uk-grid-margin">
                         <div class="uk-width-1-2">
                         <?php if($this->session->userdata('org_id') == 1){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                             <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> 
                                       <b> Country </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                               <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
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
                                       <b> Domain </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="domains[]" id="domain_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
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
                                       <b style="float:left"> Department </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="department[]" id="department_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
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
                                        <b>Category </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="category[]" id="category_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
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
                                       <b> Roles </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="roles[]" id="roles_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
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
                                        <b>Users </b>
                                    </label>
                                </div>
                                <div class="uk-width-8-10">
                            <!-- <div class="parsley-row"> -->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="users[]" id="users_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div> -->
                        </div>
                        
                    </div>
                    <?php if($this->session->userdata('org_id') == 1){ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                            <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> <b style="float:left">Organization</b></label>
                                </div>
                                <div class="uk-width-8-10">
                            <!--<div class="parsley-row">-->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="organization[]" id="organization_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                        
                    </div>
                    <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-2-2">
                            <div class="uk-grid">
                                <div class="uk-width-2-10">
                                    <label for="" class="inline-label"> <b>Forms</b></label>
                                </div>
                                <div class="uk-width-8-10">
                            <!--<div class="parsley-row">-->
                               <span class="icheck-inline">
                                    <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="create"/>
                                    <label class="inline-label">
                                        Create
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="read"/>
                                    <label class="inline-label">
                                        View Only
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="update"/>
                                    <label class="inline-label">
                                        Update
                                    </label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="checkbox" name="forms[]" id="forms_permission" data-md-icheck  value ="delete"/>
                                    <label class="inline-label">
                                        Delete
                                    </label>
                                </span>
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                        
                    </div>
                        </div>
                      <div class="uk-width-1-2">
                            <h4 class="heading_c uk-margin-small-bottom">Permission Information</h4>
                            <ul class="md-list">
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;">Create</span>
                                        <span class="uk-text-small uk-text-muted">Can able to add and edit data added by the user</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;">View Only</span>
                                        <span class="uk-text-small uk-text-muted">Can able to view the list</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;">Update</span>
                                        <span class="uk-text-small uk-text-muted">Can able to update the data added by the user and other users</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading" style="color: #1e88e5;">Delete</span>
                                        <span class="uk-text-small uk-text-muted">Can able to delete the data added by the user and other users</span>
                                    </div>
                                </li>
                            </ul>
                            <input type="hidden" name="org_id" value="<?php echo $this->session->userdata('org_id'); ?>">
                        </div>
                        </div>
                    </div> 
                </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <input type="submit" class="uk-form-file md-btn md-btn-primary" style="float:right;" name="save" value="Save">

                        </div>
                        <div class="uk-width-medium-1-2">
                                 <a href="<?php echo base_url(); ?>role" class="uk-form-file md-btn md-btn-danger">Cancel</a>
                        </div>
                    </div>

            
 </form>    
        </div>
    </div>

   
