 <style>
        li.rows{
            min-height:80px;
        }
        li.columns{
            float:left;
            height:75px;
            list-style: none;
        }
        li.highlight{
            min-height: 70px;
        }
        .dropovers{
          /*  border:1px solid #ccc;
            border-right-color:red;*/
        }
        .dragdrop-panel > span{
                display: inline-block;
    width: 80%;
}
        .content{
            padding-left: 0px !important;
        }
    </style>
    <div id="page_content">
        <div id="page_content_inner" class="form-page-alignment">
            <div class="uk-grid" style="display: block;padding-left:0px !important"; data-uk-grid-margin data-uk-grid-match id="wizard_forms">
                <div class="uk-width-large-8-10"  id="content_right" style="float:left;padding-left:35px; margin-top:0px;">
                    <?php if($org_id != 1){ 
                        $style= '';
                    }else{
                        $style="margin-bottom:20px";
                    }
                    ?>
                	<div class="uk-grid details" style="background: #fff; margin-left: 0px;">
                        <div class="uk-width-1-2" style="<?php echo $style; ?>;padding-left:10px;" >
                            <div class="parsley-row">
                                <div class="form-desc ">
                                    <label class="fn">Name your form<span class="req">*</span></label>
                                    <input type="text" class="md-input fn-field" id="form_name" name="form_name" value="" data-parsley-trigger="change" required  />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2"  style="<?php echo $style; ?>">
                            <div class="parsley-row">
                                <div class="form-category" style="margin-top:16px">
                                    <select name="form_category" class="chosen_select" data-placeholder="Choose your form category" id="form_categorys">
                                        <option value=""></option>
                                    <?php 
                                    foreach($categories as $key=>$value){ ?>
                                        <option value="<?php echo $key ?>"><?php echo $value;?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if($org_id != 1){ ?>
                        <div class="uk-width-1-2" style ="padding-left:10px">
                            <div class="location" style="margin-top:20px;">
                                <select name="location[]" class="chosen_select location_change" required id="location_change" multiple data-placeholder="Select Job Sites">
                                    <option value=""></option>
                                    <?php foreach($org_location as $key=>$value){ ?>
                                    <option value="<?php echo $value['id']?>">                  <?php echo $value['location_name'].','.$value['city'].','.$value['state'];?>
                                     </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="parsley-row">
                                <div class="form_assign" style="margin-top:20px">
                                    <label class="fn" style="margin-right:20px;">Assign</label>
                                    <span class="icheck-inline">
                                    <input type="radio" value="user" name="assign[]" class="formAssign" data-md-icheck />
                                    <label for="radio_demo_inline_1" class="inline-label">User</label>
                                </span>
                                <!--data-md-icheck-->
                                <span class="icheck-inline">
                                    <input type="radio" value="dept" name="assign[]" class="formAssign" data-md-icheck />
                                    <label for="radio_demo_inline_2" class="inline-label">Department</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" value="workflow" name="assign[]" class="formAssign" data-md-icheck />
                                    <label for="radio_demo_inline_3" class="inline-label">Workflow</label>
                                </span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="md-card">
                        <div class="md-card-content" style="">
                            <div id="forms" data-form_id ="1" style="width:100%;height:642px;max-height: 642px;overflow:auto">
                                    <ul id="pages" style="">
                                    	<p class="drop_elements">Drop elements here to create the form</p>
                                    </ul>
                            </div>
                            <div class="buildform">
                                 <!--<a class="preview">Preview</a>-->
                                <span class="publish">Save</span>
                                <a class="cancel" href="<?php echo base_url().'form'; ?>">
                                    Cancel
                                </a>
                            </div>
                        </div>
                        
                    </div>                     
                </div>
                
                <div class="uk-width-large-2-10"  id="sidebar" style="float: left; margin-top: -24px; padding-left: 15px;">
                    <div class="md-card dragdrop-panel">
                        <div class="md-card-content">
                           <div class="uk-panel">
                                <div class="heading">Form Elements</div>
                                <div class="uk-accordion" data-uk-accordion>
                                    <h3 class="uk-accordion-title uk-accordion-title-primary">Basic</h3>
                                    <p class="hint-text">Drag and drop for build new form</p>
                                    <div class="uk-accordion-content">
                                        <ul id="basic">
                                            <li><div class="singleline-icon" ></div><span value="heading">Heading</span></li>
                                            <li><div class="singleline-icon" ></div><span value="text">Single Line Text</span></li>
                                            <li><div class="email-icon"></div><span value="email">Email</span></li>
                                            <li><div class="multiline-icon"></div><span value="textarea">Multi Line Text</span></li>
                                            <li><div class="multiline-icon"></div><span value="number">Number</span></li>
                                            <li><div class="radio-icon"></div><span value="radio">Radio</span></li>
                                            <li><div class="select-icon"></div><span value="select">Select</span></li>
                                            <li><div class="checkbox-icon"></div><span value="checkbox">Checkbox</span></li>
                                            <li><div class="date-icon"></div><span value="date">Date</span></li>
                                            <li><div class="time-icon"></div><span value="time">Time</span></li>
                                            <li><div class="file-icon"></div><span value="file">File</span></li>
                                            <!--<li><span value="reset">Reset</span></li>
                                            <li><span value="submit">Submit</span></li>-->
                                        </ul>
                                    </div>
                                    <!--<h3 class="uk-accordion-title uk-accordion-title-primary">Group</h3>
                                    <div class="uk-accordion-content">
                                        <ul id="group">
                                            <li><span value="name">Name</span></li>
                                            <li><span value="address">Address</span></li>
                                        </ul>
                                    </div>-->
                                    <h3 class="uk-accordion-title uk-accordion-title-primary">Advanced</h3>
                                    <div class="uk-accordion-content">
                                        <ul id="advanced">
                                            <li><div class="sign-icon"></div><span value="signature">Signature</span></li>
                                            <!--<li>
                                                <span value="placepicker">Place Picker</span>
                                            </li>-->
                                        </ul>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                <form class="uk-form-stacked" id="wizard_advanced_form" method="post" action ="">
                    <input type="hidden" name="formToken" class="form_token" value ="" />
                    <input type="hidden" name="form_name" class="form_name" value = " "/>
                    <input type="hidden" name="form_desc" class="form_desc" value = " "/>
                    <input type="hidden" name="form_category" class="form_category" />
                    <input type="hidden" name="form_location" class="form_location" />
                    <input type="hidden" name="assign" class="assign" />
                    <input type="hidden" name="assign_users" class="assign_users" />
                    <input type="hidden" name="assign_dept" class="assign_dept" /> 
                    <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
                </form>
            <?php $this->load->view('form/template'); ?>
         <!-- </form> -->
        </div>

</div>
                      