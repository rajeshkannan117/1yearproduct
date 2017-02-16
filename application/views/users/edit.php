<?php 
    $org_id = $this->session->userdata['org_id'];
?>
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
                        <h3 class="heading_a">
                          <?php echo $this->lang->line('edit_user'); ?> 
                        </h3>
                        <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                          <div class="uk-alert uk-alert-success" data-uk-alert="">
                    	         <a href="#" class="uk-alert-close uk-close"></a>
                                  <?php echo $this->session->flashdata('SucMessage');  ?>
                          </div> 
                        <?php } ?>
                          <div class="uk-grid" data-uk-grid-margin>
                            <?php if($org_id == 1){?> 
                            <!--   <div class="uk-width-medium-2-4">
                                 <label><?php echo $this->lang->line('organization'); ?> </label>
                                 <span id="details">
                                      <input type="text" class="md-input" name="org_name" value="<?php if(ISSET($_POST['org_name'])){ echo set_value('org_name'); } else{ echo $user['org_name']; }?>" disabled/>
                                      <?php echo "<div style='color:red'>".form_error('org_name')."</div>"; ?>
                                 </span>
                              </div> -->
                            <?php } ?>
                              <div <?php if($this->session->userdata['org_id']!=1){?> class="uk-width-medium-1-2" <?php }else{?>class="uk-width-medium-1-4" <?php } ?> >
                                <div class="parsley-row">
                                   <label><?php echo $this->lang->line('first_name'); ?><span class="req">*</span></label>
                                   <span id="firstname">
                                      <input type="text" class="md-input" id="firstname" name="firstname" value="<?php if(ISSET($_POST['firstname'])){ echo set_value('firstname'); } else{ echo $user['firstname']; }?>" required data-parsley-error-message="<?php echo $this->lang->line('first_name_req'); ?>" />
                                      <?php echo "<div style='color:red'>".form_error('firstname')."</div>"; ?>
                                   </span>
                                 </div>
                              </div>
                              <div <?php if($this->session->userdata['org_id']!=1){?> class="uk-width-medium-1-2" <?php }else{?>class="uk-width-medium-1-4" <?php } ?>>
                                  <div class="parsley-row">
                                       <label><?php echo $this->lang->line('last_name'); ?><span class="req">*</span></label>
                                       <span id="lastname">
                                       <input type="text" class="md-input" id="lastname" name="lastname" value="<?php if(ISSET($_POST['lastname'])){ echo set_value('lastname'); } else{ echo $user['lastname']; }?>" required data-parsley-error-message="<?php echo $this->lang->line('last_name_req'); ?>"/>
                                       <?php echo "<div style='color:red'>".form_error('lastname')."</div>"; ?>
                                       </span>
                                  </div>
                              </div>
                              
                          </div>
                          <?php if($org_id ===1){?> 
                          <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-1-2">
                                  <label><?php echo $this->lang->line('location'); ?> </label>
                                  <span id="details">
                                    <input type="text" class="md-input" name="location" value="<?php if(ISSET($_POST['org_name'])){ echo set_value('location'); } else{ echo $user['country_name']; }?>" disabled/>
                                       <?php echo "<div style='color:red'>".form_error('location')."</div>"; ?>
                                  </span>
                              </div>
                              <div class="uk-width-medium-1-2">
                                  <label><?php echo $this->lang->line('domain'); ?> </label>
                                    <span id="domain">
                                      <input type="text" class="md-input" name="domain" value="<?php if(ISSET($_POST['domain'])){ echo set_value('domain'); } else{ echo $user['domain_name']; }?>" disabled/>
                                       <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                                    </span>
                              </div>
                          </div>
                          <?php }?>
                           <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                  <div class="parsley-row">
                                    <label><?php echo $this->lang->line('email'); ?> </label>
                                        <input type="text" readonly class="md-input" id="usr_email" name="usr_email" value="<?php if(ISSET($_POST['usr_email'])){ echo set_value('usr_email'); } else{ echo $user['email']; }?>"data-parsley-error-message="<?php echo $this->lang->line('email_req'); ?>"/>
                                          <?php echo "<div style='color:red'>".form_error('usr_email')."</div>"; ?>
                                  </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <div class="parsley-row">
                                    <label><?php echo $this->lang->line('phone'); ?> <span class="req">*</span> </label>
                                      <input id="kUI_masked_phone" type="text" id ="usr_phone" class="uk-form-width-medium md-input" name="usr_phone" required value="<?php if(ISSET($_POST['usr_phone'])){ echo set_value('usr_phone'); } else{ echo $user['phone']; }?>"  data-parsley-error-message="<?php echo $this->lang->line('phone_req'); ?>" />
                                      <span class="uk-form-help-block">(000)000-0000</span>
                                      <?php echo "<div style='color:red'>".form_error('usr_phone')."</div>"; ?>
                                    </div>
                                </div>
                            </div>
                          <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                <label for="parent" class=""><?php echo $this->lang->line('select_department'); ?> <span class="req">*</span></label>
                                    <select name="department[]" required class="chosen_select" id="multiselects" multiple="multiple" data-parsley-error-message="<?php echo $this->lang->line('department_req'); ?>" data-placeholder="Select Deparment..." >
                                     <?php 
                                     foreach($dept as $key=>$value) { ?>
                                        <option value="<?php echo $value['dept_id']; ?>"
                                        <?php 
                                            if(ISSET($_POST['department'])){
                                              if(in_array($value['dept_id'],$_POST['department']))
                                              {   echo 'selected'; }
                                            }
                                            else{
                                              if(in_array($value['dept_id'],$user['dept'])){
                                                  echo 'selected';
                                              }
                                          }
                                       ?>><?php echo $value['dept_name']; ?></option>
                                    <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('department')."</div>"; 
                                      ?>
                                  </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                  <div class="parsley-row">
                                    <label for="role_id"><?php echo $this->lang->line('select_role'); ?>  <span class="req">*</span></label>
                                    <?php if($user['role_id'] == 1){ ?>
                                        <input type="text" class="md-input" value="Superadmin" disabled/>
                                        <input type="hidden" name="role_id" value ="1"/>
                                    <?php } else { ?>
                                    <select id="" class="chosen_select" required data-placeholder="Select Role..." name="role_id" data-parsley-error-message="<?php echo $this->lang->line('role_req'); ?>" data-parsley-errors-container="#error-container" >
                                      <?php 
                                        foreach($role as $key=>$value){ ?>
                                              <option value="<?php echo $value['role_id']; ?>"<?php if(isset($_POST['role_id'])){
                                                      if($value['role_id'] == $_POST['role_id']){
                                                      echo 'selected';
                                                      }
                                                  }else{
                                                      if($value['role_id'] == $user['role_id']){ 
                                                              echo 'selected';
                                                      }
                                                  }?> > <?php echo $value['role_name']; ?>
                                              </option>
                                          <?php } ?>
                                      </select>
                                      <?php echo "<div style='color:red'>".form_error('role_id')."</div>"; 
                                        }
                                      ?>
                                      <div id="error-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                  <div class="parsley-row">
                                    <label><?php echo $this->lang->line('location'); ?> <span class="req">*</span> </label>
                                      <select name="location_id[]" required id="multiselect_locations" class="chosen_select" multiple="multiple" data-placeholder="Select JobSites..." data-parsley-error-message="<?php echo $this->lang->line('jobsite_req'); ?>">
                                      <?php 
                                      foreach($organization_location as $key=>$value) { ?>
                                        <option <?php if(set_value('location_id') == $value['location_id']) { ?>selected= "selected"<?php } 
                                            if(in_array($value['location_id'], $user_location)){
                                                echo 'selected';
                                            }
                                        ?> value="<?php echo $value['location_id']; ?>">
                                            <?php echo $value['location']; ?>
                                        </option>
                                      <?php } ?>
                                      </select>
                                      <?php 
                                        echo "<div style='color:red'>".form_error('location_id[]')."</div>"; 
                                      ?>
                                       </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                </div>
                            </div>
                           
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2" >
                                  <input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
                                  <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="Create" value="<?php echo $this->lang->line('update'); ?> "/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <a href="<?php echo base_url(); ?>users"  class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?> </a>
                                </div>
                            </div>
                      </div>
                </div>
            </form>    
        </div>
    </div>