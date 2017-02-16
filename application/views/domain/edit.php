<div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('edit_domain'); ?></h3>

	<form action="" id="form_validation" class="uk-form-stacked" name="domain" method="post" enctype="multipart/form-data">
            <div class="md-card">
                <div class="md-card-content">
                	<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                	<div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                  		  <?php echo $this->session->flashdata('SucMessage');  ?>
                	</div> <?php } 
                           
                            

//print_r($domain);exit;
                    ?>  
                    <div class="uk-grid" data-uk-grid-margin>
                        <input type="hidden" name="domain_id" value="<?php echo $domain['domain_id']; ?>" />
                        <input type="hidden" name="map_id" value="<?php //echo $domain['id']; ?>" />
                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="domainname"><?php echo $this->lang->line('domain_name'); ?><span class="req">*</span></label>
                                    <input type="text" name="domain_name" data-parsley-trigger="change" required data-parsley-error-message="<?php echo $this->lang->line('industry_name_req'); ?>" class="md-input" value="<?php if(ISSET($_POST['domain_name']))
                                                { echo trim(set_value('domain_name')); }
                                                else{
                                                   echo trim($domain['domain_name']);
                                                }
                                        ?>" />
                            <?php echo "<div style='color:red'>".form_error('domain_name')."</div>"; ?>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                          <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="domainname desc"><?php echo $this->lang->line('domain_desc'); ?></label>
                                    <textarea name="domain_desc" class="md-input"><?php if(ISSET($_POST['domain_desc'])){ echo trim(set_value('domain_desc'));}else{ echo trim($domain['domain_desc']);}?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('domain_desc')."</div>"; ?>
                                </div>
                        </div>
                         
                    </div>
                    
                     <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                
                                    <label for="countries"><?php echo $this->lang->line('select_country'); ?><span class="req">*</span></label>
                                    <select id="multiselect" required multiple="multiple" class="country_change" data-placeholder=" Select Countries" name="countries[]" data-parsley-error-message="<?php echo $this->lang->line('country_req'); ?>">

                                    <option value=" ">Select Country</option>
                                        <?php 
                                        foreach($countries as $key=>$value){ ?>
                                            <option value="<?php echo $value['loc_id']; ?>" 
                                            <?php
                                             if(isset($_POST['countries'])){
                                                if($value['loc_id'] === $_POST['countries']){
                                                    echo 'selected';
                                                }

                                            }else{ 
                                                if(in_array($value['loc_id'],$domain['country'])){ 
                                                        echo 'selected';
                                                }

                                            }?> > <?php echo $value['country_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('countries')."</div>"; ?>
                                </div>
                        </div>
                        
                    </div>
                    <!--<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                    <?php if($show_default) { ?>
                            <label for="" class="inline-label">Set as Default</label>
                            <div class="parsley-row">
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"    <?php  
                                            if(ISSET($_POST['default'])){
                                                if($_POST['default'] == 1) {
                                                    echo 'checked';
                                                }
                                            }else{
                                                if($domain[0]['default'] == 1) {
                                                    echo 'checked';
                                               }
                                            }
                                        ?>  />
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" class="domain" name="default_edit" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                            if(ISSET($_POST['default'])){
                                                if($_POST['default'] == 0) {
                                                    echo 'checked';
                                                }
                                            }else{
                                                if($domain[0]['default'] == 0){
                                                    echo 'checked';
                                               }
                                            }
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                </div>
                                 <?php } ?>
                                 <div class="default" style="display:none;">
                                  <label for="" class="inline-label">Set as Default</label>
                             <div class="parsley-row">
                                <span class="icheck-inline">
                                    <input type="radio" class="domain" name="default_edit" id="radio_demo_inline_1" data-md-icheck value="1" <?php  
                                            if(ISSET($_POST['default'])){
                                                if($_POST['default'] == 1) {
                                                    echo 'checked';
                                                }
                                            }else{
                                                if($domain[0]['default'] == 1) {
                                                    echo 'checked';
                                               }
                                            }
                                         ?>  />
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" class="domain" name="default_edit" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                            if(ISSET($_POST['default'])){
                                                if($_POST['default'] == 0) {
                                                    echo 'checked';
                                                }
                                            }else{
                                                if($domain[0]['default'] == 0){
                                                    echo 'checked';
                                               }
                                            }
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                </div>
                                </div>

                                <?php /*else if(!$default_option) {  ?>
                                 <label for="" class="inline-label">Set Default</label>
                                 <div class="parsley-row">
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  
                                            if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                        echo 'checked';
                                                }
                                         ?>  />
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                            if(ISSET($_POST['default'])){
                                                if($_POST['default'] == 0) {
                                                        echo 'checked';
                                                }
                                            }else{
                                                    echo 'checked';
                                            }
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                </div>
                                 <?php } */ ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>-->
                    <div class="uk-grid" data-uk-grid-margin>
                         <div class="uk-width-medium-1-2">
                            <label for="" class="inline-label"></label>
                            <div class="parsley-row">
                            <span class="icheck-inline">
                                <input type="radio" name="status" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  
                                        if(ISSET($_POST['status'])){
                                            if($_POST['status'] == 1) {
                                                echo 'checked';
                                        }
                                        }else{
                                            if($domain['status'] == 1) {
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
                                            if($domain['status'] == 0) {
                                              echo 'checked';
                                          }
                                        } 
                                    ?>
                                />
                                <label for="radio_demo_inline_2" class="inline-label"><?php echo $this->lang->line('inactive'); ?></label>
                            </span>
                           </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                    		<input type="submit" class="md-btn md-btn-primary" style="float:right;" name="save" value="<?php echo $this->lang->line('update'); ?>">

                    	</div>
                    	<div class="uk-width-medium-1-2">
                    			 <a href="<?php echo base_url(); ?>domain" class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?></a>
                    	</div>
                    </div>

                </div>
            </div>

	</form>
</div>
</div>