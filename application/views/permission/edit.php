<div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom">New Permission</h3>
	<form action="" id="form_validation" class="uk-form-stacked" name="permission" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                	<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                	<div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                  		  <?php echo $this->session->flashdata('SucMessage');  ?>
                	</div> <?php } ?>  
                     <input type="hidden" name="permission_id" value="<?php echo $permission->permission_id; ?>" />
                    <div class="uk-grid" data-uk-grid-margin>

                    	<div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="permissionname">Permission Name <span class="req">*</span></label>
                                    <input type="text" data-parsley-trigger="change" required name="permission_name" class="md-input" value="<?php if(ISSET($_POST['permission_name']))
                                                { echo $_POST['permission_name']; }
                                                if($permission->permission_name){
                                                	echo $permission->permission_name;
                                                }
                                        ?>" />
                                    <?php echo "<div style='color:red'>".form_error('permission_name')."</div>"; ?>
                                </div>
                        </div>

                          <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="permissionname desc">Permission Name Description </label>
                                    <textarea name="permission_desc" class="md-input"><?php if(ISSET($_POST['permission_desc']))
                                                { echo $_POST['permission_desc']; }
                                              if($permission->permission_desc){
                                                	echo $permission->permission_desc;
                                                }  
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('permission_desc')."</div>"; ?>
                                </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-2">
                         <label for="" class="inline-label">Set Status</label>
                                <div class="parsley-row">
                                     <span class="icheck-inline">
                                    <input type="radio" name="status" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  
                                             if(ISSET($_POST['status']) && $_POST['status'] == 1) {
                                                        echo 'checked';
                                                }
                                               if($permission->status == 1) {

                                                		echo 'checked';
                                            	}
                                         ?>  />
                                    <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" name="status" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                             if(ISSET($_POST['status']) && $_POST['status'] == 0) {
                                                        echo 'checked';
                                                }
                                                 if($permission->status == 0) {

                                                		echo 'checked';
                                            	}
                                         ?>
                                    />
                                    <label for="radio_demo_inline_2" class="inline-label">No</label>
                                </span>
                                </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-1-2">
                    		<input type="submit" class="uk-form-file md-btn md-btn-primary" style="float:right;" name="save" value="Save">

                    	</div>
                    	<div class="uk-width-1-2">
                    			 <a href="<?php echo base_url(); ?>permission" class="uk-form-file md-btn md-btn-primary">Cancel</a>
                    	</div>
                    </div>

                </div>
            </div>

	</form>
</div>
</div>