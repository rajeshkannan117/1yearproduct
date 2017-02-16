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

                            case 'text':
                                     $res .= $this->input_text($col);
                                    break;
                            case 'element-single-line-text':
                                    $res .= $this->input_text($col);
                                    break;
                            case 'time':
                                    $res .= $this->input_time($col);
                                    break;
                            case 'email':
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
	public function generate_apiformat($col)
	{
            $res = '';	
            $type =  $col;
            switch($type){

                case 'text':
                         $res = 'element-single-line-text';
                        break;
                case 'radio':
                        $res  = 'element-either-or-choice';
                        break;
                case 'checkbox':
                        $res = 'element-multi-choice';
                        break;
                case 'select':
                        $res = 'element-single-select';
                        break;
                case 'textarea':
                        $res = 'element-multi-line-text';
                        break;
                case 'password':
                        $res = 'element-password';
                        break;
                case 'file':
                        $res = 'element-single-file';
                        break;
                case 'hidden':
                        $res = 'hidden';
                        break;
                case 'reset':
                        $res = 'reset';
                        break;
                case 'submit':
                        $res = 'element-button-submit';
                        break;

            }
		//}
		return $res;
	}
	public function input_text($value){

		return '<label for="fullname">'.$value->title.'</label><input class="md-input" type="text" id="'.$value->name.'" name="'.$value->name.'" value=""/>';
	 
	}
        public function input_time($value){
            $label = '<label for="uk_tp_1">'.$value->title.'</label>
                           <input class="md-input" type="text" id="uk_tp_1" data-uk-timepicker>';
            return $label;
        }
        public function input_email($value){
            $email = '<label for="masked_email">'.$value->title.'</label>
                            <input class="md-input masked_input" id="masked_email" type="text" data-inputmask="\'alias\': \'email\'" data-inputmask-showmaskonhover="false" />';
            return $email;
        }
	public function input_radio($value){
			$radio = '<label class="uk-form-label">'.$value->title.'</label>';
			
			foreach($value->radio_label as $values=>$text){
				$radio.='<span class="icheck-inline">
						<input type="radio" name="'.$value->name.'" value="'.$value->radio_value[$values].'" data-md-icheck /><label for="radio_demo_1" class="inline-label">'.$text.'</label></span>';
			}

			return $radio;

	}
	public function input_checkbox($value)
	{
		$checkbox = '<label class="uk-form-label">'.$value->title.'</label>';
		foreach($value->checkbox_label as $values=>$text){
			$checkbox .='<span class="icheck-inline">
							<input type="checkbox" name="'.$value->name.'[]" value="'.$value->checkbox_value[$values].'" data-md-icheck /><label for="checkbox_demo_2" class="inline-label">'.$text.'</label></span>';
		}
		return $checkbox;

	}
	public function input_select($value){
		$select ='<label class="uk-form-label">'.$value->title.'</label>';
		$select .= '<select data-md-selectize name="'.$value->name.'">';
			foreach($value->options_label as $values=>$text){
				$select.='<option value="'.$value->options_value[$values].'">'.$text.'</option>';
			}
		$select.='</select>';

		return $select;

	}
	public function input_textarea($value){

		$textarea = ' <label>'.$value->title.'</label>';
		$textarea.='<textarea class="md-input" name="'.$value->name.'"></textarea>';
		return $textarea;
	}
	public function input_password($value){
		$pwd = '<label>'.$value->title.'</label>';
		$pwd.='<input type="password" name="'.$value->name.'" value="'.$value->value.'" class="md-input" />';
		return $pwd;
	}
	public function input_file($value){
		$file = '<div class="uk-form-file md-btn md-btn-primary">
                       <input id="form-file" type="file" name="'.$value->name.'" />
                    </div>';

        return $file;

	}
	public function input_hidden($value){

		$hidden ='<input type="hidden" name="'.$value->name.'" value="'.$value->value.'"/>';

		return $hidden;
	}
	public function input_reset($value){

		$reset ='<button class="md-btn md-btn-primary" type="reset" value="'.$value->title.'">'.$value->title.'</button>';
		return $reset;
	}
	public function input_submit($value){

		$submit = '<button class="md-btn md-btn-primary" type="submit" value="'.$value->title.'">'.$value->title.'</button>';
		return $submit;
	}

}