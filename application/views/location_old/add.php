<div id="page_content">
    <div id="page_content_inner">

        <form action="" id="form_validation" class="uk-form-stacked" name="organization_location" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Job Title information</h3>
                        
                    <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                    <div class="uk-alert uk-alert-success" data-uk-alert="">
                	   <a href="#" class="uk-alert-close uk-close"></a>
                        <?php echo $this->session->flashdata('SucMessage');  ?>
                    </div> <?php } ?>  
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
			 					<label for="val_select" >Location name <span class="required">*</span></label></label>
                                <input type="text" class="md-input" required name="location_name" value="<?php echo set_value('location_name');?>"/>
			                <?php 
                                echo "<div style='color:red'>" . form_error('location_name') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" >Location Id <span class="required">*</span></label></label>
                                <input type="text" class="md-input" required name="location_id" value="<?php echo set_value('location_id');?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('location_id') . "</div>";
                             ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                             <div class="parsley-row">
                                <label for="address">Address (100 Chars max)<span class="required">*</span></label></label>
                                <textarea name="address" required class="md-input" cols="4" rows="4" data-parsley-trigger="keyup" data-parsley-maxlength="100" data-parsley-validation-threshold="10" data-parsley-maxlength-message = "Max length is exceeded the limit"><?php if(ISSET($_POST['address']))
                                            { echo $_POST['address']; }
                                    ?></textarea>
                                <?php echo "<div style='color:red'>".form_error('address')."</div>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" >City <span class="required">*</span></label></label>
                                <input type="text" class="md-input" required name="city" value="<?php echo set_value('city');?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('city') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" >State <span class="required">*</span></label></label>
                                <input type="text" class="md-input" required name="state" value="<?php echo set_value('state');?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('state') . "</div>";
                             ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" >ZIP Code <span class="required">*</span></label></label>
                                <input type="number" class="md-input" required name="zip_code" value="<?php echo set_value('zip_code');?>"/>
                            <?php 
                                echo "<div style='color:red'>" . form_error('zip_code') . "</div>";
                             ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="val_select" >Country <span class="required">*</span></label></label>
                                 <select required data-placeholder="Select Countries..." name="countries" class="location_country">
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
                            </div>
                        </div>
                    </div>
                        
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
		                  <input type="submit" class="uk-form-file md-btn md-btn-primary" style="float:right;" name="Create" value="Create">
		      			</div>
		      			<div class="uk-width-medium-1-2" style="">
		                  <a class="md-btn md-btn-danger" href="<?php echo base_url() ?>location">
                            Cancel
                           </a>
		      			</div>
                    </div>
                </div>
            </div>
	
        </form>    

        </div>
    </div>