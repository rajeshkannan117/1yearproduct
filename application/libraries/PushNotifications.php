<?php 
// Server file
class PushNotifications {
	// (Android)API access key from Google API's Console.
	private static $API_ACCESS_KEY = 'AIzaSyBCaC5QHN7IkP68fEV8QA_4lT3VXKzh9BQ';
	// (iOS) Private key's passphrase.
	private static $passphrase = '';
	// (Windows Phone 8) The name of our push channel.
        private static $channelName = "joashp";
	
	// Change the above three vriables as per your app.
	/*public function __construct() {
		exit('Init function is not allowed');
	}*/
	
        // Sends Push notification for Android users
	public function android($data, $reg_id) {
	        $url = 'https://fcm.googleapis.com/fcm/send';
	        
			$details['message'] = $data['title'];
			$details['type'] = $data['type'];
			if($data['type'] == '2.1'){
				$details['alert_id'] = $data['details']['alert_id'];
				$details['location_id'] = $data['details']['location_id'];
			}else if($data['type'] == '2.2'){
				$details['alert_id'] = $data['details']['alert_id'];
				$details['user_id'] = $data['details']['user_id'];
			}else if($data['type'] == '2.3'){
				$details['alert_id'] = $data['details']['alert_id'];
				$details['user_id'] = $data['details']['user_id'];
			}else{
				$details['form_id'] = $data['details']['form_id'];
				$details['submission_id'] = $data['details']['submission_id'];
				$details['location_id'] = $data['details']['location_id'];
				$details['org_id'] = $data['details']['org_id'];
			}
	        $message = array(
	            'title' => $data['title'],
	            'body' => $details
	        );
	        $headers = array(
	        	'Authorization: key=' .self::$API_ACCESS_KEY,
	        	'Content-Type: application/json'
	        );			
	        $fields = array(
	            'to' => $reg_id,
	            'notification' => $message
	        );
	        //echo json_encode($fields);
	    	$response = $this->useCurl($url, $headers, json_encode($fields));
	    	//print_r($response);
    	}
	
	// Sends Push's toast notification for Windows Phone 8 users
	public function WP($data, $uri) {
		$delay = 2;
		$msg =  "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
		        "<wp:Notification xmlns:wp=\"WPNotification\">" .
		            "<wp:Toast>" .
		                "<wp:Text1>".htmlspecialchars($data['mtitle'])."</wp:Text1>" .
		                "<wp:Text2>".htmlspecialchars($data['mdesc'])."</wp:Text2>" .
		            "</wp:Toast>" .
		        "</wp:Notification>";
		
		$sendedheaders =  array(
		    'Content-Type: text/xml',
		    'Accept: application/*',
		    'X-WindowsPhone-Target: toast',
		    "X-NotificationClass: $delay"
		);
		
		$response = $this->useCurl($uri, $sendedheaders, $msg);
		
		$result = array();
		foreach(explode("\n", $response) as $line) {
		    $tab = explode(":", $line, 2);
		    if (count($tab) == 2)
		        $result[$tab[0]] = trim($tab[1]);
		}
		
		return $result;
	}
	
        // Sends Push notification for iOS users
	public function ios($data, $devicetoken) {
		$deviceToken = $devicetoken;
		$pem_url = PEM_URL.'Push_Dev.pem';
		//echo $pem_url;exit;
		$ctx = stream_context_create();
		// ck.pem is your certificate file
		stream_context_set_option($ctx, 'ssl', 'local_cert',$pem_url);
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);
		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		// Create the payload body
		$body['aps'] = array(
			'alert' => $data['details']['title'],
        	'body' => '',
        	'sound' => 'default'
		);
		$body['type'] = $data['type'];
		if($data['type'] == '2.1'){
			$body['details'] = array(
				'alert_id' => $data['details']['alert_id'],
				'location_id' => $data['details']['location_id'],
			);
		}else if($data['type'] == '2.2'){
			$body['details'] = array(
				'alert_id' => $data['details']['alert_id'],
				'user_id' => $data['details']['user_id'],
			);
		}else if($data['type'] == '2.3'){
			$body['details'] = array(
				'alert_id' => $data['details']['alert_id'],
				'user_id' => $data['details']['user_id'],
			);
		}
		else{
			$body['details'] = array(
				'form_id' => $data['details']['form_id'],
				'org_id' => $data['details']['org_id']
			);
			if(isset($data['details']['submission_id'])){
				$body['details']['submission_id'] = $data['details']['submission_id'];
			}
			if(isset($data['details']['location_id'])){
				$body['details']['location_id'] = $data['details']['location_id'];
			}
		}
		// Encode the payload as JSON
		$payload = json_encode($body);
		//echo $payload;exit;
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));		
		//echo $result;
		// Close the connection to the server
		fclose($fp);
		if (!$result)
			return 'Message not delivered' . PHP_EOL;
		else
			return 'Message successfully delivered' . PHP_EOL;
	}
	
	// Curl 
	private function useCurl($url, $headers, $fields = null) {
	        // Open connection
	        $ch = curl_init();	        
	        if(!is_array($headers)){throw new InvalidArgumentException('headers MUST be an array!');}
	        if ($url) {
	            // Set the url, number of POST vars, POST data
	            curl_setopt($ch, CURLOPT_URL, $url);
	            curl_setopt($ch, CURLOPT_POST, true);
	            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	     
	            // Disabling SSL Certificate support temporarly
	            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	            if ($fields) {
	                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	            }
	     
	            // Execute post
	            $result = curl_exec($ch);
	            if ($result === FALSE) {
	                die('Curl failed: ' . curl_error($ch));
	            }
	     
	            // Close connection
	            curl_close($ch);
	
	            return $result;
        }
    }
    
}
?>