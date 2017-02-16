<?php
#functions for API Request Validation
function mandatoryArray($requestArray,$mandatoryKeys,$nonMandatoryValueKeys)
{
	
	
	$requestArray=array_map('trim',$requestArray);

	  $error= array();	

	  
	  foreach ($mandatoryKeys as $key => $val){		  

		  if(!array_key_exists($key,$requestArray)) {

			  $error["msg"] = "Request must contain ".$key;

			  $error["statusCode"] = 400; 	

			  break;		    

		  }	 
		  
		  if( (empty($requestArray[$key]))  && (!in_array($key,$nonMandatoryValueKeys)) && ($requestArray[$key]!='0') )
		   {
		  	
			  		$error["msg"] = $val." should not be empty";		
			  
			  		$error["statusCode"] = 400;
			  
				    break;       

		  }  

	  }

	  

	  return $error;

 }







?>