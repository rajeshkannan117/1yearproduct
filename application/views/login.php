<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>
<meta name="robots" content="noindex,nofollow">
<meta name="description" content=" Innoforms let you build instant digital forms to replace your paper. Start building a efficient workforce by replacing paper forms and letting your team access instant data."/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<?php 
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip=$_SERVER['HTTP_CLIENT_IP'];}
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {
  $ip=$_SERVER['REMOTE_ADDR'];}
?>
<!-- Google Analytics Code -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89786027-1', 'auto');
  ga('send', 'pageview', {'dimension1':  '<?=$ip;?>'});

</script>
<!-- End Google Analytics Code -->


	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicon-32x32.png" sizes="32x32">

    <title>Login - Innoforms</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/login_page.min.css" />
    <style>
    ul.parsley-errors-list{
        padding-left:0px;
    }
    ul.parsley-errors-list li{
        list-style: none !important;
        color:red;
    }
    li.parsley-required,li.parsley-type {
        list-style: none !important;
        color:red;
    }
	.login_heading .logo-main { width:65px; display:inline-block; vertical-align:middle; }
	.login_heading span { font-size: 27px; vertical-align: middle; margin-left: 10px; font-family: 'Open sans'; font-weight: 200; }
    div.g-recaptcha iframe{
        width: 294px !important;
    }
    div.g-recaptcha > div:first-child{
        width: 294px !important;   
    }
    </style>
</head>
<body class="login_page" data-baseurl="<?=base_url()?>">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <!--<div class="user_avatar"></div>-->
                    <div style="" class="logo-main">
                    	<img src="<?php echo base_url(); ?>assets/assets/img/logo.png" />
                    </div>
                    <span style="">Innoforms</span>
                </div>
                
                <?php if ($this->session->flashdata('ErrorMessages')!='') { ?>
                                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                                	
                                    <?php echo $this->session->flashdata('ErrorMessages');  ?>
                </div> <?php } ?>  
                                
                <?php if($ErrorMessages!='')
				{?>
					<div class="uk-alert uk-alert-danger" data-uk-alert="">
						
						<?php echo $ErrorMessages;  ?>
				    </div> <!-- /.alert -->
				<?php } ?>

                <form method="post" id="form_validation" autocomplete="off">
                    <div class="uk-form-row">
                        <div class="parsley-row">
                            <label for="login_username"><?php echo $this->lang->line('email_address'); ?><span class="req" style="color:red;">*</span>
                            </label>
                            <input class="md-input" autocomplete="off" type="email" id="login_username" name="login_username" data-parsley-trigger="change" required data-parsley-type="email" data-parsley-required-message="Email address is required"  data-parsley-email  />
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="parsley-row">
                            <label for="login_password"><?php echo $this->lang->line('password'); ?><span class="req" style="color:red;">*</span>
                            </label>
                            <input class="md-input" autocomplete="off" type="password" id="login_password" name="login_password" data-parsley-trigger="" min-length="3" required value="" data-parsley-error-message="Password is requried" />
                        </div>
                    </div><!-- (Minimum 3 with no special characters) -->
                      <div class="g-recaptcha" data-sitekey="6LcikxEUAAAAAJy7-llFltMlqhZc_FAs-5RFC65n" style="margin-top: 15px;margin-bottom: 15px;"></div>

                    <div class="uk-form-row">
                        <a href="#" id="password_reset_show" class="uk-float-right">
                            <?php echo $this->lang->line('forgot_password'); ?>
                        </a>
                    </div>
                    <div class="uk-form-row">
                       <!--  <a href="index.html" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</a>  -->
                        
                        <input type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large" value="<?php echo $this->lang->line('login'); ?>" >
                    </div>
                    <div class="uk-margin-top">
                        <?php if($this->session->flashdata('return')) {
                            $return = base64_encode($this->session->flashdata('return'));
                        }else { $return = ''; } ?>
                        <input type="hidden" name="return" value="<?php echo $return; ?>" />
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding" id="login_password_reset" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-large-bottom">
                    <?php echo $this->lang->line('forgot_password'); ?>
                </h2>
                <form id="form_validation" action ="<?php echo base_url().'login/forgot_password'?>" class="forgot_password" method="post" name="forgot_password">
                    <div class="uk-form-row">
                        <div class="parsley-row">
                            <label for="login_email_reset"><?php echo $this->lang->line('your_email_address'); ?></label>
                            <input class="md-input" type="email" id="forgot_email" name="forgot_email" data-parsley-trigger="change" data-parsley-type="email" required data-parsley-error-message="Email is requried" />
                        </div>
                    </div>
                    <div id="hide_domain_content" style="position: absolute;width: 95%;height: 50px;z-index: -9;background: #ddd;opacity: 0.5">
                            <img style="margin-left: 40%;padding: 10px;" src="<?php echo base_url().'assets/assets/img/spinners/spinner_warning.gif' ?>" />
                    </div>
                    <div id="error_email">
                    
                    </div>
                    <div class="uk-margin-medium-top">
                        <input type="submit" class="md-btn md-btn-primary md-btn-block reset_email" value="<?php echo $this->lang->line('submit'); ?>" />
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding" id="register_form" style="display: none">
                <h2 class="heading_a uk-margin-medium-bottom">Reset password</h2>
                <form>
                    <div class="uk-form-row">
                        <label for="register_password">Password</label>
                        <input class="md-input" type="password" id="register_password" name="register_password" />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_password_repeat">Repeat Password</label>
                        <input class="md-input" type="password" id="register_password_repeat" name="register_password_repeat" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <a href="index.html" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
       <!-- <div class="uk-margin-top uk-text-center">
            <a href="#" id="signup_form_show">Create an account</a>
        </div> -->
         
    </div>
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery1.12.4.js"></script>
    <!-- common functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/common.min.js"></script>

    <!-- altair core functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/login.min.js"></script>
    
     <!-- uikit functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/uikit_custom.min.js"></script>
    
     <script src="<?php echo base_url(); ?>assets/bower_components/parsleyjs/dist/parsley.min.js"></script> 
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!--  forms validation functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/forms_validation.min.js">
    </script>
    <script>
    // load parsley config (altair_admin_common.js)
        altair_forms.parsley_validation_config();
        var baseURL = $('body').data('baseurl');
        $('#forgot_email').on('focus',function(){
            $('#error_email').empty();
        });
        $("#hide_domain_content").css('z-index','-9');
        $("#hide_domain_content").hide();
        window.ParsleyValidator
            .addValidator('email', function (value, requirement) {
                var response = false;
                $.ajax({
                    url: baseURL + "login/validate",
                    type: "get",
                    data: {email: value},
                    dataType: "json",
                    //dataType: "html",
                    async: false,
                    success: function(data) {
                       if(data == 1){
                            response = true;
                        }else{
                            response = false;
                        }
                    },
                    error: function() {
                        response = true;
                    }
                }); 
                return response;
            }, 32)
            .addMessage('en', 'email', 'The email is not exists.');
        $('.reset_email').on('click',function(){
            var email = $('#forgot_email').val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)){
                if($('#error_email').find('p.error').length == 0){
                    $('#error_email').append('<p class ="error" style="color:red">Please enter valid email </b>');
                }
                return false;
            }{
                $.ajax({
                    method:'POST',
                    url: baseURL + "login/check_email",
                    data:{email:email},
                    dataType: "json",
                    beforeSend: function() {

                       $("#hide_domain_content").css('z-index','999999');
                       $("#hide_domain_content").show();
                      /*$(".reset_email").css('z-index','-9');
                      $(".reset_email").hide();                */
                    },
                    success:function(data){
                        if(data == 0){
                            $("#hide_domain_content").css('z-index','-9');
                            $("#hide_domain_content").hide();
                            if($('#error_email').find('p.error').length < 1){
                                $('#error_email').append('<p class="error" style="color:red">Email is not registered </p>');
                             }
                            return false;
                        }else{
                            forgot_password(email);
                        }
                    }

                });
                return false;
            }
           
        });
        function forgot_password(email){
            $.ajax({
                method:'POST',
                url: baseURL + "login/forgot_password",
                data:{email:email},
                dataType: "json",
                beforeSend: function() {
                   $("#hide_domain_content").css('z-index','999999');
                   $("#hide_domain_content").show();
                },
                success:function(data){
                    if(data){
                       window.location.href = baseURL+'login';
                    }
                }
            });
        }
    </script>

</body>
</html>
