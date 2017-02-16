<div id="templates">
        <!-- Text Box Templates-->
        <div id="config_text" style="display : none">
            <div class="portlet-header" data-type="text" data-fieldid ="1">
                <!--<input type="text" />-->
                <div class="uk-grid">
                    <div class="uk-width-2-10">
                        <label class="title_label">Single Line Text</label>
                        <br/>
                        <input type="text"/>
                    </div>
                    <div class=" uk-width-2-10 action" style="display: none;" id="edits">
                        <div style="float:left">
                         <input  type="checkbox" id="text_check" class="required" data-type="text"/>Required
                        </div>
                        <div class="click-edit-icon" style="float:left" ></div>
                        <div class="uk-icon-remove delete_field" style="float:left"></div>
                        <input type="hidden" class="formfieldid" value="0" />
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Email Controls -->
         <div id="config_email" style="display : none">
            <div class="portlet-header" data-type="email" data-fieldid ="10">
                <div class="uk-grid">
                    <div class="uk-width-2-10">
                         <label class="title_label">Email</label>
                          <br/>
                          <input type="email"/>
                    </div>
                    <div class="uk-width-2-10 action" style="display: none;" id="edits">
                        <div style="float:left">
                        <input  type="checkbox" id="email_check" class="required" data-type="email"/>Required
                        </div>
                        <div class="click-edit-icon" style="float:left" ></div>
                        <div class="uk-icon-remove delete_field" style="float:left"></div>
                        <input type="hidden" class="formfieldid" value="0" />
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Date controls -->
        <div id="config_date" style="display : none">
            <div class="portlet-header" data-type="date" data-fieldid ="4">
                <div class="uk-grid">
                 <div class="uk-width-2-10">
                     <label class="title_label">Date</label>
                     <input type = "hidden" id="date_format"  value ="" />
                     <br/>
                 </div>
                    <div class="uk-width-2-10 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div>
                        <div class="click-edit-icon" ></div><br/>
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="date_check" class="required" data-type="date"/>Required
                         <a href="javascript:void(0)" class="open_options"> options </a>
                    </div>
                    <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                                <select style="padding:4px 6px;"  class="uk-form-select" name="date_format" id="date_formats">
                                        <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                        <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                        <option value="YYYY/MM/DD">YYYY/MM/DD</option>
                                    </select>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Time controls -->
        <div id="config_time" style="display : none">
            <div class="portlet-header" data-type="time" data-fieldid ="5">
                <div class="uk-grid">
                    <div class="uk-width-2-10">
                         <label class="title_label">Time</label><br/>
                         <input type = "hidden" id="time_format"  value ="" />
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div>
                        <div class="click-edit-icon" ></div><br/>
                        <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="time_check" class="required" data-type="time"/>Required
                         <a href="javascript:void(0)" class="open_options"> options </a>
                    </div>
                    <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                                <select style="padding:4px 6px;"  class="uk-form-select" name="time_format" id="time_formats">
                                    <option value="hh:mm:ss">12 Hrs</option>
                                    <option value="HH:mm:ss">24 Hrs</option>
                                </select>
                            </div>
                    </div>
                </div>
            </div>
            <!--<div class="uk-form-row">
                <span class="uk-form-labels"> Time </span>
                <div class="uk-form-controls">
                    
                </div>
            </div>-->
        </div>
        <!-- Signature -->
        <div id="config_signature" style="display : none">
            <div class="portlet-header" data-type="signature" data-fieldid ="16">
                <div class="uk-grid">
                 <div class="uk-width-1-2">
                     <label class="title_label">Signature</label>
                     <br/>
                 </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div>
                        <div class="click-edit-icon" ></div><br/>
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="signature_check" class="required" data-type="signature"/>Required
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Radio Button Templates -->
        <div id="config_radio" style="display : none">
            <div class="portlet-header" data-type="radio" data-fieldid ="2">
                <label class="title_label">Radio</label><br/>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <div class="title_radio select">
                            <input type="radio" /> <span class="title_value" data-optionid="0">Yes</span>
                            <input type="radio" /> <span class="title_value" data-optionid="0">No</span>
                        </div>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div> 
                         <div class="click-edit-icon" ></div><br/>               
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
                                        <input type="text" name="select[]" class="select_label" data-optionid="0" value="Yes" />
                                    </p>
                                    <p>
                                        <input type="text" name="select[]" class="select_label" data-optionid="0" value="No" />
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
                <label class="title_label">Multi choice</label><br/>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <div class="title_checkbox select">
                            <input type="checkbox" /> 
                                <span class="title_value" data-optionid="0">First Option</span>
                        </div>
                        <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                                <a class="add_field_button md-btn md-btn-primary">
                                    Add More
                                </a>
                                <element>
                                    <p>
                                        <input type="text" name="select[]" class="select_label" data-optionid="0" value="First Option" />
                                    </p>
                                </element>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div>   
                         <div class="click-edit-icon" ></div><br/>                  
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="checkbox_check" class="required" data-type="checkbox"/>Required
                        <a href="javascript:void(0)" class="open_options"> options </a>
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
                    <div class="uk-width-1-2" >
                        <div class="uk-icon-remove delete_field"></div>          
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
                <div class="uk-icon-remove delete_field"></div>                     
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
                <label class="title_label">Single Select Label</label><br/>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <div class="select">
                            <select>
                                <option class="title_value" data-optionid="0">
                                    First Option
                                </option>
                                <option class="title_value" data-optionid="0">
                                    Second Option
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
                                    <input type="text" name="select[]" class="select_label" data-optionid="0" value="First Option"/></p>
                                    <p><input type="text" name="select[]" class="select_label" data-optionid="0" value="Second Option"/>
                                    </p>
                                </element>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div>                     
                        <div class="click-edit-icon" ></div><br/>
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input type="checkbox" id="checkbox_check" class="required" data-type="select"/>Required
                        <a href="javascript:void(0)" class="open_options"> options </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- TextArea Templates -->
        <div id="config_textarea" style="display : none">
            <div class="portlet-header" data-type="textarea" data-fieldid ="6">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <label class="title_label">Multi Line Text</label><br/>
                        <textarea></textarea>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div>
                        <div class="click-edit-icon" ></div><br/>       
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="textarea_check" class="required" data-type=/>Required
                    </div>
                </div>
            </div>
        </div>
        <!-- File Select Templates -->
        <div id="config_file" style="display : none">
            <div class="portlet-header" data-type="file" data-fieldid ="11">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <label class="title_label">File Upload</label><br/>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div> 
                        <div class="click-edit-icon" ></div><br/>                           
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="file_check" class="required" data-type=/>Required
                    </div>
                </div>
            </div>
        </div>
        <!-- Place picker -->
        <div id="config_placepicker" style="display : none">
            <div class="portlet-header" data-type="placepicker" data-fieldid ="15">
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <label class="title_label">Place picker</label><br/>
                    </div>
                    <div class="uk-width-1-2 action" style="display: none;" id="edits">
                        <div class="uk-icon-remove delete_field"></div>                     
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="placepicker_check" class="required" data-type= class="required" data-type=/>Required
                    </div>
                </div>
            </div>
        </div>
    </div>