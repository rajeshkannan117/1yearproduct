<?php 
class Templates {
 	public function generate($col,$c){
    $res = '';
    if(is_object($col)){
        $type =  $col->type;
        switch($type){     
            case 'heading':
                $res .= $this->input_heading($col,$c);
                break;
            case 'text':
                 $res .= $this->input_text($col,$c);
                break;
            case 'date':
                $res .= $this->input_date($col,$c);
                break;
            case 'time':
                $res .= $this->input_time($col,$c);
                break;
            case 'number':
                $res .= $this->input_number($col,$c);
                break;
            case 'signature':
                $res .= $this->input_signature($col,$c);
                break;
            case 'email':
                $res .= $this->input_email($col,$c);
                break;
            case 'radio':
                $res .= $this->input_radio($col,$c);
                break;
            case 'checkbox':
                $res .= $this->input_checkbox($col,$c);
                break;
            case 'select':
                $res .= $this->input_select($col,$c);
                break;
            case 'textarea':
                $res .= $this->input_textarea($col,$c);
                break;
            case 'file':
                $res .= $this->input_file($col,$c);
                break;
            case 'placepicker':
                $res .= $this->input_placepicker($col,$c);
                break;
        }
    }
    	return $res;
    }
    public function input_heading($column,$c){
        $heading = '';
        $heading.='
        <div class="uk-panel config_heading portlet">
            <div class="portlet-header" data-type="heading" data-fieldid ="17">
                <div class="uk-grid">
                    <div class="titl-field'.$c.' left_setting">
                        <label class="title_label">'.$column->title.'</label>
                    </div>
                    <div class="action hover-icons hover-icons'.$c.'  right_setting" style="display:none;" id="edits_'.$column->formfieldid.'">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
                    </div>
                </div>
            </div>
        </div>
        ';
        return $heading;
    }
    public function input_text($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
    	$text = '';
    	$text .='
	       	<div class="uk-panel config_text portlet">
	            <div class="portlet-header" data-type="text" data-fieldid ="1">
	                <div class="uk-grid">
	                    <div class="titl-field'.$c.' left_setting">                          
	                        <label class="title_label" style="width:100%;display:table">'.
	                        $column->title.$req.'
	                        </label>
	                        <input type="text" readonly style="display:table"/>
	                    </div>
	                    <div class="action hover-icons hover-icons'.$c.'  right_setting" style="display:none;" id="edits_'.$column->formfieldid.'">
	                        <span class="delete_field"></span>
	                        <span class="click-edit-icon" ></span>
	                        <span class="'.$check.' check "></span>
	                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
	                    </div>
	                </div>
	            </div>
	        </div>';
	     return $text;
    }
    public function input_date($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        switch($column->format){
            case 'MM/dd/yyyy':
                $cur_date = date('m-d-Y');
                break;
            case 'dd/MM/yyyy':
                $cur_date = date('d-m-Y');
                break;
            case 'yyyy/MM/dd':
                $cur_date = date('Y-m-d');
                break;
            default:
                $cur_date = date('m-d-Y');
                break;
        }
    	$date = '
    		<div class="uk-panel config_date portlet">
    			<div class="portlet-header" data-type="date" data-fieldid ="4">
	                <div class="uk-grid">
	                    <div class="titl-field'.$c.' left_setting">
	                        <label class="title_label" style="width:100%;display:table">'.$column->title.$req.'</label>
	                        <input type="text" id="value_'.$column->formfieldid.'"  readonly style="display:table" value="'.$cur_date.'" />
	                        <input type = "hidden" class="date_format" id="date_format_'.$column->formfieldid.'"  value ="'.$column->format.'" />
                             <input type = "hidden" id="cur_date_'.$column->formfieldid.'"  value ="'.$cur_date.'" />
	                    </div>
	                    <div class="hover-icons hover-icons'.$c.' action right_setting" style="display: none;" id="edits">
	                        <span class="delete_field"></span>
	                        <span class="click-edit-icon" ></span>
	                        <span class="open_options_'.$column->formfieldid.' options-icon"></span>
	                        <span class="'.$check.' check "></span>
	                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
	                    </div>
	                    <div class="options" id="choices_'.$column->formfieldid.'" style="display:none">
	                        <div class="input_fields_wrap">
	                            <select style="padding:4px 6px;"  class="uk-form-select" name="date_format" id="date_formats_'.$column->formfieldid.'">
	                                    <option value="MM/dd/yyyy"'.(($column->format === "MM/dd/yyyy")?"selected":" ").'>MM/DD/YYYY</option>
	                                    <option value="dd/MM/yyyy"'.(($column->format === "dd/MM/yyyy")?"selected":" ").'>DD/MM/YYYY</option>
	                                    <option value="yyyy/MM/dd"'.(($column->format === "yyyy/MM/dd")?"selected":" ").' >YYYY/MM/DD</option>
	                            </select>
	                        </div>
	                    </div>
	                </div>
            	</div>
    		</div>
    		';
    	return $date;
    }
    public function input_time($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        if($column->format != ''){
            if($column->format == 'hh:mm:ss'){
                $cur_time = date('h:i:s A');
            }else if($column->format == 'HH:mm:ss'){
                $cur_time = date('H:i:s');
            }
        }else{
            $cur_time = date('h:i:s A');
        }

        $time ='
        <div class="uk-panel config_time portlet">
                <div class="portlet-header" data-type="time" data-fieldid ="5">
                    <div class="uk-grid">
                        <div class="titl-field'.$c.' left_setting">
                            <label class="title_label" style="width:100%;display:table">'.$column->title.$req.'</label>
                            <input type="text"  readonly style="display:table" id="value_'.$column->formfieldid.'" value="'.$cur_time.'"/>
                            <input type = "hidden" class="time_format" id="time_format_'.$column->formfieldid.'"  value ="'.$column->format.'" />
                        </div>
                        <div class="hover-icons hover-icons'.$c.' action right_setting" style="display: none;" id="edits_'.$column->formfieldid.'">
                            <span class="delete_field"></span>
                            <span class="click-edit-icon" ></span>
                            <span class="open_options_'.$column->formfieldid.' options-icon"></span>
                            <span class="'.$check.' check "></span>
                            <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
                        </div>
                        <div class="options" id="choices_'.$column->formfieldid.'" style="display:none">
                            <div class="input_fields_wrap">
                            <select style="padding:4px 6px;"  class="uk-form-select" name="time_format" id="time_formats_'.$column->formfieldid.'">
                                <option value="hh:mm:ss"'.(($column->format === "hh:mm:ss")?"selected":" ").' >12 Hrs</option>
                                <option value="HH:mm:ss"'.(($column->format === "HH:mm:ss")?"selected":" ").' >24 Hrs</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        return $time;
    }
    public function input_select($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        $select='
        <div class="uk-panel config_select portlet">
            <div class="portlet-header" data-type="select" data-fieldid="8">
                <div class="uk-grid">
                    <div class="titl-field'.$c.' left_setting">
                        <label class="title_label">'.$column->title.$req.'</label>
                        <div class="select">
                            <select id="'.$column->formfieldid.'">';
                        foreach($column->choices as $key=>$value){
                            $select .= '<option>'.$value->title.'</option>';
                        }
                        $select .='</select>';
                        foreach($column->choices as $key=>$value){
                        $select.='<input type="hidden" class="title_value" data-optionid="'.$value->id.'" value="'.$value->title.'">';
                        }
                    $select .='    
                        </div>
                    </div>
                    <div class="hover-icons'.$c.' right_setting hover-icons action" style="display: none;" id="edits_'.$column->formfieldid.'">
                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon"></span>
                        <span class="open_options_'.$column->formfieldid.' options-icon"></span>
                        <span class="'.$check.' check "></span>
                    </div>
                    <div class="options" id="choices_'.$column->formfieldid.'" style="display:none">
                        <div class="input_fields_wrap">
                            <element>';
                            $total = count($column->choices);
                            $i=0;

                            foreach($column->choices as $key=>$value){
                            $i++;    
            $select.='      <p>
                                <input type="text" name="select[]" class="select_label" data-optionid="'.$value->id.'" value="'.$value->title.'" />
                                <span class="delete-option remove_field" id="label_remove'.$value->id.'"></span>
                                ';

                            if($i === $total){
            $select .='       <span class="add-option add_field_button"></span>';
                            }
                            
            $select .=      '</p>';
                        }
             //$select.='     <span class="add-option add_field_button"></span>
                                //';
          $select .=        '</element>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        return $select;
    }
    public function input_radio($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        $radio = '
        <div class="uk-panel config_radio portlet">
            <div class="portlet-header" data-type="radio" data-fieldid="2">
                <div class="uk-grid">
                    <div class="titl-field'.$c.' left_setting">
                        <label class="title_label">'.$column->title.$req.'</label><br>
                        <div class="title_radio select">';
                        foreach($column->choices as $key=>$value){
                    $radio.='<input type="radio" name="choices_'.$column->formfieldid.'"> 
                                <span class="title_value" data-optionid="'.$value->id.'">'.$value->title.'</span>';
                            }

                $radio.='</div>
                    </div>
                    <div class="hover-icons'.$c.' right_setting hover-icons action" style="display: none;" id="edits_'.$column->formfieldid.'">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon"></span>
                        <span class="open_options_'.$column->formfieldid.' options-icon" data-dialog=""></span>
                        <span class="'.$check.' check "></span>
                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
                        <input type="hidden" id="dialog_id_'.$column->formfieldid.'" value="" />
                    </div>
                    <div class="options" id="choices_'.$column->formfieldid.'" style="display:none">
                        <div class="input_fields_wrap">
                            <element>';
                            $i=0;
                            $total = count($column->choices);
                            foreach($column->choices as $key=>$value){
                                $i++;
                                /*<span class="delete-option remove_field" id="label_remove'.$value->id.'"></span>*/
            $radio.='        <p>
                                <input type="text" name="select[]" class="select_label" data-optionid="'.$value->id.'" value="'.$value->title.'" />
                                
                                ';
                            if($i === $total){
            $radio .='          <span class="add-option add_field_button"></span>';
                            } 
            $radio .='
                            </p>';
                        }
            // $radio.='     <span class="add-option add_field_button"></span>
             //                   ';
          $radio .=        '</element>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                ';
        return $radio;
    }
    public function input_checkbox($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        $checkbox= '
        <div class="uk-panel config_checkbox portlet">
            <div class="portlet-header" data-type="checkbox" data-fieldid="3">
                <div class="uk-grid">
                    <div class="titl-field'.$c.' left_setting">
                        <label class="title_label">'.$column->title.$req.'</label><br>
                        <div class="title_checkbox select">';
                        foreach($column->choices as $key=>$value){
        $checkbox.='         <input type="checkbox">
                                <span class="title_value" data-optionid="'.$value->id.'">'.$value->title.'</span>';
                        }
        $checkbox.='   </div>
                    </div>
                    <div class="hover-icons'.$c.' right_setting hover-icons action" style="display: none;" id="edits_'.$column->formfieldid.'">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon"></span>
                        <span class="open_options_'.$column->formfieldid.' options-icon"></span>
                        <span class="'.$check.' check "></span>
                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'">
                    </div>
                    <div class="options" id="choices_'.$column->formfieldid.'" style="display:none">
                        <div class="input_fields_wrap">
                            <element>';
                            foreach($column->choices as $key=>$value){
            $checkbox.='        <p>
                                <input type="text" name="select[]" class="select_label" data-optionid="'.$value->id.'" value="'.$value->title.'" />
                                </p>';
                        }
             $checkbox.='     <span class="add-option add_field_button"></span>
                                ';
          $checkbox .=      '</element>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    	';
        return $checkbox;
    }
    public function input_textarea($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        //print_r($column);
    	$textarea = ' <div class="uk-panel config_textarea portlet">
                        <div class="portlet-header" data-type="textarea" data-fieldid ="6">
                        <div class="uk-grid">
                            <div class="titl-field'.$c.' left_setting">
                                <label class="title_label">'.$column->title.$req.'</label><br/>
                                <textarea style="resize: none;height: 40px; width: 200px;" readonly>'.$column->value.'</textarea>
                            </div>
                            <div class="hover-icons hover-icons'.$c.'  action right_setting" style="display: none;" id="edits_'.$column->formfieldid.'">
                                <span class="delete_field"></span>
                                <span class="click-edit-icon" ></span>
                                <span class="'.$check.' check "></span>
                                <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
                            </div>
                        </div>
                        </div>
                    </div>';
        return $textarea;
    }
    public function input_file($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        $file = '
        <div class="uk-panel config_file portlet">
            <div class="portlet-header" data-type="file" data-fieldid ="11">
                <div class="uk-grid">
                    <div class="titl-field'.$c.' left_setting">
                        <label class="title_label">'.$column->title.$req.'</label><br/>
                        <input type="file" disabled="true" />
                    </div>
                    <div class="hover-icons hover-icons'.$c.'   action right_setting" style="display: none;" id="edits_'.$column->formfieldid.'">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="'.$check.' check "></span>
                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'"/>
                    </div>
                </div>
            </div>
        </div>';
    return $file;
    	
    }
    public function input_email($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
    	$email = '
            <div class="uk-panel config_email portlet">
                <div class="portlet-header" data-type="email" data-fieldid ="10">
                    <div class="uk-grid">
                        <div class="titl-field'.$c.' left_setting">    
                             <label class="title_label" style="width:100%;display:table">'.$column->title.$req.'</label>
                              <input type="email" readonly style="display:table" />
                        </div>
                        <div class="hover-icons hover-icons'.$c.' action right_setting" style="display: none;" id="edits_'.$column->formfieldid.'">
                            <span class="delete_field"></span>
                            <span class="click-edit-icon" ></span>
                            <span class="'.$check.' check "></span>
                            <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
                        </div>
                    </div>
                </div>
            </div>';
        return $email;
    }
    public function input_signature($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
    	$signature ='
        <div class="uk-panel config_signature portlet">
            <div class="portlet-header" data-type="signature" data-fieldid ="16">
                <div class="uk-grid">
                    <div class="titl-field'.$c.' left_setting">
                        <label class="title_label">'.$column->title.$req.'</label>
                        <br/>
                        <input type="text" readonly style="display:table">
                    </div>
                    <div class="hover-icons hover-icons'.$c.' action right_setting" style="display: none;" id="edits_'.$column->formfieldid.'">
                        <span class="delete_field"></span>
                        <span class="click-edit-icon" ></span>
                        <span class="'.$check.' check "></span>
                        <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'"  />
                    </div>
                </div>
            </div>
        </div>';
        return $signature;
    }
    public function input_number($column,$c){
        if($column->required == '1'){
            $req = '<span class="req">*</span>';
            $check="check-red";
        }else{
            $req = '';
            $check="uncheck-grey";
        }
        $number = '<div class="uk-panel config_number portlet">
                    <div class="portlet-header" data-type="number" data-fieldid ="18">
                        <div class="uk-grid">
                            <div class="titl-field'.$c.' left_setting">    
                                 <label class="title_label" style="width:100%;display:table">'.
                                 $column->title.$req.'</label>
                                  <input type="number" readonly style="display:table" />
                            </div>
                            <div class="hover-icons hover-icons'.$c.' action right_setting" style="display: none;" id="edits_'.$column->formfieldid.'">
                                <span class="delete_field"></span>
                                <span class="click-edit-icon" ></span>
                                <span class="'.$check.' check "></span>
                                <input type="hidden" class="formfieldid" value="'.$column->formfieldid.'" />
                            </div>
                        </div>
                    </div>
                </div>';
        return $number;
    }
}
/*

        <!-- Heading Templates-->
        <div id="config_heading" style="display : none">
            <div class="portlet-header" data-type="heading" data-fieldid ="17">
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
                        <input type="text"  readonly style="display:table" />
                        <input type = "hidden" id="date_format"  value ="" />
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
                          <input type="text" readonly style="display:table">
                         <input type = "hidden" id="time_format"  value ="" />
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
    </div>*/
?>