 var baseURL = $('body').data('baseurl');
  /*
  Old Changes
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
*/

/* Muniraj Changes */
function filter_submit_report(){
      $('.submission_list').empty();
      //console.log($( "#filter_form" ).serialize());
      var oForm = document.forms["filter_form"];
 }
 //function to get report submitting form 
 function get_export_result()
 {  
     $.ajax({
        type: "POST",
        url: baseURL + "form/export",
        data: $( "#filter_form" ).serialize(),
        dataType: "html",
        beforeSend:function(){
        },
        success: function(data) 
        {
            alert(data);
        }
    })
   /* var filters = $('#filter_form').serialize();
    //$('#form_export > #filters').val(filters);
    $('#form_export').submit();*/
 }
function filter_submit(){
    $('#form_export').html('');
    $('.submission_list').empty();
    var h = $( "#filter_form" ).html();
    $('#form_export').html(h);
    $.ajax({
        type: "POST",
        url: baseURL + "form/reports/",
        data: $( "#filter_form" ).serialize(),
        dataType: "html",
        beforeSend:function(){
            $('.submission_list').html('Loading');
        },
        success: function(data) 
        {
            $('.submission_list').html(data);
            $('#form_export').html(h);
        }
    })
}
$('#clear_all').on('click',function(){
   var length = $('.advanced_filter').length;
   if(length > 1){
        $('.advanced_filter').each(function(i){
            if(i != 0){
                $(this).remove();
            }
        });
   }
   $('.advanced_filter').find('#filter').val('');
   $('.advanced_filter').find('#filter_condition').val('');
   $('.advanced_filter').find('input[type="text"]').val('');
   $('.advanced_filter').find('.addremove').append('<a class="add" href="#" style="display: inline;"> <img class="icon" height="22px" width="22px" title="" src="'+baseURL+'assets/assets/images/add2.png" alt=""> </a>');
});
$('.column_check').on('click',function(){
    var length = $("input[name='columns[]']:checked").length;
    if(length > 3){
        $('label.error').text('For Advanced Filter allows only 3 fields');
        return false;
    }else{
        $('label.error').text('');
    }
});
$(document).on('click',".newForm",function(){
    $.ajax({
        type: "POST",
        url: baseURL + "form/check_category",
        dataType: "html",
        success: function(data) 
        {
            if(data != false){
                UIkit.modal.alert(data, function(){ 
                   
                });
            }else{
                window.location.href = baseURL+'form/add';
            }
           
        }
    });
    return false;
});
/*$(document).on('click',".newForm",function(){
    $.ajax({
        type: "POST",
        url: baseURL + "form/check_category",
        dataType: "html",
        success: function(data) 
        {
            if(data != false){
                UIkit.modal.alert(data, function(){ 
                   
                });
            }else{
                window.location.href = baseURL+'form/add';
            }
           
        }
    });
    return false;
});*/
$(document).on('click',".newUser",function(){
    $.ajax({
        type: "POST",
        url: baseURL + "users/department_and_role",
        dataType: "html",
        success: function(data) 
        {
            if(data != false){
                UIkit.modal.alert(data, function(){ 
                   
                });
            }else{
                window.location.href = baseURL+'users/add';
            }  
        }
    });
    return false;
});
/* Check JobSite Limit */
$(document).on('click',".addLocation",function(){    
    $.ajax({
        type: "POST",
        url: baseURL + "location/check_subscribed_location",
        dataType: "html",
        success: function(data) 
        {        
            console.log(data);
            if(data != false){
                UIkit.modal.alert(data, function(){ 
                   
                });
            }else{
                window.location.href = baseURL+'location/add';

            }  
        }
    });
    return false; 
});
/* Form creation Assign user ,dept , workflow */

$(".form_assign input").on('ifClicked',function(event){
    var value = this.value;
    var form_location = $("#location_change").val();
    var assign = $('.assign').val();
    if(assign == ''){
        assign = value;
    }
    if(form_location === 'null' || form_location === null){
        UIkit.modal.alert('Please Select JobSites', function(){ 
                
        });
        var cual= this;
        setTimeout(function(){ $(cual).iCheck('uncheck');}, 1);
    }else{
        var locations = CryptoJS.AES.encrypt(JSON.stringify(form_location),'',{format: CryptoJSAesJson}).toString();
        switch(value){
            case 'user':
                $.ajax({
                    type: "GET",
                    url: baseURL + "users/assign_users",
                    data:{assign:assign,location:locations,users:$('.assign_users').val()},
                    dataType: "html",
                    beforeSend:function(data){
                        //UIkit.modal.blockUI('<div class=\'uk-text-center\'>Wait for a moment...<br/>');
                        //altair_helpers.content_preloader_show('regular');
                        $('body').addClass("loading");
                    },
                    success: function(data) 
                    {
                        if(data != false){
                            //setTimeout(function(){
                                $('.uk-modal-dialog-replace').css('display','none');
                                UIkit.modal.confirm(data, function(){
                                    
                                    var assigned_users = $("#assign_users").val();
                                    if(assigned_users != '' && assigned_users != null){
                                        $('.assign').val(value);
                                        $('.assign_users').val(CryptoJS.AES.encrypt(JSON.stringify(assigned_users),'',{format: CryptoJSAesJson}).toString());
                                    }else if(assigned_users == null){
                                        $('.users').append('<p class="error">Please select users</p>');
                                    }
                                },{labels: {'Ok': 'Assign', 'Cancel': 'Cancel'}

                                });
                            //},5000);
                        }
                    },
                    complete:function(){
                      //altair_helpers.content_preloader_hide('regular'); 
                      $('body').removeClass("loading"); 
                    }
                });
                break;
            case 'dept' :
                $.ajax({
                    type: "GET",
                    url: baseURL + "department/assign_department",
                    data:{assign:assign,dept:$('.assign_dept').val(),users:$('.assign_users').val(),location:locations},
                    dataType: "html",
                    beforeSend:function(data){
                        $('body').addClass("loading");
                    },
                    success: function(data) 
                    {
                        if(data != false){
                            UIkit.modal.confirm(data, function(){  
                               var assigned_users = Array();
                               $("#assign_users option").each(function(i)
                                {
                                    assigned_users[i]= $(this).val();
                                });
                                if(assign_users.length == 0){
                                    $('.users').append('<p class="error">Please atleast one user</p>');
                                }else{
                                    $('.assign').val(value);
                                    var assign_dept = $("#department_change").val();
                                    $('.assign_dept').val(CryptoJS.AES.encrypt(JSON.stringify(assign_dept),'',{format: CryptoJSAesJson}).toString());
                                    $('.assign_users').val(CryptoJS.AES.encrypt(JSON.stringify(assigned_users),'',{format: CryptoJSAesJson}).toString());
                                }
                                //$('.form_location').val(CryptoJS.AES.encrypt(JSON.stringify(form_location),'',{format: CryptoJSAesJson}).toString());
                            },{labels: {'Ok': 'Assign', 'Cancel': 'Cancel'}
                            });
                        }
                    },
                    complete:function(){
                      //altair_helpers.content_preloader_hide('regular'); 
                      $('body').removeClass("loading"); 
                    }
                });
                break;

            case 'workflow' :
                $('.assign').val(value);     
                /*$.ajax({
                    type: "GET",
                    url: baseURL + "form/assign_workflow",
                    data:{assign:$('.assign').val(),location:$('.form_location').val()},
                    dataType: "html",
                    success: function(data) 
                    {
                        if(data != false){
                            UIkit.modal.confirm(data, function(){  
                                var form_location = $("#location_changes").val();
                                console.log($("#location_changes").val());
                                $('.assign').val(value);
                                $('.form_location').val(CryptoJS.AES.encrypt(JSON.stringify(form_location),'',{format: CryptoJSAesJson}).toString());
                            },{labels: {'Ok': 'Assign', 'Cancel': 'Cancel'}
                            });
                        }
                    }
                });*/
                break;

            }
        }
});

$(document).on('click','#update',function(){
    var assign_user = $('select.assign_user').val();
    var authorized_id = '';
    var authority_id = '';
    $('select.authorized_users').each(function(){
        var current = $(this).val();
        if(current == ''){
            authorized_id = $(this).attr('id');
        }
    });

    $('select.authority').each(function(){
        var current = $(this).val();
        if(current == ''){
            authority_id = $(this).attr('id');
        }
    });
    if(assign_user == null && authorized_id != '' && authority_id != ''){
        if($('#user').find('p.error').length <= 0){

            $('div.assign_user').after('<p class="error">Please select some users to assign the form</p>');
        }
        if($('select#'+authorized_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authorized_id).after('<p class="error">Please select authorised users</p>');
        }
        if($('select#'+authority_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authority_id).after('<p class="error">Please select actions</p>');
        }
        return false;
    }else if(assign_user == null && authorized_id != ''){
        if($('#user').find('p.error').length <= 0){
            $('div.assign_user').after('<p class="error">Please select some users to assign the form</p>');
        }
        if($('select#'+authorized_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authorized_id).after('<p class="error">Please .parent().parent()select authorised users</p>');
        }
        return false;
    }else if(assign_user == null && authority_id != ''){
        if($('#user').find('p.error').length <= 0){
            $('div.assign_user').after('<p class="error">Please select some users to assign the form</p>');
        }
        if($('select#'+authority_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authority_id).after('<p class="error">Please select action for the users</p>');
        }
        return false;
    }else if(authorized_id != '' && authority_id != ''){
        if($('select#'+authorized_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authorized_id).after('<p class="error">Please select authorised users</p>');
        }
        if($('select#'+authority_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authority_id).after('<p class="error">Please select action for the users</p>');
        }
        return false;
    }
    else if(authorized_id != ''){
        if($('select#'+authorized_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authorized_id).after('<p class="error">Please select authorised users</p>');
        }
        return false;
    }else if(authority_id != ''){
        if($('select#'+authority_id).parent().parent().find('p.error').length <= 0){
            $('select#'+authority_id).after('<p class="error">Please select action for the users</p>');
        }
        return false;
    }else if(assign_user == null){
        if($('#user').find('p.error').length <= 0){
            $('div.assign_user').after('<p class="error">Please select some users to assign the form</p>');
        }
        return false;
    }else{
        $('#setWorkflow').submit();
        //return true;
    }

});

$(document).on('change','select.assign_user',function(){
    $('#user').find('p.error').remove();
});
$(document).on('change','select.authority',function(){
    $(this).parent().parent().find('p.error').remove();
});
$(document).on('change','#location_change',function(){
   var  loc_id = $(this).val();
   if(loc_id || loc_id==null)
   {    
       var users = $("#assign_users").val();
       $(this).parent().find('.error').remove();
       get_location_users(loc_id,users);
   }
});
$(document).on('change','#assign_users',function(){
    $(this).parent().find('.error').remove();
});

function get_location_users(loc_id,user)
{
   //$("#department").empty();
    $.ajax({
       type : "POST",
       url : baseURL+"users/location_users",
       data:{loc_id : loc_id,user:user},
       dataType:"html",
        beforeSend:function(){
        },
       success:function(data){
          $(".users").html(data);
          var script = document.createElement("script");
          script.type = "text/javascript";
          script.innerHTML ="$('.chosen_select').chosen({no_results_text:'Oops, nothing found!',width:'95%'})";            
         $(".users").append(script);
       }
    });
}
function moveAll(from, to) {
    $('.'+from+' option').remove().appendTo('.'+to); 
}

function moveSelected(from, to) {
    $('.'+from).parent().parent().find("p.error").remove();
    $('.'+from+' option:selected').remove().appendTo('.'+to); 
}

$(document).on('change','#department_change',function(){
   var dept_id = $(this).val();
   if(dept_id || dept_id==null)
   {   
        var location = $("#location_change").val();
        var exclude_users = Array();
        $("select#exclude option").each(function(i)
        {
            exclude_users[i]= $(this).val();
        });
        var include_user = Array();
        $("select.include option").each(function(i)
        {
            include_user[i]= $(this).val();
        });

       //var exclude_users = $("select.exclude").val();
       //var include_user = $("select.include").val();
       get_dept_users(location,dept_id,exclude_users,include_user);
   }
});

function get_dept_users(loc_id,dept_id,exclude_user,include_user)
{
    $.ajax({
       type : "POST",
       url : baseURL+"department/dept_users",
       data:{loc_id : loc_id,exclude_user:exclude_user,dept:dept_id,include_user:include_user},
       dataType:"html",
        beforeSend:function(){
        },
        success:function(data){
          users = data.split('#');
          $("div.include").html(users[0]);
          $("div.exclude").html(users[1]);
       }
    });
}


/* Location Delete */
function location_delete(uuid){
    $.ajax({
        type: "GET",
        url: baseURL + "location/check_location_branch",
        data:{uuid:uuid},
        dataType: "html",
        success: function(data) 
        {
            if(data == 1){
                UIkit.modal.confirm('Are you sure want to delete this Jobsite ?', function(){ 
                location.href=baseURL+'location/delete/'+uuid;
                })
            }else if(data == 0){
                UIkit.modal.alert("You Can't Delete the Home Branch Location Details ", function(){ 
                       
                });
                
            }

        }
    });
    return false;
}


/*** default filter ***/
  $('#filter').on('change', function() {
  $('option:selected', this).attr('selected',true).siblings().removeAttr('selected');
});
/*** function to add or remove selected="selected" to selected item in reports ***/
function filter_check(id){
    $(".ckeck_sub"+id).attr('checked', true);
    if ($('.ckeck_sub'+id).is(':checked')) {
       $(".ckeck_sub"+id).attr('checked', true);
    } else {
         $(".ckeck_sub"+id).attr('checked', false);
    }
} 
function filter_id(id){
  var selectedValue = $(".filter"+id+" option:selected").val(); 
  $('.filter'+id).find('option:selected', this).attr('selected',true).siblings().removeAttr('selected');
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
$('#customize_columns').click(function(){
    var form_id = $('#form_id').val();
    var sel =  $('.columns_selected').val();
    $.ajax({
        type: "GET",
        url: baseURL + "form/customize_columns",
        data: {form_id:form_id,sel_column:sel},
        dataType: "html",
        success: function(data) 
        {
            UIkit.modal.confirm(data, function(){
                i = 0;
                var sel_column = Array();
                $('.columns').each(function(){
                    if($(this).prop("checked") == true){
                        sel_column[i++] = $(this).val();
                    }
                });
                $('.columns_selected').val(JSON.stringify(sel_column));
            },{labels: {'Ok': 'Ok', 'Cancel': 'Cancel'}
            });
        }
    });
});
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
            /*multi_select_user = form_user.kendoMultiSelect().data("kendoMultiSelect");
            $("#select").click(function() {
            var values = $.map(multi_select_user.dataSource.data(), function(dataItem) {
              return dataItem.value;
            });
            multi_select_user.value(values);
          });
          $("#deselect").click(function() {
            multi_select_user.value([]);
          });*/
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
    $('#form_categorys').on('change',function(){
            $('.form-category').parent().find('p.error').remove();
        });
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
            authorized_users.append("<option value=''></option>");
        $.each(users, function (i, el) {
            authorized_users.append("<option value='"+el.id+"'>" + el.name + "</option>");
        });
        }
        return authorized_users;
    }
    function condition_set(user,level){
        users = jQuery.parseJSON(user);
        var condition = $("<select></select>").attr({class:"authority",id:"authority_"+level,name:"report[report]["+level+"][authority]"}); 
            condition.append("<option value=''></option>")
            if(users.length <= 1){
                condition.append("<option value='2'>Approve</option>");
            }else{
                condition.append("<option value='1'>Review</option>");
                condition.append("<option value='2'>Approve</option>");
            }
        return condition;
    }
    function get_next_level_user(user,org_id,level,row_level,hierarchy,form){
        $res = '';
        var remaining_user = '';
        var remaining = '';
        $.ajax({
            type: "POST",
            url: baseURL + "form/report_user",
            data: {id:user,'org_id':org_id,level:level,hierarchy:hierarchy,form:form},
            dataType: "html",
            success: function(data)
            {
                datas = data.split('?^');
                //condition = condition_set(datas[0],level);
                remaining_user = approve_user_dropdown(datas[0],level);
                $user = getElementChecked(remaining_user[0]);
                condition = condition_set(datas[0],level);
                $res+='<tr class="level" id="level_'+level+'" data-level="'+level+'">';
                //$res +='<td><div class="uk-grid level" data-uk-grid-margin id="level_'+level+'" data-level="'+level+'">';
                $res+= '<td>Level '+row_level+'</td>';
                //$res += '<td><div class="uk-width-medium-1-3"><div id="user" style=""><label for="val_select"> User <span class="req">*</span></label><br/><input type="text" disabled="" value="'+datas[1]+'" /><input type="hidden" value="'+datas[2]+'" name="report[report]['+level+'][users]" /></div></div></td>';
                //$res += '<td><div class="uk-width-medium-1-3"><div id="approve" style=""><label for="val_select"> Status  <span class="req">*</span></label><br/>'+condition[0].outerHTML+'</div></div></td>';
                if($user != ''){ 
                    var auth_user = '<div id="authorized_user_'+level+'">'+$user+'</div>';
                    $res +='<td>'+auth_user+'</td>';
                    //$res += '<div class="uk-width-medium-1-3"><div id="authorized_user_'+level+'" style=""><label for="val_select" >Authorized User  <span class="req">*</span></label><br/>'+$user+'</div></div>';
                }
                $res += '<td><div id="approve" style="">'+condition[0].outerHTML+'</div></td>';
                $res += '<td class="report_level_'+level+'"></td>';
                $res += '<td class="actions_level_'+level+'"></td>';
                $res += '</tr>';
                $('.workflows_page').append($res);
                var scripts = document.createElement("script");
                scripts.type = "text/javascript";
                scripts.id="level_"+level;
                scripts.innerHTML ="var condition= $('#approve_user_"+level+"');if(condition) {condition.kendoDropDownList(); } var users =$('#authority_"+level+"');if(users) {users.kendoDropDownList();} ";
                $("#level_"+level).append(scripts);
            }
        });
    }
    $(document).on('change','.authority',function(){
        var level = $(this).parent().parent().parent().parent().data('level');
        var hierarchy = $("#hierarchy_id").val();
        var form = $("#form_id").val();
        if(level != undefined){
            var id  = $(this).parent().parent().parent().parent().attr('id');
            var row_level = level;
            row_level +=2;
            var parent =$(this).parent().parent().parent().parent();
            var current_val = $(this).val();
            $('.level').each(function(i){
                if(i > level && i != undefined){
                    $('#level_'+i).remove();
                }
            });
            
            if(current_val == '2'){
                console.log(level)
                $('.report_level_'+level).html('N/A');
            }
            else if (current_val == '1'){
                /* Find Authorized user is selected or not */
                var reported_user = $(parent).find('.authorized_users :selected').val();
                if(reported_user != ''){
                    var user = [];
                    $('.authorized_users :selected').each(function(i, selected){ 
                        user[i] = $(selected).val(); 
                    });
                    var org_id = $('#org_id').val();
                    /* Generate Next row */
                    level++;
                    get_next_level_user(user,org_id,level,row_level,hierarchy,form);
                    --level;
                    $('.report_level_'+level).html('Report to next level');
                }else{
                    $(parent).find('#authorized_user').after('<p class="error">Please select Authorised User</p>');
                    return false;
                }
            }
        }
    });
    $(document).on('change','.authorized_users',function(){
        var id  = $(this).parent().parent().parent().parent().attr('id');
        var level = $(this).parent().parent().parent().parent().data('level');
        var hierarchy = $("#hierarchy_id").val();
        var form = $("#form_id").val();
        var row_level = level;
        row_level += 2;
        var parent =$(this).parent().parent().parent().parent();
        $(parent).find('.error').remove();
        var reported_user = $(this).val();
        $('tr.level').each(function(i){
            if(i > level && i != undefined){
                $('#level_'+i).remove();
            }
        });
        var reported_user = $(this).val();
        var action1 = $(parent).find('.authority :selected').val();
        var org_id = $('#org_id').val();
        var remaining_user = '';
        var remaining = '';
        if(reported_user != '' && action1 == '1'){
            var user = [];
            $('.authorized_users :selected').each(function(i, selected){ 
                user[i] = $(selected).val(); 
            });
            level++;
            get_next_level_user(user,org_id,level,row_level,hierarchy,form);
        }
    });
    function getElementChecked(referenceVar) {
        if(referenceVar) {
            return referenceVar.outerHTML;
        } else {
            return '';
        }
    }
    $(document).on('change','#form_workflow',function(){
        if(this.value != ''){
            window.location=baseURL+'workflow/edit/' + this.value;
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
        //$("#assign_to").show();
    });


    $("input[name='assign_to']").change(function(){
        current = $(this).val();
        $('#lists').empty();
        var org_id = $('#org_id').val();
        if(org_id == 0){
            org_id = $('#form_org').val();
        }
        console.log(current);
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
                        scripts.innerHTML ="var multiselect_user= $('#multiselectuser');if(multiselect_user.length){ multiselect_user.chosen(); }";
                        //scripts.innerHTML ="var $kUI_multiselect_user= $('#multiselectuser');if($kUI_multiselect_user.length) {$kUI_multiselect_user.kendoMultiSelect(); }";
                        $("#lists").append(scripts);
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
                        
                    },
                    success: function(data) 
                    {
                        $("#lists").html(data);
                        var script = document.createElement("script");
                        script.type = "text/javascript";
                        //script.innerHTML ="var $kUI_multiselect_dept= $('#multiselectdept');if($kUI_multiselect_dept.length) {$kUI_multiselect_dept.kendoMultiSelect(); }";
                        script.innerHTML ="var $kUI_multiselect_dept= $('#multiselectdept');if($kUI_multiselect_dept.length) {$kUI_multiselect_dept.chosen(); }";
                        $("#lists").append(script);
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
                    console.log(data);
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
                 /*var script = document.createElement("script");
                 script.type = "text/javascript";
                 script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                 //script.innerHTML ="var $kUI_multiselect_domain = $('#multiselect_domain');if($kUI_multiselect_domain.length) {$kUI_multiselect_domain.kendoMultiSelect(); }";
                 $("#domain").append(script);*/

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
            $("#details").html(data[0]);
            $("#domain").html(data[1]);
             if(data[2] != ''){
                $("#department").html(data[2]);
                var script = document.createElement("script");
                script.type = "text/javascript";
                script.innerHTML ="var $kUI_multiselect_department = $('#multiselect_department');if($kUI_multiselect_department.length) {$kUI_multiselect_department.kendoMultiSelect(); }";
            }else{
                $('#department').html('<br/>No Department against this organization.Please create a <a href="'+baseURL+'department/add">Department</a>');
            }
            $("#users").html(data[3]);
            if(data['org_roles']){
                $('#role').html(data['org_roles']);
                var role_script = document.createElement("script");
                role_script.type = "text/javascript";
                role_script.innerHTML ="var orgrole_chosen = $('.chosen_select');if(orgrole_chosen.length) {orgrole_chosen.chosen({no_results_text:'Oops, nothing found!',width:'95%'}); }";
                $('#role').append(role_script);
            }
            if(data['org_location']){
                $('#location').html(data['org_location']);
                var location_script = document.createElement("script");
                location_script.type = "text/javascript";
                location_script.innerHTML ="var orglocation_chosen = $('.location_chosen');if(orglocation_chosen.length) {orglocation_chosen.chosen({no_results_text:'Oops, nothing found!',width:'95%'}); }";
                $('#location').append(location_script);
            }
            $("#details").append(script);
        }
    });
}
function org_location_change(orgid){
    var org_id = orgid;
    
            $.ajax({
             type: "POST",
             url: baseURL + "users/org_details/",
             data: {org_id: org_id},
             dataType: "json",
             success: function(data) 
            {
                $("#users").html(data['org_user']);
                var script = document.createElement("script");
                script.type = "text/javascript";
                script.innerHTML ="var multiselectuser = $('#multiselect_users');if(multiselectuser.length) {multiselectuser.kendoMultiSelect(); }";
                $(".org_users").append(script);
                console.log(data['org_country']);
                $("span.location_country").find('.k-input').text(data['org_country']);
            }

         });
}

/* User Preview */
function user_preview(id){
    $.ajax({
        type: "GET",
        url: baseURL + "users/user_preview",
        data:{id:id},
        dataType: "html",
        beforeSend:function(){
            $('body').addClass("loading");
        },
        success: function(data) 
        {
            UIkit.modal.alert(data, function(){ 

            });
        },
        complete:function(){
          $('body').removeClass("loading");  
        }
    });
}
/* Location preview */
function location_preview(id){
    $.ajax({
        type: "GET",
        url: baseURL + "location/location_preview",
        data:{id:id},
        dataType: "html",
        beforeSend:function(){
            $('body').addClass("loading");
        },
        success: function(data) 
        {
            UIkit.modal.alert(data, function(){ 

            });
        },
        complete:function(){
          $('body').removeClass("loading");  
        }
    });   
}
/* Form Preview */
function form_preview(id){
    $.ajax({
        type: "GET",
        url: baseURL + "form/preview",
        data:{id:id},
        dataType: "html",
        beforeSend:function(){
            $('body').addClass("loading");
        },
        success: function(data) 
        {
            UIkit.modal.alert(data, function(){ 

            });
        },
        complete:function(){
          $('body').removeClass("loading");  
        }
    });   
}
/* Form Submission Preview */
function submission_preview(id){
    $.ajax({
        type: "GET",
        url: baseURL + "form/submission_preview",
        data:{id:id},
        dataType: "html",
        beforeSend:function(){
            $('body').addClass("loading");
        },
        success: function(data) 
        {
            UIkit.modal.alert(data, function(){ 

            });
        },
        complete:function(){
          $('body').removeClass("loading");  
        }
    });   
}
function worflow_preview(id){
    $.ajax({
        type: "GET",
        url: baseURL + "workflow/preview",
        data:{id:id},
        dataType: "html",
        beforeSend:function(){
            $('body').addClass("loading");
        },
        success: function(data) 
        {
            UIkit.modal.alert(data, function(){ 

            });
        },
        complete:function(){
          $('body').removeClass("loading");  
        }
    });   
}
/* Delete Role Function */

/* Role Preview */
function role_preview(id){
    /*console.log($(this));
    var id = $(this).data();
    console.log(id);*/
    $.ajax({
        type: "GET",
        url: baseURL + "role/role_preview",
        data:{id:id},
        dataType: "html",
        beforeSend:function(){
            $('body').addClass("loading");
        },
        success: function(data) 
        {
            UIkit.modal.alert(data, function(){ 

            });
        },
        complete:function(){
          $('body').removeClass("loading");  
        }
    });
}

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
                console.log(data);
                 if(data!=0)
                 {
                    UIkit.modal.alert("Since already a Department is Default.You can't set this department as default.", function(){ 
                       
                    });
                    
                    return false;
//                    $("#depart_default").prop("checked", false);
                 }
                 else if(data == 0)
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
/*$('.newOrg').submit(function(e){
    var email =$("#usr_email").val();
    $.ajax({
            type: "POST",
            url: baseURL + "users/validate",
            data: {email: email},
            dataType: "html",
            success: function(data) 
            {           
                console.log(data);     
                if(data == 0){
                    return true;
                }else{
                    e.preventDefault();
                    return false;
                }
            }
    });
});*/
 window.ParsleyValidator
        .addValidator('email', function (value, requirement) {
            var response = false;
            $.ajax({
                url: baseURL + "users/email_validate",
                data: {email: value},
                dataType: 'json',
                method: 'post',
                async: false,
                success: function(data) {
                   console.log(data);
                   if(data == 0){
                        response = true;
                    }else{
                        response = false;
                    }
                },
                error: function() {
                    response = false;
                    console.log(response);
                }
            });

            return response;
        }, 32)
        .addMessage('en', 'email', 'The email already exists.');

function get_domain_submit_block()
{
    $("#hide_domain_content").css('z-index','999999');
    $("#hide_domain_content").show();
}


    $(document).ready(function() {
        $('.advanced_check_filters').click(function() {
                $('.check_filters').slideToggle("fast");
        });
        function readURL(input,id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(id).css('background-image','');
                    $(id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        function logo(input,id){

            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.addEventListener("load", function (e) {
                    var img = new Image();
                    img.onload = function () {
                        alert(this.width + " " + this.height);
                    };
                    $(id).attr('src', e.target.result);
                });
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#user_edit_avatar_control").change(function(){
            readURL(this,'.profile_image');
        });
        $("#org_logo").change(function(){
              
                var current = this;
                $(this).parent().find('.error').remove();
                var fileInput = document.getElementById('org_logo');
                var file = fileInput.files[0];
                var sizeKB = file.size / 1024;
                var ext = file.type.split('/').pop().toLowerCase();
                if($.inArray(ext, ['png','jpg','jpeg']) < 0) {
                    $(this).after('<p class="error" style="margin-top:46px">Supported Image format(png,jpg,jpeg)</p>');                    
                }else {
                        var img = new Image();
                        img.src = window.URL.createObjectURL( file );
                        img.onload = function() {
                            var width = img.naturalWidth,
                                height = img.naturalHeight;
                            window.URL.revokeObjectURL( img.src );
                            if( width === 500 && height === 300 ) {
                                logo(current,'.org_logo');
                            }
                            else {
                                $(current).parent().append('<p class="error" style="margin-top:46px">Image size is exceeded the limit</p>');
                            }
                        };
                    /*//var formData = new FormData();
                    var form = new FormData($('#form_validation')[0]);
                    //formData.append('file', file);
                    console.table(form);
                    $.ajax({
                        type:"post",
                        url:baseURL+'organization/logo',
                        data:form,
                        cache: false,
                        success: function(reponse) {
                              if(reponse) {
                                alert(reponse);
                              } else {
                                alert('Erreur');
                              }
                        }
                    });*/
                    /*if(sizeKB < 50){
                        logo(this,'.org_logo');
                    }else{
                        $(this).after('<p class="error">Image size is exceeded the limit</p>');
                    }*/
                }
        });
            //
        //});
        
        $('.plan').click(function(){
            var plan = $(this).data('plan');
            var check_green = $(this).parent().parent().parent().parent().parent().find('.plan');
            if(check_green.hasClass('green-bg')){
                check_green.removeClass('green-bg');
            }   
            if(plan != ''){
                $('#org_plans').val(plan);
                $(this).addClass('green-bg');
                $('.new_plan').val('');
            }else{
                if($(this).parent().hasClass('green-bg')){
                    $(this).parent().removeClass('green-bg');
                }
                var lilist = $(this).parent().parent().find('.plan-list li');
                var list = $(this).parent().parent().find('.plan-list');
                lilist.each(function(i){
                    if(i <= 3){
                        $(this).remove();
                    }
                    i++;//console.log(i);
                });
                $.ajax({
                    type:'post',
                    url: baseURL+'organization/plans',
                    data:{plans:$('.new_plan').val(),preview:0},
                    dataType:'html',
                    beforeSend:function(){

                    },
                    success:function(data){
                        list.append(data);
                    }
                })
                var parent = $(this).parent();
                parent.append('<div class="actions"> <b class="ok" onclick="planok(this)"> Ok </b> <b class="cancel" onclick="plancancel(this);">Cancel</b></div>');
                $(this).css('display','none');
            }
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