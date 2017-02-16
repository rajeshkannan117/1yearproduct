<?php
	if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
		header("location:https://www.innoforms.com");
		exit;
	}else{
		$headers = "From: Admin < contactus@innoppl.com > " . "\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail_addresses	= "agunalan@innoppl.com";
		//$mail_addresses		= "solomon.i@innoppl.com";
		$name	= trim(addslashes($_POST['name']));
		$email	= trim(addslashes($_POST['email']));
		$phone	= trim(addslashes($_POST['phone']));
		$message	= trim(addslashes($_POST['message']));
		$subject_mail = "$name Customer Quote from Innoforms.com Website";
		//echo strlen($name);
		if($name == ''){
			echo json_encode(array('flag'=>'error',"name"=>'true',"message"=>"Please enter your name"));
			exit;
		}else if(strlen($name) < 2){
			echo json_encode(array('flag'=>'error',"name"=>'true',"message"=>"Please enter at least 2 characters"));
			exit;
		}else if($email == ''){
			echo json_encode(array('flag'=>'error',"email"=>'true',"message"=>"Please enter your email"));
			exit;
		}else if( !preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(?!test)(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $email)){
			echo json_encode(array('flag'=>'error',"email"=>'true',"Please enter a valid email"));
			exit;
		}else if($phone != '' && !preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/', $phone)){
			echo json_encode(array('flag'=>'error',"phone"=>'true',"message"=>"Please enter a valid phone number"));
			exit;
		}else if($message == ''){
			echo json_encode(array('flag'=>'error',"message"=>'true',"message"=>"Please enter your message"));
			exit;
		}else if(strlen($message) < 5){
			echo json_encode(array('flag'=>'error',"message"=>'true',"message"=>"Please enter at least 5 characters"));
			exit;
		}else{
			$content	= "<table><tr><td> Name :</td><td> : ".$name."</td></tr>";
			$content	.= "<tr><td>Email :</td><td> : ".$email."</td></tr>";
			if($phone != ''){
				$content	.= "<tr><td>Phone </td><td> : ".$phone."</td></tr>";
			}
			$content	.= "<tr><td>Message :</td><td> : ".$message."</td></tr>";
			$content 	.= "</table>";
			if ( mail( $mail_addresses, $subject_mail, $content, $headers )  ) {
				//echo $content;
				echo json_encode(array('flag'=>'success',"message"=>'Mail sent successfully'));
				exit;
			} else {
				echo json_encode(array('flag'=>'mailer-error',"message"=>'Try Again Later'));
				exit;
			}
		}
	}

?>
