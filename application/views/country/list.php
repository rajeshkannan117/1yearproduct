    <div id="page_content">
        <div id="page_content_inner" style="padding:0 0px;">
                 <!-- <h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('countries'); ?></h3>  -->
                 <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                    <div class="uk-alert uk-alert-success" data-uk-alert="">
                        <a href="#" class="uk-alert-close uk-close"></a>
                        <?php echo $this->session->flashdata('SucMessage');  ?>
                    </div> 
                <?php } ?> 
                
                
        <div class="uk-margin-medium-bottom">
             <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <div class="uk-grid">
                             <div class="uk-width-1-2">
                             </div>
                            <div class="uk-width-1-2 uk-text-right">
                                <?php if(in_array('create',$roles)){ ?>
                                    <a class="add-buuton-new" href="<?php echo base_url().'country/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                    <!--<img src="<?php echo base_url(); ?>assets/assets/img/add_circle_white_48dp.png" style="width:40px;" /> -->
                                    <span>Add new</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- //dt_server -->
                        <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">#</th>
                                <th class="uk-width-2-10"><?php echo $this->lang->line('country_name'); ?></th>
                                <th class="uk-width-1-10 uk-text-center"><?php echo $this->lang->line('status'); ?></th>
                                <th class="uk-width-2-10 uk-text-center"><?php echo $this->lang->line('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            
                                <?php $i='0';  
                                if (is_array($result) || is_object($result)){                              
                                foreach($result as $details) { 
                                $i += 1;
                                ?>
                                <tr>
                                    <td class="uk-text-center"><?php echo $i; ?></td>
                                    <td><?php echo wordwrap($details['country_name'],25,"<br>",TRUE); ?><br>
                                    <span style="font-size: 12px;color:red;"><?php if($details['default'] == "1"){ echo "System Default"; } ?> </span>
                                    </td>
                                    
                                    <td class="uk-text-center">
                                        <?php if($details['status'] == "1"){ ?><span class="uk-badge uk-badge-success" style="">Active</span> <?php } ?>
                                        <?php if($details['status'] == "0"){ ?><span class="uk-badge uk-badge-danger2" style="">Inactive</span> <?php } ?>
                                    </td>
                                    <td class="uk-text-center" id="<?php echo "default".$i;?>">
                                        <?php if($details['default'] == 0){ 
                                            $this->load->helper('access');
                                            $edit = action_return($roles,'country',$details['loc_id'],$user_id,$details['created_by']);    
                                            if(in_array('delete',$roles)){ 
                                                if($edit != 'N/A'){ echo $edit; }else{ echo $edit = ''; }              
                                        ?>
                                        <a onclick="UIkit.modal.confirm('<?php echo $this->lang->line("warning"); ?>', function(){ 
                                            location.href='<?php echo base_url();?>country/delete/<?php echo $details['loc_id']; ?>'
                                            })" >
                                            <i class="md-icon material-icons">&#xE872s</i>
                                        </a>
                                        <?php 
                                            } else { 
                                                    if($edit === 'N/A'){ echo $edit; }else{ echo $edit; } 
                                               }
                                        } else{ echo "N/A";} ?>
                                        <!--<a href="<?php echo base_url();?>country/delete/<?php echo $details['loc_id']; ?>" onclick="return confirm('Are you sure, you want to delete this Country?')"><i class="md-icon material-icons">&#xE872;</i></a>-->
                                    </td>
                                </tr>

                              <?php } }?>  
                            </tbody> 
                        </table>
                    </div>
                </div>
            </div>  

        </div>
    </div>

  