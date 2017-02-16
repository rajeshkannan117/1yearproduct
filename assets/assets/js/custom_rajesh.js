 var baseURL = $('body').data('baseurl');
  function filter_submit(){
        $('.submission_list').empty();
        $.ajax({
            type: "POST",
            url: baseURL + "form/reports/",
            data: $( "#filter_form" ).serialize(),
            dataType: "html",
            success: function(data) 
            {
                $('.submission_list').html(data);
            }
        })
     }
    function filter_change(current){
        var field = $(current).val();
        $parent = $(current).parent().parent();

        $key = $parent.data('filter');
        var count = $('.advanced_filter').length;
        var data = $( "#filter_form" ).serialize()+'&'+$.param({ 'fieldid':field,'key':$key,'count':count });
        $parent.find('#filter_condition').remove();
        $parent.find('#filter_data').remove();
        console.log($parent);
        //var data = $( "#filter_form" ).serialize()+'&'+$.param({ 'fieldid':field,'key':$key,'count':count });
        $parent.append('<div class="filter-loader"><i class="uk-icon-refresh uk-icon-medium uk-icon-spin"></i></div>');
        $.ajax({
            type: "POST",
            url: baseURL + "form/advanced_filter",
            data: data,
            dataType: "html",
            success: function(data) 
            {
               $parent.find('.uk-icon-refresh').remove();
               datas = data.split('^%');
               $parent.find(".condition").html(datas[0]);
               $parent.find('.data').html(datas[1]);
            }
        });
    }
    function authorized_user_report(current){
        var current_id = $(current).val();
        var org_id = $('#org_id').val();
        var level = $('#authorized_user').parent().parent().data('level');
        console.log(level);
        $.ajax({
            type: "POST",
            url: baseURL + "form/report_user",
            data: {id:current_id,'org_id':org_id,level:level},
            dataType: "html",
            success: function(data)
            {
               $('.workflows_page').append(data);
            }
        });
    }
    function approve_user_dropdown(user,level){
        users = jQuery.parseJSON(user);
        if(users.length < 1){
            var authorized_users = '';
        }else{
        var authorized_users = $("<select></select>").attr({class:"authorized_users",id:"approve_user_"+level,name:"report[report]["+level+"][approve]"});
            authorized_users.append("<option value=''> </option>");
        $.each(users, function (i, el) {
            authorized_users.append("<option value='"+el.id+"'>" + el.name + "</option>");
        });
        }
        return authorized_users;
    }
    function condition_set(user,level){
        users = jQuery.parseJSON(user);
        var condition = $("<select></select>").attr({class:"authority",id:"authority_"+level,name:"report[report]["+level+"][authority]"}); 
            if(users.length < 1){
                condition.append("<option value='2'>Will approve</option>");
            }else{
                condition.append("<option value='1'>Reporting to</option>");
                condition.append("<option value='2'>Will approve</option>");
            }
        return condition;
    }
    function comments(e,current) {
        if (e.keyCode === 13) {
            var comments_value = current.value;
            var comments_id = current.id;
            var id = comments_id.split('_');
            var msg_box = '#msg_'+id[1];
            $(msg_box).find('#comment_0').remove();
            var name = $('#name').val();
            var html = '<li id="comment_0">'+comments_value+'<span class="chat_message_time">'+name+'</span></li>';
            $(msg_box).append(html); 
            $('#'+comments_id).val('');
            $('#hidden_'+id[1]).val(comments_value);
            if(comments_value != ''){
                console.log(id[1]);
                $('h5.heading_a_'+id[1]).css('font-weight','800');
            }
            $( ".uk-close" ).trigger( "click" );
            return false;
        }
    }
    function comments_submit(current){
        var comments_html = $(current).parent().parent();
        var comments_id = $(comments_html).find('.comments').attr('id');
        var comments_value = $('#'+comments_id).val();
        var id = comments_id.split('_');
        var msg_box = '#msg_'+id[1];
        $(msg_box).find('#comment_0').remove();
        var name = $('#name').val();
        var html = '<li id="comment_0">'+comments_value+'<span class="chat_message_time">'+name+'</span></li>';
        $(msg_box).append(html); 
        $('#'+comments_id).val('');
        $('#hidden_'+id[1]).val(comments_value);
        if(comments_value != ''){
            console.log(id[1]);
            $('.heading_a_'+id[1]).css('font-weight','800');  
        }
        $( ".uk-close" ).trigger( "click" );
    }
    $('.uk-modal').on({
        'show.uk.modal': function(){
            var current_id = $(this).attr('id');
            var formfield = current_id.split('_');
            var hidden_comments_text = $('#'+current_id).find('#hidden_'+formfield[1]).val();
            $('#comments_'+formfield[1]).val(hidden_comments_text);
        },
        'hide.uk.modal': function(){
            //console.log("Element is not visible.");
        }
    });
    function reassign(current){
        var value = $(current).val();
        //$('#action').val(value);
        var submission_id = $('#submission_id').val();
        $.ajax({
            type: "GET",
            url: baseURL + "form/reassign/"+submission_id,
            success: function(data)
            {
                if(data != ''){
                   $('#modal_reassign').find('#reassign_users').empty().append(data);
                   var script = document.createElement("script");
                   script.type = "text/javascript";
                   script.innerHTML ="var multiselect_user = $('#multiselect_user'); if(multiselect_user.length) {multiselect_user.kendoMultiSelect(); }";  
                   $("#scripts").append(script);
                }
               $('#reassign').trigger('click');
            }
        });
        //document.getElementById('formreview').submit();
    }

    $('#modal_reassign').on({
        'show.uk.modal': function(){
        },
        'hide.uk.modal': function(){
            $("#scripts").empty();
        }
    });
    function reassign_submit(current){
        var users = $(current).parent().parent().find('#multiselect_user').val();
        var desc = $('#reassign_desc').val();
        if(users){
            var users_hidden = '<input type="hidden" name="users" value="'+users+'"/>';
             $('#formreview').append(users_hidden);
        }
        var desc_hidden = '<input type="hidden" name="reassign_desc" value="'+desc+'"/>';
        $('#formreview').append(desc_hidden);
        $('#action').val("Reassigned");
        $('#formreview').submit();
    }

$(document).ready(function() 
{
     /*  Organization onchange function  in location */
    $('#time-sessions-filter .advanced_filter:last a.add').show();
    $('#form_org').kendoDropDownList();
    var location_form= $('#location_form');
        if(location_form.length) {
            location_form.kendoMultiSelect();
        }
    /*var assign_user =  $('.assign_user');
        if(assign_user.length) {
            assign_user.kendoMultiSelect();
        }*/
    /* Forms List */
    var forms = $("#form_workflow");
    if(forms.length) {
        forms.kendoDropDownList();
    }
    var form_user = $('.assign_user');
        if(form_user.length) {
            multi_select_user = form_user.kendoMultiSelect().data("kendoMultiSelect");
            $("#select").click(function() {
            var values = $.map(multi_select_user.dataSource.data(), function(dataItem) {
              return dataItem.value;
            });
            multi_select_user.value(values);
          });
          $("#deselect").click(function() {
            multi_select_user.value([]);
          });
        }
    var form_department = $('#assign_department');
        if(form_department.length) {
            form_department.kendoMultiSelect();
        }
    var form_category = $('#form_category');
        if(form_category.length) {
            form_category.kendoDropDownList();
        }
        
    var approve_user = $('#approve_user_0');
        if(approve_user.length) {
            approve_user.kendoDropDownList();
        }
    var authority = $('#authority_0');
        if(authority.length) {
            authority.kendoDropDownList();
        }
    var condition= $('#authorized_users_0');
        if(condition) {
            condition.kendoDropDownList(); 
        } 
    /*var users =$('.authority');
        if(users) {
            users.kendoDropDownList();
        }*/
    $('.country_change').change(function() 
    {
        var country_id = $(this).val();
        $.ajax({
            type: "POST",
            url: baseURL + "country/domain_lists/",
            data: {country_id: country_id},
            dataType: "html",
            success: function(data) 
            {
                $("#domains").html(data);
                var script = document.createElement("script");
                script.type = "text/javascript";
                script.innerHTML ="var $kUI_multiselect_domain = $('#multiselect_domain'); if($kUI_multiselect_domain.length) {$kUI_multiselect_domain.kendoMultiSelect(); }";        
                $("#domains").append(script);
            }
        });
        
    });
    $(document).on('change','.authorized_users',function(){
        var id  = $(this).parent().parent().parent().parent().attr('id');
        var level = $(this).parent().parent().parent().parent().data('level');
        //console.log(level);
        var reported_user = $(this).val();
        $('.level').each(function(i){
            if(i > level && i != undefined){
                $('#level_'+i).remove();
            }
        });
        var selected_user = $(".assign_user").val();
        if(reported_user != ''){
            var user = [];
            $('.authorized_users :selected').each(function(i, selected){ 
                user[i] = $(selected).val(); 
            });
            var org_id = $('#org_id').val();
            var remaining_user = '';
            var remaining = '';
            level++;
            $res = '';
            $.ajax({
                type: "POST",
                url: baseURL + "form/report_user",
                data: {id:user,'org_id':org_id,level:level},
                dataType: "html",
                success: function(data)
                {
                    datas = data.split('?^');
                    condition = condition_set(datas[0],level);
                    remaining_user = approve_user_dropdown(datas[0],level);
                    $user = getElementChecked(remaining_user[0]);
                    $res +='<div class="uk-grid level" data-uk-grid-margin id="level_'+level+'" data-level="'+level+'">';
                    $res += '<div class="uk-width-medium-1-3"><div id="user" style=""><label for="val_select"> User <span class="req">*</span></label><br/><input type="text" disabled="" value="'+datas[1]+'" /><input type="hidden" value="'+datas[2]+'" name="report[report]['+level+'][users]" /></div></div>';
                    $res += '<div class="uk-width-medium-1-3"><div id="approve" style=""><label for="val_select"> Status  <span class="req">*</span></label><br/>'+condition[0].outerHTML+'</div></div>';
                    if($user != ''){ 
                        $res += '<div class="uk-width-medium-1-3"><div id="authorized_user_'+level+'" style=""><label for="val_select" >Authorized User  <span class="req">*</span></label><br/>'+$user+'</div></div>';
                    }
                    $res += '</div>';
                    $('.workflows_page').append($res);
                    var scripts = document.createElement("script");
                    scripts.type = "text/javascript";
                    scripts.id="level_"+level;
                    scripts.innerHTML ="var condition= $('#approve_user_"+level+"');if(condition) {condition.kendoDropDownList(); } var users =$('#authority_"+level+"');if(users) {users.kendoDropDownList();} ";
                    $("#level_"+level).append(scripts);
                }
            });
        }else{
            return false;   
        }
    });
    function getElementChecked(referenceVar) {
        if(referenceVar) {
            return referenceVar.outerHTML;
        } else {
            return '';
        }
    }
    $(document).on('change','.authority',function(){
        var level = $(this).parent().parent().parent().parent().data('level');
        $('.level').each(function(i){
            if(i > level && i != undefined){
                $('#level_'+i).remove();
            }
        });
        console.log(level);
        if(level != undefined){
            var current_val = $(this).val();
            if(current_val == '2'){
                $("#level_"+level).find('#authorized_user_'+level).hide();
            }
            else if (current_val == '1'){
                $("#level_"+level).find('#authorized_user_'+level).show();   
            }
        }
    });
    $(document).on('change','#form_workflow',function(){
        if(this.value != ''){
            window.location=baseURL+'form/workflow/' + this.value;
        }
    });
    $('.advanced_filters').on('click','.add',function(){
        $parent = $(this).parent().parent().parent();
        var filter_new = $parent.clone();
        var unique = filter_new.data('filter');
        var unique= unique+1;
        var form_id = $("#form_id").val();
        filter_val = $parent.find('#filter').val();
        if(filter_val != ''){
            $.ajax({
                type: "GET",
                url: baseURL + "form/filter_add",
                data: {form_id: form_id,filter:unique},
                dataType: "html",
                success: function(data) 
                {
                   $('.advanced_filters').append(data);
                }
            });
            $(this).hide();
        }
        else{
            alert("You need to complete the current criteria row before adding a new one");
        }        
    });
    $('.advanced_filters').on('click','.remove',function(){
        var length = $('.advanced_filter').length;
        if(length > 1){
            $parent = $(this).parent().parent().parent().remove();
            $('.advanced_filter:last').find('.add').show();    
        }else{
            //$(this).parent().parent().parent().find('#filter').val('');
            alert("Can't remove this filter");
        }
        $parent = $(this).parent().parent().parent();

    });
    $(".domain_change").change(function(){
       var  domain_id = $(this).val();
       if(domain_id || domain_id==null)
       {    var depart_id = $("#multiselect_department").val();
           get_domain_departments(domain_id,depart_id);
       }
    });
    $("#org_forms").change(function(){
        var form = $(this).val();
        window.location.href=baseURL+'form/report/'+form;
        /*$("#review_form").empty();
        $('.submission_list').empty();*/
       /* $.ajax({
            type: "POST",
            url: baseURL + "form/filter_view",
            data: {form_id: form},
            dataType: "html",
            success: function(data) 
            {
                datas = data.split('^%');
                var script = document.createElement("script");
                script.type = "text/javascript";
                script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                $("#review_form").html(datas[0]);
                $("#review_form").append(script);
                $('.submission_list').html(datas[1]);
            }
        });*/
    });


     $('.editcountry_change').change(function() 
     {
            var country_id = $(this).val();
            $.ajax({
             type: "POST",
             url: baseURL + "country/edit_domain_lists/",
             data: {country_id: country_id},
             dataType: "html",
             success: function(data) 
            {
                 //alert(data);
                 //var data_arr = data.split("#");

                 $("#domains").html(data);
                 //$("#user_list").html(data_arr[1]);
                 var script = document.createElement("script");
                 script.type = "text/javascript";
                 script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                 //script.innerHTML ="var $kUI_multiselect_domain = $('#multiselect_domain');if($kUI_multiselect_domain.length) {$kUI_multiselect_domain.kendoMultiSelect(); }";
                 $("#domains").append(script);

             }

         });
        
    });



    /* Creating new form when change organization get organization related information
        category and users and department and all
    */

    $("#form_org").change(function(){
        var org_id = $(this).val();
        $('.org_category').empty();
        $('input[name="assign_to"]').prop('checked', false);
        $('#lists').empty();
       /* $.ajax({
            type:'POST',
            url:baseURL +'organization/org_details',
            data:{org_id:org_id},
            dataType:"html",
            beforeSend:function(){
                altair_helpers.content_preloader_show('regular');
            },
            success:function(data){
                $('.org_category').html(data);
                $('#org_id').val(org_id);
                var scripts = document.createElement("script");
                scripts.type = "text/javascript";
                scripts.innerHTML ="var $kUI_multiselect_category= $('#multiselect');if($kUI_multiselect_category.length) {$kUI_multiselect_category.kendoMultiSelect(); }";
                $(".org_category").append(scripts);
                altair_helpers.content_preloader_hide();
            }
        }) */
        $.ajax({
            type:'POST',
            url:baseURL +'form/org_category',
            data:{org_id:org_id},
            dataType:"html",
            beforeSend:function(){
                //altair_helpers.content_preloader_show('regular');
            },
            success:function(data){
                $('.org_category').html(data);
                $('#org_id').val(org_id);
                var script = document.createElement("script");
                script.type = "text/javascript";
                script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                // var scripts = document.createElement("script");
                //scripts.type = "text/javascript";
                // scripts.innerHTML ="var $kUI_multiselect_category= $('#multiselect');if($kUI_multiselect_category.length) {$kUI_multiselect_category.kendoMultiSelect(); }";
                $(".org_category").append(script);
               // altair_helpers.content_preloader_hide();
            }
        });
        $.ajax({
            type:'POST',
            url:baseURL +'form/org_users',
            data:{org_id:org_id},
            dataType:"html",
            beforeSend:function(){
                //altair_helpers.content_preloader_show('regular');
            },
            success:function(data){
                $('.org_users').html(data);
                $('#org_id').val(org_id);
                var script = document.createElement("script");
                script.type = "text/javascript";
                script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                var scripts = document.createElement("script");
                scripts.type = "text/javascript";
                scripts.innerHTML ="var $kUI_multiselect_users= $('#multiselect_users');if($kUI_multiselect_users.length) {$kUI_multiselect_users.kendoMultiSelect(); }";
                $(".org_users").append(scripts);
                altair_helpers.content_preloader_hide();
            }
        });
    });


    $("input[name='assign_to']").change(function(){
        current = $(this).val();
        $('#lists').empty();
        var org_id = $('#org_id').val();
        if(org_id == 0){
            org_id = $('#form_org').val();
        }
        //console.log(org_id);
        switch(current){
            case 'user':
                $.ajax({
                    type: "POST",
                    url: baseURL + "users/user_lists/",
                    data: {org_id: org_id},
                    dataType: "html",
                    beforeSend:function(){
                        //altair_helpers.content_preloader_show('regular');
                    },
                    success: function(data) 
                    {
                        $("#lists").html(data);
                        var scripts = document.createElement("script");
                        scripts.type = "text/javascript";
                         //var script = document.createElement("script");
                         //script.type = "text/javascript";
                         //script.src = baseURL + "assets/assets/js/kendoui_custom.min.js";
                        scripts.innerHTML ="var $kUI_multiselect_user= $('#multiselectuser');if($kUI_multiselect_user.length) {$kUI_multiselect_user.kendoMultiSelect(); }";
                         //$("#lists").append(script);
                        $("#lists").append(scripts);
                        altair_helpers.content_preloader_hide();
                    }
                 });
                break;
            case 'dept':
                 $.ajax({
                    type: "POST",
                    url: baseURL + "department/dept_list/",
                    data: {org_id: org_id},
                    dataType: "html",
                    beforeSend:function(){
                        //altair_helpers.content_preloader_show('regular');
                    },
                    success: function(data) 
                    {
                        $("#lists").html(data);
                        var script = document.createElement("script");
                        script.type = "text/javascript";
                        script.innerHTML ="var $kUI_multiselect_dept= $('#multiselectdept');if($kUI_multiselect_dept.length) {$kUI_multiselect_dept.kendoMultiSelect(); }";
                        //script.src = baseURL + "assets/assets/js/kendoui_custom.min.js";
                        $("#lists").append(script);
                        altair_helpers.content_preloader_hide();
                    }
                 });

                break;
        }
    });

 });

function confirm_delete(id){
    var url = baseURL+"country/delete/"+id;
   
    UIkit.modal.confirm('Are you sure want to delete this country ?', function(){ 
                location.href=baseURL+'country/delete/'+id
                                            })
    
}

$(document).on('click', '.defaults,.setdefaults', function() {

        mapid   = $(this).closest('td').attr('mapid');
        display = $(this).closest('td').attr('id');
        page    = $(this).closest('td').attr('page');
        
        if(page == 'country'){
            $.ajax({
                 url: baseURL + "country/check_default_country/",
                 dataType: "html",
                 success: function(data) 
                {
                    if(mapid == data){
                        alert("Please select any one country as default");
                    }else{
                        if (confirm("Would you like to change the default country?")) {

                            $.ajax({ 
                                type: "POST",       
                                url: baseURL + "country/set_default_country/",
                                data: {change_id: mapid,default_id: data},
                                dataType: "json",
                                success: function(responcedata) 
                                {
                                    
                                   var id = $("td[mapid='"+data+"']").attr('id');
                                   
                                   /*if(mapid == data){
                                    alert("Please select any one country as default");
                                    //$("#"+id).html(responcedata[1]);
                                    //$("#default"+id).html("N/A");
                                   }else{*/
                                    $("#"+display).html(responcedata[0]);
                                    $("#"+id).html(responcedata[1]);

                                    //$("#nodefault"+id).hide();
                                    $("#default"+display).html("N/A");
                                    
                                    //$("#default"+id).show();
                                    //$("#nodefault"+display).show();
                                    
                                  // }
                                }           
                            });
                        }
                    }

                 }
             });

        }else if(page == 'domain'){
            $.ajax({
                 type: "POST",
                 url: baseURL + "domain/check_default_domain/",
                 data: {mapid: mapid},
                 dataType: "json",
                 success: function(data) 
                {
                    
                    if (confirm("Want to replace the existing domain?")) {
                        $.ajax({ 
                            type: "POST",       
                            url: baseURL + "domain/set_default_domain/",
                            data: {change_id: mapid,default_id: data},
                            dataType: "json",
                            success: function(responcedata) 
                            {
                               
                               var id = $("td[mapid='"+data+"']").attr('id');
                               if(mapid == data){

                                $("#"+id).html(responcedata[1]);
                               }else{
                                $("#"+display).html(responcedata[0]);
                                $("#"+id).html(responcedata[1]);
                               }
                            }           
                        });
                    }

                 },
                 error: function(returndata) 
                {
                    
                     $.ajax({ 
                            type: "POST",       
                            url: baseURL + "domain/set_default_domain/",
                            data: {change_id: mapid,default_id: null},
                            dataType: "json",
                            success: function(data) 
                            {
                                $("#"+display).html(data[0]);
                            }           
                        });

                 }

             });
        }else if(page == 'department'){
            $.ajax({
                 type: "POST",
                 url: baseURL + "department/check_default_department/",
                 data: {mapid: mapid},
                 dataType: "json",
                 success: function(data) 
                {
                    if (confirm("Want to replace the existing department?")) {
                        $.ajax({ 
                            type: "POST",       
                            url: baseURL + "department/set_default_department/",
                            data: {change_id: mapid,default_id: data},
                            dataType: "json",
                            success: function(responcedata) 
                            {
                               
                               var id = $("td[mapid='"+data+"']").attr('id');
                               if(mapid == data){
                                
                                $("#"+id).html(responcedata[1]);
                               }else{
                                $("#"+display).html(responcedata[0]);
                                $("#"+id).html(responcedata[1]);
                               }
                            }           
                        });
                    }

                 },
                 error: function(returndata) 
                {
                     $.ajax({ 
                            type: "POST",       
                            url: baseURL + "department/set_default_department/",
                            data: {change_id: mapid,default_id: null},
                            dataType: "json",
                            success: function(data) 
                            {
                                
                                $("#"+display).html(data[0]);
                            }           
                        });

                 }

             });
        }else if(page == 'category'){
            $.ajax({
                 type: "POST",
                 url: baseURL + "category/check_default_category/",
                 data: {mapid: mapid},
                 dataType: "json",
                 success: function(data) 
                {
                    if (confirm("Want to replace the existing category?")) {
                        $.ajax({ 
                            type: "POST",       
                            url: baseURL + "category/set_default_category/",
                            data: {change_id: mapid,default_id: data},
                            dataType: "json",
                            success: function(responcedata) 
                            {
                               
                               var id = $("td[mapid='"+data+"']").attr('id');
                               if(mapid == data){
                                
                                $("#"+id).html(responcedata[1]);
                               }else{
                                $("#"+display).html(responcedata[0]);
                                $("#"+id).html(responcedata[1]);
                               }
                            }           
                        });
                    }

                 },
                 error: function(returndata) 
                {
                     $.ajax({ 
                            type: "POST",       
                            url: baseURL + "category/set_default_category/",
                            data: {change_id: mapid,default_id: null},
                            dataType: "json",
                            success: function(data) 
                            {
                                
                                $("#"+display).html(data[0]);
                            }           
                        });

                 }

             });
        }

        });


//Validate form submission
function validate(){
    
    $("form").find("span").remove();
    var req = 0;
    

    $('form#register').find('input').each(function(){
       
        var $label = $('label[for="' + this.name + '"]').html();   
        
    if($(this).prop('required')){
        if($(this).val() == ""){
            req++;
            
            $(this).after("<span style='color:crimson;'>The "+ $label +" field is required</span>");
        }
    }
    else{
        
        $(this).next("span").remove(); 
        
    }
    
});

    if(req > 0){
        
        return false;
    }
    else{
        return true;
    }

}

function countrychange(countryid){
    var country_id = countryid;
    
            $.ajax({
             type: "POST",
             url: baseURL + "country/get_org_country_domain/",
             data: {country_id: country_id},
             dataType: "html",
             success: function(data) 
            {
                 //alert(data);
                 //var data_arr = data.split("#");

                 $("#domain").html(data);
                 //$("#user_list").html(data_arr[1]);
                 var script = document.createElement("script");
                 script.type = "text/javascript";
                 script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                 //script.innerHTML ="var $kUI_multiselect_domain = $('#multiselect_domain');if($kUI_multiselect_domain.length) {$kUI_multiselect_domain.kendoMultiSelect(); }";
                 $("#domain").append(script);

             }

         });
}



function domainchange(domainid){
    var country_id=$('#country').val();
    var domain_id = domainid;
    
            $.ajax({
             type: "POST",
             url: baseURL + "category/department_lists/",
             data: {country_id: country_id,domain_id: domain_id},
             dataType: "html",
             success: function(data) 
            {
                 //alert(data);
                 //var data_arr = data.split("#");

                 $("#department").html(data);
                 //$("#user_list").html(data_arr[1]);
                 var script = document.createElement("script");
                 script.type = "text/javascript";
                 script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                 //script.innerHTML ="var $kUI_multiselect_department = $('#multiselect_department');if($kUI_multiselect_department.length) {$kUI_multiselect_department.kendoMultiSelect(); }";
                 $("#department").append(script);

             }

         });
}

function domain_delete(domain_id)
{
    
    $.ajax({ 
            type: "POST",       
            url: baseURL + "domain/domain_delete_check/",
            data: {domain_id: domain_id},
            dataType: "json",
            success: function(data) 
            {
                if(data==0)
                {
                    UIkit.modal.confirm('Are you sure, you want to delete this Domain?', function(){ 
                        location.href=baseURL+'domain/delete/'+domain_id; 
                    });
                }
                else if(data>0)
                {
                    UIkit.modal.alert("Since some data are associated with this Domain,you can't delete this. ", function(){ 
                       
                    });
                }
            }           
        });
    
//    UIkit.modal.confirm('Are you sure, you want to delete this Category?', function(){ 
//    location.href='<?php //echo base_url();?>category/delete/<?php //echo $details['cat_id']; ?>' 
    
}



function org_change(orgid){
    var org_id = orgid;
    
            $.ajax({
             type: "POST",
             url: baseURL + "users/org_details/",
             data: {org_id: org_id},
             dataType: "json",
             success: function(data) 
            {
                
                 //alert(data);
                 //console.log(data);
                 //var data_arr = data.split("#");

                 $("#details").html(data[0]);
                 $("#domain").html(data[1]);
                 $("#department").html(data[2]);
                 //$("#role").html(data[3]);
                 //$("#user_list").html(data_arr[1]);
                 var script = document.createElement("script");
                 script.type = "text/javascript";
                 //script.src = baseURL + "assets/assets/js/kendoui_custom.min.js";
                 script.innerHTML ="var $kUI_multiselect_department = $('#multiselect_department');if($kUI_multiselect_department.length) {$kUI_multiselect_department.kendoMultiSelect(); }";
                 /*var scripts = document.createElement("script");
                 scripts.type = "text/javascript";
                 scripts.src = baseURL + "assets/assets/js/altair_admin_common.min.js";*/
                 //script.innerHTML ="var $kUI_multiselect_department = $('#multiselect_department');if($kUI_multiselect_department.length) {$kUI_multiselect_department.kendoMultiSelect(); }";
                    
                 //$("#details").append(scripts);
                 $("#details").append(script);

             }

         });
}




 /* Delete Role Function */

 function deleteroleFunction(id) 
 {
     var x;
     var r = confirm("Are you sure you want to delete this Role?");
     if (r == true) {
         location.href = baseURL + 'role/delete?id=' + id;
     } else {
         x = "You pressed Cancel!";
     }
 }


 


function get_domain_departments(domain_id,depart_id)
{
           //$("#department").empty();
            $.ajax({
               type : "POST",
               url : baseURL+"category/domain_department_list",
               data:{domain_id : domain_id,depart_id:depart_id},
               dataType:"html",
                beforeSend:function(){
                    //altair_helpers.content_preloader_show('regular');
                    //$("#department").empty();
                },
               success:function(data){
                  $("#department").html(data);
                  var script = document.createElement("script");
                 script.type = "text/javascript";
                 //script.src = baseURL + "assets/assets/js/kendoui_custom.min.js";
                 script.innerHTML ="var $kUI_multiselect_domain = $('#multiselect_department'); if($kUI_multiselect_domain.length) {$kUI_multiselect_domain.kendoMultiSelect(); }";
                    
                 $("#department").append(script);
               }
            });
}


function checkadd_depart(org_id)
{
    var system_default = $("input[type='checkbox'][name='depart_default']:checked").length;
        if(system_default==1)
	{
            $.ajax({
             type: "POST",
             url: baseURL + "department/check_department_default/",
             data: {org_id: org_id},
             dataType: "html",
             success: function(data) 
            {//alert(data);

                 if(data!=0)
                 {
                    UIkit.modal.alert("Since already a Department is Default.You can't set this department as default.", function(){ 
                       
                    });
                    
                    return false;
//                    $("#depart_default").prop("checked", false);
                 }
                 else if(data=='0')
                 {
                     return true;
                 }
            }

         });      
      }
    
}






function check_domain_unique(domain_name)
{   
    if(domain_name.trim()!='')
    {
        $("#check_domain_registered").html('');
        
        $.ajax({
             type: "POST",
             url: baseURL + "domain/check_domain_unique/",
             data: {domain_name: domain_name.trim()},
             dataType: "html",
             success: function(data) 
            {                
                if(data.trim()!='no')
                {
                    $("#domain_name").val('');
                    $("#check_domain_registered").html(data.trim());
                    $("#domain_name").attr("placeholder", domain_name.trim());
                }
                $("#hide_domain_content").css('z-index','-9');
                $("#hide_domain_content").hide();
            }

         }); 
    }
    else
    {
        $("#hide_domain_content").css('z-index','-9');
        $("#hide_domain_content").hide();
    }
}

function get_domain_submit_block()
{
    $("#hide_domain_content").css('z-index','999999');
    $("#hide_domain_content").show();
}


    $(document).ready(function() {
        $('.advanced_check_filters').click(function() {
                $('.check_filters').slideToggle("fast");
        });
    });

/*$(document).ready(function() {
 $('.k-dropdown').change(function(){
    console.log(this);
    $("#width_tmp_select").html($('.k-dropdown option:selected').text());
    $(this).width($("#width_tmp_select").width()); 
 });
});

    */