<?php
/**
 * Format class
 *
 * Helps to genereate form based on its type.
 *
 * @author  	RajeshKannan.C
 */
class Fields {

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
				case 'email':
					 $res .= $this->input_email($col);
					break;
				case 'element-email':
					$res .= $this->input_email($col);
					break;
				case 'number':
					 $res .= $this->input_number($col);
					break;
				case 'element-number':
					$res .= $this->input_number($col);
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
                case 'date':
                        $res .= $this->input_date($col);
                        break;
                case 'time':
                        $res .= $this->input_time($col);
                            break;
                case 'signature':
                		$res .= $this->input_signature($col);
                			break;


			}
		}
		return $res;
	}
	public function input_heading($value){
		return '<h3 class="heading_b uk-margin-bottom">'.$value->title.'</h3>';
	}
	public function input_text($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$values = isset($value->value)?$value->value:'';
		if($value->required === '1'){

			return '<label for="'.$value->title.'">'.$value->title.' <span class="req">*</span></label><input class="md-input" type="text" id="'.$name.'" name="'.$name.'" value="'.$values.'"/>';
		}else{
			return '<label for="'.$name.'">'.$value->title.'</label><input class="md-input" type="text" id="'.$name.'" name="'.$name.'" value="'.$values.'"/>';
		}
	 
	}
	public function input_number($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$values = isset($value->value)?$value->value:'';
		if($value->required === '1'){
			return '<label for="'.$value->title.'">'.$value->title.' <span class="req">*</span></label><input class="md-input" type="number" id="'.$name.'" name="'.$name.'" value="'.$values.'"/>';
		}else{
			return '<label for="'.$name.'">'.$value->title.'</label><input class="md-input" type="number" id="'.$name.'" name="'.$name.'" value="'.$values.'"/>';
		}
	 
	}
	public function input_signature($value){
		//print_r($value); exit;
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$values = isset($value->value)?$value->value:'';
		if($values === ''){
        	$content = 'Drop Signature file';
        }else{
        	$content = '<img src = "'.$values.'" alt="'.$values.'" widht ="50" height="50" />';
        }
        if($value->required === '1'){
				$req = '<span class="req">*</span>';
		} 
		if($value->required === '1'){
			$file = '<label for="'.$name.'">'.$value->title.$req.'
					</label><br/>
						'.$content.'';
        }else{
        	$file = '<label for="'.$name.'">'.$value->title.'
        			 </label><br/>'.$content;
        }

        return $file;	 
	}
	public function input_file($value){
		//print_r($value);
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$values = isset($value->value)?$value->value:'';	
		if($value->required === '1'){
				$req = '<span class="req">*</span>';
		}
		if($values === ''){
			$content ='Drop file';
        }else{
        	$content = '<img src = "'.$values.'" alt="'.$values.'" />';
        } 
		if($value->required == 1){
			$file = '<label for="'.$name.'">'.$value->title.$req.'
					</label><br/>'.$content;
        }else{
        	$file = '<label for="'.$name.'">'.$value->title.'
        			 </label><br/>'.$content;
        }
        return $file;	
	}

	public function input_email($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$values = isset($value->value)?$value->value:'';
		if($value->required === '1'){

			return '<label for="'.$name.'">'.$value->title.' <span class="req">*</span></label><input class="md-input" type="email" id="'.$name.'" name="'.$name.'" value="'.$values.'" required="required"/>';
		}else{

			return '<label for="'.$name.'">'.$value->title.'</label><input class="md-input" type="email" id="'.$name.'" name="'.$name.'" value="'.$values.'"/>';
		}
	}
        public function input_time($value){
        	$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
        	$values = isset($value->value)?$value->value:'';
        	if($value->required == 1){

            $label = '<label for="uk_tp_1">'.$value->title.' <span class="req">*</span></label>
                        <input class="md-input" type="text" required="required id="uk_tp_1" data-uk-timepicker name="'.$name.'" value ="'.$values.'">';
            }else{

            $label = '<label for="uk_tp_1">'.$value->title.'</label>
                        <input class="md-input" type="text" id="uk_tp_1" data-uk-timepicker name="'.$name.'" value ="'.$values.'" >';
            }
            return $label;
        }
        
        public function input_date($value){
        	$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
        	$values = isset($value->value)?$value->value:'';
            $format = str_replace('/','.',$value->format);
            if($value->required == 1){
            $date = '<div class="uk-input-group">
                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
            			<label for="uk_dp_1">'.$value->title.' <span class="req">*</span></label>
                    	<input class="md-input" required="required type="text" value="'.$values.'" style="padding:12px 4px;"></div>';
            }else{
            	$date = '<div class="uk-input-group">
                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
            			<label for="uk_dp_1">'.$value->title.'</label>
                    	<input class="md-input" type="text" id="uk_dp_start" data-uk-datepicker="{format:\''.strtoupper($format).'\'}" value="'.$values.'" style="padding:12px 4px;"></div>';
            }
            return $date;
        }
	public function input_radio($value){
			$req = '';
			$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
			if($value->required === '1'){
				$req = '<span class="req">*</span>';
			}
			$radio = '<h5 class="heading_a '.$name.' " style="font-size:15px !important;">'.$value->title.$req.'</h5>
					<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">';
            foreach($value->choices as $key=>$values){
            	if($values->checked === 1){
            		$checked ='checked = "checked"';
            	}
            	else{
            		$checked = '';
            	}
            	if($value->required === '1'){
					$radio.='<span class="icheck-inline">
						<input type="radio" name="'.$name.'" value="'.$values->id.'" data-md-icheck required="required" '.$checked.'/><label for="radio_demo_1" class="inline-label">'.$values->title.'</label></span>';
				}else{
					$radio.='<span class="icheck-inline">
						<input type="radio" name="'.$name.'"'.$checked.' value="'.$values->id.'" data-md-icheck /><label for="radio_demo_1" class="inline-label">'.$values->title.'</label>
						</span>';
				}
            }
			$radio .='</div></div>';

			return $radio;

	}
	public function input_checkbox($value)
	{
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$req = '';
		if($value->required === '1'){
			$req = '<span class="req">*</span>';
		}
		$checkbox = '<h5 class="heading_a '.$name.' " style="font-size:15px!important;">'.$value->title.$req.'</h5>
					<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                                    ';
        foreach($value->choices as $key=>$values){
            	if($values->checked === 1){
            		$checked ='checked';
            	}
            	else{
            		$checked = '';
            	}
            if($value->required === '1'){
				$checkbox .='<span class="icheck-inline">
							<input type="checkbox" name="'.$name.'[]" value="'.$values->id.'" data-md-icheck required="required"/>
							<label for="checkbox_demo_2" class="inline-label">'.$values->title.'</label>
							</span>';
			}else{
				$checkbox .='<span class="icheck-inline">
							<input type="checkbox" name="'.$name.'[]" value="'.$values->id.'" data-md-icheck '.$checked.' />
							<label for="checkbox_demo_2" class="inline-label">'.$values->title.'</label>
							</span>';
			}
        }
		$checkbox .='</div></div>';
		return $checkbox;

	}
	public function input_select($value){
		$req = '';
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		if($value->required === '1'){
			$req = '<span class="req">*</span>';
		}
		$select ='<h5 class="heading_a '.$name.'ss " style="font-size:15px !important;">'.$value->title.$req.'</h5>
					';
		if($value->required === '1'){
			$select .= '<select name="'.$name.' required="required">';
		}else{
			$select .= '<select name="'.$name.'">';
		}

		foreach($value->choices as $key=>$values){
			$selected = '';
			if($values->checked === 1){
            		$selected .= 'selected';
            	}
            	else{
            		$selected .= '';
            	}
            $select.='<option value="'.$values->id.'"'.$selected.'>'.$values->title.'</option>';
		}
		$select.='</select>';
		return $select;

	}
	public function input_textarea($value){
		$req = '';
		$values = isset($value->value)?$value->value:'';
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
			if($value->required === '1'){
				$req = '<span class="req">*</span>';
			}
			if(!isset($value->min)){
				$value->min = '5';
			}
			if(!isset($value->max)){
				$value->max = '30';
			}
			//print_r($value); exit;
		$textarea = ' <label for="'.$name.'">'.$value->title.$req.' </label>';
		if($value->required == '1'){
			$textarea.='<textarea class="md-input" name="'.$name.' required="required" data-parsley-minlength="'.$value->min.'" data-parsley-maxlength="'.$value->max.'" data-parsley-validation-threshold="10" data-parsley-minlength-message = "Come on! You need to enter at least '. $value->min.' caracters long comment..">'.$values.'</textarea>';
		}else{
			$textarea.='<textarea class="md-input" name="'.$name.'" data-parsley-minlength="'.$value->min.'" data-parsley-maxlength="'.$value->max.'" data-parsley-validation-threshold="10" data-parsley-minlength-message = "Come on! You need to enter at least a '. $value->min.' caracters long comment..">'.$values.'</textarea>';	
		}
		return $textarea;
	}
	public function input_password($value){
		$req = '';
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$values = isset($value->value)?$value->value:'';
			if($value->required === '1'){
				$req = '<span class="req">*</span>';
			}
		$pwd = '<label for="'.$name.'">'.$value->title.$req.' </label>';
		if($value->required == 1){
			$pwd.='<input type="password" name="'.$name.'" value="'.$values.'" id="'.$name.'" class="md-input" required="required"/>';
		}else{
			$pwd.='<input type="password" name="'.$name.'" value="'.$values.'" id="'.$name.'" class="md-input" />';
		}
		return $pwd;
	}
	
	public function input_hidden($value){

		$hidden ='<input type="hidden" name="'.$name.'" value="'.$values.'"/>';

		return $hidden;
	}
	public function input_reset($value){

		$reset ='
			<button class="md-btn md-btn-danger" style="float:right" type="reset" value="'.$value->title.'">'.$value->title.'</button>
			';
		return $reset;
	}
	public function input_submit($value){

		$submit = '<button class="md-btn md-btn-primary" type="submit" value="'.$value->title.'">'.$value->title.'</button>';
		return $submit;
	}

}
