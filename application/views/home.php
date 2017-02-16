<!DOCTYPE html>
<html>
<head>
<title>Build A Compliant Business Process With Innoforms</title>
<meta name="robots" content="noindex,nofollow">
<meta name="description" content=" Innoforms let you build instant digital forms to replace your paper. Start building a efficient workforce by replacing paper forms and letting your team access instant data."/>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<!--Custom Theme files-->
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all"> 
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link rel='stylesheet' type='text/css' href='css/jquery.easy-gallery.css' />
<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">
<!--//Custom Theme files-->
<!--js-->
<script src="js/jquery-2.2.3.min.js"></script> 
<script src="js/SmoothScroll.min.js"></script>
<!--//js-->
<!--start-smooth-scrolling-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>	
<script type="text/javascript">
jQuery(document).ready(function($) {
$(".scroll").click(function(event){		
event.preventDefault();

$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
});
});
</script>
<!--//end-smooth-scrolling-->	
</head>
<body>
<!--banner-->
<div id="home" class="banner">
<!--header-->
<div class="header">
<div class="container">	
<div class="menu-wrap">
<nav class="menu">
<div class="logo">
<h1><a>Contact Us For A Free Demo!</a></h1>
</div>
<div class="icon-list">
<div class="col-md-7 contact-form side">
<form action="#" method="post" name="popup-form" id="popup-form">
<div class="form-group col-md-4">
<input type="text" name="name" id="name" placeholder="Name">
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-4">
<input class="email" type="text" name="email" id="email" placeholder="Email">
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-4">
<input class="phone" type="text" name="phone" id="phone" placeholder="Phone">
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-12 msg-container">
<textarea placeholder="Message" name="message" id="message"></textarea>
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-12 sm-center">
<input type="submit" value="SUBMIT">
</div>
<div class="clearfix"></div>
</form>
</div>
</div>
</nav>
<button class="close-button" id="close-button">Close Menu</button>
</div>

<div class="nav navbar-nav w3ls-logo">
<h2><a href="/"><img src="images/logo.png" alt="Innoforms Logo" title="Innoforms" ></a></h2>
</div>
<div class="nav navbar-nav navbar-right w3ls-header-right">
<ul>
<li><a href="#services" class="scroll"><i class="glyphicon glyphicon-cog" aria-hidden="true"></i> Features</a></li>
<li><a href="#about" class="scroll"><i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i> Why Innoforms</a></li>
<li><a href="#contact" class="scroll"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> Contact Us</a></li>	
<li><a href="<?php echo base_url() ?>login"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> Login</a></li>

</ul>
</div>
<div class="clearfix"> </div>
</div>
</div>
<!--//header-->
<!--banner-text-->
<div class="banner-text">
<div class="container">	
<div class="w3ls-title">
<section class="slider">
<div class="flexslider">
<ul class="slides">
<li>
<h3>Losing Time And Money With Manual Forms? </h3> 
<!--<p>Create unlimited forms. Share Data. Take Action! </p>
--><button class="cta" id="open-button">Get Innoforms</button>
</li>
<li>
<h3>Transform Your Business Process With Mobile Forms</h3> 
<button class="cta" id="open-button-1">Try Innoforms</button>
</li>
<li>
<h3>Automate And Improvise Your Business Workflow</h3>
<button class="cta" id="open-button-2">Get Innoforms</button> 
</li>
</ul>
</div> 
</section>
<!-- FlexSlider -->
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
$(window).load(function() {
$('.flexslider').flexslider({
animation: "slide",
controlsContainer: $(".custom-controls-container"),
customDirectionNav: $(".custom-navigation a")
});
});
</script>
<!-- //FlexSlider -->
</div>
<!--<div class="w3ls-bottom-text">
<ul>
<li>
<h3> 52</h3>
<p>Projects Done </p>
</li>
<li>
<h3> 40</h3>
<p>Team Members</p>
</li>
<li>
<h3> 10K</h3>
<p>Our Likes</p>
</li>
<li>
<h3> 90</h3>
<p>Our Visitors</p>
</li>
<li>
<h3> 68</h3>
<p>New Products </p>
</li>
</ul>
</div>-->
</div>
</div>
<!-- //banner-text -->
</div>
<!-- //banner -->
<!-- projects -->
<div class="projects">
<div class="container">	

<div class="wthree-projects-row">
<div class="col-md-4 process-flow">
<img src="images/create-a-form.jpg" alt="Create A Form" title="Create A Form" class="img-responsive">
<h4>Create A Form</h4></div>
<div class="col-md-4 process-flow"><img src="images/access-from-anywhere.jpg" alt="Access From Anywhere" title="Access From Anywhere" class="img-responsive"> <h4>Access From Anywhere</h4></div>
<div class="col-md-4 process-flow"><img src="images/automate-workflow.jpg" alt="Automate Workflow" title="Automate Workflow"  class="img-responsive">
<h4>Automate Workflow</h4>
</div>				
</div>

<div class="col-xs-12 text-center process-cont">

<p>Tired of wasting time with never ending paperwork? Empower your company and improve communication within your team with  Innoforms. It's time to bid goodbye to paper - Access forms using your workstation as well your Andoird and iOS devices. Get access to predefined compliance checklists to ease you workflow and start building an efficient team by integrating and accessing data instantly.</p>
</div>
</div>
</div>
<!-- //projects -->
<!-- services -->
<div id="services" class="services">
<div class="container">	
<div class="agileits-title">
<h3>Build Forms With Ease</h3>
</div>
<div class="wthree-services-row">
<div class="col-md-4 services-grid">
<div class="col-xs-12 services-grid-left">
<img src="images/diy-form-builder.png"  alt="DIY Form Builder" title="DIY Form Builder" />
</div>
<div class="col-xs-12 services-grid-right">
<h4>DIY Form Builder</h4>
<p>It's as easy as dragging and dropping each field to build a custom form. Put up forms within minutes and share.</p>
</div>
<div class="clearfix"> </div>
</div>
<div class="col-md-4 services-grid">
<div class="col-xs-12 services-grid-left">
<img src="images/stay-compliant.png" alt="Stay Compliant" title="Stay Compliant" />
</div>
<div class="col-xs-12 services-grid-right">
<h4>Stay Compliant</h4>
<p>Stay up to date with industry standards and compliant with regulatory changes. Forms can be updated immediately and quickly.</p>
</div>
<div class="clearfix"> </div>
</div>
<div class="col-md-4 services-grid">
<div class="col-xs-12 services-grid-left">
<img src="images/mobile-forms.png" alt="Mobile Forms" title="Mobile Forms" />
</div>
<div class="col-xs-12 services-grid-right">
<h4>Mobile Forms</h4>
<p>Remote teams can access forms trough their Android and iOS devices and remove paperwork and manual data entry</p>

</div>
<div class="clearfix"> </div>
</div>
<div class="col-md-4 services-grid services-grid-bottom">
<div class="col-xs-12 services-grid-left">
<img src="images/instant-integration.png" alt="Instant Integration" title="Instant Integration" />
</div>
<div class="col-xs-12 services-grid-right">
<h4>Instant Integration</h4>
<p>Data entered in the mobile form can be seamlessly integrated when connected to the internet. Start taking immediate action!
</p>
</div>
<div class="clearfix"> </div>
</div>
<div class="col-md-4 services-grid services-grid-bottom">
<div class="col-xs-12 services-grid-left">
<img src="images/seamless-workflow.png" alt="Seamless Workflow" title="Seamless Workflow" />
</div>
<div class="col-xs-12 services-grid-right">
<h4>Seamless Workflow</h4>
<p>Incorporate forms with your business process by creating a seamless workflow with appropriate roles for users. 
</div>
<div class="clearfix"> </div>
</div>
<div class="col-md-4 services-grid services-grid-bottom">
<div class="col-xs-12 services-grid-left">
<img src="images/get-notified.png" alt="Get Notified" title="Get Notified" />
</div>
<div class="col-xs-12 services-grid-right">
<h4>Get Notified </h4>
<p>Send out instant alert after submitting each form to take instant action. Special 'alert' feature lets you rectify errors on the go.
</div>
<div class="clearfix"> </div>
</div>
<div class="clearfix"> </div>
</div>
</div>
</div>
<!-- //services -->
<!-- skills -->
<div id="skills" class="skills">
<div class="container">
<div class="agileits-title">
<h3>Remove Inefficiency And Manual Error By Bringing Your Mobile Team Closer</h3>
<p><a href="#" class="cta"  id="open-button-3">Try Innoforms</a></p>
</div>

</div>
</div>
<!-- //skill -->
<!-- about -->
<div id="about" class="about">
<div class="container">	
<div class="col-md-6 about-grid">
<h3>Why Do You Need Innoforms?</h3>
<ul>
<li>Manage your remote team with confidence</li>
<li>Reduce paperwork and manual errors</li>
<li>Get instant notifications and take immediate action</li>
<li>Reduce your business process time frame</li>
<li>Make use of your form data for easy retrieval and analysis</li>

</ul>

<a href="/home/download" class="cta-2">Download Brochure</a>

</div>
<div class="col-md-6 about-grid">
<img src="images/why-we-need-innoform.png" alt="Why Do You Need Innoform ?" title="Why Do You Need Innoform ?" />
</div>
<div class="clearfix"> </div> 
</div>
</div>
<!-- //about -->
<!-- contact -->
<div class="contact" id="contact">
<div class="container">
<div class="agileits-title">
<h3>Contact Us</h3>
<p>Eager to use Innoforms? Contact Us!</p>
</div> 
<div class="contact-grids">

<div class="col-md-12 contact-form">
<form action="#" method="post" name="footer-form" id="footer-form">
<div class="form-group col-md-4">
<input type="text" name="name" id="name" placeholder="Name">
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-4">
<input class="email" type="text" name="email" id="email" placeholder="Email">
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-4">
<input class="phone" type="text" name="phone" id="phone" placeholder="Phone Number">
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-12 msg-container">
<textarea placeholder="Message" name="message" id="message"></textarea>
<div class="help-block with-errors"></div>
</div>
<div class="form-group col-md-12 sm-center">
<input type="submit" value="SUBMIT">
</div>
<div class="clearfix"></div>
</form>
</div>

<div class="col-md-4 address">
<h4>US Head Office  </h4>

<p><img src="images/location.png"><span>3400 Peachtree Road,<br> NE Suite 939,<br>Atlanta, GA 30326</span></p>
<p><img src="images/phone.png"> <span>(404) 788-6332</span></p>
</div>
<div class="col-md-4 address">
<h4>MEA Head Office</h4>
<p><img src="images/location.png"><span> P.O. Box 238605, 1st Floor,<br> Office # P-05,
Bay Square,<br> Building Number 7, Business Bay,<br>
Dubai (U.A.E)</span></p>
<p><img src="images/phone.png"> <span>+971 52 837 7260 / +971 56 216 5922</span></p>
</div>
<div class="col-md-4 address">
<h4>Email</h4>

<p><img src="images/mail.png"><span><a href="mailto:contactus@innoppl.com">contactus@innoppl.com</a></span></p>
<a href="/home/download" class="cta-2">Download Brochure</a>
</div>



<div class="clearfix"> </div>    
</div>
</div>
</div>
<!-- //contact -->
<!-- footer -->
<div class="footer">
<div class="container">

<div class="footer-left">
<p>©  Copyright <?php echo date('Y'); ?> <a>Innoppl</a>. All Rights Reserved. </p>
</div>
<!--<div class="footer-right social-icons">
<ul>
<li><a href="#"> </a></li>
<li><a href="#" class="pin"> </a></li>
<li><a href="#" class="in"> </a></li>
<!--<li><a href="#" class="be"> </a></li>
<li><a href="#" class="vimeo"> </a></li>-->
<!--</ul>
<div class="clearfix"> </div>
</div>-->
</div>
</div>
<!-- //footer -->	 
<!--smooth-scrolling-of-move-up-->
<script type="text/javascript">
$(document).ready(function() {
/*
var defaults = {
containerID: 'toTop', // fading element id
containerHoverID: 'toTopHover', // fading element hover id
scrollSpeed: 1200,
easingType: 'linear' 
};
*/

$().UItoTop({ easingType: 'easeOutQuart' });

});
</script>
<!--//smooth-scrolling-of-move-up-->
<!-- menu-js -->
<script src="js/classie.js"></script>
<script src="js/main.js"></script>
<!-- //menu-js -->	 
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/bootstrap.js"></script>
</body>
</html>