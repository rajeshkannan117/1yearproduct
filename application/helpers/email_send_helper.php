<?php 
    /*
        $from = > From address (no-reply@formpro.com)
        $from_name => Sender Name
        $send_to => Receipent email Some times it will be array of bulk receipient
        $email_template => Choose Email Templates based on its value
        $subject => Mail Subject content
        $message => Mail Message content Array
    */
    function send_email($from,$from_name,$send_to,$email_template,$subject,$message){
        $CI =& get_instance();
        $CI->load->library('email');
        //$CI->load->library('email');
        $type = array (
            'mailtype' => 'html',
            'charset'  => 'utf-8',
            'priority' => '1'
        );
        $data = array(
            'receiver_name'=> $message['receiver_name'],  // Users Name
            'message' => $message['message'],
            'name' => $message['name'],
            'form_name' => $message['form_name'],
            'location_name' => $message['location_name'],
            'datetime' => $message['datetime']
        );
        $CI->email->initialize($type);
        $CI->email->set_newline("\r\n");
        $CI->email->from($from, $from_name);
        $CI->email->to($send_to);  // replace it with receiver mail id
        $CI->email->subject($subject); // replace it with relevant subject 
        $body = $CI->load->view('emails/'.$email_template,$data,TRUE);
        $CI->email->message($body);
        if($CI->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
?>
