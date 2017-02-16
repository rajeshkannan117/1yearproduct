<div id="page_content">
        <div id="page_content_inner"  style="">
<form action="" id="form_validation" class="uk-form-stacked" name="organization" method="post" enctype="multipart/form-data">

           <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                  <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?> 

                 <div class="" >
                <div class="md-card-content">
                       <div class="uk-grid" data-uk-grid-margin>
                         <input type="hidden" name="user_id" value="<?php if(ISSET($_POST['user_id'])){echo set_value('user_id');} else{ echo $user['id']; }?>" />

                        <div class="uk-width-medium-1 profile-bg-main">
                             <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                     <?php if($user['imgname']!=""){ ?>
                                      <?php if(file_exists(IMAGE_PATH.$user['imgname'])){ ?>
                                           <img src="<?php echo base_url().'uploads/user/'.$user['imgname']; ?>" height="75" width="75" class="profile_image">
                                           <input type="hidden" name="image" value="<?php echo $user['imgname']; ?>" />
                                      <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>uploads/user/blank.png" alt="user avatar" class="profile_image"/>
                                      <?php } ?>
                                      <?php }else{ ?>
                                         <img src="<?php echo base_url(); ?>uploads/user/blank.png" alt="user avatar" class="profile_image"/>
                                      <?php } ?>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <span class="fileinput-new">Upload Photo</span>
                                            <span class="fileinput-exists"></span>
                                            <input type="file" name="image" id="user_edit_avatar_control">
                                        </span>
                                        <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!--<h3 class="heading_a">User Details</h3>-->
                    <div class="uk-grid profile-view-main" data-uk-grid-margin>
                     
                      <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label>First Name <span class="req">*</span></label>
                                <input type="text" class="md-input" id="firstname" name="firstname" required value="<?php if(ISSET($_POST['firstname'])){echo set_value('firstname');} else{ echo $user['firstname']; }?>" data-parsley-error-message="<?php echo $this->lang->line('first_name_req'); ?>" />
                                <?php echo "<div style='color:red'>".form_error('firstname')."</div>"; ?>
                            </div>
                            <div class="parsley-row">
                                <label>Last Name <span class="req">*</span></label>
                                <input type="text" required class="md-input" id="lastname" name="lastname" value="<?php if(ISSET($_POST['lastname'])){echo set_value('lastname');} else{ echo $user['lastname']; }?>" data-parsley-error-message="<?php echo $this->lang->line('last_name_req'); ?>"/>
                                <?php echo "<div style='color:red'>".form_error('lastname')."</div>"; ?>
                            </div>
                            <div class="parsley-row">
                              <label>Email <span class="req">*</span></label>
                              <input type="text" class="md-input" disabled id="usr_emails" name="usrs_email" value="<?php if(ISSET($_POST['usr_email'])){echo set_value('usr_email');} else{ echo $user['email']; }?>" />
                              <?php echo "<div style='color:red'>".form_error('usr_email')."</div>"; ?>
                              <input type="hidden" name="usr_email" value="<?php echo $user['email']; ?>" />
                          </div>
                          <div class="parsley-row">
                            <label>Phone <span class="req">*</span></label>
                            <input type="text" required class="md-input" id="kUI_masked_phone" name="usr_phone" value="<?php if(ISSET($_POST['usr_phone'])){echo set_value('usr_phone');} else{ echo $user['phone']; }?>" data-parsley-error-message="<?php echo $this->lang->line('phone_req'); ?>"/>
                              <span class="uk-form-help-block">(000)000-0000</span>
                                <?php echo "<div style='color:red'>".form_error('usr_phone')."</div>"; ?>
                          </div>
                       </div>
					             <div class="uk-width-medium-1-2">
                          <div class="parsley-row">
                                <label for="fullname">Organization Name <span class="req">*</span></label>
                                <input type="text" required name="org_name" disabled class="md-input" value="<?php if(ISSET($_POST['org_name'])){ echo set_value('org_name'); } else{ echo $user['org_name']; }?>" />
                                <?php echo "<div style='color:red'>".form_error('org_name')."</div>"; ?>
                          </div>
                          <div class="parsley-row">
                              <label for="country">Country <span class="req">*</span></label>
                              <input type="text" required name="country" disabled class="md-input" value="<?php if(ISSET($_POST['country'])){ echo set_value('country'); } else{ echo $user['country_name']; }?>" />
                              <?php echo "<div style='color:red'>".form_error('country')."</div>"; ?>
                          </div>
                          <div class="parsley-row">
                              <label for="domain">Industry<span class="req">*</span></label>
                               <input type="text" required name="domain" disabled class="md-input" value="<?php if(ISSET($_POST['domain'])){ echo set_value('domain'); } else{ echo $user['domain_name']; }?>" />
                              <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                          </div>
                       </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                      <div class="uk-width-medium-1-2" style="float:right;" >
                          <input type="submit" class="md-btn md-btn-primary uk-center"  name="Create" value="Update" style="float:right" />
                      </div>
                      <div class="uk-width-medium-1-2">
                          <a href="<?php echo base_url(); ?>dashboard" class="md-btn md-btn-danger uk-center" style="">Cancel</a>
                      </div>
                    </div>
               

              </div>
                </div>
            </div>
	
        </form>    

        </div>
    </div>
