<div id="page_content">
    <div id="page_content_inner">

        <form action="" id="form_validation" class="uk-form-stacked" name="organization_location" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Edit Job Site</h3>
                        
                    <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                    <div class="uk-alert uk-alert-success" data-uk-alert="">
                       <a href="#" class="uk-alert-close uk-close"></a>
                        <?php echo $this->session->flashdata('SucMessage');  ?>
                    </div> <?php } ?> 
                    <?php if($org_id == 1) { ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('organization'); ?>  <span class="required">*</span></label>
                                    <select id="val_select" name="org_id" class="org_change" required data-md-selectize onchange="org_location_change(this.value);">
                                        <?php foreach($org as $org_det) {?>
                                            <option <?php 
                                            if(ISSET($_POST['org_id'])){
                                               if($org_det['id'] == $_POST['org_id'])
                                               { 
                                                    echo 'selected'; 
                                                }
                                            }
                                            else{
                                                if($org_det['id'] == $org_id){
                                                    echo 'selected';
                                                }
                                            }?> value="<?php echo $org_det['id']; ?>">
                                                <?php echo $org_det['org_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                <?php echo "<div style='color:red'>" . form_error('org_id') . "</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?> 
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" >
                                    <?php echo $this->lang->line('location_name'); ?><span class="req">*</span>
                                </label>
                                <input type="text" class="md-input" required name="location_name" value="<?php if(isset($_POST['location_name'])){echo $_POST['location'];}elseif($location['location_name'] != ''){echo $location['location_name'];} ?>" data-parsley-error-message="<?php echo $this->lang->line('location_name_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('location_name') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('location_id'); ?><span class="req">*</span></label></label>
                                <input type="text" class="md-input" required name="location_id" value="<?php if(isset($_POST['location_id'])){echo $_POST['location_id'];}elseif($location['location_id'] != ''){echo $location['location_id'];} ?>" data-parsley-error-message="<?php echo $this->lang->line('location_id_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('location_id') . "</div>";
                             ?>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                             <div class="parsley-row">
                             <br/>
                                <label for="address" style="top: -3px;"><?php echo $this->lang->line('address'); ?> (100 Chars max)<span class="req">*</span></label>
                                <textarea name="address" required class="md-input" cols="4" rows="4" data-parsley-trigger="keyup" data-parsley-maxlength="100" data-parsley-validation-threshold="10" data-parsley-maxlength-message = "Max length is exceeded the limit" data-parsley-error-message="<?php echo $this->lang->line('address_req'); ?>"><?php if(ISSET($_POST['address']))
                                            { echo $_POST['address']; }elseif($location['address'] != ''){echo $location['address'];} ?></textarea>
                                <?php echo "<div style='color:red'>".form_error('address')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('city'); ?><span class="req">*</span></label></label>
                                <input type="text" class="md-input" required name="city" value="<?php if(isset($_POST['city'])){echo $_POST['city'];}elseif($location['city'] != ''){echo $location['city'];} ?>" data-parsley-error-message="<?php echo $this->lang->line('city_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('city') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('state'); ?><span class="req">*</span></label></label>
                                <input type="text" class="md-input" required name="state" value="<?php if(isset($_POST['state'])){echo $_POST['state'];}elseif($location['state'] != ''){echo $location['state'];} ?>" data-parsley-error-message="<?php echo $this->lang->line('state_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('state') . "</div>";
                             ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('zip_code'); ?> <span class="req">*</span></label></label>
                                <input type="number" class="md-input" required name="zip_code" value="<?php if(isset($_POST['zip_code'])){echo $_POST['zip_code'];}elseif($location['zip_code'] != ''){echo $location['zip_code'];} ?>" data-parsley-error-message="<?php echo $this->lang->line('zipcode_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('zip_code') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" >
                                    <?php echo $this->lang->line('country'); ?> 
                                    <span class="req">*</span>
                                </label><br/>
                                 <select required data-placeholder="Select Countries..." name="countries" class="location_countrys chosen_select" data-parsley-error-message="<?php echo $this->lang->line('country_req'); ?>">
                                        <?php 
                                        foreach($countries as $key=>$value){ ?>
                                            <option value="<?php echo $value['loc_id']; ?>" 
                                            <?php 
                                                if($location['country_id'] === $value['loc_id']){
                                                    echo 'selected';
                                                }else if($value['loc_id'] === $default){ 
                                                        echo 'selected';
                                                }
                                                if(isset($_POST['countries']) && in_array($value['loc_id'],$_POST['countries'])){
                                                    echo 'selected';
                                                }
                                                 ?> > <?php echo $value['country_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row org_users">
                                <label><?php echo $this->lang->line('users'); ?></label><br/>
                                <div id="users">
                                <select id="multiselect_userss" name="users[]" multiple="multiple" class="chosen_select" data-placeholder="Select Users...">
                                    <?php foreach($users as $key=>$value) { 
                                        ?>
                                    <option value="<?php echo $value['id']; ?>"
                                    <?php
                                        if(is_array($location_user)){
                                            if(in_array($value['id'], $location_user)){
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
                                    ?>
                                    ><?php echo $value['firstname'].' '.$value['lastname']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                          <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="Update" value="<?php echo $this->lang->line('update'); ?>" />
                        </div>
                        <div class="uk-width-medium-1-2" style="">
                          <a class="md-btn md-btn-danger" href="<?php echo base_url() ?>location">
                            <?php echo $this->lang->line('cancel'); ?>
                           </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>