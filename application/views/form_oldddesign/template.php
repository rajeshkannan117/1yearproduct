<div id="templates">
        <!-- Text Box Templates-->
        <div id="config_text" style="display : none">
            <div class="portlet-header" data-type="text" data-fieldid ="1">
                <!--<input type="text" />-->
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <label class="title_label">Single Line Text</label>
                        <b class="info">Click text to edit</b><br/>
                        <input type="text" readonly/>
                    </div>
                    <div class=" uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>
                        <!--<i class="uk-icon-edit edit_field"></i>--> 
                        <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="text_check" class="required" data-type="text"/>Required
                    </div>
                </div>
            </div>
        </div>
        <!-- Email Controls -->
         <div id="config_email" style="display : none">
            <div class="portlet-header" data-type="email" data-fieldid ="10">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                         <label class="title_label">Email</label>
                         <b class="info">Click text to edit</b><br/>
                          <input type="email" readonly/>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>
                        <!--<i class="uk-icon-edit edit_field"></i>--> 
                        <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="email_check" class="required" data-type="email"/>Required
                    </div>
                </div>
            </div>
        </div>
        <!-- Date controls -->
        <div id="config_date" style="display : none">
            <div class="portlet-header" data-type="date" data-fieldid ="4">
                <div class="uk-grid">
                 <div class="uk-width-1-2">
                     <label class="title_label">Date</label>
                 </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="date_check" class="required" data-type="date"/>Required
                    </div>
                </div>
            </div>
            <!--<div class="portlet-content portlet-content-date" type="date" style="display:none" data-fieldid ="4">
                <div class="tab">
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <div class="uk-form uk-form-stacked text">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Date Format </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="date_format" id="date_format">
                                         <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                        <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                        <option value="YYYY/MM/DD">YYYY/MM/DD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <!-- Time controls -->
        <div id="config_time" style="display : none">
            <div class="portlet-header" data-type="time" data-fieldid ="5">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                         <label class="title_label">Time</label>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>
                        <!--<i class="uk-icon-edit edit_field"></i>--> 
                        <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="time_check" class="required" data-type="time"/>Required
                    </div>
                </div>
            </div>
            <!--<div class="uk-form-row">
                <span class="uk-form-labels"> Time </span>
                <div class="uk-form-controls">
                    <select style="padding:4px 6px;"  class="uk-form-select" name="time_format" id="time_format">
                        <option value="12">12 Hrs</option>
                        <option value="24">24 Hrs</option>
                    </select>
                </div>
            </div>-->
        </div>
        <!-- Signature -->
        <div id="config_signature" style="display : none">
            <div class="portlet-header" data-type="signature" data-fieldid ="16">
                <div class="uk-grid">
                 <div class="uk-width-1-2">
                     <label class="title_label">Signature</label>
                 </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="signature_check" class="required" data-type="signature"/>Required
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Radio Button Templates -->
        <div id="config_radio" style="display : none">
            <div class="portlet-header" data-type="radio" data-fieldid ="2">
                <label class="title_label">Radio</label>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <div class="title_radio select">
                            <input type="radio" /> <span class="title_value" data-optionid="0">myfirstoption</span>
                            <input type="radio" /> <span class="title_value" data-optionid="0">mysecondoption</span>
                            <input type="radio" /> <span class="title_value" data-optionid="0">mythirdoption</span>
                        </div>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>                     
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="radio_check" class="required" data-type="radio"/>Required
                        <a href="javascript:void(0)" class="open_options"> options </a>
                    </div>
                    <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                                <a class="add_field_button md-btn md-btn-primary">
                                    Add More
                                </a>
                                <element>
                                    <p>
                                        <input type="text" name="select[]" class="select_label" data-optionid="0" />
                                    </p>
                                    <p>
                                        <input type="text" name="select[]" class="select_label" data-optionid="0" />
                                    </p>
                                </element>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!--Check Box Templates -->
        <div id="config_checkbox" style="display : none">
            <div class="portlet-header" data-type="checkbox" data-fieldid ="3">
                <label class="title_label">Multi choice</label>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <div class="title_checkbox select">
                            <input type="checkbox" /> 
                                <span class="title_value" data-optionid="0">myfirstoption</span>
                            <input type="checkbox" /> 
                                <span class="title_value" data-optionid="0">mysecondoption</span>
                            <input type="checkbox" /> 
                                <span class="title_value" data-optionid="0">mythirdoption</span>
                        </div>
                        <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                                <a class="add_field_button md-btn md-btn-primary">
                                    Add More
                                </a>
                                <element>
                                    <p>
                                        <input type="text" name="select[]" class="select_label" data-optionid="0" />
                                    </p>
                                </element>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>                     
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="checkbox_check" class="required" data-type="checkbox"/>Required
                        <a href="javascript:void(0)" class="open_options"> options </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Password Field Templates 
        <div id="config_password" style="display : none">
            <div class="portlet-header">
                <div class="uk-grid">
                 <div class="uk-width-1-2">
                <label class="title_label">myfieldlabel</label>
                 </div>
                <div class="uk-width-1-2">    
                <i class="uk-icon-remove delete_field"></i>                     
                <!--<i class="uk-icon-edit edit_field"></i>
                </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-password" style="display:none" type="password" data-fieldid ="7">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="password_label" id="password_label" placeholder="Enter your password label" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Placeholder <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="placeholder_password_label" id="placeholder_password_label" placeholder="Enter your password text" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Survey name <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="survey_password" id="survey_password" placeholder="Enter your password survey text" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="password_name" placeholder="Enter your password name" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-labels">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="password_value" />
                                    <input type="hidden" class="password_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> General </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;" class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                        <option value="alpha_num">Alphabets & Numbers</option>
                                        <option value="alpha">Only Alphabets</option>
                                        <option value="num">Only Numbers</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- Hidden Field Templates 
        <div id="config_hidden" style="display : none">
            <div class="portlet-header">
                <label class="title_label">myfieldlabel</label>
                <input type="hidden" /> 
                <i class="uk-icon-remove delete_field"></i>                     
                <!--<i class="uk-icon-edit edit_field"></i>
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
                                <label for="text_name" class="uk-form-labels">Name *</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="hidden_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Label </label>
                                <div class="uk-form-controls">
                                    <input type="text" class="hidden_label" id="text_label" placeholder="myfieldlabel" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-labels">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="hidden_value" />
                                     <input type="hidden" class="hidden_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!--Reset Button Templates -->
        <div id="config_reset" style="display : none">
            <div class="portlet-header">
                <label class="title_label">Reset</label>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input type="reset" class="title_value" value="reset" />
                    </div>
                    <div class="uk-width-1-2" >
                        <i class="uk-icon-remove delete_field"></i>          
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        
                    </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-reset" style="display:none" type="reset" data-fieldid ="13">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="reset_label" id="text_label" placeholder="myfieldlabel" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="reset_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-labels">Value</label>
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
                <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                  </div>
                 </div>
            </div>
            <div class="portlet-content portlet-content-submit" style="display:none" type="submit" data-fieldid ="14">
                <div class="tab">
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Submit Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <!--<div class="uk-form-row">
                                <label for="text_name" class="uk-form-labels">Name *</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="submit_name" placeholder="myfieldname" value="" />
                                </div>
                            </div>-->
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Label *</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="submit_label" id="text_label" placeholder="myfieldlabel" value="" />
                               <input type="hidden" class="submit_datafieldId" value="0" />
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Select dropdown Templates -->
        <div id="config_select" style="display : none">
            <div class="portlet-header" data-type="select" data-fieldid ="8">
                <label class="title_label">Single Select Label</label>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <div class="select">
                            <select>
                                <option class="title_value" data-optionid="0">
                                    myfirstoption
                                </option>
                                <option class="title_value" data-optionid="0">
                                    mysecondoption
                                </option>
                                <option class="title_value" data-optionid="0">
                                    mythirdoption
                                </option>
                            </select>
                        </div>
                        <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                                <a class="add_field_button md-btn md-btn-primary">
                                    Add More
                                </a>
                                <element>
                                    <p>
                                    <input type="text" name="select[]" class="select_label" data-optionid="0" />
                                    </p>
                                </element>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>                     
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input type="checkbox" id="checkbox_check" class="required" data-type="select"/>Required
                        <a href="javascript:void(0)" class="open_options"> options </a>
                    </div>
                </div>
            </div>
            <!--<div class="portlet-content portlet-content-select" style="display:none" type="select" data-fieldid ="8">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Select informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="select_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="select_name" placeholder="Enter your select name" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="select_label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                                    
                                    <input type="text" class="select_label" placeholder="Enter your select label" />
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
                        
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> General </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;" class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <!-- TextArea Templates -->
        <div id="config_textarea" style="display : none">
            <div class="portlet-header" data-type="textarea" data-fieldid ="6">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <label class="title_label">Multi Line Text</label>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="textarea_check" class="required" data-type=/>Required
                    </div>
                </div>
            </div>
            <!--<div class="portlet-content portlet-content-textarea" style="display:none" type="textarea" data-fieldid ="6">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Textarea informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="textarea_label" id="text_label" placeholder="Enter your textarea label" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="textarea_label" class="uk-form-labels">Placeholder <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="placeholder_textarea_label" id="textarea_label" placeholder="Enter your textarea placeholder" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="textarea_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="textarea_name" placeholder="Enter your textarea name" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="textarea_value" class="uk-form-labels">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="textarea_value" />
                                             <input type="hidden" class="textarea_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> General </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;" class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Min length </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="number" name="min" id="mintext" value="5" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Max length </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <input type="number" name="max" id="maxtext" value="20" />
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>-->
        </div>
        <!-- File Select Templates -->
        <div id="config_file" style="display : none">
            <div class="portlet-header" data-type="file" data-fieldid ="11">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <label class="title_label">File Upload</label>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>                     
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="file_check" class="required" data-type=/>Required
                    </div>
                </div>
            </div>
            <!--<div class="portlet-content portlet-content-file" style="display:none" type="file" data-fieldid ="11">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>File informations</h3>
                        <div class="uk-form-row">
                            <label for="file_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="file_label" placeholder="Enter your file field label" />
                                <input type="hidden" class="file_datafieldId" value="0" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="file_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="file_name" placeholder="Enter your file fieldname" />
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
                        </div> 
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> General </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> File Select</span>
                                <div class="uk-form-controls uk-form-controls-text">
                                   <input type="radio" name="file_type" id="file_type" value ="single" /> Single
                                   <input type="radio" name="file_type" id="file_type" value ="multi" data-uk-toggle ="{target:'#multi',cls:'uk-'}" /> Multipl
                                </div>
                            </div>
                            <div class="uk-form-row uk-panel-hidden" id="multi">
                                <span class="uk-form-labels">No of files to select</span>
                                <div class="uk-form-controls uk-form-controls-text">
                                   <input type="number" name="multi" id="multi_files" value ="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <!-- Place picker -->
        <div id="config_placepicker" style="display : none">
            <div class="portlet-header" data-type="placepicker" data-fieldid ="15">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <label class="title_label">Place picker</label>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <i class="uk-icon-remove delete_field"></i>                     
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="placepicker_check" class="required" data-type= class="required" data-type=/>Required
                    </div>
                </div>
            </div>
            <!--<div class="portlet-content portlet-content-placepicker" style="display:none" type="placepicker" data-fieldid ="15">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Place Picker Informations</h3>
                        <div class="uk-form-row">
                            <label for="placepicker_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="placepicker_label" placeholder="Enter your Placepicker field label" />
                                <input type="hidden" class="placepicker_datafieldId" value="0" />
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px"> 
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> General </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select class="" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-labels">Radius Limit</span>
                               <div class="uk-form-controls uk-form-controls-text">
                                    <input type="number" name="radius" id="radius" value="300" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>