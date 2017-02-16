    <div id="page_content">
        <div id="page_content_inner">
<h3 class="heading_b uk-margin-bottom">Roles</h3>
<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?> 
<div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <div class="uk-grid">
                             <div class="uk-width-1-2">
                             </div>
                            <div class="uk-width-1-2 uk-text-right">
                                <?php if(in_array('create',$roles)){ ?>
                                    <a class="md-btn md-btn-primary" href="<?php echo base_url().'role/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                    <img src="<?php echo base_url(); ?>assets/assets/img/add_circle_white_48dp.png" style="width:40px;" />
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                         <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="uk-width-1-10 uk-text-center">#</th>
                                    <th class="uk-width-2-10">Role Name</th>
                                    <th class="uk-width-2-10">Role Description</th>
                                    <th class="uk-width-1-10 uk-text-center">Status</th>
                                    <th class="uk-width-2-10 uk-text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            	<?php  $this->load->helper('access'); $i='0'; if(!empty($result)) {
				foreach($result as $key=>$details) { 
                                    $i += 1;
				?>
                                <tr>
                                    <td class="uk-text-center"><?php echo $i; ?></td>
                                    <td><?php echo $details['role_name']; ?></td>
                                     <td><?php echo $details['role_desc']; ?></td>
                                    <td class="uk-text-center">
                                    	<?php if($details['status'] == "1"){ ?><span class="uk-badge uk-badge-success" style="">Active</span> <?php } ?>
                                    	<?php if($details['status'] == "0"){ ?><span style="color:red;"">Inactive</span> <?php } ?>
                                    </td>
                                    <td class="uk-text-center">
                                       <?php if($details['default'] == 0){
                                           
                                            $edit = action_return($roles,'role',$details['role_id'],$user_id,$details['created_by']);
                                            if(in_array('delete',$roles)){
                                                if($edit != 'N/A'){ 
                                                    echo $edit; 
                                                }else{ 
                                                    echo $edit = ''; 
                                                }
                                        ?>
                                        <a onclick="UIkit.modal.confirm('Are you sure want to delete this country ?', function(){ 
                                            location.href='<?php echo base_url();?>role/delete/<?php echo $details['role_id']; ?>'
                                            })" >
                                            <i class="md-icon material-icons">&#xE872s</i>
                                        </a>
                                        <?php 
                                            } else { 
                                                    if($edit === 'N/A'){ 
                                                        echo $edit; 
                                                    }else{ 
                                                        echo $edit; 
                                                    } 
                                               }
                                        } else{ 
                                            echo "N/A";
                                            
                                        } ?>
                                    </td>
                                </tr>

                               <?php } } ?> 
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>  

        </div>
    </div>

   
