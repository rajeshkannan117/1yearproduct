<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

    <title>Innoforms</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin error page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/error_page.min.css" />
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700" rel="stylesheet">
    
   

</head>
<body class="error_page">

    <div class="error_page_header">
    	<div class="uk-width-1-1">
            <h2 class="uk-container-center">
                <img src="<?php echo base_url() ?>assets/assets/img/a_arrow 404.png"><?php /*?><?php echo $msg; ?><?php */?>
                <span>404</span>
            </h2>
            <p class="error_page_content">Uh oh! Looks like something broke.</p>
            <a href="#">
                <i><img src="<?php echo base_url() ?>assets/assets/img/a_return-404.png"></i>       					 			
                Take Me Away
            </a>
        </div>
    </div>
    
</body>
</html>