 <style>
        li.rows{
            min-height:80px;
        }
        li.columns{
            float:left;
            list-style: none;
        }
        .dropovers{
            border:1px solid #ccc;
            border-right-color:red;
        }
    </style>
    <div id="page_content">
        <div id="page_content_inner">
            <form class="uk-form-stacked" id="wizard_advanced_form" method="post" action ="">
            <div class="uk-grid" style="display: block;" data-uk-grid-margin data-uk-grid-match id="wizard_form">
                <!--<div id="wizard_advanced">-->
                <h2>Form Creations</h2>
                <section>
                <div class="uk-width-large-2-10" style="position:fixed">
                    <div class="md-card">
                        <div class="md-card-content">
                           <div class="uk-panel">
                                <div class="uk-accordion" data-uk-accordion>
                                    <h3 class="uk-accordion-title uk-accordion-title-primary">Basic</h3>
                                    <div class="uk-accordion-content">
                                        <ul id="basic">
                                            <li><span value="text">Single Line Text</span></li>
                                            <li><span value="email">Email</span></li>
                                            <li>
                                            <span value="textarea">Multi Line Text</span>
                                            </li>
                                            <li><span value="radio">Radio</span></li>
                                            <li><span value="select">Select</span></li>
                                            <li><span value="checkbox">Checkbox</span></li>
                                            <li><span value="date">Date</span></li>
                                            <li><span value="time">Time</span></li>
                                            <li><span value="file">File</span></li>
                                            <!--<li><span value="reset">Reset</span></li>
                                            <li><span value="submit">Submit</span></li>-->
                                        </ul>
                                    </div>
                                    <h3 class="uk-accordion-title uk-accordion-title-primary">Group</h3>
                                    <div class="uk-accordion-content">
                                        <ul id="group">
                                            <li><span value="name">Name</span></li>
                                            <li><span value="address">Address</span></li>
                                        </ul>
                                    </div>
                                    <h3 class="uk-accordion-title uk-accordion-title-primary">Advanced</h3>
                                    <div class="uk-accordion-content">
                                        <ul id="advanced">
                                            <li><span value="signature">Signature</span></li>
                                            <li>
                                                <span value="placepicker">Place Picker</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-8-10" style="float: right;padding-left: 40px;">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div id="forms" data-form_id ="1" style="width:100%;min-height: 1200px;">
                                    <ul id="pages" style="min-height: 100px">
                                       <!--<li class="rows" id="rows_1"></li>-->
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <h2>
                Form Details     
            </h2>
            <section>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid" data-uk-grid-margin>
                    <?php if($org_id == 1){ ?>
                        <div class="uk-width-medium-1-1 uk-container-center">
                            <div class="parsley-row">
                                <select required name="organization" id="form_org">
                                     <option value="">Choose Organization</option>
                                    <?php
                                       // print_r($organizations);    
                                        foreach($organizations as $key=>$value){
                                            if($value['id'] != '1'){
                                        ?>
                                        <option value="<?php echo $value['id'] ?>"
                                        <?php 
                                            if(isset($_POST['organization'])){ 
                                                if($_POST['organization'] === $value['id']){
                                                    echo 'selected';
                                                }
                                            } 
                                        ?> ><?php echo $value['org_name']; ?>
                                        </option>
                                            <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="errors" style="color:red;">*</span>
                            </div>
                        </div>
                    <?php } ?>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <label>Form Name  <span class="errors" style="color:crimson;">*</span></label>
                                    <input type="text" class="md-input" id="form_name" name="form_name" value="<?php echo set_value('form_name'); ?>" data-parsley-trigger="change" required  />
                                     <?php  echo "<div style='color:red'>" . form_error('form_name') . "</div>"; ?>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <label>Form Description </label>
                                    <textarea name="form_desc"  class="md-input"><?php if(ISSET($_POST['form_desc']))
                                                    { echo set_value('form_desc'); }
                                            ?></textarea>
                                        <?php echo "<div style='color:red'>".form_error('form_desc')."</div>"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="formToken" class="form_token" value ="" />
                <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
            </section>
            <h2>
                Samples    
            </h2>
            <section>
                Test2
            </section>
            <?php $this->load->view('form/template'); ?>
         </form>
        </div>
</div>
                      