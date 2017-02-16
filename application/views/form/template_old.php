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
            <div class="portlet-content portlet-content-text" type="text" style="display:none" data-fieldid ="1">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3> Text Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="text_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="text_label" id="text_label" placeholder="Enter your text label" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="placeholder_text_label" class="uk-form-labels">Placeholder <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="placeholder_text_label" id="placeholder_text_label" placeholder="Enter your placeholder text" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="text_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="text_name" placeholder="Enter your field name" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="survey_text" class="uk-form-labels">Survey Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="survey_text" placeholder="Enter your survey field name" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="text_value" class="uk-form-labels">Value</label>
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
                                <span class="uk-form-labels"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="validation_rules" id="validation_rules">
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
        <!-- Email Controls -->
         <div id="config_email" style="display : none">
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
            <div class="portlet-content portlet-content-email" type="email" style="display:none" data-fieldid ="10">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Email Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="email_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="email_label" id="email_label" placeholder="Enter your email text label" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="placeholder_email_label" class="uk-form-labels">Placeholder <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="placeholder_email_label" id="placeholder_email_label" placeholder="Enter your placeholder email text" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="email_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="email_name" placeholder="Enter your email field name" value="" />
                                </div>
                            </div>
                             <div class="parsely-row uk-form-row">
                                <label for="survey_email" class="uk-form-labels">Survey Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="survey_email" placeholder="Enter your email survey field name" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="email_value" class="uk-form-labels">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="email_value" />
                                   <input type="hidden" class="email_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked text">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="validation_rules" id="validation_rules">
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
        <!-- Date controls -->
        <div id="config_date" style="display : none">
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
            <div class="portlet-content portlet-content-date" type="date" style="display:none" data-fieldid ="4">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Date Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="date_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="date_label" id="date_label" placeholder="Enter your date text label" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="placeholder_date_label" class="uk-form-labels">Placeholder <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="placeholder_date_label" id="placeholder_date_label" placeholder="Enter your placeholder date text" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="date_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="date_name" placeholder="Enter your date field name" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="survey_date" class="uk-form-labels">Survey name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="survey_date" placeholder="Enter your survey date field name" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="date_value" class="uk-form-labels">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="date_value" />
                                   <input type="hidden" class="date_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked text">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="validation_rules" id="validation_rules">
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
        <!-- Time controls -->
        <div id="config_time" style="display : none">
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
            <div class="portlet-content portlet-content-time" type="time" style="display:none" data-fieldid ="5">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Time Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="time_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="time_label" id="time_label" placeholder="Enter your time text label" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="placeholder_time_label" class="uk-form-labels">Placeholder <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="placeholder_time_label" id="placeholder_time_label" placeholder="Enter your placeholder time text" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="time_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="time_name" placeholder="Enter your time field name" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="survey_time" class="uk-form-labels">Survey name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="survey_time" placeholder="Enter your survey time field name" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="time_value" class="uk-form-labels">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="time_value" />
                                   <input type="hidden" class="time_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked text">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="validation_rules" id="validation_rules">
                                        <option value="-1">Optional</option>
                                        <option value="req">Required</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Time </span>
                                <div class="uk-form-controls">
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="time_format" id="time_format">
                                        <option value="12">12 Hrs</option>
                                        <option value="24">24 Hrs</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Signature -->
        <div id="config_signature" style="display : none">
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
            <div class="portlet-content portlet-content-signature" type="signature" style="display:none" data-fieldid ="16">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Signature Informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="signature_label" class="uk-form-labels">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="signature_label" id="signature_label" placeholder="Enter your signature text label" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="placeholder_signature_label" class="uk-form-labels">Placeholder <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="placeholder_signature_label" id="placeholder_signature_label" placeholder="Enter your placeholder signature text" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="signature_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="signature_name" placeholder="Enter your signature field name" value="" />
                                </div>
                            </div>
                            <div class="parsely-row uk-form-row">
                                <label for="survey_signature" class="uk-form-labels">Survey name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" required class="survey_signature" placeholder="Enter your survey signature field name" value="" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="signature_value" class="uk-form-labels">Value</label>
                                <div class="uk-form-controls">
                                    <input type="text" class="signature_value" />
                                   <input type="hidden" class="signature_datafieldId" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked text">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
                                    <select style="padding:4px 6px;"  class="uk-form-select" name="validation_rules" id="validation_rules">
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
            <div class="portlet-content portlet-content-radio" style="display:none" type="radio" data-fieldid ="2">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Input radio informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="radio_label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                                    
                                    <input type="text" class="radio_label" placeholder="Enter your radio button label" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="radio_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="radio_name" placeholder="Enter your radio button fieldname" />
                                    <input type="hidden" class="radio_datafieldId" value="0" />
                                </div>
                            </div>
                            
                             <div class="uk-form-row">
                                <label for="survey_radio">Survey name <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                                    
                                    <input type="text" class="survey_radio" placeholder="Enter your radio button survey label" />
                                </div>
                            </div>
                            <h3>Radio buttons</h3>
                            <div class="uk-form uk-form-option">
                            <span class="addOption addRadio" compt="1">Add radio</span>
                                <div class="uk-grid option">
                                    <div class="uk-width-medium-1-3">
                                        <div class="uk-form-controls">
                                            <input type="text" class="select_option select_option_label uk-width-1-1" placeholder="Label" data-optionid ="0" />
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
                                <span class="uk-form-labels"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
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
            <div class="portlet-content portlet-content-checkbox" style="display:none" type="checkbox" data-fieldid ="3">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Input checkbox informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="checkbox_label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                                    
                                    <input type="text" class="checkbox_label" placeholder="Enter your checkbox label" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="checkbox_name">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="checkbox_name" placeholder="Enter your checkbox name" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="survey_checkbox">Survey Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="survey_checkbox" placeholder="Enter your checkbox survey name" />
                                    <input type="hidden" class="checkbox_datafieldId" value="0" />
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
                                <span class="uk-form-labels"> Validation </span>
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
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Validation </span>
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
        </div>
        <!--Reset Button Templates -->
        <div id="config_reset" style="display : none">
            <div class="portlet-header">
                <label class="title_label">Reset</label>
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
                <i class="uk-icon-edit edit_field"></i>
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
            <div class="portlet-content portlet-content-select" style="display:none" type="select" data-fieldid ="8">
                <div class="tab">
                    <ul class="uk-tab">
                        <li><a href="#tabs-1">Informations</a></li>
                        <li><a href="#tabs-3">Validation rules</a></li>
                    </ul>
                    <div id="tabs-1" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Select informations</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <label for="select_label">Label <span style="color:red">*</span><span>(Can't be empty .min : 4 char, max 20 chars)</span></label>
                                <div class="uk-form-controls">                             
                                    <input type="text" class="select_label" placeholder="Enter your select label" />
                                    <input type="hidden" class="select_datafieldId" value="0" />
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label for="select_name" class="uk-form-labels">Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="select_name" placeholder="Enter your select name" />
                                </div>
                            </div>
                               <div class="uk-form-row">
                                <label for="survey_select">Survey Name <span style="color:red">*</span><span>(Can't be empty & can't contain spaces or special character)</span></label>
                                <div class="uk-form-controls">
                                    <input type="text" class="survey_select" placeholder="Enter your Select survey name" />
                                </div>
                            </div>
                            <h3>Select Options</h3>
                            <div class="uk-form uk-form-option">
                            <span class="addOption addDrop" compt="1" >Add dropdown</span>
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
                                <span class="uk-form-labels"> Validation </span>
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
            <div class="portlet-content portlet-content-textarea" style="display:none" type="textarea" data-fieldid ="6">
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
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Validation </span>
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
            </div>
        </div>
        <!-- File Select Templates -->
        <div id="config_file" style="display : none">
            <div class="portlet-header">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                <label class="title_label">File Label</label>
                    </div>
                <div class="uk-width-1-2">
                <i class="uk-icon-remove delete_field"></i>                     
                <i class="uk-icon-edit edit_field"></i>
                </div>
                </div>
            </div>
            <div class="portlet-content portlet-content-file" style="display:none" type="file" data-fieldid ="11">
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
                        </div>  -->  
                    </div>
                    <div id="tabs-3" style="margin-left:10px;margin-bottom: 10px">
                        <h3>Validation rules</h3>
                        <div class="uk-form uk-form-stacked">
                            <div class="uk-form-row">
                                <span class="uk-form-labels"> Validation </span>
                                <div class="uk-form-controls uk-form-controls-text">
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