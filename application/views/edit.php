

    <div id="page_content">
        <div id="page_content_inner">

<form action="" id="form_validation" class="uk-form-stacked" name="organization" method="post" enctype="multipart/form-data">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Organization</h3>
            
                <!--<?php if($ErrorMessages!='') {?>
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $ErrorMessages;  ?>
                </div> <?php } ?>  -->
                
                <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?>  
                            <?php //print_r($result); ?>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 <div class="parsley-row">
                                    <label for="fullname">Organization Name <span class="req">*</span></label>
                                    <input type="text" name="org_name" class="md-input" value="<?php if(ISSET($_POST['org_name'])){ set_value('org_name'); } else{ echo $result['org']['org_name']; }?>" />
                                    <?php echo "<div style='color:red'>".form_error('org_name')."</div>"; ?>
                                </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                                   <label>Organization Logo</label>
                                   <input type="text" class="md-input" id="org_logo" name="org_logo" />
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Location</h3>
                    <div class="location_container" >
                    <?php if(isset($_POST['address'])) {
      				foreach($_POST['address'] as $count)
					{ ?>
					<div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<input type="hidden" name="loc_id[]" value="<?php echo set_value('loc_id[]'); ?>" />
                        <div class="uk-width-medium-1-2">
                                 <label>Address</label>
                                 <input type="text" class="md-input" name="address[]" value="<?php echo set_value('address[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('address[]')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                                   <label>City</label>
                                   <input type="text" class="md-input" name="city[]" value="<?php echo set_value('city[]');?>" />
                                   <?php echo "<div style='color:red'>".form_error('city[]')."</div>"; ?>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                    	<div class="uk-width-medium-1-2">
                                   <label>Country</label>
                                   <input type="text" class="md-input" name="country[]" value="<?php echo set_value('country[]');?>" />
                                   <?php echo "<div style='color:red'>".form_error('country[]')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                                 <label>state</label>
                                 <input type="text" class="md-input" name="state[]" value="<?php echo set_value('state[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('state[]')."</div>"; ?>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 <label>Zip Code</label>
                                 <input type="text" class="md-input" name="zip[]" value="<?php echo set_value('zip[]');?>" />
                                 <?php echo "<div style='color:red'>".form_error('zip[]')."</div>"; ?>
                        </div>
                    </div>
                    <hr style="border-top:1px #000 solid;">
                    <div class="remove_field" style="text-align: right;width: 92%;">+ Remove Location</div>
                    </div>
                    <?php }
      		} else{
      		
      				foreach($result['location'] as $location)
					{ ?>
<div>
		      		<div class="uk-grid" data-uk-grid-margin>
		      			<input type="hidden" name="loc_id[]" value="<?php echo $location['id'];?>" />
		      			<div class="uk-width-medium-1-2">
				      		<label>Location Name</label>
				      		<input type="text" class="md-input" name="address[]" value="<?php echo $location['location_name'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('location_name[]')."</div>"; ?>
			      		</div>
			      		
			      		<div class="uk-width-medium-1-2">
				      		<label>Address</label>
				      		<input type="text" class="md-input" name="address[]" value="<?php echo $location['address'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('address[]')."</div>"; ?>
			      		</div>
			      	</div>
			      	<div class="uk-grid" data-uk-grid-margin>
			      		<div class="uk-width-medium-1-2">
				      		<label>City</label>
				      		<input type="text" class="md-input" name="city[]" value="<?php echo $location['city'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('city[]')."</div>"; ?>
			      		</div>
			      		<div class="uk-width-medium-1-2">
				      		<label>Country</label>
				      		<input type="text" class="md-input" name="country[]" value="<?php echo $location['country'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('country[]')."</div>"; ?>
			      		</div>
			      	</div>
			      	<div class="uk-grid" data-uk-grid-margin>
			      		<div class="uk-width-medium-1-2">
				      		<label>state</label>
				      		<input type="text" class="md-input" name="state[]" value="<?php echo $location['address'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('state[]')."</div>"; ?>
			      		</div>
			      		<div class="uk-width-medium-1-2">
				      		<label>Zip Code</label>
				      		<input type="text" class="md-input" name="zip[]" value="<?php echo $location['zip_code'];?>" />
				      		<?php echo "<div style='color:red'>".form_error('zip[]')."</div>"; ?>
			      		</div>
		      		</div>
		      		<hr style="border-top:1px #000 solid;">
<div class="remove_field" style="text-align: right;width: 92%;">+ Remove Location</div>
</div>
      	<?php } } ?>
      		
      		</div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <a class="add_location_button"> + Add New Location </a>
                    </div>
                </div>
            </div>
            
            
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">User Info</h3>
                        
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                 <label>User Name</label>
                                 <input type="text" class="md-input" id="usr_name" name="usr_name" value="<?php if(ISSET($_POST['user_name'])){echo set_value('usr_name');} else{ echo $result['org']['user_name']; }?>" />
                                 <?php echo "<div style='color:red'>".form_error('usr_name')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                                <label>Passsword</label>
                                <input type="password" class="md-input" id="usr_psw" name="usr_psw" value="<?php if(ISSET($_POST['usr_psw'])){echo set_value('usr_psw');} else{ echo $result['org']['password']; }?>" />
                                <?php echo "<div style='color:red'>".form_error('usr_psw')."</div>"; ?>
                        </div>
                    </div>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                                        <label>Email</label>
                                        <input type="text" class="md-input" id="usr_email" name="usr_email" value="<?php if(ISSET($_POST['usr_email'])){echo set_value('usr_email');} else{ echo $result['org']['email']; }?>" />
                                        <?php echo "<div style='color:red'>".form_error('usr_email')."</div>"; ?>
                        </div>
                        <div class="uk-width-medium-1-2">
                                <label>Phone</label>
                                <input type="text" class="md-input" id="usr_phone" name="usr_phone" value="<?php if(ISSET($_POST['usr_phone'])){echo set_value('usr_phone');} else{ echo $result['org']['phone']; }?>" />
                                <?php echo "<div style='color:red'>".form_error('usr_phone')."</div>"; ?>
                        </div>
                    </div>
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
		                  
		      			</div>
		      			<div class="uk-width-medium-1-2" style="float:right;">
		                  <input type="submit" class="uk-form-file md-btn md-btn-primary" style="float:right;" name="Create" value="Create" onclick="return showNoFile();">
		      			</div>
                    </div>
                </div>
            </div>
	
        </form>    

        </div>
    </div>

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
    <!-- altair common functions/helpers -->
    <script src="<?php echo base_url(); ?>assets/assets/js/altair_admin_common.min.js"></script>


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

		    var cont = '<div><div class="uk-grid" data-uk-grid-margin><div class="uk-width-medium-1-2"><label>Address</label><input type="text" class="md-input" name="address[]" value="<?php echo set_value('address[]');?>" /></div><div class="uk-width-medium-1-2"><label>City</label><input type="text" class="md-input" name="city[]" value="<?php echo set_value('city[]');?>" /></div></div><div class="uk-grid" data-uk-grid-margin><div class="uk-width-medium-1-2"><label>Country</label><input type="text" class="md-input" name="country[]" value="<?php echo set_value('country[]');?>" /></div><div class="uk-width-medium-1-2"><label>state</label><input type="text" class="md-input" name="state[]" value="<?php echo set_value('state[]');?>" /></div></div><div class="uk-grid" data-uk-grid-margin><div class="uk-width-medium-1-2"><label>Zip Code</label><input type="text" class="md-input" name="zip[]" value="<?php echo set_value('zip[]');?>" /></div></div><hr style="border-top:1px #000 solid;"><div class="remove_field" style="text-align: right;width: 92%;">+ Remove Location</div></div>';
		    
		    var x = 1; //initlal text box count
		    
		    $(add_button).click(function(e){ //on add input button click
		    	
		        e.preventDefault();
		       
		            x++; //text box increment
		            $(wrapper).append(cont); //add input box

		           datepick();
		    });		

		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent().remove(); x--;
		    });
		       
		});
</script>

</body>
</html>
