<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<style>

* { margin:0px; padding:0px;  }
body { background:#fff; font-family: 'Open Sans', sans-serif; }
img { border:0px; }
</style>
</head>

<body>
    <table cellpadding="0" cellspacing="0" width="600px" align="left" style=" margin: 20px; background:#F2F2F2">
        <tr>
            <td style="border-bottom: 1px solid #e9e9e9; text-align:center;background:#fff">
                    <img src="<?php  echo base_url();    ?>assets/assets/img/logo.png" style="width:200px; margin: 20px 0 20px 0px;" />
            </td>
            
        </tr>
        <tr>
            <td colspan="2" style="padding: 20px 30px 0px; font-size: 16px; line-height:24px;">
                Dear <?php echo $name; ?>,<br /><br />
                
                Welcome to <b>FORMPRO</b>. An account have been successfully registered.<br /><br />
                Use the details below to login for your account.<br /><br />
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:10px 30px;">
                <p style="border:1px solid #e9e9e9;background:#fff; border-radius:4px; -moz-border-radius:4px; -webkit-border-radius:4px; font-size: 16px; line-height:24px; padding: 10px 20px;">Login Url <span style="color:#4568c4;"><?php  echo base_url();    ?></span></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:10px 30px;">
                <p style="border:1px solid #e9e9e9;background:#fff; border-radius:4px; -moz-border-radius:4px; -webkit-border-radius:4px; font-size: 16px; line-height:24px; padding: 10px 20px;">Registered Email Address <span style="color:#4568c4;"><?php echo $email; ?></span></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:10px 30px; padding-bottom: 40px;">
                <p style="border:1px solid #e9e9e9;background:#fff; border-radius:4px; -moz-border-radius:4px; -webkit-border-radius:4px; font-size: 16px; line-height:24px; padding: 10px 20px;">Your Password <span style="color:#4568c4;"><?php echo $password; ?></span></p>
            </td>
        </tr>
    </table>
</body>
</html>
