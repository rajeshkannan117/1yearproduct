(function(w,d,$){
    $(document).ready(function($){
        var rowid = start_rows ;
        var form_rows = 1;
        var colid = start_cols;
        var comptField = 1;
        var dialog;
        var todrag = $("#basic li span,#group li span,#advanced li span");
        var pages = $("#pages");
        var cols = $(".connected"); 
        rowid = rowid+1;
        todrag.draggable({
          containment : "#container",
          helper: "clone",
          start:function(){
            pages.find('.drop_elements').remove();
            if($("#rows_"+rowid).length){
                var dragstart='<ul id="rows_'+rowid+'" class="connected"></ul>';
                 $(dragstart).droppable( droppable ).last($("ul#rows_"+rowid));
            }else{
            var dragstart = '<li class="rows uk-width-1-1" id="rows_'+rowid+'"><ul id="rows_'+rowid+'" class="connected"></ul></li>';
             $(dragstart).droppable( droppable ).appendTo(pages);
            }
           
            rowid++;
                    //console.log(rowid);
           },
           drag:function(event,ui){
                $(ui.helper).width(125),$(ui.helper).addClass("addField"),$(ui.helper).find("p").show()
            },zIndex:999,
           stop:function(){
            $(this).removeClass('addField');

           }

        });
        /*var scroll =  common.hasScrollBar($('#forms'));
        if(scroll){
            var myDiv = $("#forms");
            var scrollto = myDiv.offset().top + (myDiv.height() / 2);
            myDiv.animate({ scrollTop:  scrollto});
        }*/
        pages.children(':first').droppable(droppable).on('scroll',function(){
            var myDiv = $("#forms");
                var scrollto = myDiv.offset().top + (myDiv.height() / 2);
                console.log(scrollto);
                myDiv.animate({ scrollTop:  scrollto});
        });
        var droppable ={
            drop: function( event, ui) {                
                var type = ui.draggable.attr("value");
                var row_id = $(event.target).attr('id');               
                var collength = common.countcollength(row_id);
                if(type !== undefined){
                    if(collength <= 3){
                        html = $('#config_'+type).html();
                        /* Set individual required field as unique id */
                        reg = new RegExp("(text_check)", "g");
                        html = html.replace(reg, 'text_check_'+comptField);
                        /* Set individual edits field as unique id */
                        reg = new RegExp("(edits)", "g");
                        html = html.replace(reg, 'edits_'+comptField);
                        /* Set individual options as field as unique id */
                        reg = new RegExp("(choices)", "g");
                        html = html.replace(reg, 'choices_'+comptField);
                        reg = new RegExp("(open_options)" , "g");
                        html = html.replace(reg, 'open_options_'+comptField);
                        reg = new RegExp("(date_value)", "g");
                        html = html.replace(reg, 'date_value_'+comptField);
                        reg = new RegExp("(cur_date)", "g");
                        html = html.replace(reg, 'cur_date_'+comptField);
                        reg = new RegExp("(date_formats)", "g");
                        html = html.replace(reg, 'date_formats_'+comptField);
                        reg = new RegExp("(dates_format)", "g");
                        html = html.replace(reg, 'dates_format_'+comptField);
                        reg = new RegExp("(time_value)", "g");
                        html = html.replace(reg, 'time_value_'+comptField);
                        reg = new RegExp("(cur_time)", "g");
                        html = html.replace(reg, 'cur_time_'+comptField);
                        reg = new RegExp("(time_formats)", "g");
                        html = html.replace(reg, 'time_formats_'+comptField);
                        reg = new RegExp("(times_format)", "g");
                        html = html.replace(reg, 'times_format_'+comptField);
                        var append_div = '<li class="columns uk-width-1-'+collength+'" id="columns_'+collength+'"><div class="cols uk-width-1-'+form_rows+' '+type+'_'+colid+'"><div class="uk-panel config_'+type+' portlet">'+html+'</div></div></li>'; 
                        $('ul#'+row_id).append(append_div);
                        common.auto_update_text(type);
                        var col = $(this).attr('id');            
                        var colid = $(append_div).attr('id');
                        var ro = $('ul#'+col+' '+'li.columns');
                        var maxHeight =$('#'+colid).height('');
                        ro.each(function(){ 
                            $(this).css('height','');
                            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
                        });
                        ro.each(function(){
                            $(this).css('height',maxHeight);
                        });
                        if(type === 'radio' || type === 'checkbox' || type === 'select' || type === 'time' || type === 'date'){
                            dialog = popup_initialize('choices_'+comptField,this,type,row_id,"columns_"+collength);
                            common.options_open(type,type+'_'+colid,'choices_'+comptField,dialog);
                            common.open_dialog(type,type+'_'+colid,'choices_'+comptField,'open_options_'+comptField,dialog);
                            rowid++;
                        } 
                        colid++;
                        var rows = $('.rows');
                        var empty_li = 0;
                        /* Remove li has zero columns */
                        rows.each(function(){
                            var length = $('ul.connected',this).find('li.columns').size();
                            if(length === 0){
                                ++empty_li;
                                if(empty_li > 2){
                                    $(this).remove();   
                                }
                            }else{
                                $id = $('ul.connected',this).attr('id');
                                if($id !== undefined){
                                    //console.log($id);
                                }
                                if($(this).find('.highlight')){
                                    $(this).find('.highlight').remove();
                                }
                            }
                        });
                        /* Resize the column width based upon its size */
                        $('.resize').each(function(){
                              var length = $('ul.connected',this).find('li.columns').size();
                              var width ='uk-width-1-'+length;
                              var left_div = 'titl-field'+length+' left_setting';
                              var right_div ='hover-icons'+length+' right_setting hover-icons action';
                              var columns = $('.columns');
                              $('.columns',this).each(function(){
                                    $(this).removeClass().addClass(width).addClass('columns').css('width','');
                                    $(this).find('.left_setting').removeClass().addClass(left_div);
                                    $(this).find('.right_setting').removeClass().addClass(right_div);
                                });
                            $(this).removeClass('resize');
                        });
                        if($("#"+row_id).hasClass("dropover")){
                            $("#"+row_id).removeClass('dropover');
                        }
                        if($("#"+row_id).find('.columns').hasClass("dropovers")){
                            $("#"+row_id).removeClass('dropovers');
                        }
                    }   
                    else{
                        return false;
                    }
                }
                comptField++;
            },
            out:function(event,ui){
                if($("ul#pages").find('.highlight')){
                    $(this).find('.highlight').remove();
                }
            },
            over :function(event,ui){
                var rowid = $(event.target).attr('id');
                /* Remove highlighted area */
                $('#pages').find('.highlight').remove(); 
                var colcount = $('ul#'+rowid).find('.columns').length;
                //console.log(colcount);
                if(colcount === 1){
                    width = 100/2+'%';
                    $('#'+rowid).find('.columns').css('width',width);
                    var over_id = $('li.columns','ul#'+rowid).last().attr('id');
                    if(over_id != undefined){
                            if($("#"+rowid).find('.highlight').size() == 0){
                            $('#'+rowid+' li#'+over_id).after('<li class="highlight" style="width:'+width+'"></li>');
                        }
                    }
                }else if(colcount === 2){
                    width = 100/3+'%';
                    $('#'+rowid).find('.columns').css('width',width);
                    var over_id = $('li.columns','ul#'+rowid).last().attr('id');
                    if(over_id != undefined){
                            if($("#"+rowid).find('.highlight').size() == 0){
                            $('#'+rowid+' li#'+over_id).after('<li class="highlight" style="width:'+width+'"></li>');
                        }
                    }
                }   
                else if(colcount === 0){
                    width = 100+'%';
                    $('li#'+rowid).find('.columns').css('width',width);
                    if($("ul#"+rowid).find('li').size() == 0){
                        $('ul#'+rowid).after('<li class="highlight" style="width:'+width+'"></li>');
                    }
                }
                $('#'+rowid).find('.columns');
                //console.log("Over "+rowid+" Count "+colcount);
                var rows = $('.rows');
                rows.each(function(){
                    if($(this).hasClass('dropover')){
                        $(this).removeClass('dropover');
                    }
                }); 
                $('#'+rowid).addClass('dropover resize');
                $('#'+rowid).find('.columns').addClass('dropovers');
            },
        }

///max height
    pages.children().droppable(droppable).on('scroll',function(){
            $(this).scrollTop();
        });



        $(d).on("blur",".title_labels" ,function () {
            var txt = $(this).val();
            current = $(this).parent().parent();
            var type = $(current).find('.required').data('type');
            if(current.find('.check-red').length > 0){
                txt +='<span class ="req">*</span>';
            }
            currents = $(this).parent().parent().parent().parent().parent().parent().parent();
            $(this).replaceWith("<label class='title_label'>"+txt+"</label>");
            var col = $(currents).attr('id'); //column id
            var ro = $('ul#'+col+' '+'li.columns');
            var colid = $(current).closest("li").attr('id');
            var maxHeight =$('#'+colid).height('');
            ro.each(function(){ 
                $(this).css('height','');
                maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height(); 
            });
            ro.each(function(){
                $(this).css('height',maxHeight);
            });
        });

        $(d).on("click",'.edit_field',function(){
            //UIkit.modal.prompt('Name:','', function(val){ Console.log(val) });
        });
        $(d).on("mouseover",".columns",function(){
            var id = $(this).find('.action').attr('id');
            $('#'+id).show();

            $(this).addClass('hover');
        });
        $(d).on("mouseout",".columns",function(){
            var id = $(this).find('.action').attr('id');
            $('#'+id).hide();
            $(this).removeClass('hover');
        });
        $(d).on('click','.required',function(){
            var type = $(this).data('type');
            if(type === 'select' || type === 'radio' || type === 'checkbox'){
                grandparent = $(this).parent().parent().parent();   
            }else{
                grandparent = $(this).parent().parent();
            }
            if($(this).is(':checked')){
                $(grandparent).find('.title_label').append('<span class="req">*</span>');
            }else{
                $(grandparent).find('span.req').remove();
            }
        });
        $(d).on('input[readonly]','focus',function(){
                this.blur();
        });
        $('#form_name').on('focus',function(){
            $(this).parent().find('b.req').remove();
        });



        $(d).on('click','.delete_field',function(){
            grand_parent = $(this).parent().parent().parent().parent().parent().parent().parent().attr('id');
            parent = $(this).parent().parent().parent().parent().parent().parent().attr('id');
            UIkit.modal.confirm('Are you sure, you want to delete this row?', 
                function(){
                        $("ul#"+grand_parent+" #"+parent).remove();
                    
                    var length = $('ul#'+grand_parent).find('.columns').size();
                    if(length <= 3 && length != 0){
                        var width ='uk-width-1-'+length;
                        var left_div = 'titl-field'+length+' left_setting';
                        var right_div ='hover-icons'+length+' right_setting hover-icons action';
                        var columns = $('.columns');
                        $('ul#'+grand_parent+' .columns').each(function(){
                            //$(this).
                            $(this).removeClass().addClass(width).addClass('columns',400,'easeInBack');
                            $(this).find('.left_setting').removeClass().addClass(left_div);
                            $(this).find('.right_setting').removeClass().addClass(right_div);
                        });
                    }else if(length == 0){
                        $("li#"+grand_parent).remove();
                    }
                if($('ul#pages li').length == 0){
                    $('ul#pages').append('<p class="drop_elements ui-droppable">Drop elements here to create the form</p>');
                }
            },{labels: {'Ok': 'Yes', 'Cancel': 'No'}
            });
            
        });
        $(d).on('click','.check',function(){
            req_parent = $(this).parent().parent();
            if($(this).hasClass('uncheck-grey')) {
                req_parent.find('.title_label').append('<span class="req"> *</span>');
                $(this).removeClass("uncheck-grey").addClass("check-red");
            }else{
                req_parent.find('.req').remove();
                $(this).removeClass("check-red").addClass("uncheck-grey");
            }
        }); 
        $(d).on('click','.publish',function(){
            var formname = $("#form_name").val();
            var form_category = $('#form_categorys').val();
            var form_location = $('#location_change').val();
            var org_id = $('#org_id').val();
            if((formname === '' || formname === undefined) && (form_category == '') && (form_location == '' || form_location == null) && org_id != 1){
                if (($('#form_name').parent().find('p.error').length) == 0){
                    $('#form_name').after('<p class="req error">Please enter form name </p>');
                }
                if (($('.form-category').parent().find('p.error').length) == 0){
                    $('.form-category').after('<p class="error">Please Choose category</p>');
                }
                if (($('.location').find('p.error').length) == 0){
                    $('div.location').append('<p class="error">Please Choose Jobsites</p>');
                }
                return false;
            }else if((formname === '' || formname === undefined) && form_category == '' ){
                if (($('#form_name').parent().find('p.error').length) == 0){
                    $('#form_name').after('<p class="req error">Please enter form name </p>');
                }
                if (($('.form-category').parent().find('p.error').length) == 0){
                    $('.form-category').after('<p class="error">Please Choose category</p>');
                }
                return false;
            }else if((formname === '' || formname === undefined) && (form_location == '' || form_location == null) && org_id != 1){
                if (($('#form_name').parent().find('p.error').length) == 0){
                    $('#form_name').after('<p class="req error">Please enter form name </p>');
                }
                if (($('.location').find('p.error').length) == 0){
                    $('div.location').append('<p class="error">Please Choose Jobsites</p>');
                }
                return false;
            }else if((form_category == '') && (form_location == '' || form_location == null) && org_id != 1){
                if (($('.form-category').parent().find('p.error').length) == 0){
                    $('.form-category').after('<p class="error">Please Choose category</p>');
                }
                if (($('.location').find('p.error').length) == 0){
                    $('div.location').append('<p class="error">Please Choose Jobsites</p>');
                }
                return false;
            }else if(formname === '' || formname === undefined){
                if (($('#form_name').parent().find('p.error').length) == 0){
                    $('#form_name').after('<p class="req error">Please enter form name </p>');
                }
            }else if(form_category == ''){
                if (($('.form-category').parent().find('p.error').length) == 0){
                    $('.form-category').after('<p class="error">Please Choose category</p>');
                }
                return false;
            }
            else if(form_location == '' || form_location == null && org_id != 1){
                if (($('.location').find('p.error').length) == 0){
                    $('div.location').append('<p class="error">Please Choose Jobsites</p>');
                }
                return false;
            }
            else{
                common.build(); 
            }
        });
        function popup_initialize(popupid,current,type,row_id,column_id){
            var dialog = $(current).find('#'+popupid).dialog({
              title: " OPTIONS",
              height: "auto",
              width: "auto",
              modal: true,
              //height: 300,
              buttons: {
                "ok" :function(){
                    var html = '';
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
                                var cur_format = $('#dates_format_'+date_id[1]).val();
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
                                $('#date_value_'+date_id[1]).val(date_string);
                                $('#cur_date_'+date_id[1]).val(date_string);
                                $('#sel_date_format',current).val(sel_format);
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
                                    $('#time_value_'+time_id[1]).val(time);
                                }else if(sel_time_format == 'HH:mm:ss'){
                                    /* 24 Hour */
                                    var date = new Date();
                                    var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
                                    var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
                                    var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
                                    time = hours + ":" + minutes + ":" + seconds;
                                    $('#time_value_'+time_id[1]).val(time);
                                }
                                $('#sel_time_format',current).val(sel_time_format);
                            break;

                    }
                    $('ul#'+row_id+'> #'+column_id).find('.select').empty().append(select);
                    $(this).dialog( "close" );
                },
                Cancel: function() {
                  $(this).dialog( "close" );
                }
              },
            });
            return dialog;
        }
        
        var common = {
            countcollength :function(rowid){    
                var colcount = $('#'+rowid).find('div.cols').size();
                //console.log(colcount+" Column "+" in "+rowid);
                return ++colcount;
            },
            auto_update_text:function(type){
                $(d).on("click",'label.title_label', function () {

                    var current = $(this).parent().parent();
                    var txt = $(this).text();
                    console.log(txt);
                    $(".title_label",current).replaceWith('<input class="title_labels" value="'+txt+'"/>');
                    $(".info",current).remove();
                });
                $(d).on('click','span.click-edit-icon',function(){
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
                     console.log(txt);
                    $(".title_label",current).replaceWith('<input class="title_labels" value="'+txt+'"/>');
                });
            },
            open_dialog:function(type,selectedid,popupid,optionid,dialog){
                $('.'+optionid).click(function(){
                    dialog.dialog( "open" );
                });
            },
            options_open:function(type,selectedid,popupid,dialog){
                current = dialog.attr('id');
                var max_fields      = 5; //maximum input boxes allowed
                var wrapper         = $("#"+current+" element"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                var x = 0;
                $(wrapper).on("click",'.add_field_button',function(e){ //on add input button click
                    
                     //initlal text box count
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
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
            options_close:function(type,selectedid,popupid,dialog){
                $(d).on('click','.options_cancel',function(){
                });
            },
            required:function(){
                $(d).on('click','.check',function(){    
                   req_parent = $(this).parent().parent();
                    if($(this).hasClass('uncheck-grey') === true)   {
                        console.log(req_parent);
                        req_parent.find('.title_label').append('<span class="req">*</span>');
                        $(this).removeClass("uncheck-grey").addClass("check-red");
                    }else{
                        console.log(req_parent);
                        req_parent.find('.req').remove();
                        $(this).removeClass("check-red").addClass("uncheck-grey");
                    }
                }); 
            },
            build:function(){
                var formname = $("#form_name").val();
                if(formname === '' || formname === undefined){
                    if (($('#form_name').parent().find('p.error').length) == 0){
                        $('#form_name').after('<p class="req error">Please enter form name </p>');
                        return false;
                    }else{
                        return false;
                   }
                }
                var button_col = new Array();
                reset = {};
                reset.type = "reset";
                reset.formfieldid = "0";
                reset.title = "Reset";
                reset.api_type = "element-reset";
                buttons = {};
                buttons.type = "submit";
                buttons.formfieldid = "1";
                buttons.title = "Submit";
                buttons.api_type = "element-button-submit";
                fields ={};
                button_col[0]  = reset;
                button_col[1] = buttons;
                var pages = [];
                var rows = $('ul#pages li');
                var row_ = new Array();
                var row_incr = 0;
                if(rows.find('ul.connected li').length == 0){                   
                    if($('#forms').parent().find('.error').length == 0){
                        $('#forms').first().before('<p class="req formfields error">Please create some fields for form creation </p>');
                    }
                    return false;
                }
                $(rows).each(function(r,rows){
                    var row = $('ul.connected li',rows);
                    length = row.length;
                    if(length != 0){
                          var col = new Array();
                          var col_incr = 0;
                        $(row).each(function(c,columns){
                            fielddata = {};
                            rclass =  $('.cols', columns).attr('class').split("_");
                            id = rclass[1].split("-");
                            type = $('.portlet-header',columns).data('type').toString();
                            $('.title_label',columns).find('.req').remove();
                            title = $('.title_label',columns).text().trim();
                            // implement fieldid on libraries/Template.php
                            // every field need a fieldid
                            // first time need a formfieldid as zero while creating the form once the form saved
                            // formfieldid value should be form_fields table primary id
                            // field params are 

                            /*  fieldid
                                formfieldid
                                type
                                title
                                required
                                choices
                            */

                            fielddata.fieldid =$('.portlet-header', columns).data('fieldid').toString();
                            fielddata.formfieldid =String($('.formfieldid',columns).val());
                            fielddata.type = type;
                            fielddata.title = title;
                            if($(columns).find('.title_value').length > 0){
                                choices = [];
                                $(columns).find('.title_value').each(function(i,value){
                                    options = {};
                                    if($(this).text() === ''){
                                        options['title'] = $(this).val();
                                    }else{
                                        options['title'] = $(this).text();
                                    }
                                    options['id'] = String($(this).data('optionid'));
                                    options['checked'] =String(0);
                                    choices.push(options);
                                    fielddata.choices = choices;
                                });
                            }
                            if($(columns).find('.time_format').length > 0){
                                fielddata.format = $('.time_format').val();
                            }
                            if($(columns).find('.date_format').length > 0){
                                fielddata.format = $('.date_format').val();
                            }
                            if($(columns).find('.check-red').length > 0){
                                fielddata.required = String(1);
                            }
                            else{
                                fielddata.required = String(0);   
                            }
                            col[col_incr]=fielddata;
                            col_incr++;
                        });
                        row_[row_incr] = col; 
                        row_incr++; 
                    }
                });
                row_[row_incr++] = button_col;
               // row_[row_incr++] = buttons;
                pages[0] = row_;
                fields.fields = pages;
                console.log(JSON.stringify(fields));
                $('.form_token').val(CryptoJS.AES.encrypt(JSON.stringify(fields),'',{format: CryptoJSAesJson}).toString());
                var form_name = $("#form_name");
                var form_desc = $("#form_desc");
                var form_category = $("#form_categorys");
                var form_location = $("#location_change").val();
                $('.form_name').val(form_name.val());
                $(".form_desc").val(form_desc.val());
                $(".form_category").val(form_category.val());
                $('.form_location').val(CryptoJS.AES.encrypt(JSON.stringify(form_location),'',{format: CryptoJSAesJson}).toString());
                $('#wizard_advanced_form').submit();
            }
        }
    });
  }(window,document,window.jQuery));