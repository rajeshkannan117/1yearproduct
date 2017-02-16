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
     <script src="<?php echo base_url(); ?>assets/assets/js/uikit_custom.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/assets/js/altair_admin_common.min.js"></script>


    <?php 
        /* Check Page Current selection */
        $page = $this->uri->segment(1);
        $sub_page = $this->uri->segment(2);
         if($sub_page == 'add'){
    ?>
    <!-- altair common functions/helpers -->

     <script>
    // load parsley config (altair_admin_common.js)
        altair_forms.parsley_validation_config();
    </script> 

    <script src="<?php echo base_url(); ?>assets/bower_components/parsleyjs/dist/parsley.min.js"></script>
    <!-- Forms Validation -->
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/forms_validation.min.js"></script>
    <?php } ?>
    
     <!-- datatables -->
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables colVis 
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
    <!-- datatables tableTools 
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script> -->
    <!-- datatables custom integration  -->
    <script src="<?php echo base_url(); ?>assets/assets/js/custom/datatables_uikit.min.js"></script>
    <!--  datatables functions -->
    <!--<script src="<?php echo base_url(); ?>assets/assets/js/pages/plugins_datatables.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/plugins_datatables.js"></script>

     <!-- page specific plugins 
    <!-- kendo UI  -->
    <script src="<?php echo base_url(); ?>assets/assets/js/kendoui_custom.min.js"></script>

    <!--  kendoui functions --> 
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/kendoui.min.js"></script>
   

    <script type="text/javascript">
        
     var $kUI_multiselect_basic = $('#multiselect');
        if($kUI_multiselect_basic.length) {
            $kUI_multiselect_basic.kendoMultiSelect();
        }
        var multiselect_size = $('.multiselect_size');
        if(multiselect_size.length) {
            multiselect_size.kendoMultiSelect();
        }
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
 
    <?php //} ?>
 <!-- common functions -->

    <script src="<?php echo base_url(); ?>assets/assets/js/custom.js"></script>

    <?php //if($sub_page == 'add') { ?>
  <script src="<?php echo base_url(); ?>assets/assets/js/jquery1.10.js"></script>

    <script src="<?php echo base_url(); ?>assets/assets/js/builder.js"></script>

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
       
});
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
                }).success(function (response) {
                   
                    if (response != 0)
                    {
                        UIkit.modal.alert("Since already a Department is Default.You can't set this department as default.", function () {
                        });
                        return false;
                    } else if (response == '0')
                    {
                        $("#form_validation").submit();
                    }
                }); /* prevent default when submit button clicked*/
                return false;
            }
        });
    });
</script>    
<?php } ?>



<div id="page_content">
    <div id="page_content_inner">
 <p style="text-align: center;position: fixed;display: block;width: 76%;bottom: 0;background: #ccc;padding: 10px;margin-bottom: 0px;">&copy; Formpro 2016<p>
         </div>
</div> 
</body>
</html>
