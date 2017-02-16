<div id="page_content">
    <div id="page_content_inner">

        <form action="" id="form_validation" class="uk-form-stacked" name="organization_location" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Add Job Site</h3>
                        
                    <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                    <div class="uk-alert uk-alert-success" data-uk-alert="">
                	   <a href="#" class="uk-alert-close uk-close"></a>
                        <?php echo $this->session->flashdata('SucMessage');  ?>
                    </div> <?php } ?>  
                    <?php if($org_id == 1) { ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('organization'); ?>  <span class="required">*</span></label> <br/>
                                    <select id="val_select" data-placeholder="Choose a Organisation..." name="org_id" class="chosen_select org_change" required onchange="org_location_change(this.value);">
                                        <option value="-1"></option>
                                        <?php foreach($org as $org_det) { 
                                                if($org_det['id'] != 1){
                                            ?>
                                            <option <?php if(isset($_POST['org_id'])){
                                                    if($_POST['org_id'] == $org_det['id']){ ?>
                                                        selected= "selected"
                                                   <?php }} ?> value="<?php echo $org_det['id']; ?>"><?php echo $org_det['org_name']; ?>
                                            </option>
                                        <?php   } 
                                            }
                                        ?>
                                    </select>
                                <?php echo "<div style='color:red'>" . form_error('org_id') . "</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
			 					<label for="val_select" ><?php echo $this->lang->line('location_name'); ?><span class="req">*</span></label></label>
                                <input type="text" class="md-input" required name="location_name" value="<?php echo set_value('location_name');?>" data-parsley-error-message="<?php echo $this->lang->line('location_name_req'); ?>"/>
			                <?php 
                                echo "<div style='color:red'>" . form_error('location_name') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('location_id'); ?><span class="req">*</span></label></label>
                                <input type="text" class="md-input" required name="location_id" value="<?php echo set_value('location_id');?>" data-parsley-error-message="<?php echo $this->lang->line('location_id_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('location_id') . "</div>";
                             ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                             <div class="parsley-row">
                                <label for="address" style="top: -3px;">Address (100 Chars max)<span class="req">*</span></label>
                                <textarea name="address" required class="md-input" cols="4" rows="4" data-parsley-trigger="keyup" data-parsley-maxlength="100" data-parsley-validation-threshold="10" data-parsley-maxlength-message = "Max length is exceeded the limit" data-parsley-error-message="<?php echo $this->lang->line('address_req'); ?>"><?php if(ISSET($_POST['address']))
                                            { echo $_POST['address']; }
                                    ?></textarea>
                                <?php echo "<div style='color:red'>".form_error('address')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('city'); ?><span class="req">*</span></label></label>
                                <input type="text" class="md-input" required name="city" value="<?php echo set_value('city');?>"  data-parsley-error-message="<?php echo $this->lang->line('city_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('city') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('state'); ?><span class="req">*</span></label></label>
                                <input type="text" class="md-input" required name="state" value="<?php echo set_value('state');?>" data-parsley-error-message="<?php echo $this->lang->line('state_req'); ?>"/>
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
                                <input type="number" class="md-input" required name="zip_code" value="<?php echo set_value('zip_code');?>" data-parsley-error-message="<?php echo $this->lang->line('zipcode_req'); ?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('zip_code') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" ><?php echo $this->lang->line('country'); ?> <span class="req">*</span></label></label><br/>
                                 <select required data-placeholder="Select Countries..." name="countries" class="location_countrys chosen_select" data-parsley-error-message="<?php echo $this->lang->line('country_req'); ?>">
                                        <?php 
                                        foreach($countries as $key=>$value){ ?>
                                            <option value="<?php echo $value['loc_id']; ?>" 
                                            <?php 
                                                if($value['loc_id'] === $org_country){ 
                                                        echo 'selected';
                                                }
                                                if(isset($_POST['countries']) && in_array($value['loc_id'],$_POST['countries'])){
                                                    echo 'selected';
                                                }
                                                 ?> > <?php echo $value['country_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                 <?php 
                                echo "<div style='color:red'>" . form_error('countries') . "</div>";
                             ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row parsley-row org_users">
                                <label>Users</label><br/>
                                <div id="users">
                                <select id="multiselect_userss" class="chosen_select" name="users[]" multiple="multiple" data-placeholder="Select Users...">
                                <?php 
                                    if($org_id != 1){
                                    foreach($users as $key=>$value) { 
                                ?><option value="<?php echo $value['id']; ?>"
                                <?php
                                    if(isset($_POST['users'])){
                                       if(in_array($value['id'],$_POST['users'])){
                                        echo 'selected';
                                       }
                                    }else if($value['id'] === $user_id){
                                        echo 'selected';
                                    }
                                ?> >
                                    <?php echo $value['firstname'].' '.$value['lastname']; ?>
                                </option>
                                <?php } 
                                    }
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
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
		                  <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="Create" value="<?php echo $this->lang->line('create'); ?>">
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