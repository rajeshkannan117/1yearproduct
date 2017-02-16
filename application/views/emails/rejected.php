<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

 <table cellpadding="0" cellspacing="0" width="600px" align="left" style=" padding: 20px;background:#f2f2f2;padding-bottom:80px">
    	<tr>
        	<td style="border-bottom: 1px solid #e9e9e9; text-align:center;">
                    <img src="<?php  echo base_url();    ?>assets/assets/img/logo.png" style="width:200px; margin: 20px 0 20px 0px;" />
            </td>            
        </tr>
<tr style="background:#fff">    
<td style="text-align:center;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 35px;padding-top:40px">Hi <?php echo $name;?>,</td> 
</tr>
<tr style="background:#fff">
<td style="text-align:center;color: #565656;font-family: Georgia,serif;font-size: 20px;line-height: 35px;padding:20px 0px 40px">Sorry your form got <b style="color:red">Rejected</b></td>
</tr>

<!--<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">To activate this password click the link below </p>
	<a href="<?php echo $link.'/'.$activation; ?>" style="width:100%; height:32px;text-align:center;border:1px solid #41673e;background-color:#41673e;padding:10px;color:white"> Activation </a>-->

</table> 

</body>
</html>

