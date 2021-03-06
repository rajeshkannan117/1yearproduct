<?php   
   /* $content = json_decode($contents);*/
    $CI =& get_instance();
    $CI->load->library('status');
    //$permission_access = $this->session->userdata('menu'); 
?>
<div id="page_content">
    <div id="page_content_inner" style="padding:0 0px"; >
        <?php if ($this->session->flashdata('SucMessage')!='') { ?>
            <div class="uk-alert uk-alert-success" data-uk-alert="">
                <a href="#" class="uk-alert-close uk-close"></a>
                <?php echo $this->session->flashdata('SucMessage');  ?>
            </div> 
        <?php } ?> 
        <div class="uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="uk-overflow-container">
                    <table class="uk-table" id="dt_default" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-center">#</th>
                                <th class="uk-width-2-10 uk-center"><?php echo $this->lang->line('submitted_by'); ?></th>
                                <th class="uk-width-1-10 uk-center"><?php echo $this->lang->line('form_name');?></th>
                                <th class="uk-width-1-10 uk-center"><?php echo $this->lang->line('created_at');?></th>
                                <th class="uk-width-1-10 uk-center"><?php echo $this->lang->line('status');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(is_array($details)){
                            foreach($details as $key=>$value){ ?>
                                <tr>
                                    <td class="uk-width-1-10 uk-center">
                                        <a href="<?php echo base_url().'todo/review/'.$value['uuid'];?>">
                                            <?php echo $value['id'];?>    
                                        </a>
                                    </td>
                                    <td class="uk-width-2-10 uk-center">
                                        <?php echo $value['name'];?>
                                    </td>
                                    <td class="uk-width-1-10 uk-center">
                                        <?php echo $value['form_name'];?>
                                    </td>
                                    <td class="uk-width-1-10 uk-center">

                                        <span id="time_<?php echo $value['id']; ?>">
                                            <!-- <?php echo $value['createddate'];?> -->
                                        </span>
                                        <script>
                                            get_local_date_js('<?php echo $value['createddate']; ?>','time_<?php echo $value['id']; ?>');
                                        </script>
                                    </td>
                                    <td class="uk-width-1-10 uk-center">
                                        <span class="uk-badge <?php echo $CI->status->status_code($value['status']); ?>">
                                            <?php echo $this->lang->line($value['status']);?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } 
                            } 
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>