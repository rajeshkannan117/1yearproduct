<div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('new_domain'); ?></h3>
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
	<form action="" id="form_validation" class="uk-form-stacked" name="domain" method="post" enctype="multipart/form-data" >

            <div class="md-card">
                <div class="md-card-content large-padding">
                    <div class="uk-grid" data-uk-grid-margin>

                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="domainname" class="">
                                            <?php echo $this->lang->line('domain_name'); ?> <span class="req">*</span>
                                    </label>
                                    <input type="text" name="domain_name" id="domain_name" data-parsley-trigger="change"  onfocus="get_domain_submit_block()"  onkeypress="get_domain_submit_block()" onblur="check_domain_unique(this.value)" required class="md-input" value="<?php if(ISSET($_POST['domain_name']))
                                                { echo trim(set_value('domain_name')); }
                                        ?>" data-parsley-error-message="<?php echo $this->lang->line('industry_name_req'); ?>" /><span id="check_domain_registered"></span>
                                    <?php echo "<div style='color:red'>".form_error('domain_name')."</div>"; ?>
                                </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                          <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="domainname desc"> <?php echo $this->lang->line('domain_desc'); ?> </label>
                                    <textarea name="domain_desc" class="md-input"><?php if(ISSET($_POST['domain_desc']))
                                                { echo trim(set_value('domain_desc')); }
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('domain_desc')."</div>"; ?>
                                </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                        <!-- Change default -> 1 Vomit -> 0 apply original actions -> -1 -->
                            <input type="hidden" name="change_default" id="change_default" value="" />
                            <input type="hidden" name="action" id="action" value="-1" />
                        </div>
                    </div>
                     <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="countries">
                                        <?php echo $this->lang->line('select_country'); ?><span class="req">*</span></label>
                                    <select id="multiselect" data-parsley-error-message="<?php echo $this->lang->line('country_req'); ?>" required multiple="multiple" data-placeholder="Select Countries..." name="countries[]">
                                    	<?php 
                                    	foreach($countries as $key=>$value){ ?>
                                    		<option value="<?php echo $value['loc_id']; ?>" 
                                    		<?php 
                                    			if($value['loc_id'] === $default){ 
                                    					echo 'selected';
                                    			}
                                    			if(isset($_POST['countries']) && in_array($value['loc_id'],$_POST['countries'])){
                                    				echo 'selected';
                                    			}
                                    			 ?> > <?php echo $value['country_name']; ?>
                                    		</option>
                                    	<?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('countries[]')."</div>"; ?>
                                </div>
                        </div>
                         <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <!--<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <?php //if(!$default_option) { ?>
                         <label for="" class="inline-label">Set Default</label>
                                <div class="parsley-row">
                                     <span class="icheck-inline">
                                     data-md-icheck-->
                                   <!-- <input type="radio" name="default" id="radio_default_1"  value="1"  <?php  
                                             if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                        echo 'checked';
                                                }
                                         ?>  />
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" name="default" id="radio_default_2" value="0" <?php  
                                             if(ISSET($_POST['default']) && $_POST['default'] == 0) {
                                                        echo 'checked';
                                                }
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                 <!--<input type="checkbox" name="checkbox_demo" id="checkbox_demo_1"  />
                                        <label for="checkbox_demo_1" class="inline-label">Mercury</label>-->
                                <!--</div>-->
                            <?php //} ?>
                                <!--<div class="parsley-row">
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="default" id="default" data-md-icheck 
                                          <?php if(ISSET($_POST['default'])) {
                                        		$status = $_POST['default'];
                                          		echo 'checked';
                                    		} else{$status = '';} ?>  value ="<?php echo $status; ?>"
                                         />
                                        <label for="checkbox_demo_inline_1" class="inline-label">Set Default</label>
                                    </span>
                                </div> -->
                        <!--</div>
                         <div class="uk-width-medium-1-2">
                        </div>
                    </div>-->

<div id="hide_domain_content" style="position: absolute;width: 95%;height: 50px;z-index: -9;background: #ddd;opacity: 0.5">
                            <img style="margin-left: 40%;padding: 10px;" src="<?php echo base_url().'assets/assets/img/spinners/spinner_warning.gif' ?>" />
                        </div>

                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                    		<input type="submit" class="md-btn md-btn-primary" style="float:right;" name="save" id="save_add_domain" value="<?php echo $this->lang->line('save'); ?>">

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
