<?php
/**
 * Format class
 *
 * Helps to genereate form based on its type.
 *
 * @author      RajeshKannan.C
 */
class Template {

    public function generate($col){
        $res = '';
        if(is_object($col)){
            $type =  $col->type;
            switch($type){

                case 'text':
                     $res .= $this->input_text($col);
                    break;
                case 'element-single-line-text':
                    $res .= $this->input_text($col);
                    break;
                case 'radio':
                    $res .= $this->input_radio($col);
                    break;
                case 'element-either-or-choice':
                    $res .= $this->input_radio($col);
                    break;
                case 'checkbox':
                    $res .= $this->input_checkbox($col);
                    break;
                case 'element-multi-choice':
                    $res .= $this->input_checkbox($col);
                    break;
                case 'select':
                    $res .= $this->input_select($col);
                    break;
                case 'element-single-choice':
                    $res .= $this->input_select($col);
                    break;
                case 'textarea':
                    $res .= $this->input_textarea($col);
                    break;
                case 'element-multi-line-text':
                    $res .= $this->input_textarea($col);
                    break;
                case 'password':
                    $res .= $this->input_password($col);
                    break;
                case 'element-password':
                    $res .= $this->input_password($col);
                    break;
                case 'file':
                    $res .= $this->input_file($col);
                    break;
                case 'element-single-file':
                    $res .= $this->input_file($col);
                    break;
                case 'hidden':
                    $res .= $this->input_hidden($col);
                    break;
                case 'reset':
                    $res .= $this->input_reset($col);
                    break;
                case 'submit':
                    $res .= $this->input_submit($col);
                    break;
                case 'element-button-submit':
                    $res .= $this->input_submit($col);
                    break;

            }
        }
        return $res;
    }

    public function input_text($v){

            $text= '<li class="text cols">';
            $text.= '<div class="uk-panel config_'.$v->type.' portlet">';
            $text.=  '<div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <!--<input type="text" />-->
            <i class="uk-icon-remove delete_fields"></i>
            <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
            </div>
            <div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="text">
            <div class="tab">
            <ul class="tabs uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
                <li><a href="#tabs-1">Informations</a></li>
                <li><a href="#tabs-3">Validation rules</a></li>
            </ul>
            <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="text_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="text_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="text_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="text_label" id="text_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="text_value">Value</label>
                            <div class="uk-form-controls">
                                <input type="text" class="text_value" value="'.$v->value.'" />
                                <input type="hidden" class="text_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                    </div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-text">';
                       $text.='<select  class="uk-form-select" name="validation_rules_'.$v->name.'" id="validation_rules_'.$v->name.'">
                                <option value="-1">Optional</option>
                                <option value="req" '.(($v->rules == 'req')?" selected":"").'>Required</option>
                                <option value="alpha_num"'.(($v->rules == 'alpha_num')?" selected":"").'>Alphabets & Numbers</option>
                                <option value="alpha"'.(($v->rules == 'alpha')?" selected":"").'>Alphabets</option>
                                <option value="num"'.(($v->rules == 'num')?" selected":"").'>Only Numbers</option>
                                <option value="email"'.(($v->rules == 'email')?" selected":"").' >Email</option>
                                </select>';
                        $text.='
                            <!--<input type="radio" id="form-h-r" name="req_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[0]))? "checked = true " : '').'/>
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="req_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>-->
                        </div>
                    </div>
                    <!--<div class="uk-form-row">
                        <span class="uk-form-label"> Alphabets </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="alpha_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[1]))? "checked = true" : " ").'/>
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="alpha_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <span class="uk-form-label"> Is Natural </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="isna_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[2]))? "checked = true" : " " ).'/>
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="isna_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>-->
                    <!--<div class="uk-form-row">
                        <span class="uk-form-label"> Is Natural But no Zero </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="isnoz_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[3]))? "checked = true" : " " ).'/>
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="isnoz_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <span class="uk-form-label"> Email </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="email_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[4]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="email_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>-->
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </li>';

        return $text;
    }

    public function input_radio($v){
        $radio = '<li class="'.$v->type.'s cols">';
$radio .='<div class="uk-panel config_radio portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
        <div class="title_radio">';
        foreach($v->radio_label as $key=>$value){
$radio.=                    '<input type="radio" name="'.$v->name.'" value="'.$v->radio_value[$key].'" />
                <span class="title_value">'.$value.'</span>';

        }
$radio.= '                       
        </div>
        <i class="uk-icon-remove delete_fields"></i>
        <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
</div>
<div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="radio">
    <div class="tab">
        <ul class="uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
            <li><a href="#tabs-1">Informations</a></li>
            <li><a href="#tabs-3">Validation rules</a></li>
        </ul>
        <div id="my-id-'.$v->name.'" class="uk-switcher">
        <div id="tabs-1">
            <h3>Input radio informations</h3>
            <div class="uk-form uk-form-stacked">
                <div class="uk-form-row">
                    <label for="radio_name" class="uk-form-label">Name *</label>
                    <div class="uk-form-controls">
                        <input type="text" class="radio_name" placeholder="myfieldname" value="'.$v->name.'" />
                    </div>
                </div>
                <div class="uk-form-row">
                    <label for="radio_label">Label *</label>
                    <div class="uk-form-controls">                                    
                        <input type="text" class="radio_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                        <input type="hidden" class="radio_datafieldId" value="'.$v->datafieldId.'"  />
                    </div>
                </div>
                <h3>Radio buttons</h3>
                <div class="uk-form uk-form-option">
                <span class="addOption addRadio" compt="1">Add radio</span>';
                 foreach($v->radio_label as $key=>$value){
                   $radio.=  '<div class="uk-grid option">
                                <div class="uk-width-medium-1-3">
                                    <div class="uk-form-controls">
                                        <input type="text" value="'.$value.'" class="select_option select_option_label uk-width-1-1" placeholder="RadioOption Label" />
                                    </div>
                                </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <input type="text" value="'.$v->radio_value[$key].'" class="select_option select_option_value uk-width-1-1" placeholder="RadioOption Value" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <span class="deleteOption"></span>
                            </div>
                        </div>
                    </div>';
                }
        $radio.=  '</div>
            </div>
        </div>';
      $radio.=  '<div id="tabs-3">
            <h3>Validation</h3>
            <div class="uk-form uk-form-stacked">
                <div class="uk-form-row">
                    <div class="uk-form-controls uk-form-controls-text">
                        <!--<input type="radio" id="form-h-r" name="req_rules'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[0]))? "checked = true" : " " ).'/>
                        <label for="form-s-r1">Yes</label>
                        <input type="radio" id="form-h-r1" name="req_rules'.$v->name.'" value="0" />
                        <label for="form-s-r2">No</label>-->
                        <select  class="uk-form-select" name="validation_rules_'.$v->name.'" id="validation_rules_'.$v->name.'">
                                <option value="-1">Optional</option>
                                <option value="req"'.(($v->rules == 'req')?" selected":"").' >Required</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</li>';

return $radio;

    }

    public function input_checkbox($v){

        $checkbox = '<li class="'.$v->type.'s cols">
    <div class="uk-panel config_checkbox portlet">
        <div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <div class="title_checkbox">';
                foreach($v->checkbox_label as $key=>$value){
$checkbox .=  '<input type="checkbox" name="'.$v->name.'" value="'.$v->checkbox_value[$key].'"/>
                        <span class="title_value">'.$value.'</span>';
                }
$checkbox .=     '</div>
            <i class="uk-icon-remove delete_fields"></i>
            <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
        </div>
        <div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="checkbox">
            <div class="tab">
                <ul class="uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
                    <li><a href="#tabs-1">Informations</a></li>
                    <li><a href="#tabs-3">Validation rules</a></li>
                </ul>
            <div id="my-id-'.$v->name.'" class="uk-switcher">
                <div id="tabs-1">
                    <h3>Input CheckBox informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="checkbox_name" class="uk-form-label">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="checkbox_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="radio_label">Label *</label>
                            <div class="uk-form-controls">                                    
                                <input type="text" class="checkbox_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                           <input type="hidden" class="checkbox_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                        <h3>Check boxes</h3>
                        <div class="uk-form uk-form-option">
                         <span class="addOption addCheck" compt="1">Add Options</span>';
                        foreach($v->checkbox_label as $key=>$value){
                            $checkbox .='<div class="uk-grid option">
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-controls">
                                                <input type="text" value="'.$value.'" class="select_option select_option_label uk-width-1-1" placeholder="Check Box Label" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-controls">
                                                 <input type="text" value="'.$v->checkbox_value[$key].'" class="select_option select_option_value uk-width-1-1" placeholder="Check Box Value" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-controls">
                                                <span class="deleteOption"></span>
                                            </div>
                                        </div>
                                    </div>';
                        }
     $checkbox .=       '</div>
                    </div>
                </div>';
    $checkbox .= '<div id="tabs-3">
                    <h3>Validation</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <div class="uk-form-controls uk-form-controls-text">
                                <!--<input type="radio" id="form-h-r" name="req_rules'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 || isset($v->rules))? "checked = true" : " " ).' />
                                <label for="form-s-r1">Yes</label>
                                <input type="radio" id="form-h-r1" name="req_rules'.$v->name.'" value="0" />
                                <label for="form-s-r2">No</label>-->
                                 <select  class="uk-form-select" name="validation_rules_'.$v->name.'" id="validation_rules_'.$v->name.'">
                                <option value="-1">Optional</option>
                                <option value="req"'.(($v->rules == 'req')?" selected":"").' >Required</option>
                        </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>';
        return $checkbox;
    }

public function input_select($v){

    $select ='  <li class="'.$v->type.' cols">
<div class="uk-panel config_select portlet">
    <div class="portlet-header">
        <label class="title_label">'.$v->title.'</label>
        <div class="select">
        <select name="'.$v->name.'">';
            foreach($v->options_label as $key=>$value){
$select .= ' <option value="'.$v->options_value[$key].'" >'.$value.'</option>';
            }
$select .= '               </select>
        </div>
        <i class="uk-icon-remove delete_fields"></i>
        <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
    </div>  
    <div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="select">
        <div class="tab">
            <ul class="uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
                <li><a href="#tabs-1">Informations</a></li>
                <li><a href="#tabs-3">Validation rules</a></li>
            </ul>
            <div id="my-id-'.$v->name.'" class="uk-switcher">
                <div id="tabs-1">
                    <h3>Select Informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="select_name" class="uk-form-label">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="select_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="select_label">Label *</label>
                            <div class="uk-form-controls">                                    
                                <input type="text" class="select_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            <input type="hidden" class="select_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                        <h3>Check boxes</h3>
                        <div class="uk-form uk-form-option">
                        <span class="addOption addDrop" compt="1">Add Option</span>';
                        foreach($v->options_label as $key=>$value){
                            $select.=    '<div class="uk-grid option">
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-controls">
                                                <input type="text" value="'.$value.'" class="select_option select_option_label uk-width-1-1" placeholder="Select Box Label" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-controls">
                                                 <input type="text" value="'.$v->options_value[$key].'" class="select_option select_option_value uk-width-1-1" placeholder="Select Box Value" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-controls">
                                                <span class="deleteOption"></span>
                                            </div>
                                        </div>
                                    </div>';
                        }
     $select.=               '</div>
                    </div>
                </div>
                <div id="tabs-3">
                    <h3>Validation</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <div class="uk-form-controls uk-form-controls-text">
                                <!--<input type="radio" id="form-h-r" name="req_rules'.$v->name.'" value="1" '.((is_array($v->rules) && count($v->rules) > 0 || isset($v->rules))? "checked = true" : " " ).'/>
                                <label for="form-s-r1">Yes</label>
                                <input type="radio" id="form-h-r1" name="req_rules'.$v->name.'" value="0" />
                                <label for="form-s-r2">No</label>-->
                                 <select  class="uk-form-select" name="validation_rules_'.$v->name.'" id="validation_rules_'.$v->name.'">
                                <option value="-1">Optional</option>
                                <option value="req"'.(($v->rules == 'req')?" selected":"").' >Required</option>
                        </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</li>';

return $select;

}

public function input_textarea($v){

    $textarea = '<li class="'.$v->type.' cols">
<div class="uk-panel config_textarea portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
    <i class="uk-icon-remove delete_fields"></i>
    <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
</div>';
$textarea .= '<div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="textarea">
    <div class="tab">
        <ul class="tabs uk-tab" data-uk-tab="{connect:\'#my-id-'.$v->name.'\'}">
            <li><a href="#tabs-1">Informations</a></li>
            <li><a href="#tabs-3">Validation rules</a></li>
        </ul>
        <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="text_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="textarea_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="text_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="textarea_label" id="textarea_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="text_value">Value</label>
                            <div class="uk-form-controls">
                                <input type="text" class="textarea_value" value="'.$v->value.'" />
                            <input type="hidden" class="textarea_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                    </div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-text">
                            <select  class="uk-form-select" name="validation_rules_'.$v->name.'" id="validation_rules_'.$v->name.'">
                                <option value="-1">Optional</option>
                                <option value="req"'.(($v->rules == 'req')?" selected":"").' >Required</option>
                            </select>
                           <!-- <input type="radio" id="form-h-r" name="req_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[0]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="req_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>-->
                        </div>
                    </div>
                    <!--<div class="uk-form-row">
                        <span class="uk-form-label"> Alphabets </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="alpha_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 || isset($v->rules[1]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="alpha_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <span class="uk-form-label"> Is Natural </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="isna_rules_'.$v->name.'" value="1" '.((is_array($v->rules) && count($v->rules) > 0 || isset($v->rules[2]))? "checked = true" : " " ).'/>
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="isna_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <span class="uk-form-label"> Is Natural But no Zero </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="isnoz_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 || isset($v->rules[3]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="isnoz_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <span class="uk-form-label"> Email </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="email_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 || isset($v->rules[4]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="email_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
     </div>
 </div>
</div>
</li>';

return $textarea;

}
public function input_password($v){
  $password ='<li class="'.$v->type.' cols">
<div class="uk-panel config_password portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
    <i class="uk-icon-remove delete_fields"></i>
    <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
</div>
<div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="password">
    <div class="tab">
        <ul class="tabs uk-tab" data-uk-tab="{connect:\'#my-id-'.$v->name.'\'}">
            <li><a href="#tabs-1">Informations</a></li>
            <li><a href="#tabs-3">Validation rules</a></li>
        </ul>
        <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="password_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="password_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="password_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="password_label" id="password_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="password_value">Value</label>
                            <div class="uk-form-controls">
                                <input type="text" class="password_value" value="'.$v->value.'" />
                                <input type="hidden" class="password_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                    </div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-text">
                            <!--<input type="radio" id="form-h-r" name="req_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[0]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="req_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>-->
                            <select  class="uk-form-select" name="validation_rules_'.$v->name.'" id="validation_rules_'.$v->name.'">
                                <option value="-1">Optional</option>
                                <option value="req"'.(($v->rules == 'req')?" selected":"").' >Required</option>
                                <option value="alpha_num" '.(($v->rules == 'alpha_num')?" selected":"").' >Alphabets & Numbers</option>
                                <option value="num" '.(($v->rules == 'num')?" selected":"").' >Only Numbers</option>
                                <option value="email" '.(($v->rules == 'email')?" selected":"").' >Email</option>
                            </select>
                        </div>
                    </div>
                    <!--<div class="uk-form-row">
                        <span class="uk-form-label"> Alphabets </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="alpha_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[1]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="alpha_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <span class="uk-form-label"> Is Natural </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="isna_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[2]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="isna_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>-->
                    <!--<div class="uk-form-row">
                        <span class="uk-form-label"> Is Natural But no Zero </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="isnoz_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[3]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="isnoz_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <span class="uk-form-label"> Email </span>
                        <div class="uk-form-controls uk-form-controls-text">
                            <input type="radio" id="form-h-r" name="email_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules[4]))? "checked = true" : " " ).' />
                            <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="email_rules_'.$v->name.'" value="0" />
                            <label for="form-s-r2">No</label>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
     </div>
 </div>
</div>
</li>';

  return $password;
}
public function input_hidden($v){
    $hidden = '<li class="'.$v->type.'s cols">
<div class="uk-panel config_hidden portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
    <input type="hidden" name="'.$v->name.'" value="'.$v->value.'">
    <i class="uk-icon-remove delete_fields"></i>
    <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
</div>
<div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="hidden">
    <div class="tab">
        <ul class="tabs uk-tab" data-uk-tab="{connect:\'#my-id-'.$v->name.'\'}">
            <li><a href="#tabs-1">Informations</a></li>
        </ul>
        <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="password_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="hidden_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="password_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="hidden_label" id="hidden_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="password_value">Value</label>
                            <div class="uk-form-controls">
                                <input type="text" class="hidden_value" value="'.$v->value.'" />

                                <input type="hidden" class="hidden_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
</li>';
return $hidden;
}
public function input_file($v){

    $file = '<li class="'.$v->type.' cols">
<div class="uk-panel config_file portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
    <i class="uk-icon-remove delete_fields"></i>
    <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
</div>
<div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="file">
    <div class="tab">
        <ul class="tabs uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
            <li><a href="#tabs-1">Informations</a></li>
            <li><a href="#tabs-3">Validation rules</a></li>
        </ul>
        <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="file_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="file_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="file_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="file_label" id="file_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            <input type="hidden" class="file_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                    </div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-text">
                            <!--<input type="radio" id="form-h-r" name="req_rules_'.$v->name.'" value="1"'.((is_array($v->rules) && count($v->rules) > 0 && isset($v->rules))? "checked = true" : " " ).' />
                                <label for="form-s-r1">Yes</label>
                            <input type="radio" id="form-h-r1" name="req_rules_'.$v->name.'" value="0" />
                                <label for="form-s-r2">No</label>-->
                            <select  class="uk-form-select" name="validation_rules_'.$v->name.'" id="validation_rules_'.$v->name.'">
                                <option value="-1">Optional</option>
                                <option value="req"'.(($v->rules == 'req')?" selected":"").' >Required</option>
                                <!--<option value="alpha_num" '.($v->rules == 'alpha_num')?" selected":"".' >Alphabets & Numbers</option>
                                <option value="num" '.($v->rules == 'num')?" selected":"".' >Only Numbers</option>
                                <option value="email" '.($v->rules == 'email')?" selected":"".' >Email</option>-->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</li>';

  return $file;
}
public function input_submit($v){

    $submit = '<li class="'.$v->type.' cols">
<div class="uk-panel config_submit portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
    <input class="title_value" type="submit" value="submit">
    <i class="uk-icon-remove delete_fields"></i>
    <i class="uk-icon-edit edit_field" data-toggle="portlet-content-'.$v->type.'"></i>
</div>
<div class="portlet-content portlet-content-'.$v->type.'" type="submit" style="display:none">
    <div class="tab" style="height:100px">
        <div id="my-id-'.$v->title.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="submit_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="hidden" class="submit_datafieldId" value="'.$v->datafieldId.'"  />
                                <input type="text" class="submit_label" id="submit_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
</li>';
return $submit;
}
public function input_reset($v){
    $reset = '<li class="'.$v->type.' cols">
<div class="uk-panel config_reset portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
    <input class="title_value" type="reset" value="'.$v->value.'">
    <i class="uk-icon-remove delete_fields"></i>
    <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
</div>
<div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="reset">
    <div class="tab">
        <ul class="tabs uk-tab" data-uk-tab="{connect:\'#my-id-'.$v->name.'\'}">
            <li><a href="#tabs-1">Informations</a></li>
        </ul>
        <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label for="reset_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="reset_name" placeholder="myfieldname" value="'.$v->name.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="reset_label">Label *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="reset_label" id="reset_label" placeholder="myfieldlabel" value="'.$v->title.'" />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label for="reset_value">Value</label>
                            <div class="uk-form-controls">
                                <input type="text" class="reset_value" value="'.$v->value.'" />
                                 <input type="hidden" class="reset_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
</li>';

return $reset;
}

}
