/*
*  Altair Admin
*  @version v2.0.0
*  @author tzd
*  @license http://themeforest.net/licenses
*  forms_wizard.js - forms_wizard.html
*/

$(function() {
    // wizard
    altair_wizard.advanced_wizard();
    altair_wizard.assign();
    //altair_wizard.vertical_wizard();
           
    $('#form_org').kendoDropDownList()
});

// wizard
altair_wizard = {
    content_height: function(this_wizard,step) {
        //console.log(this_wizard);
        var this_height = $(this_wizard).find('.step-'+ step).actual('outerHeight');
        console.log(this_height);
        $(this_wizard).children('.content').animate({ height: this_height }, 280, bez_easing_swiftOut);
        //$('#pages').css('height',this_height);
    },
    assign :function(){
         $('input[name="assign_to"]').on('click',function(){
                var selected  = $('input[name="assign_to"]:checked').val();
                console.log(selected);
                if(selected == 'user'){
                    $('#'+selected).show();    
                    $('#department').hide();
                }
                else if(selected == 'department'){
                    $('#'+selected).show();
                    $('#user').hide();
                }
            });
    },
    advanced_wizard: function() {
        var $wizard_advanced = $('#wizard_form');
            //$wizard_advanced_form = $('#wizard_advanced_form');
        var advanced = $('#wizard_advanced_form');
        if ($wizard_advanced.length) {
            $wizard_advanced.steps({
                headerTag: "h2",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                trigger: 'change',
                loadingTemplate: '<span class="spinner"><img src="../css/images/loading.gif" /></span>',
                onInit: function(event, currentIndex) {
                    //advanced.css('display','none');
                    altair_wizard.content_height($wizard_advanced,currentIndex);
                    // initialize checkboxes
                    /*altair_md.checkbox_radio($(".wizard-icheck"));
                    // reinitialize uikit margin
                    altair_uikit.reinitialize_grid_margin();*/
                    //altair_md.checkbox_radio($(".wizard-icheck"));
                    $('#wizard_form').find('.content').addClass('uk-width-1-1');
                    $('#wizard_form').find('.actions').addClass('uk-width-1-1');
                    var location_form= $('#location_form');
                        if(location_form.length) {
                            location_form.kendoMultiSelect();
                        }
                    var form_user = $('#assign_user');
                    if(form_user.length) {
                        form_user.kendoMultiSelect();
                    }
                    var form_department = $('#assign_department');
                    if(form_department.length) {
                        form_department.kendoMultiSelect();
                    }
                    var form_category = $('#form_category');
                    if(form_category.length) {
                        form_category.kendoDropDownList();
                    }
                    setTimeout(function() {
                        $window.resize();
                    },100)
                },
                onStepChanged: function (event, currentIndex) {
                    altair_wizard.content_height($wizard_advanced,currentIndex);
                    setTimeout(function() {
                        $window.resize();
                    },100)
                },
                onContentLoaded:function(event,currentIndex){
                    console.log('On load');
                },
                onStepChanging: function (event, currentIndex, newIndex) {
                    var step = $wizard_advanced.find('.body.current').attr('data-step'),
                        $current_step = $('.body[data-step=\"'+ step +'\"]');

                    if(currentIndex === 0 && newIndex == 1){
                        var formname = $("#form_name").val();

                        if(formname === '' || formname === undefined){
                            console.log($('#form_name').parent().find('b').length);
                          if (($('#form_name').parent().find('b').length) == 0){
                            $('#form_name').after('<b class="req">Please enter form name </b>');
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
                                    title = $('.title_label',columns).text();
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
                                    if($(columns).find('#time_format').length > 0){
                                        fielddata.format = $('#time_format').val();
                                    }
                                    if($(columns).find('#date_format').length > 0){
                                        fielddata.format = $('#date_format').val();
                                    }
                                    console.log(columns);
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
                    }
                    // check input fields for errors
                    // wizard
             

                    // adjust content height
                    $window.resize();

                    return $current_step.find('.md-input-danger').length ? false : true;
                },
                onFinished: function() {
                    advanced.submit();
                    //advanced.css('display','block');
                   /* var form_serialized = JSON.stringify( $wizard_advanced_form.serializeObject(), null, 2 );
                    UIkit.modal.alert('<p>Wizard data:</p><pre>' + form_serialized + '</pre>');*/
                }
            })/*.steps("setStep", 2)*/;

            $window.on('debouncedresize',function() {
                var current_step = $wizard_advanced.find('.body.current').attr('data-step');
                altair_wizard.content_height($wizard_advanced,current_step);
            });
           
            // wizard
            $wizard_advanced
                .parsley()
                .on('form:validated',function() {
                    setTimeout(function() {
                        altair_md.update_input(advanced.find('.md-input'));
                        // adjust content height
                        $window.resize();
                    },100)
                })
                .on('field:validated',function(parsleyField) {

                    var $this = $(parsleyField.$element);
                    setTimeout(function() {
                        altair_md.update_input($this);
                        // adjust content height
                        var currentIndex = $wizard_advanced.find('.body.current').attr('data-step');
                        altair_wizard.content_height($wizard_advanced,currentIndex);
                    },100);


                    /*$(parsleyField.$element).each(function() {
                        console.log($this);
                    });*/
                });

        }
    }

};