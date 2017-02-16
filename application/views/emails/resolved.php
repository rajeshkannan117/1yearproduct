<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $this->lang->line('submission'); ?></title> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
  <table cellpadding="0" cellspacing="0" width="600px" align="center" style=" margin:20px auto;background:#f2f2f2;padding-bottom:80px">
      <tr>
          <td style="border-bottom: 1px solid #e9e9e9; text-align:center;">
                <img src="<?php  echo base_url();       ?>assets/assets/img/logo.png" style="width:200px; margin: 20px 0 20px 0px;" />
            </td>            
        </tr>
    <tr style="background:#fff">    
      <td style="text-align:left;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 35px;padding: 20px 30px 0px;">Hi <?php echo $receiver_name;?>,
      </td> 
    </tr>
    <tr style="background:#fff">    
      <td style="text-align:justify;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 35px;padding: 20px 30px 20px;">
        <?php echo $this->lang->line('approved_msg'); ?> <!-- <a href="<?php echo $form_url; ?>"> --><b style="color:red"><?php echo $form_name; ?></b><!-- </a> --><?php echo $this->lang->line('from').' '.$location_name.' '.$this->lang->line('location').' '.$this->lang->line('on').' '.$datetime.''; ?><b><?php echo $this->lang->line('approved_status');?></b><?php echo $this->lang->line('by').' '.$name; ?>
      </td> 
    </tr>
  </table> 
</body>
</html>

