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

                case 'heading':
                    $res .= $this->input_heading($col);
                    break;
                case 'element-label':
                    $res .= $this->input_heading($col);
                    break;
                case 'text':
                     $res .= $this->input_text($col);
                    break;
                case 'element-single-line-text':
                    $res .= $this->input_text($col);
                    break;
                case 'date':
                    $res .= $this->input_date($col);
                    break;
                case 'element-date':
                    $res .= $this->input_date($col);
                    break;
                case 'time':
                    $res .= $this->input_time($col);
                    break;
                case 'element-time':
                    $res .= $this->input_time($col);
                    break;
                case 'signature':
                    $res .= $this->input_signature($col);
                    break;
                case 'element-signature':
                    $res .= $this->input_signature($col);
                    break;
                case 'email':
                    $res .= $this->input_email($col);
                    break;
                case 'element-email':
                    $res .= $this->input_email($col);
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
    public function templates_header($v){

    }
    public function survey_name($v){

        $survey = '';
        if(isset($v->survey)){
            $survey.='
                <div class="uk-form-row">
                    <label for="text_name">Survey name *</label>
                    <div class="uk-form-controls">
                        <input type="text" class="survey_'.$v->type.'" placeholder="Enter your placeholder '.$v->type.'" value="'.$v->survey.'" />
                    </div>
                </div>';
        }
        return $survey;
    }
    public function placeholder($v){
        $placeholder = '';
        $placeholder.='
            <div class="uk-form-row">
                    <label for="text_name">Placeholder *</label>
                    <div class="uk-form-controls">
                        <input type="text" class="placeholder_'.$v->type.'_label" id="placeholder_'.$v->type.'_label" placeholder="Enter your placeholder '.$v->type.'" value="'.$v->placeholder.'" />
                    </div>
            </div>';
        return $placeholder;
    }
    
    public function label($v){
        $label = '';
        $label .='<div class="uk-form-row">
                            <label for="text_label">Labels *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="'.$v->type.'_label" id="'.$v->type.'_label" placeholder="Enter your '.$v->type.' label" value="'.$v->title.'" />
                                <input type="hidden" class="'.$v->type.'_datafieldId" value="'.$v->datafieldId.'"  />
                            </div>
                        </div>';
        return $label;
    }
    public function name($v){
        $name = '';
        $name .='<div class="uk-form-row">
                            <label for="text_name">Name *</label>
                            <div class="uk-form-controls">
                                <input type="text" class="'.$v->type.'_name" placeholder="Enter your '.$v->type.' name" value="'.$v->name.'" />
                            </div>
                 </div>';
        return $name;
    }
    public function value($v){
        $value = '';
        $value .=  '<div class="uk-form-row">
                            <label for="text_value">Value</label>
                            <div class="uk-form-controls">
                                <input type="text" class="'.$v->type.'_value" value="'.$v->value.'" />
                            </div>
                    </div>';
        return $value;
    }
    public function validation($v){
        $validation = '<div class="uk-form-row">
                            <span class="uk-form-labels">Validation </span><br/>';
        $validation .='<select class="uk-form-select" name="validation_rules" id="validation_rules_'.$v->name.'" style="padding: 4px;">
                            <option value="-1">Optional</option>
                            <option value="req" '.(($v->rules == 1)?" selected":"").'>Required</option>
                       </select>';
        $validation .='</div>';
        return $validation;
    }
    public function radio_option($v){
        $radio = '';
        foreach($v->choices as $key=>$value){
            $radio.='<div class="uk-grid option">
                                <div class="uk-width-medium-1-3">
                                    <div class="uk-form-controls">
                                        <input type="text" value="'.$value->title.'" class="select_option select_option_label uk-width-1-1" placeholder="RadioOption Label" data-optionid="'.$value->id.'" />
                                    </div>
                                </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <input type="text" value="'.$value->value.'" class="select_option select_option_value uk-width-1-1" placeholder="RadioOption Value" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <span class="deleteOption"></span>
                            </div>
                        </div>
                    </div>';
        }
        /*foreach($v->choices as $key=>$value){
                   $radio.=  '<div class="uk-grid option">
                                <div class="uk-width-medium-1-3">
                                    <div class="uk-form-controls">
                                        <input type="text" value="'.$value->value.'" class="select_option select_option_label uk-width-1-1" placeholder="RadioOption Label" data-optionid="'.$value->id.'" />
                                    </div>
                                </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <input type="text" value="'.$value->value[$key].'" class="select_option select_option_value uk-width-1-1" placeholder="RadioOption Value" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <span class="deleteOption"></span>
                            </div>
                        </div>
                    </div>';
                }*/
        return $radio;
    }
    public function checkbox_option($v){
            $checkbox = '';
        foreach($v->choices as $key=>$value){
            $checkbox .='<div class="uk-grid option">
                                <div class="uk-width-medium-1-3">
                                    <div class="uk-form-controls">
                                        <input type="text" value="'.$value->title.'" class="select_option select_option_label uk-width-1-1" placeholder="Check box Label" data-optionid="'.$value->id.'" />
                                    </div>
                                </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <input type="text" value="'.$value->value.'" class="select_option select_option_value uk-width-1-1" placeholder="Check box Value" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <span class="deleteOption"></span>
                            </div>
                        </div>
                    </div>';
        }    
        /*foreach($v->checkbox_label as $key=>$value){
            $checkbox .='<div class="uk-grid option">
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <input type="text" value="'.$value.'" class="select_option select_option_label uk-width-1-1" placeholder="Check Box Label" data-optionid="'.$v->choices[$key]->id.'" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                 <input type="text" value="'.$v->checkbox_value[$key].'" class="select_option select_option_value uk-width-1-1" placeholder="Check Box Value"  />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <span class="deleteOption"></span>
                            </div>
                        </div>
                    </div>';
        }*/
        return $checkbox;
        
    }
    public function select_option($v){
        $select = '';
        foreach($v->choices as $key=>$value){
             $select.='<div class="uk-grid option">
                                <div class="uk-width-medium-1-3">
                                    <div class="uk-form-controls">
                                        <input type="text" value="'.$value->title.'" class="select_option select_option_label uk-width-1-1" placeholder="Select box Label" data-optionid="'.$value->id.'" />
                                    </div>
                                </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <input type="text" value="'.$value->value.'" class="select_option select_option_value uk-width-1-1" placeholder="Select box Value" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <span class="deleteOption"></span>
                            </div>
                        </div>
                    </div>';
         }
       /* foreach($v->options_label as $key=>$value){
            $select.=    '<div class="uk-grid option">
                        <div class="uk-width-medium-1-3">
                            <div class="uk-form-controls">
                                <input type="text" value="'.$value.'" class="select_option select_option_label uk-width-1-1" placeholder="Select Box Label" data-optionid="'.$v->choices[$key]->id.'"/>
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
        }*/
        return $select;
    }
    public function time_option($v){
        
        $validation = '<div class="uk-form-row">
                        <span class="uk-form-labels"> Time Format </span><br/>';
        $validation .='<select class="uk-form-select" name="time_format" id="time_format_'.$v->name.'" style="padding: 4px;">
                            <option value="hh:mm:ss"'.(($v->format == 'hh:mm:ss')?" selected":"").'>12 Hrs</option>
                            <option value="HH:mm:ss" '.(($v->format == 'HH:mm:ss')?" selected":"").'>24 Hrs</option>
                       </select></div></div>';
        return $validation;
    }
    public function date_option($v){
        //print_r($v); exit;
        $date = '<div class="uk-form-row">
                       <span class="uk-form-labels"> Date Format </span><br/>';
        $date .='<select class="uk-form-select" name="date_format" id="date_format_'.$v->name.'" style="padding: 4px;">
                            <option value="MM/dd/yyyy"'.(($v->format == 'MM/dd/yyyy')?" selected":"").'>MM/DD/YYYY</option>
                            <option value="dd/MM/yyyy" '.(($v->format == 'dd/MM/yyyy')?" selected":"").'>DD/MM/YYYY</option>
                            <option value="yyyy/MM/dd" '.(($v->format == 'yyyy/MM/dd')?" selected":"").'>YYYY/MM/DD</option>
                       </select>
                </div>
                </div>';
        return $date;
    }
    public function min_length($v){
        $min = '<div class="uk-form-row">
                    <span class="uk-form-labels"> Min length </span>
                    <div class="uk-form-controls uk-form-controls-text">
                    <input type="number" name="min" id="min_'.$v->name.'" value="'.$v->min.'" />
                    </div>
                </div>';
        return $min;                            
    }
    public function max_length($v){
        $max = '<div class="uk-form-row">
                    <span class="uk-form-labels"> Max length </span>
                    <div class="uk-form-controls uk-form-controls-text">
                    <input type="number" name="max" id="max_'.$v->name.'" value="'.$v->max.'" />
                    </div>
                </div>';
        return $max;
    }

    public function input_heading($v){

            $heading= '<div class="heading cols">';
            $heading.= '<div class="uk-panel config_'.$v->type.' portlet">';
            $heading.=  '<div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <i class="uk-icon-remove delete_fields"></i>
            <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->title.'\'}"></i>
            </div>
            <div class="portlet-content portlet-content-'.$v->title.' uk-hidden" type="heading">
            <div class="tab">
            <ul class="tabs uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->title.'\'}">
                <li><a href="#tabs-1">Informations</a></li>
            </ul>
            <div id="my-id-'.$v->title.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input text informations</h3>
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                    '</div>
            </div>
        </div>
            </div>
            </div>
            </div>
        </div>';

        return $heading;
    }
    public function input_text($v){

            $text= '<div class="text cols">';
            $text.= '<div class="uk-panel config_'.$v->type.' portlet">';
            $text.=  '<div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
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
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render placeholder fields
                        $this->placeholder($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        $this->survey_name($v).  
                        // Render value fields;
                        $this->value($v).
                    '</div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-text">'.
                        $this->validation($v)
                      .'</div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>
            </div>
        </div>';

        return $text;
    }
    
    public function input_date($v){

            $date= '<div class="date cols">';
            $date.= '<div class="uk-panel config_'.$v->type.' portlet">';
            $date.=  '<div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <i class="uk-icon-remove delete_fields"></i>
            <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
            </div>
            <div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="date">
            <div class="tab">
            <ul class="tabs uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
                <li><a href="#tabs-1">Informations</a></li>
                <li><a href="#tabs-3">Validation rules</a></li>
            </ul>
            <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input date informations</h3>
                    <div class="uk-form uk-form-stacked">'.
                         // Render Label Fields
                        $this->label($v).
                        // Render placeholder fields
                        $this->placeholder($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        $this->survey_name($v).  
                        // Render value fields;
                        $this->value($v)
                       .'
                    </div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    '.
                          /* General Validation */
                            $this->validation($v).
                            // Date format 
                            $this->date_option($v)
                        .'
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
        </div>';
        return $date;
    }
    
    public function input_email($v){

            $email= '<div class="email cols">';
            $email.= '<div class="uk-panel config_'.$v->type.' portlet">';
            $email.=  '<div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <!--<input type="email" />-->
            <i class="uk-icon-remove delete_fields"></i>
            <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
            </div>
            <div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="email">
            <div class="tab">
            <ul class="tabs uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
                <li><a href="#tabs-1">Informations</a></li>
                <li><a href="#tabs-3">Validation rules</a></li>
            </ul>
            <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input email informations</h3>
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render placeholder fields
                        $this->placeholder($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        $this->survey_name($v).  
                        // Render value fields;
                        $this->value($v).
                    '</div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-email">'.
                        $this->validation($v)
                      .'</div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>
            </div>
        </div>';

        return $email;
    }
    public function input_time($v){

            $time= '<div class="time cols">';
            $time.= '<div class="uk-panel config_'.$v->type.' portlet">';
            $time.=  '<div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <!--<input type="time" />-->
            <i class="uk-icon-remove delete_fields"></i>
            <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
            </div>
            <div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="time">
            <div class="tab">
            <ul class="tabs uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
                <li><a href="#tabs-1">Informations</a></li>
                <li><a href="#tabs-3">Validation rules</a></li>
            </ul>
            <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input time informations</h3>
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render placeholder fields
                        $this->placeholder($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        $this->survey_name($v).  
                        // Render value fields;
                        $this->value($v).
                    '</div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-time">'.
                            $this->validation($v)
                      .'</div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-time">'.
                                $this->time_option($v)
                        .'</div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>
            </div>
        </div>';

        return $time;
    }
    
     public function input_signature($v){

            $signature= '<div class="signature cols">';
            $signature.= '<div class="uk-panel config_'.$v->type.' portlet">';
            $signature.=  '<div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <!--<input type="signature" />-->
            <i class="uk-icon-remove delete_fields"></i>
            <i class="uk-icon-edit edit_fields" data-uk-toggle="{target:\'.portlet-content-'.$v->name.'\'}"></i>
            </div>
            <div class="portlet-content portlet-content-'.$v->name.' uk-hidden" type="signature">
            <div class="tab">
            <ul class="tabs uk-tab" data-uk-tab ="{connect:\'#my-id-'.$v->name.'\'}">
                <li><a href="#tabs-1">Informations</a></li>
                <li><a href="#tabs-3">Validation rules</a></li>
            </ul>
            <div id="my-id-'.$v->name.'" class="uk-switcher">
            <div id="tabs-1">
                <h3>Input signature informations</h3>
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render placeholder fields
                        $this->placeholder($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        $this->survey_name($v).  
                        // Render value fields;
                        $this->value($v).
                    '</div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-signature">'.
                            $this->validation($v)
                      .'</div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>
            </div>
        </div>';

        return $signature;
    }

    public function input_radio($v){
        $radio = '<div class="'.$v->type.'s cols">';
        $radio .='<div class="uk-panel config_radio portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
        <div class="title_radio">';
            foreach($v->choices as $key=>$value){
                $radio.='<input type="radio" name="'.$v->name.'" value="'.$value->value.'" />
                            <span class="title_value">'.$value->title.'</span>';
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
            <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        //if(isset($v->survey_name)){
                            $this->survey_name($v)
                        //}
                        // Render value fields;
                        //$this->value($v)
                .'<h3>Radio buttons</h3>
                <div class="uk-form uk-form-option">
                <span class="addOption addRadio" compt="1">Add radio</span>'.
                    //Render radio options
                    $this->radio_option($v)
                 .
                 '</div>
            </div>
        </div>';
      $radio.=  '<div id="tabs-3">
            <h3>Validation</h3>
            <div class="uk-form uk-form-stacked">
                <div class="uk-form-row">
                    <div class="uk-form-controls uk-form-controls-text">'.
                            //Render Validation
                            $this->validation($v)
                    .'</div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>';

return $radio;

}

    public function input_checkbox($v){

        $checkbox = '<div class="'.$v->type.'s cols">
    <div class="uk-panel config_checkbox portlet">
        <div class="portlet-header">
            <label class="title_label">'.$v->title.'</label>
            <div class="title_checkbox">';
                foreach($v->choices as $key=>$value){
$checkbox .=  '<input type="checkbox" name="'.$v->name.'" value="'.$value->value.'"/>
                        <span class="title_value">'.$value->title.'</span>';
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
                    <div class="uk-form uk-form-stacked">'.
                            // Render Label Fields
                            $this->label($v).
                            // Render name Fields
                            $this->name($v).
                            // Render survey Name Fields
                            $this->survey_name($v)
                        .'<h3>Check boxes</h3>
                        <div class="uk-form uk-form-option">
                         <span class="addOption addCheck" compt="1">Add Options</span>'.
                            $this->checkbox_option($v)
                        .'</div>
                    </div>
                </div>';
    $checkbox .= '<div id="tabs-3">
                    <h3>Validation</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <div class="uk-form-controls uk-form-controls-text">'.
                              $this->validation($v)  
                            .'</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
        return $checkbox;
    }

public function input_select($v){

    $select ='  <div class="'.$v->type.' cols">
<div class="uk-panel config_select portlet">
    <div class="portlet-header">
        <label class="title_label">'.$v->title.'</label>
        <div class="select">
        <select name="'.$v->name.'">';
            foreach($v->choices as $key=>$value){
$select .= ' <option value="'.$value->value.'" >'.$value->title.'</option>';
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
                    <div class="uk-form uk-form-stacked">'.
                            // Render Label Fields
                            $this->label($v).
                            // Render name Fields
                            $this->name($v)
                            // Render survey Name Fields
                            //$this->survey_name($v)
                        .'<h3>Select Options</h3>
                        <div class="uk-form uk-form-option">
                        <span class="addOption addDrop" compt="1">Add Option</span>'.
                            $this->select_option($v)
                        .'</div>
                    </div>
                </div>
                <div id="tabs-3">
                    <h3>Validation</h3>
                    <div class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <div class="uk-form-controls uk-form-controls-text">'.
                              $this->validation($v)   
                            .'</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>';

return $select;

}

public function input_textarea($v){

    $textarea = '<div class="'.$v->type.' cols">
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
                <h3>Textarea informations</h3>
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render placeholder fields
                        $this->placeholder($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        //$this->survey_name($v).  
                        // Render value fields;
                        $this->value($v)
                    .'</div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-text">'.
                          $this->validation($v).
                          $this->min_length($v).
                          $this->max_length($v)
                        .'</div>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </div>
</div>
</div>';

return $textarea;

}
public function input_password($v){
  $password ='<div class="'.$v->type.' cols">
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
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render placeholder fields
                        $this->placeholder($v).
                        // Render name Fields
                        $this->name($v).
                        // Render survey Name Fields
                        $this->survey_name($v).  
                        // Render value fields;
                        $this->value($v).
                    '</div>
            </div>
            <div id="tabs-3">
                <h3>Validation</h3>
                <div class="uk-form uk-form-stacked">
                    <div class="uk-form-row">
                        <div class="uk-form-controls uk-form-controls-text">'.
                          $this->validation($v) 
                        .'</div>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </div>
</div>
</div>';

  return $password;
}
public function input_hidden($v){
    $hidden = '<div class="'.$v->type.'s cols">
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
</div>';
return $hidden;
}
public function input_file($v){

    $file = '<div class="'.$v->type.' cols">
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
</div>';

  return $file;
}
public function input_submit($v){

    $submit = '<div class="'.$v->type.' cols">
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
                <h3>Submit informations</h3>
                    <div class="uk-form uk-form-stacked">'.
                      $this->label($v)
                    .'</div>
            </div>
        </div>
    </div>
</div>
</div>
</div>';
return $submit;
}
public function input_reset($v){
    $reset = '<div class="'.$v->type.' cols">
<div class="uk-panel config_reset portlet">
<div class="portlet-header">
    <label class="title_label">'.$v->title.'</label>
    <input class="title_value" type="reset" value="'.$v->title.'">
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
                    <div class="uk-form uk-form-stacked">'.
                        // Render Label Fields
                        $this->label($v).
                        // Render name Fields
                        $this->name($v).  
                        // Render value fields;
                        $this->value($v)
                    .'</div>
            </div>
        </div>
    </div>
</div>
</div>
</div>';

return $reset;
}

}
