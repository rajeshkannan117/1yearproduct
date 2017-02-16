var isOpen = false;
(function() {

	var bodyEl = document.body,
		content = document.querySelector( '.content-wrap' ),
		openbtn = document.getElementById( 'open-button' ),
		openbtn1 = document.getElementById( 'open-button-1' ),
		openbtn2 = document.getElementById( 'open-button-2' ),
		openbtn3 = document.getElementById( 'open-button-3' ),
		closebtn = document.getElementById( 'close-button' );
		

	function init() {
		initEvents();
	}

	function initEvents() {
		openbtn.addEventListener( 'click', toggleMenu );
		openbtn1.addEventListener( 'click', toggleMenu );
		openbtn2.addEventListener( 'click', toggleMenu );
		openbtn3.addEventListener( 'click', toggleMenu );
		if( closebtn ) {
			closebtn.addEventListener( 'click', toggleMenu );
		}

		// close the menu element if the target it´s not the menu element or one of its descendants..
		/*content.addEventListener( 'click', function(ev) {
			var target = ev.target;
			if( isOpen && target !== openbtn ) {
				toggleMenu();
			}
		} );*/
	}

	function toggleMenu() {
		if( isOpen ) {
			classie.remove( bodyEl, 'show-menu' );
		}
		else {
			classie.add( bodyEl, 'show-menu' );
			setTimeout(setMaxheight, 2000);
			
		}
		isOpen = !isOpen;
	}

	init();

})();

function validateEmail(email) {  
    var re = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(?!test)(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return re.test(email);
}
function validatePhone(phone) {
    var ph = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
    return ph.test(phone);
}
$(document).ready(function(){
	$('#popup-form').submit(function(){
		name			= $('#popup-form #name').val();
		email			= $('#popup-form #email').val();
		phone		= $('#popup-form #phone').val();
		message		= $('#popup-form #message').val();
		if($.trim(name) == ''){
			$('#popup-form #name').parent().addClass('has-error').addClass('has-danger');
			$('#popup-form #name').next().html('Please enter your name');
		}else if( name.length < 2){
			$('#popup-form #name').parent().addClass('has-error').addClass('has-danger');
			$('#popup-form #name').next().html('Please enter at least 2 characters');
		}else{
			$('#popup-form #name').parent().removeClass('has-error').removeClass('has-danger');
			$('#popup-form #name').next().html('');
		}
		
		if($.trim(email) == ''){
			$('#popup-form #email').parent().addClass('has-error').addClass('has-danger');
			$('#popup-form #email').next().html('Please enter your email address');
		}else if(!validateEmail(email)){
			$('#popup-form #email').parent().addClass('has-error').addClass('has-danger');
			$('#popup-form #email').next().html('Please enter a valid email address');
		}else{
			$('#popup-form #email').parent().removeClass('has-error').removeClass('has-danger');
			$('#popup-form #email').next().html('');
		}
		if( $.trim(phone) != '' &&  !validatePhone(phone)){
			$('#popup-form #phone').parent().addClass('has-error').addClass('has-danger');
			$('#popup-form #phone').next().html('Please enter a valid phone number');
		}else{
			$('#popup-form #phone').parent().removeClass('has-error').removeClass('has-danger');
			$('#popup-form #phone').next().html('');
		}
		if($.trim(message) == ''){
			$('#popup-form #message').parent().addClass('has-error').addClass('has-danger');
			$('#popup-form #message').next().html('Please enter your message');
		}else if( message.length < 5){
			$('#popup-form #message').parent().addClass('has-error').addClass('has-danger');
			$('#popup-form #message').next().html('Please enter at least 5 characters');
		}else{
			$('#popup-form #message').parent().removeClass('has-error').removeClass('has-danger');
			$('#popup-form #message').next().html('');
		}
		if($('#popup-form .has-error').length > 0){
			return false;
		}else{
			
			$.ajax({
				data : $('#popup-form').serialize(),
				url  : 'process.php',
				method: 'post',
				dataType: 'json',
				success: function(data){
					if(data['flag'] == "success"){
						//alert("Hello");
						window.location = 'http://www.innoforms.com/thank-you';
					}else{
						alert(data['message']);
					}
				}
			});
			return false;
		}
	});

	$('#footer-form').submit(function(){
		name			= $('#footer-form #name').val();
		email			= $('#footer-form #email').val();
		phone		= $('#footer-form #phone').val();
		message		= $('#footer-form #message').val();
		if($.trim(name) == ''){
			$('#footer-form #name').parent().addClass('has-error').addClass('has-danger');
			$('#footer-form #name').next().html('Please enter your name');
		}else if( name.length < 2){
			$('#footer-form #name').parent().addClass('has-error').addClass('has-danger');
			$('#footer-form #name').next().html('Please enter at least 2 characters');
		}else{
			$('#footer-form #name').parent().removeClass('has-error').removeClass('has-danger');
			$('#footer-form #name').next().html('');
		}
		
		if($.trim(email) == ''){
			$('#footer-form #email').parent().addClass('has-error').addClass('has-danger');
			$('#footer-form #email').next().html('Please enter your email address');
		}else if(!validateEmail(email)){
			$('#footer-form #email').parent().addClass('has-error').addClass('has-danger');
			$('#footer-form #email').next().html('Please enter a valid email address');
		}else{
			$('#footer-form #email').parent().removeClass('has-error').removeClass('has-danger');
			$('#footer-form #email').next().html('');
		}
		if( $.trim(phone) != '' && !validatePhone(phone)){
			$('#footer-form #phone').parent().addClass('has-error').addClass('has-danger');
			$('#footer-form #phone').next().html('Please enter a valid phone number');
		}else{
			$('#footer-form #phone').parent().removeClass('has-error').removeClass('has-danger');
			$('#footer-form #phone').next().html('');
		}
		if($.trim(message) == ''){
			$('#footer-form #message').parent().addClass('has-error').addClass('has-danger');
			$('#footer-form #message').next().html('Please enter your message');
		}else if( message.length < 5){
			$('#footer-form #message').parent().addClass('has-error').addClass('has-danger');
			$('#footer-form #message').next().html('Please enter at least 5 characters');
		}else{
			$('#footer-form #message').parent().removeClass('has-error').removeClass('has-danger');
			$('#footer-form #message').next().html('');
		}
		if($('#footer-form .has-error').length > 0){
			return false;
		}else{
			
			$.ajax({
				data : $('#footer-form').serialize(),
				url  : 'process.php',
				method: 'post',
				dataType: 'json',
				success: function(data){
					if(data['flag'] == "success"){
						//alert("Hello");
						window.location = 'http://www.innoforms.com/footer-thank-you';
					}else{
						alert(data['message']);
					}
				}
			});
			return false;
		}
	});
	
	$(document).on('keyup change focusout','#popup-form #name, #footer-form #name',function(e){
		var code = e.keyCode || e.which;
		if (code == '9') {
			return false;
		}
		name	= $(this).val();
		if($.trim(name) == ''){
			$(this).parent().addClass('has-error').addClass('has-danger');
			$(this).next().html('Please enter your name');
		}else if( name.length < 2){
			$(this).parent().addClass('has-error').addClass('has-danger');
			$(this).next().html('Please enter at least 2 characters');
		}else{
			$(this).parent().removeClass('has-error').removeClass('has-danger');
			$(this).next().html('');
		}
	});
	
	$(document).on('keyup change focusout','#popup-form #message, #footer-form #message',function(e){
		var code = e.keyCode || e.which;
		if (code == '9') {
			return false;
		}
		message	= $(this).val();
		if($.trim(message) == ''){
			$(this).parent().addClass('has-error').addClass('has-danger');
			$(this).next().html('Please enter your message');
		}else if( message.length < 5){
			$(this).parent().addClass('has-error').addClass('has-danger');
			$(this).next().html('Please enter at least 5 characters');
		}else{
			$(this).parent().removeClass('has-error').removeClass('has-danger');
			$(this).next().html('');
		}
	});
	
	$(document).on('keyup change focusout','#popup-form #email, #footer-form #email',function(e){
		var code = e.keyCode || e.which;
		if (code == '9') {
			return false;
		}
		email		= $(this).val();
		if($.trim(email) == ''){
			$(this).parent().addClass('has-error').addClass('has-danger');
			$(this).next().html('Please enter your email address');
		}else if(!validateEmail(email)){
			$(this).parent().addClass('has-error').addClass('has-danger');
			$(this).next().html('Please enter a valid email address');
		}else{
			$(this).parent().removeClass('has-error').removeClass('has-danger');
			$(this).next().html('');
		}
	});
	
	$(document).on('keyup change focusout','#popup-form #phone, #footer-form #phone',function(e){
		var code = e.keyCode || e.which;
		if (code == '9') {
			return false;
		}
		phone		= $(this).val();
		id			= $(this).attr('id');
		if($.trim(phone) != '' && !validatePhone(phone)){
			$(this).parent().addClass('has-error').addClass('has-danger');
			$(this).next().html('Please enter a valid phone number');
		}else{
			$(this).parent().removeClass('has-error').removeClass('has-danger');
			$(this).next().html('');
		}
		
	});
});

function setMaxheight(){
    var winHeight = $(window).height();
    var cntFSide	= $('.contact-form');
    var formHeight	= $('.contact-form').find('form');
    var cntFSideP	= cntFSide.position();
    var cntFSideTop	= cntFSideP.top;
    var cntFSideHeight	= formHeight.height();
   // console.log(isOpen);
    if( winHeight < cntFSideHeight + cntFSideTop && isOpen){
    	var heightP = winHeight - cntFSideTop - 30;
    	heightP = Math.floor(heightP);
    	console.log(heightP + "Solomon");
	cntFSide.css({'height' : heightP, 'overflow-y':'scroll'});
	console.log(cntFSide.css('height'));
    }else{
    	//console.log(winHeight +" ----------- " +cntFSideHeight +" ----------- " +cntFSideTop  +" ----------- " + isOpen)
    	//console.log(cntFSide.css('height') + " SSSSSSSSSSSSSSS");
    	cntFSide.css({'height' : 'auto', 'overflow-y':'auto'});
    }
}

$(function(){
    setMaxheight();

    $(window).resize(function(){
        setMaxheight();
    });
});