<div id="templates">
        <!-- Text Box Templates-->
        <div id="config_text" style="display : none">
            <div class="portlet-header">
                
                <!--<input type="text" />-->
                <div class="uk-grid">
                 <div class="uk-width-1-2">
                     <label class="title_label">myfieldlabel</label>
                 </div>
                    <div class="uk-width-1-2">
                        <i class="uk-icon-remove delete_field"></i>
                        <i class="uk-icon-edit edit_field"></i>
                    </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-text" type="text" style="display:none">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="parsely-row uk-form-row">
                                <label for="text_name" class="uk-form-label">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="text_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="text_label" id="text_label" placeholder="myfieldlabel" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-label">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="text_value" />
                                   <input type="hidden" class="text_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked text">
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <!--<input type="radio" id="form-h-r" name="req_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="req_rules" value="0" />
                                    <label for="form-s-r2">No</label>-->
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                        <option value="alpha_num">Alphabets & Numbers</option>
                                        <option value="alpha">Only Alphabets</option>
                                        <option value="num">Only Numbers</option>
                                        <option value="email">Email</option>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="uk-form-row">
                                <span class="uk-form-label"> Alphabets </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="alpha_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="alpha_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Is Natural </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="isna_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="isna_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>
                            <!--<div class="uk-form-row">
                                <span class="uk-form-label"> Is Natural But No zero </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="isnoz_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="isnoz_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Email </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="email_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="email_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Radio Button Templates -->
        <div id="config_radio" style="display : none">
            <div class="portlet-header">
                <label class="title_label">myfieldlabel</label>
                <div class="uk-grid">
                 <div class="uk-width-1-2">
                <div class="title_radio">
                    <input type="radio" /> <span class="title_value">myfirstoption</span>
                    <input type="radio" /> <span class="title_value">mysecondoption</span>
                    <input type="radio" /> <span class="title_value">mythirdoption</span>
                </div>
                 </div>
                 <div class="uk-width-1-2">
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
                 </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-radio" style="display:none" type="radio">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Input radio informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="radio_name" class="uk-form-label">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="radio_name" placeholder="myfieldname" />
                                    <input type="hidden" class="radio_datafieldId" value="0" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="radio_label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                                    
                                    <input type="text" class="radio_label" placeholder="myfieldlabel" />
                                </div>
                            </div>
                            <h3>Radio buttons</h3>
                            <!--<a href="#" class="addOption" compt="1">Add radio</a>-->
                            <div class="uk-form uk-form-option">
                            <span class="addOption addRadio" compt="1">Add radio</span>
                                <div class="uk-grid option">
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_label uk-width-1-1" placeholder="Label" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_value uk-width-1-1" placeholder="Value" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <span class="deleteOption"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid option">
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_label uk-width-1-1" placeholder="Label" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_value uk-width-1-1" placeholder="Value" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                    <div class="uk-form-controls">
                                        <span class="deleteOption"></span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                   <!-- <input type="radio" id="form-h-r" name="req_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="req_rules" value="0" />
                                    <label for="form-s-r2">No</label>-->
                                    <select class="uk-form-select" style="padding:4px 6px;" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Check Box Templates -->
        <div id="config_checkbox" style="display : none">
            <div class="portlet-header">
                
                <label class="title_label">myfieldlabel</label>
               <div class="uk-grid">
                 <div class="uk-width-1-2">
                    <div class="title_checkbox">
                        <input type="checkbox" /> <span class="title_value">myfirstoption</span>
                        <input type="checkbox" /> <span class="title_value">mysecondoption</span>
                        <input type="checkbox" /> <span class="title_value">mythirdoption</span>
                    </div>
                </div>
                <div class="uk-width-1-2">
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
                </div>
            </div>
            <div class="portlet-content portlet-content-checkbox" style="display:none" type="checkbox">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Input checkbox informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="checkbox_name">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="checkbox_name" placeholder="myfieldname" />
                                    <input type="hidden" class="checkbox_datafieldId" value="0" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="checkbox_label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                                    
                                    <input type="text" class="checkbox_label" placeholder="myfieldlabel" />
                                </div>
                            </div>
                            <h3>Check Box options</h3>
                            <div class="uk-form uk-form-option">
                            <span class="addOption addCheck" compt="1">Add Options</span>
                                <div class="uk-grid option">
                                    <div class="uk-width-medium-1-3">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_label uk-width-1-1" placeholder="Label" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_value uk-width-1-1" placeholder="Value" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <div class="uk-form-controls">
                                            <span class="deleteOption"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid option">
                                    <div class="uk-width-medium-1-3">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_label uk-width-1-1" placeholder="Label" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_value uk-width-1-1" placeholder="Value" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                    <div class="uk-form-controls">
                                        <span class="deleteOption"></span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <!--<input type="radio" id="form-h-r" name="req_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="req_rules" value="0" />
                                    <label for="form-s-r2">No</label>-->
                                    <select style="padding:4px 6px;" class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- Password Field Templates -->
        <div id="config_password" style="display : none">
            <div class="portlet-header">
                <div class="uk-grid">
                 <div class="uk-width-1-2">
                <label class="title_label">myfieldlabel</label>
                 </div>
                <div class="uk-width-1-2">    
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
                </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-password" style="display:none" type="password">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_name" class="uk-form-label">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="password_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="password_label" id="text_label" placeholder="myfieldlabel" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-label">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="password_value" />
                                    <input type="hidden" class="password_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                   <!-- <input type="radio" id="form-h-r" name="req_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="req_rules" value="0" />
                                    <label for="form-s-r2">No</label>-->
                                    <select style="padding:4px 6px;" class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                        <option value="alpha_num">Alphabets & Numbers</option>
                                        <option value="alpha">Only Alphabets</option>
                                        <option value="num">Only Numbers</option>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="uk-form-row">
                                <span class="uk-form-label"> Alphabets </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="alpha_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="alpha_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Is Natural </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="isna_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="isna_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>
                            <!--<div class="uk-form-row">
                                <span class="uk-form-label"> Is Natural But No zero </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="isnoz_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="isnoz_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Email </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="radio" id="form-h-r" name="email_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="email_rules" value="0" />
                                    <label for="form-s-r2">No</label>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hidden Field Templates -->
        <div id="config_hidden" style="display : none">
            <div class="portlet-header">
                <label class="title_label">myfieldlabel</label>
                <input type="hidden" /> 
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
            </div>
            <div class="portlet-content portlet-content-hidden" style="display:none" type="hidden">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_name" class="uk-form-label">Name *</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="hidden_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-label">Label </label>
                                <div class="uk-form-controls">
                                    <input type="text" class="hidden_label" id="text_label" placeholder="myfieldlabel" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-label">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="hidden_value" />
                                     <input type="hidden" class="hidden_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Reset Button Templates -->
        <div id="config_reset" style="display : none">
            <div class="portlet-header">
                <label class="title_label">myfieldlabel</label>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input type="reset" class="title_value" value="reset" />
                    </div>
                    <div class="uk-width-1-2">
                        <i class="uk-icon-remove delete_field"></i>                     
                        <i class="uk-icon-edit edit_field"></i>
                    </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-reset" style="display:none" type="reset">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_name" class="uk-form-label">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="reset_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="reset_label" id="text_label" placeholder="myfieldlabel" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-label">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="reset_value" />
                                     <input type="hidden" class="reset_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Submit Button Templates -->
        <div id="config_submit" style="display : none">
            <div class="portlet-header">
                <label class="title_label">myfieldlabel</label>
                 <div class="uk-grid">
                    <div class="uk-width-1-2">
                <input type="submit" class="title_value" value="submit" />
                    </div>
                  <div class="uk-width-1-2">
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
                  </div>
                 </div>
            </div>
            <div class="portlet-content portlet-content-submit" style="display:none" type="submit">
                <div class="tab">
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Submit Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <!--<div class="uk-form-row">
                                <label for="text_name" class="uk-form-label">Name *</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="submit_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>-->
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-label">Label *</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="submit_label" id="text_label" placeholder="myfieldlabel" value="" />
                               <input type="hidden" class="submit_datafieldId" value="0" />
                               </div>
                            </div>
                            <!--<div class="uk-form-row">
                                <label for="text_value" class="uk-form-label">Value *</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="submit_value" />
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Select dropdown Templates -->
        <div id="config_select" style="display : none">
            <div class="portlet-header">
                <label class="title_label">myfieldlabel</label>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                <div class="select">
                    <select>
                        <option>myfirstoption</option>
                        <option>mysecondoption</option>
                        <option>mythirdoption</option>
                    </select>
                </div>
                        </div>
                  <div class="uk-width-1-2">
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
                  </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-select" style="display:none" type="select">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Select informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="radio_name" class="uk-form-label">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="select_name" placeholder="myfieldname" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="radio_label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                                    
                                    <input type="text" class="select_label" placeholder="myfieldlabel" />
                                    <input type="hidden" class="select_datafieldId" value="0" />
                                </div>
                            </div>
                            <h3>Select Options</h3>
                            <div class="uk-form uk-form-option">
                            <span class="addOption addDrop" compt="1" >Add dropdown</span>
                                <div class="uk-grid option">
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_label uk-width-1-1" placeholder="Label" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_value uk-width-1-1" placeholder="Value" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <span class="deleteOption"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid option">
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_label uk-width-1-1" placeholder="Label" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_value uk-width-1-1" placeholder="Value" />
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                    <div class="uk-form-controls">
                                        <span class="deleteOption"></span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <!--<input type="radio" id="form-h-r" name="req_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="req_rules" value="0" />
                                    <label for="form-s-r2">No</label>-->
                                    <select style="padding:4px 6px;" class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TextArea Templates -->
        <div id="config_textarea" style="display : none">
            <div class="portlet-header">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                    <label class="title_label">myfieldlabel</label>
                    </div>
                    <div class="uk-width-1-2">
                    <i class="uk-icon-remove delete_field"></i>
                    <i class="uk-icon-edit edit_field"></i>
                    </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-textarea" style="display:none" type="textarea">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Textarea informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_name" class="uk-form-label">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="textarea_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="textarea_label" id="text_label" placeholder="myfieldlabel" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-label">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="textarea_value" />
                                             <input type="hidden" class="textarea_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <!--<input type="radio" id="form-h-r" name="req_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="req_rules" value="0" />
                                    <label for="form-s-r2">No</label>-->
                                    <select style="padding:4px 6px;" class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
        <!-- File Select Templates -->
        <div id="config_file" style="display : none">
            <div class="portlet-header">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                <label class="title_label">myfieldlabel</label>
                    </div>
                <div class="uk-width-1-2">
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
                </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-file" style="display:none" type="file">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>File informations</h3>
                        <div class="uk-form-row">
                            <label for="file_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="file_name" placeholder="myfieldname" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="file_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="file_label" placeholder="myfieldlabel" />
                                <input type="hidden" class="file_datafieldId" value="0" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="file_label">File formats</label>
                            <div class="uk-form-controls">
                                <select multiple class="file_format" data-placeholder="Select File type...">
                                    <option value="jpg">jpg</option>
                                    <option value="jpeg">jpeg</option>
                                    <option value="gif">gif</option>
                                    <option value="png">png</option>
                                    <option value="bmp">bmp</option>
                                    <option value="pdf">pdf</option>
                                    <option value="doc">doc</option>
                                    <option value="xls">xls</option>
                                </select>
                            </div>
                        </div>
                        <!--<div class="uk-form-row">
                            <label for="maxfilesize">Max file size</label>
                            <div class="uk-form-controls">
                                <select class="maxfilesize" id="maxfilesize">
                                    <option value="1">1 Mb</option>
                                    <option value="2">2 Mb</option>
                                    <option value="3">3 Mb</option>
                                    <option value="4">4 Mb</option>
                                    <option value="6">6 Mb</option>
                                    <option value="8">8 Mb</option>
                                    <option value="10">10 Mb</option>
                                    <option value="20">20 Mb</option>
                                </select>
                            </div>
                        </div>  -->  
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-label"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <!--<input type="radio" id="form-h-r" name="req_rules" value="1" />
                                    <label for="form-s-r1">Yes</label>
                                    <input type="radio" id="form-h-r1" name="req_rules" value="0" />
                                    <label for="form-s-r2">No</label>-->
                                    <select data-md-selectize class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>