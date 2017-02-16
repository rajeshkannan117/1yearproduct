<div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('new_country'); ?></h3>
<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                	<div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                  		  <?php echo $this->session->flashdata('SucMessage'); 
                           ?>
                	</div> <?php } ?>  
        <div class="md-card">
                <div class="md-card-content large-padding">
	<form action="" id="form_validation" class="uk-form-stacked" name="country" method="post" enctype="multipart/form-data">
        
                    <div class="uk-grid" data-uk-grid-margin>

                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row uk-form-row">
                                    <label for="countryname" class="uk-form-label"><?php echo $this->lang->line('country_name'); ?> <span class="req">*</span></label>
                                    <input type="text" name="country_name" class="md-input" value="<?php if(ISSET($_POST['country_name']))
                                                { echo set_value('country_name'); }
                                        ?>" data-parsley-trigger="change" required data-parsley-error-message="<?php echo $this->lang->line('country_name_req'); ?>"/>
                                    <?php echo "<div style='color:red'>".form_error('country_name')."</div>"; ?>
                                </div>
                        </div>

                        </div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-1-2">
                    		<input type="submit" class="md-btn md-btn-primary" style="float: right;" name="save" value="<?php echo $this->lang->line('save'); ?>">

                    	</div>
                    	<div class="uk-width-1-2">
                    			 <a href="<?php echo base_url(); ?>country"  class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?></a>
                    	</div>
                    </div>

	</form>
                    </div>
            </div>
</div>
</div>
