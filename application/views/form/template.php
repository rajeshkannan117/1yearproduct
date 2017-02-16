<div id="templates">
        <!-- Text Box Templates-->
        <div id="config_text" style="display : none">
            <div class="portlet-header" data-type="text" data-fieldid ="1">
                <!--<input type="text" />-->
                <div class="uk-grid">
                    <div class="left_setting">                          
                        <label class="title_label" style="width:100%;display:table">Single Line Text</label>
                        <input type="text" readonly style="display:table"/>
                    </div>
                    <div class="action hover-icons right_setting" style="display:none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Heading Templates-->
        <div id="config_heading" style="display : none">
            <div class="portlet-header" data-type="heading" data-fieldid ="17">
                <!--<input type="text" />-->
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label">Heading</label>
                    </div>
                    <div class="action hover-icons right_setting" style="display:none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Email Controls -->
         <div id="config_email" style="display : none">
            <div class="portlet-header" data-type="email" data-fieldid ="10">
                <div class="uk-grid">
                    <div class="left_setting">    
                         <label class="title_label" style="width:100%;display:table">Email</label>
                          <input type="email" readonly style="display:table" />
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Number Controls -->
         <div id="config_number" style="display : none">
            <div class="portlet-header" data-type="number" data-fieldid ="18">
                <div class="uk-grid">
                    <div class="left_setting">    
                         <label class="title_label" style="width:100%;display:table">Number</label>
                          <input type="number" readonly style="display:table" />
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Date controls -->
        <div id="config_date" style="display : none">
            <div class="portlet-header" data-type="date" data-fieldid ="4">
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label" style="width:100%;display:table">Date</label>
                        <input type="text" id="date_value" value="<?php echo date('m-d-Y'); ?>" readonly style="display:table" />
                        <input type = "hidden" id="dates_format" value ="MM/dd/yyyy" />
                        <input type = "hidden" id="sel_date_format" value ="" />
                        <input type = "hidden" id="cur_date"  value ="<?php echo date('m-d-Y'); ?>" />
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="open_options options-icon"></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                    <div class="options" id="choices" style="display:none">
                        <div class="input_fields_wrap">
                            <select style="padding:4px 6px;"  class="uk-form-select" name="date_format" id="date_formats">
                                    <option value="MM/dd/yyyy">MM/DD/YYYY</option>
                                    <option value="dd/MM/yyyy">DD/MM/YYYY</option>
                                    <option value="yyyy/MM/dd">YYYY/MM/DD</option>
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
                    <div class="left_setting">
                        <label class="title_label" style="width:100%;display:table">Time</label>
                           <input type="text" id="time_value" value="<?php echo date('h:i:s A'); ?>" readonly style="display:table" />
                        <input type = "hidden" id="times_format" value ="hh:mm:ss" />
                        <input type = "hidden" id="sel_time_format" value ="" />
                        <input type = "hidden" id="cur_time"  value ="<?php echo date('h:i:s A'); ?>" />
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="open_options options-icon"></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
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
        </div>
        <!-- Signature -->
        <div id="config_signature" style="display : none">
            <div class="portlet-header" data-type="signature" data-fieldid ="16">
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label">Signature</label>
                        <br/>
                        <input type="text" readonly style="display:table">
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Radio Button Templates -->
        <div id="config_radio" style="display : none">
            <div class="portlet-header" data-type="radio" data-fieldid ="2">
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label">Radio</label><br/>
                        <div class="title_radio select">
                            <input type="radio" name="radio" /> <span class="title_value" data-optionid="0">Yes</span>
                            <input type="radio" name="radio" /> <span class="title_value" data-optionid="0">No</span>
                        </div>
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="open_options options-icon"></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                    <div class="options" id="choices" style="display:none">
                        <div class="input_fields_wrap">
                            <!-- <a class="add_field_button md-btn md-btn-primary" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                <img src="/assets/assets/img/add_circle_white_48dp.png" style="width:30px;" class="">
                            </a> -->
                            <element>
                                <p>
                                <input type="text" name="select[]" class="select_label" data-optionid="0" value="Yes" />
                                </p>
                                <p>
                                    <input type="text" name="select[]" class="select_label" data-optionid="0" value="No" /><span class="add-option add_field_button"></span>
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
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label">Multi choice</label><br/>
                        <div class="title_checkbox select">
                            <input type="checkbox" /> 
                                <span class="title_value" data-optionid="0">First Option</span>
                        </div>
                        <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                               <!--  <a class="add_field_button md-btn md-btn-primary" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                <img src="/assets/assets/img/add_circle_white_48dp.png" style="width:30px;" class="">
                                </a> -->
                                <element>
                                    <p>
                                        <input type="text" name="select[]" class="select_label" data-optionid="0" value="First Option" /><span class="add-option add_field_button"></span>
                                    </p>
                                </element>
                            </div>
                        </div>
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="open_options options-icon"></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Select dropdown Templates -->
        <div id="config_select" style="display : none">
            <div class="portlet-header" data-type="select" data-fieldid ="8">
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label">Single Select Label</label><br/>
                        <div class="select">
                            <select>
                                <option>
                                    <span class="title_value" data-optionid="0">
                                    First Option
                                    </span>
                                </option>
                                <option>
                                    <span class="title_value" data-optionid="0">
                                        Second Option
                                    </span>
                                </option>
                            </select>
                        </div>
                        <div class="options" id="choices" style="display:none">
                            <div class="input_fields_wrap">
                                <!-- <a class="add_field_button md-btn md-btn-primary" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                <img src="/assets/assets/img/add_circle_white_48dp.png" style="width:30px;" class="">
                                </a> -->
                                <element>
                                    <p>
                                    <input type="text" name="select[]" class="select_label" data-optionid="0" value="First Option"/></p>
                                    <p>
                                    <input type="text" name="select[]" class="select_label" data-optionid="0" value="Second Option"/>
                                    <span class="add-option add_field_button"></span>
                                    </p>
                                </element>
                            </div>
                        </div>
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <input type="hidden" class="formfieldid" value="0" />
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="open_options options-icon"></span>
                        <span class="uncheck-grey check "></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- TextArea Templates -->
        <div id="config_textarea" style="display : none">
            <div class="portlet-header" data-type="textarea" data-fieldid ="6">
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label">Multi Line Text</label><br/>
                        <textarea style="resize: none;height: 40px; width: 200px;" readonly></textarea>
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
                    </div>
                </div>
            </div>
        </div>
        <!-- File Select Templates -->
        <div id="config_file" style="display : none">
            <div class="portlet-header" data-type="file" data-fieldid ="11">
                <div class="uk-grid">
                    <div class="left_setting">
                        <label class="title_label">File Upload</label><br/>
                        <input type="file" disabled="true" />
                    </div>
                    <div class="hover-icons action right_setting" style="display: none;" id="edits">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="uncheck-grey check "></span>
                        <input type="hidden" class="formfieldid" value="0" />
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
                        <span class="delete_field"></span>                     
                        <!--<i class="uk-icon-edit edit_field"></i>--> <input type="hidden" class="formfieldid" value="0" />
                        <input  type="checkbox" id="placepicker_check" class="required" data-type= class="required" data-type=/>Required
                    </div>
                </div>
            </div>
        </div>
    </div>