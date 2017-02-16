
<?php //print_r($result); exit;?>
    <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Update Category - <?php echo $result['category_name']; ?></h3>
<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?>  
<form action="<?php echo base_url(); ?>category/edit/<?php echo $result['cat_id']; ?>" id="form_validation" class="uk-form-stacked" name="category" method="post" novalidate>

            <input type="hidden" class="md-input" id="cat_id" name="cat_id" value="<?php echo $result['cat_id']; ?>"  />
              <div class="md-card">
                <div class="md-card-content large-padding">
                   <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="parsley-row">

			 <label for="val_select" class="">Category Name <span style='color:red'>*</span></label>
                                  <input type="text" class="md-input" id="category_name" name="category_name" value="<?php if(isset($_POST['cat_name'])){ echo set_value('category_name'); } else { echo $result['category_name']; }?>" data-parsley-error-message="<?php echo $this->lang->line('category_name_req'); ?>" data-parsley-trigger="change" required   />
                                 <?php  echo "<div style='color:red'>" . form_error('category_name') . "</div>"; ?>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                            </div>
                      </div>
                      <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="hobbies" class="">Category Description</label>
                                        <textarea name="category_desc" class="md-input" ><?php 

                                            if(ISSET($_POST['category_desc']))
                                                { echo set_value('category_desc'); }
                                            else{
                                                     echo trim($result['category_desc']);
                                                }
                                        ?></textarea>
                                    <?php echo "<div style='color:red'>".form_error('category_desc')."</div>"; ?>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                        </div>
                    </div>
                    <?php if(!$this->session->userdata('org_id')){?>
                    <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="country[]">Select Countries <span class="req">*</span></label>
                                    <select data-md-selectize id="country" required class="country_change" data-placeholder=" Select Countries" name="countries" data-parsley-error-message="<?php echo $this->lang->line('country_req'); ?>" onchange="countrychange(this.value);">
                                    <option value=" ">Select Country</option>
                                      <?php 

                                      foreach($countries['country'] as $key=>$value){ ?>
                                        <option value="<?php echo $value['loc_id']; ?>" 
                                        <?php
                                             if(isset($_POST['countries'])){
                                                if($value['loc_id'] === $_POST['countries']){
                                                    echo 'selected';
                                                }

                                            }else{ 
                                          if($value['loc_id'] === $result['country_id']){ 
                                              echo 'selected';
                                          }

                                        }?> > <?php echo $value['country_name']; ?>
                                        </option>
                                      <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('country')."</div>"; ?>
                                </div>
                        </div>

                        </div>


                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="domain">Select Industry <span class="req">*</span></label>
                                    <span id="domain">
                                    <select data-md-selectize id="" required class="domain_change" data-parsley-error-message="<?php echo $this->lang->line('industry_req'); ?>" data-placeholder=" Select Industry" name="domain" onchange="domainchange(this.value);">
                                    <option value=" ">Select Domain</option>
                                      <?php 
                                      //print_r($domain); exit;
                                      foreach($domain as $key=>$value){ ?>
                                        <option value="<?php echo $value['domain_id']; ?>" 
                                        <?php
                                             if(isset($_POST['domain'])){
                                                if($value['domain_id'] === $_POST['domain']){
                                                    echo 'selected';
                                                }

                                            }else{ 
                                          if($value['domain_id'] === $result['domain_id']){ 
                                              echo 'selected';
                                          }

                                        }?> > <?php echo $value['domain_name']; ?>
                                        </option>
                                      <?php } ?>
                                    </select>
                                    <?php echo "<div style='color:red'>".form_error('domain')."</div>"; ?>
                                    </span>
                                </div>
                        </div>
                            <div class="uk-width-medium-1-2">
                        </div>
                      </div>

                      <?php } ?>

                      <?php if($this->session->userdata('org_id')!=0){ ?>

                      <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                              <label for="parent" class="">Select Department</label>
                              <div class="parsley-row">
                              <span id="department">
                              <select data-md-selectize id="" required  data-placeholder="Select Deparment" data-parsley-error-message="<?php echo $this->lang->line('department_req'); ?>" name="department">
                               <?php foreach($org_dept as $key=>$value) { ?>
                                  <option value="<?php echo $value['dept_id']; ?>"
                                  <?php 
                                      if(ISSET($_POST['department'])){
                                        if(in_array($value['dept_id'],$_POST['department']))
                                          {   echo 'selected'; }
                                      }
                                      else{
                                        if(in_array($value['dept_id'],$result['dept_id'])){
                                              echo 'selected';
                                        }
                                    }
                                 ?>><?php echo $value['dept_name']; ?></option>
                              <?php } ?>
                              </select>
                              </span>
                                <?php 
                                    echo "<div style='color:red'>".form_error('department[]')."</div>"; 
                                ?>
                               </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                           </div>
                        </div>

                      <?php } else{ ?>
                    <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                              <label for="parent" class="">Select Department</label>
                              <div class="parsley-row">
                              <span id="department">
                              <select data-md-selectize id="" required  data-placeholder="Select Deparment" data-parsley-error-message="<?php echo $this->lang->line('department_req'); ?>" name="department">
                               <?php foreach($dept as $key=>$value) { ?>
                                  <option value="<?php echo $value['dept_id']; ?>"
                                  <?php 
                                      if(ISSET($_POST['department'])){
                                        if(in_array($value['dept_id'],$_POST['department']))
                                          {   echo 'selected'; }
                                      }
                                      else{
                                        if(in_array($value['dept_id'],$result['dept_id'])){
                                              echo 'selected';
                                        }
                                    }
                                 ?>><?php echo $value['dept_name']; ?></option>
                              <?php } ?>
                              </select>
                              </span>
                                <?php 
                                    echo "<div style='color:red'>".form_error('department[]')."</div>"; 
                                ?>
                               </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                           </div>
                        </div>
                        <?php } ?>

                        <?php if($this->session->userdata('org_id')!=0){ 
                          
                          ?>

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2"
                              <label for="parent" class="">Select Parent</label>
                              <div class="parsley-row">
                               <select name="parent" required data-md-selectize>
                                    <?php 
                                    foreach($org_cat as $key=>$value) {
                                      if($value['cat_id'] != $category_id){
                                       ?>
                                        <option value="<?php echo $value['cat_id']; ?>"
                                            <?php 
                                              if(ISSET($_POST['parent'])){
                                                if($_POST['parent'] == $value['cat_id'])
                                                {   echo 'selected'; }
                                              }
                                              else{
                                                if($result['parent'] == $value['cat_id']){
                                                  echo 'selected';
                                                }
                                            }
                                        ?>><?php echo $value['category_name']; ?></option>
                                    <?php } } ?>
                               </select>
                               </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                        </div>
                      </div>

                        <?php } else{ ?>
                     <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                              <label for="parent" class="">Select Parent</label>
                              <div class="parsley-row">
                               <select name="parent" required data-md-selectize>
                                    <?php 
                                    foreach($parent as $key=>$value) {
                                      if($value['cat_id'] != $category_id){
                                       ?>
                                        <option value="<?php echo $value['cat_id']; ?>"
                                            <?php 
                                              if(ISSET($_POST['parent'])){
                                                if($_POST['parent'] == $value['cat_id'])
                                                {   echo 'selected'; }
                                              }
                                              else{
                                                if($result['parent'] == $value['cat_id']){
                                                  echo 'selected';
                                                }
                                            }
                                        ?>><?php echo $value['category_name']; ?></option>
                                    <?php } } ?>
                               </select>
                               </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                        </div>
                      </div>
                       <?php } ?>
                    <!--<div class="uk-grid" data-uk-grid-margin>                       
                      <div class="uk-width-medium-1-2">
                          <?php //if($default && $default ==  $result['cat_id']) { ?>
                          <label for="" class="inline-label">Set Default</label>
                                  <div class="parsley-row">
                                       <span class="icheck-inline">
                                      <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  
                                               /*if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                          echo 'checked';
                                                  }elseif($result['default'] == 1){
                                                           echo 'checked';
                                                  }*/
                                           ?>  />
                                      <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                  </span>
                                  <span class="icheck-inline">
                                      <input type="radio" name="default" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                              /* if(ISSET($_POST['default']) && $_POST['default'] == 0) {
                                                          echo 'checked';
                                                  }elseif($result['default'] == 0){
                                                           echo 'checked';
                                                  }*/
                                           ?>
                                      />
                                      <label for="radio_demo_inline_2" class="inline-label">No</label>
                                  </span>
                                  </div>
                              <?php // } else if(!$default) {  ?>
                                      <label for="" class="inline-label">Set Default</label>
                                  <div class="parsley-row">
                                       <span class="icheck-inline">
                                      <input type="radio" name="default" id="radio_demo_inline_1" data-md-icheck value="1"  <?php  
                                               /*if(ISSET($_POST['default']) && $_POST['default'] == 1) {
                                                          echo 'checked';
                                                  }*/
                                           ?>  />
                                      <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                  </span>
                                  <span class="icheck-inline">
                                      <input type="radio" name="default" id="radio_demo_inline_2" data-md-icheck value="0" <?php  
                                               /*if(ISSET($_POST['default']) && $_POST['default'] == 0) {
                                                          echo 'checked';
                                                  }*/
                                           ?>
                                      />
                                      <label for="radio_demo_inline_2" class="inline-label">No</label>
                                  </span>
                                  </div>

                              <?php //} ?>
                      </div>
                      <div class="uk-width-medium-1-2">
                           </div>
                  </div>-->
                    <div class="uk-grid" data-uk-grid-margin> 
                      <div class="uk-width-medium-1-2">
                        <label for="" class="inline-label">Set Status</label>
                          <div  class="parsley-row">
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" id="radio_demo_inline_1" data-md-icheck value="1"  <?php 
                                          if(ISSET($_POST['status'])){
                                             if($_POST['status'] == 1) {
                                                        echo 'checked';
                                              }
                                          }else{
                                             if($result['status'] == 1) {
                                                      echo 'checked';
                                                  }
                                          } 
                                             ?>  />
                                        <label for="radio_demo_inline_1" class="inline-label">Yes</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" id="radio_demo_inline_2" data-md-icheck value="0"<?php 
                                          if(ISSET($_POST['status'])){
                                             if($_POST['status'] == 0) {
                                                        echo 'checked';
                                              }
                                          }else{
                                             if($result['status'] == 0) {
                                                      echo 'checked';
                                                  }
                                          } 
                                             ?>  
                                        />
                                        <label for="radio_demo_inline_2" class="inline-label">No</label>
                                    </span>
                            </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        </div>
                  </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                <button type="submit"   style="float:right;"class="md-btn md-btn-primary">Update</button>
                            </div>
                            <div class="uk-width-1-2">
                                 <a href="<?php echo base_url(); ?>category" class="md-btn md-btn-primary">Cancel</a>
                            </div>
                        </div>
                   
                </div>
            </div>
 </form>    
        </div>
    </div>

   
