

    <div id="page_content">
        <div id="page_content_inner">

<form action="" id="form_validation" class="uk-form-stacked" name="organization" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a"></h3>

                    <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php }   
                        //print_r($user);exit;?>
                    <div class="uk-grid" data-uk-grid-margin>
                    <?php if($this->session->userdata['org_id']==1){?> 
                        <div class="uk-width-medium-2-4">
                                 <label>Organization</label>
                                 <span id="details">
                                 <input type="text" class="md-input" name="org_name" value="<?php if(ISSET($_POST['org_name'])){ echo set_value('org_name'); } else{ echo $user['org_name']; }?>" disabled/>
                                 <?php echo "<div style='color:red'>".form_error('org_name')."</div>"; ?>
                                 </span>
                        </div>
                        <?php } ?>
                        <div <?php if($this->session->userdata['org_id']!=1){?> class="uk-width-medium-1-2" <?php }else{?>class="uk-width-medium-1-4" <?php } ?> >
                                 <label>First Name</label>
                                 <span id="firstname">
                                 <input type="text" class="md-input" id="firstname" name="firstname" value="<?php if(ISSET($_POST['firstname'])){ echo set_value('firstname'); } else{ echo $user['firstname']; }?>" />
                                 <?php echo "<div style='color:red'>".form_error('firstname')."</div>"; ?>
                                 </span>
                        </div>
                        <div <?php if($this->session->userdata['org_id']!=1){?> class="uk-width-medium-1-2" <?php }else{?>class="uk-width-medium-1-4" <?php } ?>>
                                 <label>Last Name</label>
                                 <span id="lastname">
                                 <input type="text" class="md-input" id="lastname" name="lastname" value="<?php if(ISSET($_POST['lastname'])){ echo set_value('lastname'); } else{ echo $user['lastname']; }?>" />
                                 <?php echo "<div style='color:red'>".form_error('lastname')."</div>"; ?>
                                 </span>
                        </div>
                        
                    </div>
                    <?php if($this->session->userdata['org_id']==1){?> 
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-2">
                                 <label>Location</label>
                                 <span id="details">
                                 <input type="text" class="md-input" name="location" value="<?php if(ISSET($_POST['org_name'])){ echo set_value('location'); } else{ echo $user['country_name']; }?>" disabled/>
                                 <?php echo "<div style='color:red'>".form_error('location')."</div>"; ?>
                                 </span>
                        </div>

                        <div class="uk-width-medium-1-2">
                                 <label>Domain</label>
                                 <span id="domain">
                                 <input type="text" class="md-input" name="domain" value="<?php if(ISSET($_POST['domain'])){ echo set_value('domain'); } else{ echo $user['domain_name']; }?>" disabled/>
                                 <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                                 </span>
                        </div>

                        
                        </div>
            <?php }//print_r($dept);?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                              <label for="parent" class="">Select Department</label>
                              <div class="parsley-row">
                              <select name="department[]" required id="multiselect" multiple="multiple" data-placeholder="Select Deparment...">
                               <?php foreach($dept as $key=>$value) { ?>
                                  <option value="<?php echo $value['dept_id']; ?>"
                                  <?php 
                                      if(ISSET($_POST['department'])){
                                        if(in_array($value['dept_id'],$_POST['department']))
                                          {   echo 'selected'; }
                                      }
                                      else{
                                        if(in_array($value['dept_id'],$user['department'])){
                                              echo 'selected';
                                        }
                                    }
                                 ?>><?php echo $value['dept_name']; ?></option>
                              <?php } ?>
                              </select>
                                <?php 
                                    echo "<div style='color:red'>".form_error('department[]')."</div>"; 
                                ?>
                               </div>
                            </div>





                        <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="role_id">Select Role <span class="req">*</span></label>
                                    <select id="" required data-placeholder="Select Role..." name="role_id" data-md-selectize >

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
                                                }
                                                /*if(isset($_POST['countries']) && in_array($value['loc_id'],$_POST['countries'])){
                                                    echo 'selected';
                                                }*/
                                                 ?> > <?php echo $value['role_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('role_id')."</div>"; ?>
                                </div>
                        </div>
                    </div>
                        
                        <div class="uk-grid" data-uk-grid-margin>

								<div class="uk-width-medium-1-2">
                                        <label>Email</label>
                                        <input type="text" class="md-input" id="usr_email" name="usr_email" value="<?php if(ISSET($_POST['usr_email'])){ echo set_value('usr_email'); } else{ echo $user['email']; }?>" />
                                        <?php echo "<div style='color:red'>".form_error('usr_email')."</div>"; ?>
                        </div>
                        
                        <div class="uk-width-medium-1-2">
                                  <label>Phone</label>
                                <input type="text" class="md-input" id="usr_phone" name="usr_phone" value="<?php if(ISSET($_POST['usr_phone'])){ echo set_value('usr_phone'); } else{ echo $user['phone']; }?>" />
                                <?php echo "<div style='color:red'>".form_error('usr_phone')."</div>"; ?>
                                <!--<label>Passsword</label>
                                <input type="password" class="md-input" id="usr_psw" name="usr_psw" value="<?php if(ISSET($_POST['usr_psw'])){ echo set_value('usr_psw'); } else{ echo AES_Decode($user['password']); }?>" />
                                <?php echo "<div style='color:red'>".form_error('usr_psw')."</div>"; ?>-->
                        </div>
                    </div>
                    
                    
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2" style="float:right;">
                          <input type="submit" class="uk-form-file md-btn md-btn-primary" name="Create" value="Update" onclick="return showNoFile();">
                        </div>
                        <div class="uk-width-medium-1-2">
                            <a href="<?php echo base_url(); ?>users"  class="md-btn md-btn-danger">Cancel</a>
                        </div>
		      			
                    </div>
                </div>
            </div>
	
        </form>    

        </div>
    </div>

