<div id="page_content">
    <div id="page_content_inner" style="padding:0 0px;">
    		
       <!-- <h3 class="heading_b uk-margin-bottom"> <?php echo $this->lang->line('location'); ?> </h3>  -->
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
                         <?php if(in_array('create',$location)){?>
                               <a class="add-buuton-new addLocation" href="" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                    <span>Add new</span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                     <table id="dt_default" class="uk-table" cellspacing="0" width="96%">
                        <thead>
                        <tr>
                            <th class="uk-width-1-10 uk-text-center">#</th>
                            <th class="uk-width-1-10"><?php echo $this->lang->line('location_id'); ?></th>
                            <th class="uk-width-2-10"><?php echo $this->lang->line('location_name'); ?></th>
                            <th class="uk-width-2-10"><?php echo $this->lang->line('city'); ?></th>
                            <th class="uk-width-2-10"><?php echo $this->lang->line('state'); ?></th>
                            <th class="uk-width-1-10"><?php echo $this->lang->line('country'); ?></th>
                            <th class="uk-width-1-10 uk-text-center"><?php echo $this->lang->line('status'); ?></th>
                            <th class="uk-width-2-10 uk-text-center"><?php echo $this->lang->line('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                           
                        	<?php $i='0';
                            if ((is_array($result) || is_object($result))){
							foreach($result as $details) { 
							$i += 1;
							?>
                            <tr>
                                <td class="uk-text-center"><?php echo $i; ?></td>
                                <td><?php echo $details['location_id']; ?></td>
                                <td><?php echo $details['location_name']; ?></td>
                                <td><?php echo $details['city']; ?></td>
                                <td><?php echo $details['state']; ?></td>
                                <td><?php echo $details['country_name']; ?></td>
                                <td class="uk-text-center">
                                	<?php if($details['status'] == "1"){ ?>
                                        <span class="uk-badge uk-badge-success" style="">Active</span> 
                                    <?php } ?>
                                	<?php if($details['status'] == "0"){ ?>
                                        <span class="uk-badge uk-badge-danger2" style="">Inactive</span> 
                                    <?php } ?>
                                </td>
                                <td class="uk-text-center">
                                    <a onclick="location_preview('<?php echo $details['uuid']; ?>')" data-id ="<?php echo $details['uuid']; ?>" href="#" title="Preview">
                                        <i class="md-icon material-icons">&#xE8F4;</i>
                                    </a>
                                    <?php 
                                    if(!isset($details['created_by'])){
                                        $created_by = 0;
                                    }
                                    else{
                                        $created_by = $details['created_by'];
                                    }

                                    $edit = action_return($location,'location',$details['uuid'],$user_id,$created_by); 
                                    if($edit != 'N/A'){
                                        echo $edit;
                                    }else{
                                        echo $edit = '';
                                    }
                                    if(in_array('delete',$location)){ 
                                        ?>
                                        <a title="Delete" href="<?php echo base_url();?>location/delete/<?php echo $details['uuid']; ?>" onclick="return location_delete('<?php echo $details['uuid']; ?>');"><i class="md-icon material-icons">&#xE872;</i></a>
                                    <?php  } else { 
                                        if($edit == ''){
                                            echo 'N/A';
                                        }
                                   // } ?>
                                    
                                  
                                </td>
                            </tr>

                           <?php } } }?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  

    </div>
</div>
