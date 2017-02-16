<div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('edit_country'); ?></h3>
<form action="" id="form_validation" class="uk-form-stacked" name="country" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
            
                <?php if($ErrorMessages!='') {?>
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $ErrorMessages;  ?>
                </div> <?php } ?>
                  <input type="hidden" name="loc_id" value="<?php echo $result['country']['loc_id']; ?>" /> 
                <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?>  


                <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 
                                    <label for="fullname"><?php echo $this->lang->line('country_name'); ?> <span class="req">*</span></label>
                                    <div class="parsley-row">
                                    <input type="text" name="country_name" class="md-input" value="<?php if(ISSET($_POST['country_name']))
                                                { echo set_value('country_name'); }
                                              else{ echo $result['country']['country_name']; }
                                        ?>" data-parsley-error-message="<?php echo $this->lang->line('country_name_req'); ?>" />
                                    <?php echo "<div style='color:red'>".form_error('country_name')."</div>"; ?>
                                </div>
                        </div>
                </div>
                            
                    <div class="uk-grid" data-uk-grid-margin>
                       
                        <div class="uk-width-medium-1-2">
                           <label for="" class="inline-label"><?php echo $this->lang->line('status'); ?></label><br/>
                             <span class="icheck-inline">
                                 <input type="radio" name="status" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  if($result['country']['status'] == 1) {
                                             echo 'checked';
                                         }
                                         if(ISSET($_POST['status']) && $_POST['status'] == 1) {
                                                 echo 'checked';
                                         }
                                      ?>  />
                                 <label for="radio_demo_inline_1" class="inline-label"><?php echo $this->lang->line('active'); ?></label>
                             </span>
                             <span class="icheck-inline">
                                 <input type="radio" name="status" id="radio_demo_inline_2" data-md-icheck value="0" <?php  if($result['country']['status'] == 0){
                                             echo 'checked';
                                         }
                                         if(ISSET($_POST['status']) && $_POST['status'] == 0) {
                                                 echo 'checked';
                                         }
                                      ?>
                                 />
                                 <label for="radio_demo_inline_2" class="inline-label"><?php echo $this->lang->line('inactive'); ?></label>
                             </span>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                           <div class="uk-width-medium-1-2">
                             <input type="submit" class="md-btn md-btn-primary" style="float:right;" name="update" value="<?php echo $this->lang->line('update'); ?>" onclick="return showNoFile();">
                          </div>
                           <div class="uk-width-medium-1-2">
                             <a href="<?php echo base_url(); ?>country" class="md-btn md-btn-danger"><?php echo $this->lang->line('cancel'); ?></a>
                          </div>
                    </div>
                            
                        </div>
                    </div>
    </form>    
</div>
</div>