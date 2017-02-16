<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/assets/img/favicon-32x32.png" sizes="32x32">

    <title>Innoforms - Reset Password</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/login_page.min.css" />
    <style>
    ul.parsley-errors-list{
        padding-left:0px;
    }
    li.parsley-required,li.parsley-type {
        list-style: none !important;
        color:red;
    }
	.login_heading .logo-main { width:65px; display:inline-block; vertical-align:middle; }
	.login_heading span { font-size: 27px; vertical-align: middle; font-family: open-sans; margin-left: 10px; }
	.error {
		position: relative !important;
    	top: 0px !important;
	}
    </style>
</head>
<body class="login_page" data-baseurl="<?=base_url()?>">
<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="register_form">
            <?php if($change_password == '1') { ?>
            <h2 class="heading_a uk-margin-medium-bottom">Change password</h2>
            <?php } else { ?>
            <h2 class="heading_a uk-margin-medium-bottom">Reset password</h2>
            <?php } ?>
            <form method="post" id="form_validation">
                <div class="uk-form-row">
                    <span class="help-tip"><p>Password Must Contain One uppercase One Lowercase One Number,Special Characters(@%$^</p> </span>
                    <label for="register_password">Password</label>
                    <input class="md-input" required type="password" id="old_password" name="password" data-element ="" />
                    <div class="error"></div>
                </div>
                <div class="uk-form-row">
                    <span class="help-tip"><p>Password Must Contain One uppercase One Lowercase One Number,Special Characters(@%$^</p> </span>
                    <label for="register_password">Password</label>
                    <input class="md-input" required type="password" id="password" name="password" data-element ="" />
                    <div class="error"></div>
                </div>
                <div class="uk-form-row">
                    <label for="register_password_repeat">Repeat Password</label> 
                    <input class="md-input" type="password" id="password_repeat" name="password_repeat" required data-element="repeat" />
                </div>
                <div class="repeat"></div>
                <input type="hidden" name="data" value="<?php echo base64_encode($user_id); ?>" />
                <div class="uk-margin-medium-top">
                    <input type="submit" value="Reset" class="md-btn md-btn-primary md-btn-block md-btn-large"  />
                    <?php if($change_password == '1') { ?>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>   
</div>

    <style type="text/css">
    .help-tip{
        position: absolute;
        top: 18px;
        right: 18px;
        text-align: center;
        background-color: #BCDBEA;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 14px;
        line-height: 26px;
        cursor: default;
    }

    .help-tip:before{
        content:'?';
        font-weight: bold;
        color:#fff;
    }

    .help-tip:hover p{
        display:block;
        transform-origin: 100% 0%;

        -webkit-animation: fadeIn 0.3s ease-in-out;
        animation: fadeIn 0.3s ease-in-out;

    }

    .help-tip p{
        display: none;
        text-align: left;
        background-color: #1E2021;
        padding: 20px;
        width: 300px;
        position: absolute;
        border-radius: 3px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
        right: -4px;
        color: #FFF;
        font-size: 13px;
        line-height: 1.4;
    }

    .help-tip p:before{
        position: absolute;
        content: '';
        width:0;
        height: 0;
        border:6px solid transparent;
        border-bottom-color:#1E2021;
        right:10px;
        top:-12px;
    }

    .help-tip p:after{
        width:100%;
        height:40px;
        content:'';
        position: absolute;
        top:-40px;
        left:0;
    }

    @-webkit-keyframes fadeIn {
        0% { 
            opacity:0; 
            transform: scale(0.6);
        }

        100% {
            opacity:100%;
            transform: scale(1);
        }
    }

    @keyframes fadeIn {
        0% { opacity:0; }
        100% { opacity:100%; }
    }
    </style>
    <!-- common functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/common.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/pages/login.min.js"></script>
    
     <!-- uikit functions -->
    <script src="<?php echo base_url(); ?>assets/assets/js/uikit_custom.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/assets/js/jqueryvalidate.js">
    </script>
    <script>
    // load parsley config (altair_admin_common.js)
        var baseURL = $('body').data('baseurl');
        $.validator.addMethod("password", function(value) {
            var regexp = /^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9_@%$^]{7,}$/;
            var re = new RegExp(regexp);
            return re.test(value);
         }, 'Your Password contain Min 1 uppercase,lowercase,numbers and ($%^@_) allowed special characters');

        $(document).ready(function(){
            $('#form_validation').validate({
                rules: {
                    /*password: {
                        password:""
                        required:true
                    },*/
                    password:"password",
                    password_repeat: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password_repeat: {
                        required: "Please provide a password",
                        equalTo: "Please enter the same password as above"
                    },
                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('element');
                    if (placement != '') {
                        $('.'+placement).append(error);
                    } else {
                        $('div.error').append(error);
                    }
                }
            });
        });
    </script>

</body>
</html>