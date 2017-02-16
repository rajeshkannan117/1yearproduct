<?php
/**
 * Format class
 *
 * Helps to genereate form based on its type.
 *
 * @author  	RajeshKannan.C
 */
class Review {

	public function generate($col,$comments,$submission_data){
		$res = '';
		
		if(is_object($col)){
			$type =  $col->type;
			switch($type){
				case 'heading':
					$res .= $this->input_heading($col,$comments);
					break;
				case 'element-label':
					$res .= $this->input_heading($col,$comments);
					break;
				case 'text':
					$res .= $this->input_text($col,$comments);
					$res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'element-single-line-text':
					$res .= $this->input_text($col,$comments);
					break;
				case 'email':
					 $res .= $this->input_email($col,$comments);
					 $res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'element-email':
					$res .= $this->input_email($col,$comments);
					break;
				case 'radio':
					$res .= $this->input_radio($col,$comments);
					$res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'number':
					$res .= $this->input_number($col,$comments);
					$res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'element-either-or-choice':
					$res .= $this->input_radio($col,$comments);
					break;
				case 'checkbox':
					$res .= $this->input_checkbox($col,$comments);
					$res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'element-multi-choice':
					$res .= $this->input_checkbox($col,$comments);
					break;
				case 'select':
					$res .= $this->input_select($col,$comments);
					$res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'element-single-choice':
					$res .= $this->input_select($col,$comments);
					break;
				case 'textarea':
					$res .= $this->input_textarea($col,$comments);
					$res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'element-multi-line-text':
					$res .= $this->input_textarea($col,$comments);
					break;
				case 'password':
					$res .= $this->input_password($col,$comments);
					break;
				case 'element-password':
					$res .= $this->input_password($col,$comments);
					break;
				case 'file':
					$res .= $this->input_file($col,$comments);
					$res .= $this->review_dialog($col,$comments,$submission_data);
					break;
				case 'element-single-file':
					$res .= $this->input_file($col,$comments);
					break;
				case 'hidden':
					$res .= $this->input_hidden($col,$comments);
					break;
				case 'reset':
					$res .= $this->input_reset($col,$comments);
					break;
				case 'submit':
					$res .= $this->input_submit($col,$comments);
					break;
				case 'element-button-submit':
					$res .= $this->input_submit($col,$comments);
					break;
                case 'date':
                    $res .= $this->input_date($col,$comments);
                    $res .= $this->review_dialog($col,$comments,$submission_data);
                    break;
                case 'time':
                    $res .= $this->input_time($col,$comments);
                    $res .= $this->review_dialog($col,$comments,$submission_data);
                    break;
                case 'signature':
            		$res .= $this->input_signature($col,$comments);
            		$res .= $this->review_dialog($col,$comments,$submission_data);
            		break;
			}
		}
		return $res;
	}
	public function check_enabled($value){
		if(property_exists($value, "isenabled")){
			if($value->isenabled){
					$css = 'style = "font-size:16 px !important;font-weight:800"';
			}else{
				$css = '';
			}
		}else{
			$css = '';
		}
		return $css;
	}
	public function input_heading($value){
		return '<h3 class="heading_b uk-margin-bottom">'.$value->title.'</h3>';
	}
	public function input_number($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		$values = isset($value->value)?$value->value:'';
		if($value->required === '1'){
            	$req = '<span class="req">*</span>';
            	$required = 'required ="required"';
        }
        else{
        	$req = '';
        	$required = '';
        }
        $css = $this->check_enabled($value);
		return '<a href="#'.$name.'" data-uk-modal="{ center:true }">
					<label for="'.$value->title.'" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.'
					</label>
				</a>
		<input disabled class="md-input" type="number" id="'.$name.'"  value="'.$values.'"'.$required.'/>';
	}
	public function input_text($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		$values = isset($value->value)?$value->value:'';
		if($value->required === '1'){
            	$req = '<span class="req">*</span>';
            	$required = 'required ="required"';
        }
        else{
        	$req = '';
        	$required = '';
        }
        $css = $this->check_enabled($value);
		return '<a href="#'.$name.'" data-uk-modal="{ center:true }">
					<label for="'.$value->title.'" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.'
					</label>
				</a>
		<input disabled class="md-input" type="text" id="'.$name.'"  value="'.$values.'"'.$required.'/>';
	}
	public function input_signature($value){
		//print_r($value); exit;
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		$values = isset($value->value)?$value->value:'';
		if($values === ''){
        	$content = 'Drop signature to Upload';
        }else{
        	$content = '<img width="100px" height="100px" src = "'.$values.'" alt="'.$value->title.'" />';
        }
        if($value->required === '1'){
            	$req = '<span class="req">*</span>';
            	$required = 'required ="required"';
        }
        else{
        	$req = '';
        	$required = '';
        }
        $css = $this->check_enabled($value);
		$file = '<a href="#'.$name.'" data-uk-modal="{ center:true }">
					<label for="'.$name.'" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.'</label>
				</a>
				<p class="uk-text">'.$content.'</p>';
        return $file;	 
	}
	public function input_file($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		$values = isset($value->value)?$value->value:'';
		if($values === ''){
        	$content = 'Drop File to Upload';
        }else{
        	$content = '<img src = "'.$values.'" alt="'.$value->title.'" width="100" height ="100" />';
        }
        if($value->required === '1'){
            	$req = '<span class="req">*</span>';
            	$required = 'required ="required"';
        }
        else{
        	$req = '';
        	$required = '';
        }
        $css = $this->check_enabled($value);
		$file = '<a href="#'.$name.'" data-uk-modal="{ center:true }">
				<label for="'.$name.'" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.'</label>
				</a>
				<p class="uk-text">'
					.$content.'
                </p>';
        return $file;	
	}

	public function input_email($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$values = isset($value->value)?$value->value:'';
		$heading_names = $value->formfieldid;
		if($value->required === '1'){
            	$req = '<span class="req">*</span>';
            	$required = 'required ="required"';
        }
        else{
        	$req = '';
        	$required = '';
        }
        $css = $this->check_enabled($value);
		return '<a href="#'.$name.'" data-uk-modal="{ center:true }">
					<label for="'.$name.'" class="heading_a_'.$heading_names.' "'.$css.'>'
						.$value->title.$req.
					'</label>
					</a>
					<input disabled class="md-input" type="email" id="'.$name.'"  value="'.$values.'"'.$required.'/>
				';
	}
        public function input_time($value){
        	$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
        	$heading_names = $value->formfieldid;
        	$values = isset($value->value)?$value->value:'';
        	if($value->required === '1'){
            	$req = '<span class="req">*</span>';
            	$required = 'required ="required"';
            }
            else{
            	$req = '';
            	$required = '';
            }
            $css = $this->check_enabled($value);
            $label = '<a href="#'.$name.'" data-uk-modal="{ center:true }">
            				<label for="uk_tp_1" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.'</label>
            			</a>
                        <input disabled class="md-input" type="text" '.$required.' id="uk_tp_1" data-uk-timepicker  value ="'.$values.'" >';
            return $label;
        }
        
        public function input_date($value){
        	$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
        	$heading_names = $value->formfieldid;
        	$values = isset($value->value)?$value->value:'';
            $format = str_replace('/','.',$value->format);
            /*<span class="uk-input-group-addon">
                        		<i class="uk-input-group-icon uk-icon-calendar"></i>
                        	</span>*/
            if($value->required === '1'){
            	$req = '<span class="req">*</span>';
            	$required = 'required ="required"';
            }
            else{
            	$req = '';
            	$required = '';
            }
            $css = $this->check_enabled($value);
            $date = '<div class="uk-input-group">
            			<a href="#'.$name.'" data-uk-modal="{ center:true }">
            				<label for="uk_dp_1" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.' </label>
            			</a>
                    	<input disabled class="md-input" '.$required.' type="text" id="uk_dp_start" data-uk-datepicker="{format:\''.strtoupper($format).'\'}" value="'.$values.'" style="padding:12px 4px;">
                    </div>';
            return $date;
        }
	public function input_radio($value){
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		//print_r($value);
		if($value->required === '1'){
			$req = '<span class="req">*</span>';
			$required = 'required="required"';
		}else{
			$req = '';
			$required = '';
		}
		$css = $this->check_enabled($value);
		$radio = '<a href="#'.$name.'" data-uk-modal="{ center:true,bgclose:false }">
					<label class="heading_a_'.$heading_names.' " '.$css.'>'.$value->title.$req.'</label>
				 </a>
				<div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">';
        foreach($value->choices as $key=>$values){
        	if(property_exists($value, "value")){
	        	if($values->title === $value->value){
	        		$checked ='checked ';
	        	}
	        	else{
        			$checked = '';
        		}
	        }
        	else{
        		$checked = '';
        	}
			$radio.='<span class="icheck-inline">
						<input type="radio" '.$checked.$required.' value="'.$values->title.'" data-md-icheck />
						<label for="radio_demo_1" class="inline-label">'.$values->title.'</label>
				</span>';
        }
		$radio .='</div></div>';
		return $radio;
	}
	public function input_checkbox($value)
	{
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		if($value->required === '1'){
			$req = '<span class="req">*</span>';
			$required = 'required="required"';
		}else{
			$req = '';
			$required = '';
		}
		$css = $this->check_enabled($value);
		$value_list = explode(',',$value->value);
		$checkbox = '<a href="#'.$name.'" data-uk-modal="{ center:true }">
						<label class="heading_a_'.$heading_names.' " '.$css.' >'.$value->title.$req.'</label>
					</a>
					<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                        ';
        foreach($value->choices as $key=>$values){
        	if(in_array($values->title, $value_list)){
        		$checked =' checked ';
        	}
        	else{
        		$checked = '';
        	}
			$checkbox .='<span class="icheck-inline">
							<input type="checkbox" value="'.$values->title.'" data-md-icheck '.$checked.$required.'/>
							<label for="checkbox_demo_2" class="inline-label">'.$values->title.'</label>
						</span>';
        }
		$checkbox .='	</div>
					</div>';
		return $checkbox;

	}
	public function input_select($value){
		$req = '';
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		$select ='';
		if($value->required === '1'){
			$req = '<span class="req">*</span>';
			$required = 'required="required"';
		}else{
			$req = '';
			$required = '';
		}
		$css = $this->check_enabled($value);
		$select .= '<a href="#'.$name.'" data-uk-modal="{ center:true }">
						<label class="heading_a_'.$heading_names.'" '.$css.'>'
							.$value->title.$req
						.'</label>
					</a>
		<select data-md-selectize disabled '.$required.'>';
			foreach($value->choices as $key=>$values){
	            if($values->title === $value->value){
	            	$selected ='selected';
	            }
	            else{
	            	$selected = '';
	            }
	            $select.='<option value="'.$values->title.'" selected = "'.$selected.'">'.$values->title.'</option>';
			}
		$select.='</select>';
		return $select;
	}
	public function input_textarea($value){
		$req = '';
		$values = isset($value->value)?$value->value:'';
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		if($value->required === '1'){
			$req = '<span class="req">*</span>';
			$required = 'required="required"';
		}else{
			$req = '';
			$required = '';
		}
		if(!isset($value->min)){
			$value->min = '5';
		}
		if(!isset($value->max)){
			$value->max = '30';
		}
		
		$css = $this->check_enabled($value);
		$textarea = '<a href="#'.$name.'" data-uk-modal="{ center:true }"> 
						<label for="'.$name.'" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.' </label>
					</a>';
			$textarea.='<textarea class="md-input" data-parsley-minlength="'.$value->min.'" data-parsley-maxlength="'.$value->max.'" data-parsley-validation-threshold="10" data-parsley-minlength-message = "Come on! You need to enter at least a '. $value->min.' caracters long comment.." disabled>'.$values.'</textarea>';	
		return $textarea;
	}
	public function input_password($value){
		$req = '';
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$heading_names = $value->formfieldid;
		$values = isset($value->value)?$value->value:'';
			if($value->required === '1'){
				$req = '<span class="req">*</span>';
			}
			$css = $this->check_enabled($value);
		$pwd = '<label for="'.$name.'" class="heading_a_'.$heading_names.' "'.$css.'>'.$value->title.$req.' </label>';
		if($value->required == 1){
			$pwd.='<input type="password"  value="'.$values.'" id="'.$name.'" class="md-input" required="required"/>';
		}else{
			$pwd.='<input type="password"  value="'.$values.'" id="'.$name.'" class="md-input" />';
		}
		return $pwd;
	}
	
	public function input_hidden($value){

		$hidden ='<input type="hidden"  value="'.$values.'"/>';

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

	public function review_dialog($value,$comments,$submission_data){
		//if(isset)
		$name = $value->fieldid.'_'.$value->formfieldid.'_'.$value->fieldtype;
		$formfieldid = $value->formfieldid;
		//print_r($submission_data);
		if(isset($submission_data[$value->formfieldid])){
			$user_info_text_id = $submission_data[$value->formfieldid];
		}else{
			$user_info_text_id = 0;
		}
		if(isset($comments) && !empty($comments)){
			$height = "height:200px";
		}
		else{
			$height = "height:100px";
		}
		if(property_exists($value, "value")){
            		$fieldvalues = $value->value;
            	}else{
            		$fieldvalues = '';
            	}
		$dialog ='
		<div class="uk-modal" id="'.$name.'">
        <div class="uk-modal-dialog">
        	<button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">';
            if($value->fieldtype != '3'){

        $dialog .='<h3 class="uk-modal-title">'.$value->title.' - '.$fieldvalues.'</h3>';
   		}else{
            $dialog .='<h3 class="uk-modal-title">'.$value->title.'<img src ="'.$fieldvalues.'" width="50px" height="50px"/></h3>';
        }
        $dialog .= '</div>';
        $dialog.= ' <div class="uk-margin-medium-bottom">
        				<div class="md-card-content padding-reset" style="'.$height.'">
        				<div class="chat_box_wrapper">
		                	<div id="chat" class="chat_box touchscroll chat_box_colors_a">';
		               		if(isset($comments) && !empty($comments)){
								foreach($comments as $key => $values){
									if($key == $value->formfieldid){
										foreach($values as $k=>$v){
			$dialog.='			<div class="chat_message_wrapper">
									<ul class="chat_message" >';
			$dialog.= 					'<li id="comment_'.$v["comment_id"].'">'.
												$v["comments"].
											'<span class="chat_message_time">'.$v["created_by"].'</span>
											
										</li>
									</ul>
								</div>';										
										}
									}
								}
							}
							//name="comments['.$user_info_text_id.'_'.$formfieldid.']" 
		$dialog.='			</div>
							<div class="chat_submit_box" id="chat_submit_box">
	                            <div class="uk-input-group">
	                                <div class="md-input-wrapper">
	                                	<input type="text" class="md-input comments" onkeypress="return comments(event,this);" id="comments_'.$formfieldid.'" placeholder="Send Comments" value="">
	                                	<span class="md-input-bar"></span>
	                                	<input type="hidden" id="hidden_'.$formfieldid.'" name="comments['.$user_info_text_id.'_'.$formfieldid.']" value="" />
	                                </div>
	                                <span class="uk-input-group-addon">
	                                    <a href="#" onclick="return comments_submit(this);" >
	                                    	<i class="material-icons md-24"></i>
	                                    </a>
	                                </span>
	                            </div>
	                        </div>
                		</div>
                	</div>
                </div>';
        $dialog.='
            <div class="uk-modal-footer uk-text-right">
            </div>
        </div>
    </div>';
    return $dialog;
	}

}