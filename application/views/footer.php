   <?php 
    /* Check Page Current selection */
        $page = $this->uri->segment(1);
        $sub_page = $this->uri->segment(2); 
    ?>
 <!-- google web fonts -->

    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/common.min.js"></script>
    <!-- uikit functions -->
     <script src="<?php echo base_url(); ?>assets/assets/js/uikit_custom.js"></script>

    <script src="<?php echo base_url(); ?>assets/assets/js/altair_admin_common.min.js"></script>


    
     <!-- datatables -->
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables custom integration  -->
    <script src="<?php echo base_url(); ?>assets/assets/js/custom/datatables_uikit.min.js"></script>
    <!--  datatables functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/plugins_datatables.js"></script>
    <!-- d3 -->
        <script src="<?php echo base_url(); ?>assets/bower_components/d3/d3.min.js"></script>
    
    <!-- Maps js 
     <?php if($page == 'dashboard'){?>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/maplace.js/src/maplace-0.1.3.js"></script>
    <!-- chartist (charts) 
        <script src="<?php echo base_url(); ?>assets/bower_components/chartist/dist/chartist.min.js"></script>-->
          <script src="<?php echo base_url(); ?>assets/assets/js/pages/dashboard.min.js"></script>
    <?php } ?>

    <!-- peity (small charts) -->
    <script src="<?php echo base_url(); ?>assets/bower_components/peity/jquery.peity.min.js"></script>
    <!-- easy-pie-chart (circular statistics) -->
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
            
     <!-- page specific plugins 
    <!-- kendo UI  -->
    <script src="<?php echo base_url(); ?>assets/assets/js/kendoui_custom.min.js"></script>
  
    <!--  kendoui functions --> 
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/kendoui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/aes.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/aes-json-format.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/custom_localtime.js"></script>
    <!-- altair Validation functions--> 
    <script src="<?php echo base_url(); ?>assets/bower_components/parsleyjs/dist/parsley.min.js"></script>
    <!-- Forms Validation -->
    <?php if(($sub_page == 'add' && $page != 'form') || ($sub_page == 'edit' && ($page == 'myprofile' || $page != 'workflow' && $page != 'form' ))){  ?>
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/forms_validation.min.js"></script>
    <?php } ?>
    <script>
    // load parsley config (altair_admin_common.js)
        altair_forms.parsley_validation_config();
        altair_forms.parsley_extra_validators();
       
    </script> 
    <!--<script src="<?php echo base_url(); ?>assets/assets/js/custom/wizard_steps.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/forms_wizard.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/assets/js/chosen.jquery.min.js"></script>

    <script type="text/javascript">
           
     var $kUI_multiselect_basic = $('#multiselect');
        if($kUI_multiselect_basic.length) {
            $kUI_multiselect_basic.kendoMultiSelect();
        }
        var multiselect_location= $('#multiselect_location');
        if(multiselect_location.length) {
            multiselect_location.kendoMultiSelect();
        }
        var multiselect_size = $('.multiselect_size');
        if(multiselect_size.length) {
            multiselect_size.kendoMultiSelect();
        }
        var location_country = $('.location_country');
        location_country.kendoDropDownList();
        var $kUI_multiselect_domain = $('#multiselect_domain');
        if($kUI_multiselect_domain.length) {
            var required = $kUI_multiselect_domain.kendoMultiSelect().data("kendoMultiSelect");
            $(".domain_select #select").click(function() {
            var values = $.map(required.dataSource.data(), function(dataItem) {
                //if(dataItem.value){
                  return dataItem.value;
            });
            required.value(values);
            
            $('.domain_select #select').hide();
            $('.domain_select #deselect').show();
          });

          $(".domain_select #deselect").click(function() {
            required.value([]);
            $('.domain_select #deselect').hide();
            $('.domain_select #select').show();
          });
        }
    var org_location = $("#org_location");
    if(org_location.length){
        org_location.kendoDropDownList();
    }
    var org_forms = $("#org_forms");
    if(org_forms.length){
        org_forms.kendoDropDownList();
    }
    var org_users = $("#org_users");
    if(org_users.length){
        org_users.kendoDropDownList();
    }
    var $kUI_multiselect_department = $('#multiselect_department');
        if($kUI_multiselect_department.length) {
	   $kUI_multiselect_department.kendoMultiSelect(); 
	}
  /*  var $kUI_multiselect_department = $('#multiselect_department');
        if($kUI_multiselect_department.length) {
	   $kUI_multiselect_department.kendoMultiSelect(); 
	}    */
    var $kUI_multiselect_category = $('#multiselect_category');
        if($kUI_multiselect_category.length) {
       $kUI_multiselect_category.kendoMultiSelect(); 
    }
    var $kUI_multiselect_role = $('#multiselect_role');
        if($kUI_multiselect_role.length) {
       $kUI_multiselect_role.kendoMultiSelect(); 
    }
     var multiselect_users = $('#multiselect_users');
        if(multiselect_users.length) {
            multiselect_users.kendoMultiSelect();
        }
    

    </script>
    <?php 
        if(isset($workflow)){
            if(is_array($workflow)){
                $count = count($workflow);
            }else{
                $count = 0;
            }
        //$count = count($workflow);
        $i = '0';
            if($count >= 1){
                foreach($workflow as $key=>$values){ 
                $level = $key++;
                $i++;
    ?>
            <script type="text/javascript">
                var condition= $('#approve_user_<?php echo $i; ?>');
                if(condition) {
                        condition.kendoDropDownList(); 
                    } 
                var users =$('#authority_<?php echo $i; ?>');
                if(users) {
                    users.kendoDropDownList();
                } 
            </script>
    <?php       } 
            } 
        }
    ?>
 
    <?php //} 
      ?>
 <!-- common functions -->

    <script src="<?php echo base_url(); ?>assets/assets/js/custom.js"></script>
    <?php if(($sub_page == 'add' || $sub_page == 'edit') && $page == 'form'){ 
        if($sub_page != 'edit') { ?>
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery1.12.4.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery.ui.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="<?php echo base_url(); ?>assets/assets/js/form.js"></script>  
    <?php } else { ?>
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery1.12.4.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery.ui.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="<?php echo base_url(); ?>assets/assets/js/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/formEdit.js"></script>  
    <?php }  if($sub_page == 'report') { ?>
     <script src="<?php echo base_url(); ?>assets/assets/js/jquery1.12.4.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery.ui.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="<?php echo base_url(); ?>assets/assets/js/moment.js"></script>
    <?php } ?>
    <script type="text/javascript">
         if($('body').hasClass('sidebar_main_active')){
            $('body').removeClass('sidebar_main_active');
        }
        if($('body').hasClass('sidebar_main_open')){
            $('body').removeClass('sidebar_main_open');
        }
        $('body').addClass('sidebar_mini');
        function setHeight() {
            windowHeight = $(window).innerHeight();
            //console.log(windowHeight-127);
            details = $('.details').height();
            header = $('#header_main').height();
            reduce = details + header + 90;
            form_height = windowHeight - reduce;

            console.log(form_height);
            $('#forms').css('height',form_height+'px');
            $('#forms').css('max-height',form_height+'px');
            //$('.sidebar').css('min-height', windowHeight);
        };
        setHeight();
    </script> 
    <?php } ?>

    <?php //} ?>
    
    <script>
        $(function() {
            // enable hires images
           
            altair_helpers.retina_images();
            // fastClick (touch devices)
            if(Modernizr.touch) {
                FastClick.attach(document.body);
            }
          
        });
        
    </script>

     <script src="<?php echo base_url(); ?>assets/assets/js/chosen.jquery.min.js"></script>
    


 <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-selectct-no-results': {no_results_text:'Oops, nothing found!'},  
      '.chosen-select-width'     : {width:"95%"}
    }
    //for (var selector in config) {
    $('.chosen_select').chosen({no_results_text:'Oops, nothing found!',width:'95%'});
    $("select").on("chosen:showing_dropdown", function(evnt, params) {
    var chosen = params.chosen,
        $dropdown = $(chosen.dropdown),
        $field = $(chosen.form_field);
    if( !chosen.__customButtonsInitilized ) {
        chosen.__customButtonsInitilized = true;
        var contained = function( el ) {
            var container = document.createElement("div");
            container.appendChild(el);
            return container;
        }
        var width = $dropdown.width();
        var opts = chosen.options || {},
            showBtnsTresshold = opts.disable_select_all_none_buttons_tresshold || 0;
            optionsCount = $field.children().length,
            selectAllText = opts.select_all_text || 'All',
            selectNoneText = opts.uncheck_all_text || 'Clear';
        if( chosen.is_multiple && optionsCount >= showBtnsTresshold ) {
            var selectAllEl = document.createElement("a"),
                selectAllElContainer = contained(selectAllEl),
                selectNoneEl = document.createElement("a"),
                selectNoneElContainer = contained(selectNoneEl);
            selectAllEl.appendChild( document.createTextNode( selectAllText ) );
            selectNoneEl.appendChild( document.createTextNode( selectNoneText ) );
            $dropdown.prepend("<div class='ui-chosen-spcialbuttons-foot' style='clear:both;border-bottom: 1px solid black;'></div>");
            $dropdown.prepend(selectNoneElContainer);
            $dropdown.prepend(selectAllElContainer);
            var $selectAllEl = $(selectAllEl),
                $selectAllElContainer = $(selectAllElContainer),
                $selectNoneEl = $(selectNoneEl),
                $selectNoneElContainer = $(selectNoneElContainer);
            var reservedSpacePerComp = (width - 25) / 2;
            $selectNoneElContainer.addClass("ui-chosen-selectNoneBtnContainer")
                .css("float", "right").css("padding", "5px 8px 5px 0px")
                .css("max-width", reservedSpacePerComp+"px")
                .css("max-height", "55px").css("overflow", "hidden");
            $selectAllElContainer.addClass("ui-chosen-selectAllBtnContainer")
                .css("float", "left").css("padding", "5px 5px 5px 7px")
                .css("max-width", reservedSpacePerComp+"px")
                .css("max-height", "55px").css("overflow", "hidden");
            $selectAllEl.on("click", function(e) {
                e.preventDefault();
                $field.children().prop('selected', true);
                /*if($('.chosen-container').hasClass('chosen-with-drop')){
                    $('.chosen-container')
                            .removeClass('chosen-with-drop');
                }
                if($('.chosen-container').hasClass('chosen-container-active')){
                     $('.chosen-container')
                            .removeClass('chosen-container-active');
                }*/
                $field.trigger('chosen:updated');
                return false;
            });
            $selectNoneEl.on("click", function(e) {
                e.preventDefault();
                $field.children().prop('selected', false);
               /* if($('.chosen-container').hasClass('chosen-with-drop')){
                    $('.chosen-container')
                            .removeClass('chosen-with-drop');
                }
                if($('.chosen-container').hasClass('chosen-container-active')){
                     $('.chosen-container')
                            .removeClass('chosen-container-active');
                }*/
                //chosen-with-drop chosen-container-active
                $field.trigger('chosen:updated');
                return false;
            });
        }
    }
});
   //}
  </script> 
    <div id="style_switcher" style="display: none;">
    <div id="style_switcher_toggle"><i class="material-icons">&#xE8B8;</i></div>
    <div class="uk-margin-medium-bottom">
        <h4 class="heading_c uk-margin-bottom">Colors</h4>
        <ul class="switcher_app_themes" id="theme_switcher">
            <li class="app_style_default active_theme" data-app-theme="">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_a" data-app-theme="app_theme_a">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_b" data-app-theme="app_theme_b">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_c" data-app-theme="app_theme_c">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_d" data-app-theme="app_theme_d">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_e" data-app-theme="app_theme_e">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_f" data-app-theme="app_theme_f">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_g" data-app-theme="app_theme_g">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
        </ul>
    </div>
    <div class="uk-visible-large">
        <h4 class="heading_c">Sidebar</h4>
        <p>
            <input type="checkbox" name="style_sidebar_mini" id="style_sidebar_mini" data-md-icheck />
            <label for="style_sidebar_mini" class="inline-label">Mini Sidebar</label>
        </p>
    </div>
</div>



<script>
    $(function() {
        var $switcher = $('#style_switcher'),
            $switcher_toggle = $('#style_switcher_toggle'),
            $theme_switcher = $('#theme_switcher'),
            $mini_sidebar_toggle = $('#style_sidebar_mini');

        $switcher_toggle.click(function(e) {
            e.preventDefault();
            $switcher.toggleClass('switcher_active');
        });

        $theme_switcher.children('li').click(function(e) {
            e.preventDefault();
            var $this = $(this),
                this_theme = $this.attr('data-app-theme');

            $theme_switcher.children('li').removeClass('active_theme');
            $(this).addClass('active_theme');
            $('body')
                .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g')
                .addClass(this_theme);

            if(this_theme == '') {
                localStorage.removeItem('altair_theme');
            } else {
                localStorage.setItem("altair_theme", this_theme);
            }

        });

        // change input's state to checked if mini sidebar is active
        if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $('body').hasClass('sidebar_mini')) {
            $mini_sidebar_toggle.iCheck('check');
        }

        // toggle mini sidebar
        $mini_sidebar_toggle
            .on('ifChecked', function(event){
                $switcher.removeClass('switcher_active');
                localStorage.setItem("altair_sidebar_mini", '1');
                location.reload(true);
            })
            .on('ifUnchecked', function(event){
                $switcher.removeClass('switcher_active');
                localStorage.removeItem('altair_sidebar_mini');
                location.reload(true);
            });

        // hide style switcher
        $document.on('click keyup', function(e) {
            if( $switcher.hasClass('switcher_active') ) {
                if (
                    ( !$(e.target).closest($switcher).length )
                    || ( e.keyCode == 27 )
                ) {
                    $switcher.removeClass('switcher_active');
                }
            }
        });

        if(localStorage.getItem("altair_theme") !== null) {
            $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
        }
    });
</script>


<script type="text/javascript">
$(document).ready(function() {
    var wrapper         = $(".location_container"); //Fields wrapper
    var add_button      = $(".add_location_button"); //Add button ID

    var cont = '<div><div class="uk-grid" data-uk-grid-margin><div class="uk-width-medium-1-2"><label>Location Name</label><input type="text" class="md-input" name="location_name[]" value="<?php echo set_value('location_name[]');?>" /></div><div class="uk-width-medium-1-2"><label>Address</label><input type="text" class="md-input" name="address[]" value="<?php echo set_value('address[]');?>" /></div></div><div class="uk-grid" data-uk-grid-margin><div class="uk-width-medium-1-2"><label>City</label><input type="text" class="md-input" name="city[]" value="<?php echo set_value('city[]');?>" /></div><div class="uk-width-medium-1-2"><label>Country</label><input type="text" class="md-input" name="country[]" value="<?php echo set_value('country[]');?>" /></div></div><div class="uk-grid" data-uk-grid-margin><div class="uk-width-medium-1-2"><label>state</label><input type="text" class="md-input" name="state[]" value="<?php echo set_value('state[]');?>" /></div><div class="uk-width-medium-1-2"><label>Zip Code</label><input type="text" class="md-input" name="zip[]" value="<?php echo set_value('zip[]');?>" /></div></div><div class="remove_field" style="text-align: right;width: 92%;">+ Remove Location</div><hr style="border-top:1px #000 solid;"></div>';
    
    var x = 1; //initlal text box count
    
    $(add_button).click(function(e){ //on add input button click
    	
        e.preventDefault();
       
            x++; //text box increment
            $(wrapper).append(cont); //add input box

           datepick();
    });		

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    	var x = confirm("Are you sure, you want to delete Location?");
    	if (x){
       	 	e.preventDefault(); $(this).parent().remove(); x--;
    	}
    });
	

		$( ".show-buuton" ).click(function() {
			$( ".show-content" ).toggle( "slow" );
		});

       
});
$(window).load(function(){
    $("#spinner").fadeOut("slow");
}); 
function planok(current){
    var ul = $('ul.plan-list li');
    var list = $('.plan-list');
    var plans = {};
    var fields ={};
    ul.each(function(i){
        value = $(this).find('.plan-entry').val();
        data = $(this).find('.plan-entry').data('plans');
        if(value == '' || value == undefined){
            if(!$(this).find('p.error').length){
                $(this).find('.plan-entry').after('<p class="error">please type your request plan as number</p>');
            }
        }else if(value != ''){
            $(this).find('p.error').remove();
            //fieldss.value=value
            if(data == 'users'){
                plans.users = value;
            }
            if(data == 'jobsites'){
                plans.jobsites = value;
            }
            if(data == 'forms'){
                plans.forms = value;
            }

        }
    });

    if(ul.find('p.error').length == 0){
        fields.plans=JSON.stringify(plans);
        $('.new_plan').val(CryptoJS.AES.encrypt(JSON.stringify(fields),'',{format: CryptoJSAesJson}).toString());
        var change = $('.professional-plan #custom');
        $.ajax({
            type:'post',
            url: baseURL+'organization/plans',
            data:{plans:$('.new_plan').val(),preview:1},
            dataType: "html",
            beforeSend:function(){
                ul.each(function(i){
                    if(i <= 3){
                        $(this).remove();
                    }
                    i++;
                });
            },
            success:function(data){
                list.append(data);
            }
        });
        $(current).parent().remove();
        //current.remove();
        change.find('.plan').addClass('green-bg');
        change.find('.plan').css('display','block');
    }

}

function plancancel(current){
    var ul = $('ul.plan-list li');
    var list = $('.plan-list');
    var plans = {};
    var fields ={};
    var change = $('.professional-plan #custom');
     $.ajax({
            type:'post',
            url: baseURL+'organization/plans',
            data:{plans:'',preview:1},
            dataType: "html",
            beforeSend:function(){
                ul.each(function(i){
                    if(i <= 3){
                        $(this).remove();
                    }
                    i++;
                });
            },
            success:function(data){
                list.append(data);
            }
        });
        $(current).parent().remove();
        //change.addClass('green-bg');
        change.find('.plan').css('display','block');
}
</script>



<?php if(isset($setdepartmentCustomjs) && $setdepartmentCustomjs=='yes')
{   ?>
<script type="text/javascript">    
    $(document).ready(function () {
        var deptform = $('#form_validation');
        deptform.find('input[type="submit"]').click(function () {
            var system_default = $("input[type='checkbox'][name='depart_default']:checked").length;
            var dept_name = $("#dept_name").val();
            var dept_id = $("#dept_id").val();
            var org_id = $("#org_id").val();
            if (system_default == 1 && dept_name != '')
            {
                $.ajax({
                    type: "POST",
                    url: baseURL + "department/check_department_default/",
                    data: {org_id: org_id, dept_id: dept_id},
                    dataType: "html",
                }).success(function (response)
                {   console.log(response);                    
                    if(response == 1)
                    {
                        UIkit.modal.alert("Since already a Department is Default.You can't set this department as default.", function () {
                            return false;
                        });
                        
                    }/*else if(response == 0)
                    {
                        $("#form_validation").submit();
                    }*/
                    console.log(response);
                    return false;
                }); /* prevent default when submit button clicked*/
            }
        });
        var deptform = $('.form-category');
         
    });
</script>    
<?php } ?>



<!-- <div id="page_content">
    <div id="page_content_inner">
 <p style="text-align: center;position: fixed;display: block;width: 76%;bottom: 0;background: #ccc;padding: 10px;margin-bottom: 0px;">&copy; Formpro 2016<p>
         </div>
</div>  -->
<div class="modal"><!-- Place at bottom of page --></div>
</body>
</html>
