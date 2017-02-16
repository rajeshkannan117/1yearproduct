(function(w,d,$){
    $(d).ready(function(){
        var common = {
            build:function(){
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
                            console.log(columns);
                            /*rclass =  $('.cols', columns).attr('class').split("_");
                            id = rclass[1].split("-");
                            type = $('.portlet-header',columns).data('type').toString();
                            title = $('.title_label',columns).text();*/
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
            }
        }
        $(d).on('click','.publish',function(){
            console.log('publish');
            common.build();
        });
    });
}(window,document,window.jQuery));