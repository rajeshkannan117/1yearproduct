<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="<?php echo base_url(); ?>assets/image/png" href="<?php echo base_url(); ?>assets/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="<?php echo base_url(); ?>assets/image/png" href="<?php echo base_url(); ?>assets/assets/img/favicon-32x32.png" sizes="32x32">

    <title><?php echo $siteTitle; ?></title>


    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/icons/flags/flags.min.css" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/main.min.css" media="all">

    <!-- kendo UI -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/kendo-ui/styles/kendo.common-material.min.css"/>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/kendo-ui/styles/kendo.material.min.css"/>

    <!--  Form Style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/style.css">

    <!-- Forms Validation -->

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/matchMedia/matchMedia.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/matchMedia/matchMedia.addListener.js"></script>
    <![endif]-->

</head>
<body data-baseurl="<?=base_url()?>" class="sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>

                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
           
                <div class="uk-navbar-flip">

                    <ul class="uk-navbar-nav user_actions">
                        <!--<li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>-->
                        <?php //print_r($_SESSION); exit; ?>
                        <li data-uk-dropdown="{mode:'click'}">
                            <?php if($this->session->userdata('profilepic') != ''){ ?>
                            <?php if(file_exists(THUMB_IMAGE_PATH.$this->session->userdata('profilepic'))){ ?>
                            <a href="#" class="user_action_image"><img class="md-user-image" src="<?php echo base_url().'uploads/user/thumb/'.$this->session->userdata('profilepic'); ?>" alt=""/></a>
                            <?php }else{ ?>
                                <a href="#" class="user_action_image"><img class="md-user-image" src="<?php echo base_url().'uploads/user/user.png'; ?>" alt="" style="background-color:#ededed";/></a>
                            <?php } } else{ ?>
                                <a href="#" class="user_action_image"><img class="md-user-image" src="<?php echo base_url().'uploads/user/user.png'; ?>" alt="" style="background-color:#ededed";/></a>
                            <?php } ?>
                            <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="<?php echo base_url(); ?>myprofile/edit">My profile</a></li>
                                    <!--<li><a href="page_settings.html">Settings</a></li>-->
                                    <li><a href="<?php echo base_url(); ?>dashboard/logout/">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                 <div class="" style="float: right;display: inline-block;color: #fff;">

                <p style="font-size: 15px;line-height: 26px; margin: 0 0;">Welcome <?php echo $this->session->userdata('name'); ?></<p><br>
                <span style="font-size: 12px;line-height: 16px;margin: 0;"><?php echo $this->session->userdata('org_name'); ?></span>
            </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->

    <!-- main sidebar -->
    <aside id="sidebar_main">
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="/dashboard" class="sSidebar_hide"><img src="<?php echo base_url(); ?>assets/assets/img/logo2.png" alt="" width="150"/></a>
                <a href="/dashboard" class="sSidebar_show"><img src="<?php echo base_url(); ?>assets/assets/img/logo2.png" alt="" height="32" width="32"/></a>
            </div>
          
        </div>
        <?php  
            /* Check Page Current selection */
                $page = $this->uri->segment(1);
                $sub_page = $this->uri->segment(2);
                $static_role = $this->session->userdata('static_role');
                $menu_access = $menu;
                //print_r($menu);exit;
             
	//	print_r($menu_access[1]['menu']); exit;
         ?>
        <div class="menu_section">
            <ul>
                <li  <?php if($page == 'dashboard'){ echo ' class="current_section"'; } else{ } ?> title="Dashboard">
                    <a href="<?php echo base_url(); ?>dashboard/">
                        <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                        <span class="menu_title">Dashboard</span>
                    </a>
                </li>
                <?php if (array_key_exists('organization', $menu_access)) { ?>

                <li <?php if($page == 'organization'){ echo ' class="current_section"'; $organization ="organizations"; } else{$organization = 'organization'; }?>>
                    <a href="<?php echo base_url(); ?>organization/">
                        <span class="menu_icon"><i class="material-icons <?php echo $organization; ?>">&#xE8D2;</i></span>
                        <span class="menu_title">Organizations</span>
                    </a>
                   
                </li>


                <?php } ?>
                <!-- Only Master Manager and Super Admin have access to Master db changes -->
                <?php if (array_key_exists('country', $menu_access)) { ?>
                 <li <?php if($page == 'country'){ echo ' class="current_section"'; $country="countrys"; } else{ $country="country";} ?>>
                    <a href="<?php echo base_url(); ?>country/">
                        <span class="menu_icon"><i class="material-icons <?php echo $country; ?>"></i></span>
                        <span class="menu_title">Countries</span>
                    </a>
                   
                </li>
		<?php }  if (array_key_exists('domain', $menu_access)) { ?>
                <li <?php if($page == 'domain'){ echo ' class="current_section"'; $domain ="domains"; } else{$domain = 'domain';} ?>>
                    <a href="<?php echo base_url(); ?>domain/">
                        <span class="menu_icon"><i class="material-icons <?php echo $domain; ?>"></i></span>
                        <span class="menu_title">Domains</span>
                    </a>
                   
                </li>
		<?php }  if (array_key_exists('department', $menu_access)) { ?>
                <li <?php if($page == 'department'){ echo ' class="current_section"'; $department ="departments"; } else{$department = 'department';}  ?>>
                    <a href="<?php echo base_url(); ?>department/">
                        <span class="menu_icon"><i class="material-icons <?php echo $department; ?>"></i></span>
                        <span class="menu_title">Departments</span>
                    </a>
                   
                </li>
	<?php } if (array_key_exists('category', $menu_access)) { ?>
            <li <?php if($page == 'category'){ echo ' class="current_section"'; $category ="categories"; } else{$category = 'category'; }?>>
                    <a href="<?php echo base_url(); ?>category/">
                        <span class="menu_icon"><i class="material-icons <?php echo $category; ?>"></i></span>
                        <span class="menu_title">Categories</span>
                    </a>
                    
            </li>
	<?php }  if (array_key_exists('roles', $menu_access)) {  ?>
               
                 <li <?php if($page == 'roles'){ echo ' class="current_section"'; $role ="roles"; } else{$role = 'role'; }?>>
                    <a href="<?php echo base_url(); ?>role/">
                        <span class="menu_icon"><i class="material-icons <?php echo $role; ?>"></i></span>
                        <span class="menu_title">Roles</span>
                    </a>
                    
                </li>
    <?php }   if (array_key_exists('organization', $menu_access)) { ?>

                <!-- Only Site Manager and Super Admin have access to users and organization page Form page-->

                
                  
                
    <?php }  if (array_key_exists('users', $menu_access)) {  ?>
		
 		<li <?php if($page == 'users'){ echo ' class="current_section"'; $user ="users"; } else{$user = 'user'; }?>>
                    <a href="<?php echo base_url(); ?>users/">
                        <span class="menu_icon"><i class="material-icons <?php echo $user; ?>">&#xE87C;</i></span>
                        <span class="menu_title">Users</span>
                    </a>
                   
                </li>
<?php }  if (array_key_exists('forms', $menu_access)) {  ?>
			
                 <li <?php if($page == 'form'){ echo ' class="current_section"'; $form ="forms"; } else{$form = 'form'; }?>>
                    <a href="<?php echo base_url(); ?>form/">
                        <span class="menu_icon"><i class="material-icons <?php echo $form; ?>">&#xE24D;</i></span>
                        <span class="menu_title">Forms</span>
                    </a>
                    
                </li>
        <?php }  if (array_key_exists('submission', $menu_access)) {  ?>
			
                 <li <?php if($page == 'form'){ echo ' class="current_section"'; $form ="forms"; } else{$form = 'form'; }?>>
                    <a href="<?php echo base_url(); ?>form/">
                        <span class="menu_icon"><i class="material-icons <?php echo $form; ?>">&#xE24D;</i></span>
                        <span class="menu_title">Forms</span>
                    </a>
                    
                </li>
        <?php } ?>  

          
                
            </ul>
        </div>
       
    </aside><!-- main sidebar end -->
