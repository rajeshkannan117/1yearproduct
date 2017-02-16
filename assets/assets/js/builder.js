jQuery.noConflict();
//( function($) 
jQuery(document).ready(function(){
    var $ = jQuery;
    comptField = 1;
    form_rows = 1;
    $("#add li span").draggable({
      helper: "clone",
      appendTo: "table.forms",
      drag:function(event,ui){
          $("#pages").find('.error').remove();
      }
    });
    $("td.config").droppable({
      greedy: true,
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
         // //console.log(ui);
        //$( this ).find( ".placeholder" ).remove();
        if(!$(this).find('.cols').length){
            type = ui.draggable.attr("value");
            html = $('#config_'+type).html();
            // Change field and label name
            reg=new RegExp("(myfieldname)", "g");
            html = html.replace(reg, 'myfieldname'+comptField);
            reg=new RegExp("(myfieldlabel)", "g");
            html = html.replace(reg, type+'label'+comptField);
            uktoggle = new RegExp("(portlet-content-"+type+")","g");
            html = html.replace(uktoggle,'portlet-content-'+comptField);
            uktab = new RegExp("(my-id-"+type+")","g");
            html = html.replace(uktab,'my-id-'+comptField);
            reqrules = new RegExp("(validation_rules)","g");
            html = html.replace(reqrules,'validation_rules_'+comptField);
            time = new RegExp("(time_format)","g");
            html = html.replace(time,'time_format_'+comptField);
            date = new RegExp("(date_format)","g");
            html = html.replace(date,'date_format_'+comptField);
            max = new RegExp("(maxtext)","g");
            html = html.replace(max,'max_'+comptField);
            min = new RegExp("(mintext)","g");
            html = html.replace(min,'min_'+comptField);
            //console.log(type);
            //if($('#config_0 li.empty').length > 0){
              //  $('#config_0 li.empty:first').removeClass('empty').removeClass('config').addClass(type+'_'+comptField).html('<div class="uk-panel config_'+type+' portlet">'+html+'</div>');
            //}else {
               $(this).prepend('<div class="cols uk-width-1-'+form_rows+' '+type+'_'+comptField+'"><div class="uk-panel config_'+type+' portlet">'+html+'</div></div>');
            //}
            $('div.'+type+'_'+comptField+' div.config_'+type).find('.edit_field').attr("data-toggle","portlet-content-"+comptField);     
            editable(type,comptField);
            $('#text_label').keyup(function(){
                var current_val= $(this).val();
                $(this).parents(".portlet:first").find('.title_label').val(current_val);
            });
            // Active tabs
            // Compt increment
            comptField++;
        }else{
            //console.log($(this).find('.cols').length);
            $(this).append('<span class="error">Single column have only one field</span>');
        }
      }
    });
    //droppable();
   // sortable();
    /*$('.row').sortable({
        //cancel: null, // Cancel the default events on the controls
        //connectWith: ".config"
        placeholder: "ui-state-highlight"

    }).disableSelection();*/
    /*$('.hidden').sortable({
        cancel: null, // Cancel the default events on the controls
        connectWith: ".config"
    }).disableSelection(); */
    $('.addRows').click(function(){
        var clone = $('tr.hidden').clone();
        var rows = $(clone).removeClass('hidden').addClass('row');
        $("#pages").append(rows);
        droppable();
        //sortable(rows);
        deleteRows();
        //$("#pages").append('<tr class="row"><td class="uk-width-1-3"><div class="config" id="config_0"></div></td><td class="uk-width-1-3"><div class="config" id="config_1"></div></td><td class="uk-width-1-3"><div class="config" id="config_2"></div></td> </tr>');
    });
    function deleteRows(){
        $('.deleteRows').click(function(){
            var len = $(this).parent().parent().find('.cols').length;
            var current = this;
            if(!len){
                $(this).parent().parent().remove();
            }else{
                UIkit.modal.confirm('Are you sure, you want to delete this row?', 
                    function(){
                        $(current).parent().parent().remove();
                });
            }
        });
    }
    
    function sortable(rows){
        rows.sortable({
            cancel: null, // Cancel the default events on the controls
            connectWith: ".config",
            containment: 'parent',
            placeholder: "ui-state-highlight"

            /*beforeStop:function(event,ui){
                //console.log(event);
                //console.log(this);
                //console.log(ui.position);
            }*/
        }).disableSelection();
    }
    
    function droppable(){
        $("td.config").droppable({
            greedy: true,
            activeClass: "ui-state-default",
            hoverClass: "ui-state-hover",
            accept: ":not(.ui-sortable-helper)",
            drop: function( event, ui ) {
            if(!$(this).find('.cols').length){
                type = ui.draggable.attr("value");
                html = $('#config_'+type).html();
                // Change field and label name
                reg=new RegExp("(myfieldname)", "g");
                html = html.replace(reg, 'myfieldname'+comptField);
                reg=new RegExp("(myfieldlabel)", "g");
                html = html.replace(reg, type+'label'+comptField);
                uktoggle = new RegExp("(portlet-content-"+type+")","g");
                html = html.replace(uktoggle,'portlet-content-'+comptField);
                uktab = new RegExp("(my-id-"+type+")","g");
                html = html.replace(uktab,'my-id-'+comptField);
                reqrules = new RegExp("(validation_rules)","g");
                html = html.replace(reqrules,'validation_rules_'+comptField);
                time = new RegExp("(time_format)","g");
                html = html.replace(time,'time_format_'+comptField);
                date = new RegExp("(date_format)","g");
                html = html.replace(date,'date_format_'+comptField);
                max = new RegExp("(maxtext)","g");
                html = html.replace(max,'max_'+comptField);
                min = new RegExp("(mintext)","g");
                html = html.replace(min,'min_'+comptField);
                //console.log(type);
                //if($('#config_0 li.empty').length > 0){
                  //  $('#config_0 li.empty:first').removeClass('empty').removeClass('config').addClass(type+'_'+comptField).html('<div class="uk-panel config_'+type+' portlet">'+html+'</div>');
                //}else {
                   $(this).prepend('<div class="cols uk-width-1-'+form_rows+' '+type+'_'+comptField+'"><div class="uk-panel config_'+type+' portlet">'+html+'</div></div>');
                //}
                $('div.'+type+'_'+comptField+' div.config_'+type).find('.edit_field').attr("data-toggle","portlet-content-"+comptField);     
                editable(type,comptField);
                $('#text_label').keyup(function(){
                    var current_val= $(this).val();
                    $(this).parents(".portlet:first").find('.title_label').val(current_val);
                });
                // Active tabs
                // Compt increment
                comptField++;
            }else{
                //console.log($(this).find('.cols').length);
                $(this).append('<span class="error">Single column have only one field</span>');
            }
          }
        });
    }

  /*  $( ".portlet-header .edit_field" ).on('click',function(e) { 
            var toggle = $(this).data('toggle');
            e.preventDefault();
            //console.log(toggle);
            $( this ).parents( ".portlet:first" ).find( "."+toggle).toggle();
    });*/

    $(document).on('click','span.addRadio', function(e){
        //console.log('Twice Radio');
        e.preventDefault();
        _parent = $(this).parent().parent().parent().parent().parent().parent();
        html ='<div class="uk-width-medium-1-3">';
        html +='  <div class="uk-form-controls">';
        html +='    <input type="text" value="" class="select_option select_option_label uk-width-1-1" placeholder="Label" data-optionid="0">';
        html +='  </div>';
        html +='</div>';
        html +='<div class="uk-width-medium-1-3">';
        html +='  <div class="uk-form-controls">';
        html +='    <input type="text" value="" class="select_option select_option_value uk-width-1-1" placeholder="Value">';
        html +='  </div>';
        html +='</div>';
        html +='<div class="uk-width-medium-1-3">';
        html +='  <div class="uk-form-controls">';
        html +='     <span class="deleteOption"></span>';
        html +='  </div>';
        html +='</div>';
        //html = $('div.option:first', _parent).html();
       // //console.log($(html).find("[data-optionid]").removeData('optionid'));
        ////console.log(html);
        $('div.option:last', _parent).after('<div class="uk-grid option">'+html+'</div>');
        return false;
    });

        $(document).on('click','span.addCheck', function(e){
            //console.log('Twice check');
            e.preventDefault();
            _parent = $(this).parent().parent().parent().parent().parent().parent();
            //html = $('div.option:first', _parent).html();
            html ='<div class="uk-width-medium-1-3">';
            html +='  <div class="uk-form-controls">';
            html +='    <input type="text" value="" class="select_option select_option_label uk-width-1-1" placeholder="Label" data-optionid="0">';
            html +='  </div>';
            html +='</div>';
            html +='<div class="uk-width-medium-1-3">';
            html +='  <div class="uk-form-controls">';
            html +='    <input type="text" value="" class="select_option select_option_value uk-width-1-1" placeholder="Value">';
            html +='  </div>';
            html +='</div>';
            html +='<div class="uk-width-medium-1-3">';
            html +='  <div class="uk-form-controls">';
            html +='     <span class="deleteOption"></span>';
            html +='  </div>';
            html +='</div>';
            $('div.option:last', _parent).after('<div class="uk-grid option">'+html+'</div>');
            return false;
        });

        $(document).on('click','span.addDrop', function(e){
            //console.log('Twice Drop');
            e.preventDefault();
            _parent = $(this).parent().parent().parent().parent().parent().parent();
            //html = $('div.option:first', _parent).html();
            html ='<div class="uk-width-medium-1-3">';
            html +='  <div class="uk-form-controls">';
            html +='    <input type="text" value="" class="select_option select_option_label uk-width-1-1" placeholder="Label" data-optionid="0">';
            html +='  </div>';
            html +='</div>';
            html +='<div class="uk-width-medium-1-3">';
            html +='  <div class="uk-form-controls">';
            html +='    <input type="text" value="" class="select_option select_option_value uk-width-1-1" placeholder="Value">';
            html +='  </div>';
            html +='</div>';
            html +='<div class="uk-width-medium-1-3">';
            html +='  <div class="uk-form-controls">';
            html +='     <span class="deleteOption"></span>';
            html +='  </div>';
            html +='</div>';
            $('div.option:last', _parent).after('<div class="uk-grid option">'+html+'</div>');
            return false;
        });

        /*$(document).on('click','.portlet-header .delete_field', function() {
            $(this).parent().parent().parent().parent().parent().remove(); 
        });
        /*Delete Fields 
        $(document).on('click','.portlet-header .delete_fields', function() {
            _parent = $(this).parent().parent().parent(); 
            type = $(_parent).find('div.portlet-content').attr('type');
            $('.delete_fields').val($('.delete_fields').val()+','+$(_parent).find("."+type+"_datafieldId").val());
            $(_parent).remove();
            
        }); */
        $(document).on('click','.portlet-header .delete_field', function() {
            var current = this
            UIkit.modal.confirm('Are you sure, you want to delete this field?',function(){ 
                $(current).parent().parent().parent().parent().parent().remove(); 
            });
        });
        /*Delete Fields */
        $(document).on('click','.portlet-header .delete_fields', function() {
            var current = this;
            UIkit.modal.confirm('Are you sure, you want to delete this field?',function(){ 
                _parent = $(current).parent().parent().parent(); 
                type = $(_parent).find('div.portlet-content').attr('type');
                $('.delete_fields').val($('.delete_fields').val()+','+$(_parent).find("."+type+"_datafieldId").val());
                $(_parent).remove();  
            });
        });
  
  
        // Delete option        
        $(document).on('click','span.deleteOption',function(){ 
            _parent = $(this).parent().parent().parent().parent();
            /*_type = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent();
            console.log($(_type).attr('type'));
            // If the first option already exists
            if($('.option', _parent).length > 2) {
                var current = $(this).parent().parent().parent();
                $('.delete_options').val($('.delete_options').val()+','+$(current).find(".select_option_label").data('optionid'));
                $(this).parent().parent().parent().remove();
            }*/
            _type = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('type');
           if(_type !== 'checkbox'){
                console.log(_type);
                if($('.option', _parent).length > 2) {
                    var current = $(this).parent().parent().parent();
                    $('.delete_options').val($('.delete_options').val()+','+$(current).find(".select_option_label").data('optionid'));
                    $(this).parent().parent().parent().remove();
                }
            }else{
                 if($('.option', _parent).length > 1) {
                var current = $(this).parent().parent().parent();
                    $('.delete_options').val($('.delete_options').val()+','+$(current).find(".select_option_label").data('optionid'));
                    $(this).parent().parent().parent().remove();
                 }
            } 
            return false;
        });  

    // Editable
    function editable(type,comptField) {
        // Unbind click on edit icon
        $( ".portlet-header .edit_field" ).unbind('click');
        $( ".portlet-header .delete_field" ).unbind('click');
        // Create event on edit icon to show edit box
        
        $( ".portlet-header .edit_field" ).on('click',function(e) { 
            var toggle = $(this).data('toggle');
            e.preventDefault();
            checkToggle(this);
            /*if(!$(this).parent().find('.uk-icon-save').length){
                $(this).parent().prepend('<i class= "uk-icon-save uk-float-right"></i>');
            }else{
                $(this).parent().find('.uk-icon-save').remove();//('<i class= "uk-icon-save uk-float-right"></i>');
            }*/
            $( this ).parents( ".portlet:first" ).find( "."+toggle).toggle();
            //var parent = $(this).parent().parent().parent().parent().parent();
            var current = $(this).parent().parent().parent().parent();
            if($(this).data('on') === 0){
                $(current).animate({
                    //width:'350px'
                });
              //  $()
                $(this).data('on', 1);
            }else{
                $(this).data('on', 0);
                $(current).animate().removeAttr('style');
            }

        });
        $( ".portlet-content-"+comptField+" div.tab > div").eq(1).addClass('uk-hidden');
        $( ".portlet-content-"+comptField+" div.tab ul li:first").addClass('uk-active');
        $(".portlet-content-"+comptField+" li a").on('click',function(){
            var current_attr =  $(this).attr('href');
            var grandparent = $(this).parent().parent().parent().parent().attr('class').split(" ");
            var current_class =  $(this).parent().attr('class');
            if(current_attr == '#tabs-3'){
                $(this).parent().prev().removeClass('uk-active');
                $(this).parent().removeClass().addClass('uk-active');                
            }
            else{
                $(this).parent().next().removeClass('uk-active');
                $(this).parent().removeClass().addClass('uk-active'); 
            }
            if($('div.'+grandparent[1]+" "+current_attr).hasClass('uk-hidden')){
                /* div  */
                $('.'+grandparent[1]+' div'+current_attr).removeClass('uk-hidden');
                $('.'+grandparent[1]+' div'+current_attr).addClass('uk-active');
                if(current_attr == '#tabs-3'){
                    $('.'+grandparent[1]+' div'+current_attr).prev().removeClass('uk-active').addClass('uk-hidden');
                }
                else{
                    $('.'+grandparent[1]+' div'+current_attr).next().removeClass('uk-active').addClass('uk-hidden');                    
                }
            }
            return false;
        });
    }

    function checkToggle(e){
        $('div.cols > div').each(function(i,v){
            toggle = $(v).find(".edit_field").data('toggle');
            ////console.log(toggle);
            if(!$("."+toggle).is(':hidden')){
                $(this).parent().find('.uk-icon-save').remove();
                $('.'+toggle).slideUp();
            }
        });
    }
$('#text_label').keyup(function(){
    alert('sadf');
    var cur_val = $(this).val();
    var grand_parent = $(this).parent().parent().parent().parent().parent().parent().parent();
    $(grand_parent).find('.title_label').val(cur_val);
    //console.log(grand_parent);
});
    // Build Form data as JSON

    $('.valid_field').click(function(){
        error = validate_fields();
        // Create code
        if($.inArray(1,error) == -1) {
            // Hide errors
            $('#form_error').hide();
            // Show code
            $('#code').show();
            $('.error').remove();
            // Build codes */
                formDatas = genereateFields();
                //console.log(formDatas);
                formDelete = deleteFields();
                //console.log(formDelete);
                formId = $("table.forms").data('form_id');
                state = $("ul#add").data('state');
                // Call the ajax builder
                var baseURL = $('body').data('baseurl');
                $.ajax({    
                    url: baseURL+'form/add',
                    data: {
                        'form_content' : formDatas,
                        'delete_content': formDelete,
                        'form_id'    : formId,
                        'step'      : 2
                    },
                    beforeSend: function(){
                            // Handle the beforeSend event
                            UIkit.modal.alert('Please wait',function(){
                            });
                    },
                    dataType: 'json',
                    type: 'post', 
                    success: function(data){
                       if(data){
                            //window.location.href= baseURL+'form/edit_form/'+formId;
                            if($('.preview').hasClass('hide')){
                                $('.preview').removeClass('hide').addClass('show');
                               /* UIkit.modal.alert('Forms created successfully Click the preview button to view the form and save the form',function(){
                                    window.location.href= baseURL+'form/preview/'+formId;
                                });*/
                            }else{
                                /*UIkit.modal.alert('Forms created successfully Click the preview button to view the form and save the form',function(){
                                    window.location.href= baseURL+'form/preview/'+formId;
                                });*/
                            }
                       }
                    },
                    complete:function(){
                        window.location.href= baseURL+'form/preview/'+formId;
                    }
                });
        } else {
            // Show errors principal div
          //  $('#form_error').show();
            $('#form_error').html('<p class="error">Configuration error, please check fields !</p>');
            // Hide code selection
            $('#code').hide();
        }
    });
    
    function deleteFields(){
        deletes={};
        deletes.fields = $('.delete_fields').val();
        deletes.options = $('.delete_options').val();
        return JSON.stringify(deletes);
    }

    function genereateFields(){
            var type;
            fields={};
            var pages = new Array();
            var array = new Array();
            $('.forms tr td').each(function(index,value){
                var row = new Array();
                var r = 0;
                if($(value).find('#pages').length){
                    $(value).find('table#pages tr').each(function(ro,pages){
                        if($(pages).hasClass('hidden') == false){
                            var col = new Array();
                            var i = 0;
                            $(pages).find('td').each(function(c,cols){
                                if(!$(cols).find('.deleteRows').length){
                                    if($(cols).find('.cols').length){
                                        var self = $('div:first',cols);
                                        var type = $(cols).find('div.portlet-content').attr('type');
                                        if(type != undefined){
                                            ////console.log($('.portlet-content',cols).parent());
                                            col[i] = generateObjects(type,$('.portlet-content',self).parent(),index);
                                        }else{
                                            col[i] = null;
                                        }
                                    }else{
                                        col[i] = null;
                                    }
                                }
                                i++;
                            });
                            row[r] = col;
                            r++;
                        }
                    });
                    pages[index] = row;
                }
            });
            
           /* $("#pages").each(function(index,value){ 
                var columns_length = 3;
                ////console.log(columns_length);
                for(i= 0;i<columns_length;i++){
                    array.push($("div#config_"+i+" div.cols").size());
                }
                maxs = array.max();
                var row = new Array();
                var incr = 0;
                for(i = 0;i<maxs;i++){
                     var col = new Array();
                    for(j=0;j<columns_length;j++){
                        var self = $('div#config_'+j+' div.cols > div');
                        var test = $('.portlet-content',self).eq(i);
                        var type = $('.portlet-content',self).eq(i).attr('type');
                       if(type != undefined){
                            col[j]=generateObjects(type,$(test).parent(),i);
                       }
                       else{
                        col[j] = null;
                       }
                    }
                    row[incr++]=col;
                }
                pages[index]=row;
            });*/

        fields.fields = pages;
        
        return JSON.stringify(fields);

    }

    Array.prototype.max = function() {

         return Math.max.apply(null, this);
    
    };

    function generateObjects(type,thisobj,i){

            ////console.log(thisobj);

            fielddata = {};

            validationfields = ["req","isna","isnoz","email","alpha"];

            rclass =  $('.portlet-content', thisobj).attr('class').split(" ");

            id = rclass[1].split("-");
            if($('.portlet-content',thisobj).data('fieldid')){
                fielddata.fieldid =$('.portlet-content',thisobj).data('fieldid').toString();
            }else{
                fielddata.fieldid =String($('.'+type+'_datafieldId', thisobj).val());
            }
            fielddata.type = type;
            // Add var for field name
            var name = String($('.'+type+'_name', thisobj).val());
            replace = /[^A-Za-z0-9]+/g;
            fielddata.name = name.replace(replace,'');
             if(type === 'submit'){
                fielddata.name = 'submit';
            }
            if(type === 'heading'){
                fielddata.name = 'heading';
            }
            // Add var for field label
            fielddata.title = $('.'+type+'_label', thisobj).val();
            // Add var for field value if exists
            if($('.'+type+'_value', thisobj) != undefined) {
                fielddata.value = $('.'+type+'_value', thisobj).val();
            }

            //placeholder
            if($('.portlet-content',thisobj).find('.placeholder_'+type+'_label').length){
                var placeholder = $('.placeholder_'+type+'_label',thisobj).val();
                fielddata.placeholder = String(placeholder);
            }
            //survey
            if($('.portlet-content',thisobj).find('.survey_'+type).length){
              surveyName = $('.survey_'+type,thisobj).val();
              fielddata.survey=surveyName;
            }
            fielddata.datafieldId = String($('.'+type+'_datafieldId', thisobj).val());
            
            // Select
            if(type == 'select' || type == 'checkbox' || type == 'radio') {
                // Init action
                fielddata.optionid = new Array;
                switch(type) {
                    case 'select' :
                        title_select = $('.portlet-header .select', thisobj);
                        // Clear content
                        //select_html'<select name="'+$('.'+type+'_name', this).val()+'">';
                        title_select.html('');
                        title_select.html("<select id='select_"+i+"'></select>");
                        // Create new array JS
                        fielddata.options_label = new Array;
                        fielddata.options_value = new Array;
                        break;
                    case 'checkbox' :
                        title_select = $('.portlet-header .title_checkbox', thisobj);
                        // Clear content
                        title_select.html('');
                        // Create new array JS
                        
                        fielddata.checkbox_label = new Array;
                        fielddata.checkbox_value = new Array;
                        break;
                    case 'radio' :
                        title_select = $('.portlet-header .title_radio', thisobj);
                        // Clear content
                        title_select.html('');
                        // Create new array JS
                        fielddata.radio_label = new Array;
                        fielddata.radio_value = new Array;
                        break;
                }
                 // Action element by element
                $('.select_option_label ', $(thisobj)).each(function(index){
                    switch(type) {
                        case 'select' :
                            // Create options to HTML view
                            //title_select.append('<option id="select_'+index+'_'+i+'">'+$(this).val()+'</option>');

                            $('<option>').val('').text($(this).val()).appendTo('#select_'+i);
                            // Create options for JS array
                            fielddata.options_label.push($(this).val());
                            fielddata.optionid.push($(this).data('optionid'));
                            break;
                        case 'checkbox' :
                            // Create options to HTML view
                            title_select.append('<input type="checkbox" id="check_'+index+'_'+i+'" /> <span class="title_value">'+$(this).val()+'</span> ');
                            // Create options for JS array
                            fielddata.checkbox_label.push($(this).val());
                            fielddata.optionid.push($(this).data('optionid')); 
                            break;
                        case 'radio' :
                            // Create options to HTML view
                            title_select.append('<input type="radio" id="radio_'+index+'_'+i+'" /> <span class="title_value">'+$(this).val()+'</span> ');
                            // Create options for JS array
                            fielddata.radio_label.push($(this).val());
                            fielddata.optionid.push($(this).data('optionid'));
                            break;
                    }
                    
                });
                 // Action element by element
                $('.select_option_value ', $(thisobj)).each(function(index){
                    switch(type) {
                        case 'select' :
                            // Create options to HTML view
                            $("#select_"+index+"_"+i).val($(this).val());
                            //title_select.append('<option>'+$(this).val()+'</option>');
                            // Create options for JS array
                            fielddata.options_value.push($(this).val());
                            break;
                        case 'checkbox' :
                            // Create options to HTML view
                            $("#check_"+index+"_"+i).val($(this).val());
                           //title_select.append('<input type="checkbox" /> <span class="title_value">'+$(this).val()+'</span> ');
                            // Create options for JS array
                            fielddata.checkbox_value.push($(this).val());
                            break;
                        case 'radio' :
                            // Create options to HTML view
                             $("#radio_"+index+"_"+i).val($(this).val());
                            //title_select.append('<input type="radio" /> <span class="title_value">'+$(this).val()+'</span> ');
                            // Create options for JS array
                            fielddata.radio_value.push($(this).val());
                            break;
                    }
                    
                });
            }
                            
            // File
            if(type == 'file') {
                // Stringify tab of fileformat
                if($('.file_format', $(thisobj)).val() != null) {
                    fielddata.file_format = JSON.stringify($('.file_format', $(thisobj)).val());
                }
                // Add filesize
                if($('.maxfilesize', $(thisobj)).val() != null) {
                    fielddata.maxfilesize = $('.maxfilesize', $(thisobj)).val();
                }
            }
            rules = $("#validation_rules_"+id[2]).val();
            //console.log(rules);
            if(rules === 'req'){
                fielddata.rules= 1;
            }else{
                fielddata.rules=rules;
            }
            if(type === 'time'){
                format = $("#time_format_"+id[2]).val();
                fielddata.format = format;
            }
            if(type === 'date'){
                format = $("#date_format_"+id[2]).val();
                fielddata.format = format;
            }
            if(type === 'textarea'){
                //console.log(type);
                //console.log(id[2]);
                min = $('#min_'+id[2]).val();
                //console.log(min);
                max = $('#max_'+id[2]).val();
                fielddata.min = min;
                fielddata.max = max;
            }
            return fielddata;
    }
    
    function validate_fields(){
        // Init
        var error = new Array();
        var count =0;
        $('.form_error > p.error').remove();
        $('.forms tr td').each(function(index,value){
            if($(value).find('#pages').length){
                $(value).find('table#pages tr').each(function(ro,pages){
                    if($(pages).hasClass('hidden') == false){
                        $(pages).find('td').each(function(c,cols){
                            if(!$(cols).find('.deleteRows').length){
                                if($(cols).find('.cols').length){
                                    var self = $('div:first',cols);
                                    var type = $(cols).find('div.portlet-content').attr('type');
                                    if(type !== undefined){
                                        ////console.log($('.portlet-content',cols).parent());
                                        error.push(validate(self));
                                        //error = generateObjects(type,$('.portlet-content',self).parent(),index);
                                    }
                                    count++;
                                }
                            }
                        });
                    }else{
                        //console.log('type');
                    }
                });
            }
        });
        //console.log(count);
        if(count === 0){
           error.push(1);
            if(!$(".form_error > p").hasClass('error')){   
                $(".form_error").html('<p class="error">Please select fields to create a Form</p>');
           }
         }
        return error;
    }
    function validate(thisobj){
       var errorDiv = 0;
       var error = 0;
       var count = 0;
       tabFieldName = new Array;
        _parent = $('.portlet-content', thisobj);
        _grandParent = $(_parent).parent();
        // remove all errors
         $('.error', _parent).remove();
        type = $(_parent).attr('type');
        if(type !== undefined){
              // Fieldname can\'t be empty & can\'t contain spaces or special character (min : 3 char, max 40 chars)
              textName = $('.'+type+'_name', _parent);
              str = String(textName.val());
              replace = /[^A-Za-z0-9]+/g;
              str = str.replace(replace,'');
              /* reg = new RegExp("^\s*([0-9a-zA-Z\-\_]{3,40})\s*$");*/

              /* It allows underscore,numbers,alphabets */
              var regexp = /^[a-zA-Z0-9-_]+$/;
              if (str.search(regexp) == -1){
                  textName.after('<p class="error">Can not be empty & can not contain spaces or special character.Underscore allowed</p>');
                  errorDiv = error = 1;
                  _grandParent.addClass('field_error');
              }
              
              //Check place holder is present
              if($(_parent).find('.placeholder_'+type+'_label').length){
                  var reg_exp_place = /^\S[\w*\d*\-_\s!@#$%/&*;:'"+=.,]{0,}$/ig;
                  var placeholder = $('.placeholder_'+type+'_label',_parent);
                  var values = String(placeholder.val());
                  if(values.search(reg_exp_place) == -1){
                      placeholder.after('<p class="error">Placeholder field not be empty</p>');
                      errorDiv = error = 1;
                       _grandParent.addClass('field_error');
                  }
              }
              
              // check survey name
              
              surveyName = $('.survey_'+type,_parent);
              var reg_exp_survey = /^\S[\w*\d*\-_\s!@#$%/&*;:'"+=.,]{0,}$/ig;
              surveyValue = String(surveyName.val());
              if(surveyValue.search(reg_exp_survey) == -1){
                  surveyName.after('<p class="error">Survey Field not be empty</p>');
                   errorDiv = error = 1;
                   _grandParent.addClass('field_error');
              }
              
              // Check Fields name is already exists or not
              if($.inArray(textName.val(), tabFieldName) == -1) {

                  tabFieldName.push(textName.val());
                  if(_grandParent.hasClass('field_error')){
                          _grandParent.removeClass('field_error');
                      }

              } else {

                  textName.after('<p class="error">Your field name already exists !</p>');
                  errorDiv = error = 1;
                  _grandParent.addClass('field_error');
              }

              // Field label can't be empty (min : 3 char, max 40 chars) 
              // It allows space underscore numbers and alphabets 
              var reg_exp_label = /^[a-zA-Z0-9-_ !@#$%/&*;:'"+=.,]{3,}$/;
              textName = $('.'+type+'_label', _parent);
              str = String(textName.val());
              if(type != 'hidden' && type != 'reset' && type != 'submit') {
                  //reg = new RegExp("^\s*([0-9a-zA-Z\-\_\'\ ]{3,40})\s*$");
                  if (str.search(reg_exp_label) == -1){
                      textName.after('<p class="error">Cant be empty (min : 3 char, max 20 chars)</p>');
                      errorDiv = error = 1;
                     _grandParent.addClass('field_error');
                  } else {
                      if(_grandParent.hasClass('field_error')){
                          _grandParent.removeClass('field_error');
                      }
                      $('.title_label', this).html(str);
                  }
              } else {
                  if(_grandParent.hasClass('field_error')){
                          _grandParent.removeClass('field_error');
                      }
                  $('.title_label', this).html(str);
              }

              // Reset and Submit can\'t be empty (min : 3 char, max 40 chars)
              var reg_exp_reset_submit = /^[a-zA-Z-_ !@#$%/&*;:'"+=.,]{3,}$/;
              if(type == 'reset' || type == 'submit') {
                  textName = $('.'+type+'_label', _parent);
                  str = String(textName.val());
                  //reg = new RegExp("^\s*([0-9a-zA-Z\-\_\'\ ]{3,40})\s*$");
                  //if(reg.test(str) == false) {
                  if (str.search(reg_exp_reset_submit) == -1){
                      textName.after('<p class="error">Can\'t be empty (min : 3 char, max 20 chars)</p>');
                      errorDiv = error = 1;
                      _grandParent.addClass('field_error');
                      //_grandParent.css('border-color', 'red');
                  }
                  else{
                      if(_grandParent.hasClass('field_error')){
                          _grandParent.removeClass('field_error');
                      }
                      $('.title_label', this).html(str);       
                  } 
              }

              // Check options for select, checkbox and radio
              //var reg_exp_select = /^\S[\w*\d*\-_\s]{0,}$/ig;
              var reg_exp_select = /^\S[\w*\d*\-_\s!@#$%/&*;:'"+=.,]{0,}$/ig;
              if(type == 'select' || type == 'checkbox' || type == 'radio') {
                  // Options can\'t be empty & can\'t contain spaces or special character (min : 1 char, max 40 chars)
                  $('.select_option', _parent).each(function(){
                      textName = $(this);
                      myParent = $(this).parent();
                      str = String(textName.val());
                      if (str.search(reg_exp_select) == -1){
                          $(':last', myParent).after('<p class="error">Cannot be empty</p>');
                          errorDiv = error = 1;
                         _grandParent.addClass('field_error');
                      } 
                  });
              }
              count++;
              //console.log(count);
        }
        //console.log(count);
        /* None of them is Selected it Returns Error */
        if(count === 0){
            errorDiv = error = 1;
            if(!$(".form_error > p").hasClass('error')){   
                $(".form_error").html('<p class="error">Please select fields to create a Form</p>');
           }
         }
        return error;
    }
    $("a#status").click(function(){

        var id = $(this).data('id');

        var status = $(this).attr('class');

        //console.log(status);

        ajaxCall(id,status,this);

        return false;

    });
          
});
    
