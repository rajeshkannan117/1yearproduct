<?php	
$CI = & get_instance(); 
$CI->load->library('templates'); 
$datas = json_decode($details->form_content);

?>
<style>
    li.rows{
        min-height:80px;
    }
    li.columns{
        float:left;
        height:75px;
        list-style: none;
    }
    li.highlight{
        min-height: 70px;
    }
    .dropovers{
      /*  border:1px solid #ccc;
        border-right-color:red;*/
    }
    .dragdrop-panel > span{
        display: inline-block;
        width: 80%;
    }
    .content{
        padding-left: 0px !important;
    }
</style>
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery.ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/moment.js"></script>
<script>

//function auto_update_text(type){
$(document).on("click",'label.title_label', function () {

    var current = $(this).parent().parent();
    if($(this).find('.req').length > 0){
        var txt = $(this).text().replace('*','').trim();
    }else{
        var txt = $(this).text().trim();
    }
    $(".title_label",current).replaceWith('<input class="title_labels" value="'+txt+'"/>');
    $(".title_labels").focus();
});

$(document).on('click','span.click-edit-icon',function(){
    var type = $(this).data('type');
    if(type === 'select' || type === 'radio' || type === 'checkbox'){
        var current = $(this).parent().parent().parent();
    }else{
        var current = $(this).parent().parent();
    }
    if($('ul#pages').find('.title_labels')){
        var input_label = $('ul#pages').find('.title_labels').val();
        $('ul#pages').find('.title_labels').replaceWith("<label class='title_label'>"+input_label+"</label>");
    }
    var txt = $(current).find('.title_label').text();
    $(".title_label",current).replaceWith('<input class="title_labels" value="'+txt+'"/>');       
    $(".title_labels").focus();                   
});


var popups = {
    open_dialog:function(optionid,dialog){
        $('.'+optionid).click(function(){
            dialog.dialog( "open" );
        });
    },
    options_open:function(type,count,dialog){
        current = dialog.selector;
        var max_fields      = 5 - count ; 
        //maximum input boxes allowed
        var wrapper         = $(""+current+" element"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        var x = 0;
        $(wrapper).on("click",'.add_field_button',function(e){ //on add input button click
            
            //initlal text box count
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                var wrapper_size = $(wrapper).find('p').size();
                console.log(wrapper_size);
                $(wrapper).find('.add-option').remove();
                $(wrapper).append('<p><input type="text" name="mytext[]" class="select_label"/><span class="delete-option remove_field"></span><span class="add-option add_field_button"></span></p>'); //add input box

            }else{
                if($(wrapper).find('p.req').size() == 0){
                    $(wrapper).prepend('<p class="req">Limited only for trial version</p>');
                }
            }
            return false;
        });
        $(add_button).on("click",function(e){ //on add input button click
             //initlal text box count
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).find('.add-option').remove();
                $(wrapper).append('<p><input type="text" name="mytext[]" class="select_label"/><span class="delete-option remove_field" id="label_remove'+x+'"></span><span class="add-option add_field_button" id="label_remove'+x+'"></span></p>'); //add input box
            }else{
                if($(wrapper).find('p.req').size() == 0){
                    $(wrapper).prepend('<p class="req">Limited only for trial version</p>');
                }
            }
            return false;
        });
        k=0;
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
           e.preventDefault();
            if($(wrapper).find('p.req').size() == 1){
                $(wrapper).find('p.req').remove();
            }
            if(type === 'radio'){
                if($(wrapper).find('p').size() > 3){
                    if($(this).parent('p').next().length == 1){
                    }else {
                        $(this).parent('p').prev(':first').find('.add-option').remove();
                        $(this).parent('p').prev(':first').find('.remove_field').remove();
                        $(this).parent('p').prev(':first').append('<span class="delete-option remove_field"></span><span class="add-option add_field_button"></span>');
                    }
                }else{
                    $(this).parent('p').prev(':first').find('.add-option').remove();
                    $(this).parent('p').prev(':first').append('<span class="add-option add_field_button"></span>');     
                }
            }else if(type === 'checkbox' || type === 'select'){
                if($(wrapper).find('p').size() > 2){
                    if($(this).parent('p').next().length == 1){
                    } else {
                        $(this).parent('p').prev(':first').find('.add-option').remove();
                        $(this).parent('p').prev(':first').find('.remove_field').remove();
                        $(this).parent('p').prev(':first').append('<span class="delete-option remove_field"></span><span class="add-option add_field_button"></span>');     
                    }
                } else {
                    $(this).parent('p').prev(':first').find('.add-option').remove();
                    $(this).parent('p').prev(':first').append('<span class="add-option add_field_button"></span>');     
                }
            }
            $(this).parent('p').remove(); 
            x--;
        });
        return false;
    },
    options_close:function(classs,type,popupid,row_id,column_id,dialog){
        $(document).on('click','.'+classs,function(){
            dialog.dialog('close');
        });
    },
};
function popup_initialize(popupid,current,type,row_id,column_id){
    var dialog = $('#'+popupid).dialog({
      title: "OPTIONS",
      height: "auto",
      width: "auto",
      modal: true,
      autoOpen: false,
      //height: 300,
      buttons: [{
        text:'Ok',
        "click" :function(){
            var html = '';
            current = $("#"+popupid);
            switch(type){                            
                case 'select':
                    var select = '<select id="'+popupid+'_'+row_id+'">';
                    var hidden = '';
                    $('#'+popupid).find('.select_label').each(function(){
                        if($(this).val() != ''){
                            html += '<option>'+$(this).val()+'</option>';
                            hidden += '<input type="hidden" class="title_value" data-optionid="0" value="'+$(this).val()+'" />';
                        }
                    })
                    select += html;
                    select +='</select>';
                    select += hidden;
                    break;
                case 'radio':
                    var select = '';
                    $('#'+popupid).find('.select_label').each(function(){
                        if($(this).val() != ''){
                            select += '<input type="radio" name="'+popupid+'"/> <span class="title_value" data-optionid="0">'+$(this).val()+'</span>';
                        }
                    })
                    break;
                case 'checkbox':
                    var select = '';
                    $('#'+popupid).find('.select_label').each(function(){
                        if($(this).val() != ''){
                            select += '<input type="checkbox"/><span class="title_value" data-optionid="0">'+$(this).val()+'</span>';
                        }
                    })
                    break;
                case 'date':
                    var select = '';
                        date_id = popupid.split('_');
                        var cur_date = $('#cur_date_'+date_id[1]).val();
                        var sel_format = $('#date_formats_'+date_id[1]).val();
                        var cur_format = $('#date_format_'+date_id[1]).val();
                        switch(cur_format){
                            case 'MM/dd/yyyy':
                                cur_format = 'MM-DD-YYYY';
                                break;
                            case 'dd/MM/yyyy':
                                cur_format = 'DD-MM-YYYY';
                                break;
                            case 'yyyy/MM/dd':
                                cur_format = 'YYYY-MM-DD';
                                break;
                            default:
                                cur_format = 'MM-DD-YYYY';
                                break;
                        }
                        switch(sel_format){
                            case 'MM/dd/yyyy':
                                sel_format = 'MM-DD-YYYY';
                                break;
                            case 'dd/MM/yyyy':
                                sel_format = 'DD-MM-YYYY';
                                break;
                            case 'yyyy/MM/dd':
                                sel_format = 'YYYY-MM-DD';
                                break;
                            default:
                                sel_format = 'MM-DD-YYYY';
                                break;
                        }
                        var date_string = moment(cur_date, cur_format).format(sel_format.toUpperCase());
                        $('#value_'+date_id[1]).val(date_string);
                        $('#cur_date_'+date_id[1]).val(date_string);
                        $('#date_format_'+date_id[1]).val($('#date_formats_'+date_id[1]).val());
                    break;  
                case 'time':
                    var select = '';

                        var time_id = popupid.split('_');
                        var sel_time_format = $('#time_formats_'+time_id[1]).val();
                        if(sel_time_format =='hh:mm:ss'){
                            /* 12 hour */
                            var date = new Date();
                            var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
                            var am_pm = date.getHours() >= 12 ? "PM" : "AM";
                            hours = hours < 10 ? "0" + hours : hours;
                            var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
                            var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
                            time = hours + ":" + minutes + ":" + seconds + " " + am_pm;
                            $('#value_'+time_id[1]).val(time);
                        }else if(sel_time_format == 'HH:mm:ss'){
                            /* 24 Hour */
                            var date = new Date();
                            var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
                            var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
                            var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
                            time = hours + ":" + minutes + ":" + seconds;
                            $('#value_'+time_id[1]).val(time);
                        }
                        $('#time_format_'+time_id[1]).val(sel_time_format);
                    break;

            }
            $('ul#'+row_id+'> #'+column_id).find('.select').empty().append(select);
        }
        }   ,{
            text:'Cancel',
            click: function() {
            }
        }]
    });
    return dialog;
}
</script>
<div id="page_content">
    <div id="page_content_inner" class="form-page-alignment">
        <div class="uk-grid" style="display: block;padding-left:0px !important"; data-uk-grid-margin data-uk-grid-match id="wizard_forms">
         <div class="uk-width-large-8-10"  id="content_right" style="float:left;padding-left:35px; margin-top:0px;">
                    <?php if($org_id != 1){ 
                        $style= '';
                    }else{
                        $style="margin-bottom:20px";
                    }
                    ?>
                    <div class="uk-grid details" style="background: #fff; margin-left: 0px;" >
                        <div class="uk-width-1-2" style="<?php echo $style; ?>; padding-left:10px;">
                            <div class="parsley-row" >
                                <div class="form-desc ">
                                    <label class="fn">Name your form<span class="req">*</span></label>
                                    <input type="text" class="md-input fn-field" id="form_name" name="form_name" value="<?php echo $details->form_name; ?>" data-parsley-trigger="change" required  />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2"  style="<?php echo $style; ?>">
                            <div class="parsley-row">
                                <div class="form-category" style="margin-top:16px;">
                                    <select name="form_category" class="chosen_select" data-placeholder="Choose your form category" id="form_categorys">
                                        <option value=""></option>
                                    <?php 
                                    foreach($categories as $key=>$value){ ?>
                                        <option value="<?php echo $key ?>"
                                        <?php if($form_category == $key) { echo 'selected';}  ?>
                                        >
                                            <?php echo $value;?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if($org_id != 1) { ?>
                        <div class="uk-width-1-2" style="padding-left:10px;">
                            <div class="location" style="margin-top:20px">
                                <select name="location[]" class="chosen_select location_change" required id="location_change" multiple data-placeholder="Select Job Sites">
                                    <option value=""></option>
                                    <?php foreach($org_location as $key=>$value){ ?>
                                    <option value="<?php echo $value['id']?>"
                                    <?php if(in_array($value['id'], $form_location)){ echo 'selected'; } ?>
                                    >                  <?php echo $value['location_name'].','.$value['city'].','.$value['state'];?>
                                     </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="parsley-row">
                                <div class="form_assign" style="margin-top:20px">
                                    <label class="fn" style="margin-right:20px;">Assign</label>
                                    <span class="icheck-inline">
                                    <input type="radio" value="user" name="assign[]" class="formAssign" data-md-icheck <?php echo ($details->assign_to == 'user')?'checked':''; ?> />
                                    <label for="radio_demo_inline_1" class="inline-label">User</label>
                                </span>
                                <!--data-md-icheck-->
                                <span class="icheck-inline">
                                    <input type="radio" value="dept" name="assign[]" class="formAssign" data-md-icheck <?php echo ($details->assign_to == 'dept')?'checked':''; ?> />
                                    <label for="radio_demo_inline_2" class="inline-label">Department</label>
                                </span>
                                <span class="icheck-inline">
                                    <input type="radio" value="workflow" name="assign[]" class="formAssign" data-md-icheck <?php echo ($details->assign_to == 'workflow')?'checked':''; ?> />
                                    <label for="radio_demo_inline_3" class="inline-label">Workflow</label>
                                </span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="md-card">
                        <div class="md-card-content "  style="">
                            <div id="forms" data-form_id ="" style="width:100%;height:642px;max-height: 642px;overflow:auto">
                                    <ul id="pages" style="">
                                       <?php 
                        foreach($datas->fields as $p=>$pages){ 
                            $row_count = count($pages);
                            $total_rows = 0;
                            $comptField = 0;
                                foreach($pages as $r=>$rows){ 
                                $r++;
                                $column_count = count($rows);
                                if($r < $row_count){
                                    $total_rows++;
                            ?>
                            <li class="rows uk-width-1-1" id="rows_<?php echo $r; 
                             ?>">
                                <ul id="rows_<?php echo $r; ?>" class="connected"> 
                                    <?php foreach($rows as $c=>$columns) {
                                            $c++;  
                                            $comptField++;
                                    ?> 
                                    <?php if($c==1 || $c==2 || $c==3){
                                        $id=$c;
                                    }?>
                                    <li class="uk-width-1-<?php echo $column_count;?> columns" id="columns_<?php echo $c; ?>">
                                        <div class="cols uk-width-1-1 <?php echo $columns->type.'_'.$columns->formfieldid; ?>"> 
                                            <?php echo $CI->templates->generate($columns,$column_count);?>
                                        </div>
                                <?php
                                    $type =  $columns->type;
                                    $edit_row_id = 'rows_'.$r;
                                    $edit_column_id = 'columns_'.$c;
                                    $edit_choices_id = 'choices_'.$columns->formfieldid;
                                    $count = count($columns->choices); 
                                    if($type === 'radio' || $type === 'checkbox' || $type === 'select' || $type === 'time' || $type === 'date'){
                                        echo '<script>
                                        dialog =  popup_initialize("'.$edit_choices_id.'"," ","'.$type.'","'.$edit_row_id.'","'.$edit_column_id.'");  
    
                                        popups.open_dialog("open_options_'.$columns->formfieldid.'",dialog);
                                        popups.options_open("'.$type.'",'.$count.',dialog);                                                                         
                                        popups.options_close("ui-button","'.$type.'","'.$edit_choices_id.'","'.$edit_row_id.'","'.$edit_column_id.'",dialog);
                                        </script>
                                        <input type="hidden" name="popup_'.$columns->formfieldid.'" id="popup_'.$columns->formfieldid.'" value="">
                                                    ';              
                                        } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } 
                            }
                        } ?>
                    </ul>
                    <?php 
                        if($c <= 3){
                            $start_rows = $total_rows;
                            $start_cols = $c;
                        }  else{
                            $start_rows = $total_rows++;
                            $start_cols = 1;
                        }  
                    ?>

                            </div>
                            <div class="buildform">
                                 <!--<a class="preview">Preview</a>-->
                                <span class="publish">Save</span>
                                <a class="cancel" href="<?php echo base_url().'form'; ?>">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>                     
                </div>
        <div class="uk-width-large-2-10"  id="sidebar" style="float: left; margin-top: -24px; padding-left: 15px;">
            <div class="md-card dragdrop-panel">
                <div class="md-card-content">
                   <div class="uk-panel">
                        <div class="heading">Form Elements</div>
                        <div class="uk-accordion" data-uk-accordion>
                            <h3 class="uk-accordion-title uk-accordion-title-primary">Basic</h3>
                            <p class="hint-text">Drag and drop for build new form</p>
                            <div class="uk-accordion-content">
                                <ul id="basic">
                                    <li><div class="singleline-icon" ></div><span value="heading">Heading</span></li>
                                    <li><div class="singleline-icon" ></div><span value="text">Single Line Text</span></li>
                                    <li><div class="email-icon"></div><span value="email">Email</span></li>
                                    <li><div class="multiline-icon"></div><span value="textarea">Multi Line Text</span></li>
                                    <li><div class="multiline-icon"></div><span value="number">Number</span></li>
                                    <li><div class="radio-icon"></div><span value="radio">Radio</span></li>
                                    <li><div class="select-icon"></div><span value="select">Select</span></li>
                                    <li><div class="checkbox-icon"></div><span value="checkbox">Checkbox</span></li>
                                    <li><div class="date-icon"></div><span value="date">Date</span></li>
                                    <li><div class="time-icon"></div><span value="time">Time</span></li>
                                    <li><div class="file-icon"></div><span value="file">File</span></li>
                                    <!--<li><span value="reset">Reset</span></li>
                                    <li><span value="submit">Submit</span></li>-->
                                </ul>
                            </div>
                            <!--<h3 class="uk-accordion-title uk-accordion-title-primary">Group</h3>
                            <div class="uk-accordion-content">
                                <ul id="group">
                                    <li><span value="name">Name</span></li>
                                    <li><span value="address">Address</span></li>
                                </ul>
                            </div>-->
                            <h3 class="uk-accordion-title uk-accordion-title-primary">Advanced</h3>
                            <div class="uk-accordion-content">
                                <ul id="advanced">
                                    <li><div class="sign-icon"></div><span value="signature">Signature</span></li>
                                    <!--<li>
                                        <span value="placepicker">Place Picker</span>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                     </div>
                </div>
            </div>

        </div>
        <form class="uk-form-stacked" id="wizard_advanced_form" method="post" action ="">
            <input type="hidden" name="formToken" class="form_token" value ="" />
            <input type="hidden" name="form_name" class="form_name" value = " "/>
            <input type="hidden" name="form_desc" class="form_desc" value = ""/>
            <input type="hidden" name="form_category" class="form_category" value= "<?php echo $form_category; ?>" />
            <input type="hidden" name="form_location" class="form_location" value="<?php  ?>" />
            <input type="hidden" name="assign" class="assign" value="<?php echo $details->assign_to ?>" />
            <input type="hidden" name="assign_users" class="assign_users" value="<?php echo implode(",",$form_users); ?>" />
            <input type="hidden" name="assign_dept" class="assign_dept" /> 
            <input type="hidden" name="delete_fields" class="delete_fields" value = " "/>
            <input type="hidden" name="option_id" class="option_id" value = " "/>
            <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
        </form>
        <?php $this->load->view('form/template'); ?>
    </div>
</div>
</div>
<script type="text/javascript">
 var start_rows = <?php echo $start_rows; ?>; 
 var start_cols = <?php echo $start_rows; ?>;
 //$('.form_location').val(CryptoJS.AES.encrypt(JSON.stringify($('.form_location').val()),'',{format: CryptoJSAesJson}).toString());
 $('.assign_users').val(CryptoJS.AES.encrypt(JSON.stringify($('.assign_users').val()),'',{format: CryptoJSAesJson}).toString());
</script>