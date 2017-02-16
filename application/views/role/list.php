    <div id="page_content">
        <div id="page_content_inner" style="padding:0 0px;">
<!-- <h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('roles'); ?></h3> -->
<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?> 
<div class="uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <div class="uk-grid">
                             <div class="uk-width-1-2">
                             </div>
                            <div class="uk-width-1-2 uk-text-right">
                                <?php if(in_array('create',$roles)){ ?>
                                    <a class="add-buuton-new" href="<?php echo base_url().'role/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                        <span>Add new</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                         <table id="dt_default" class="uk-table" cellspacing="0" width="96%">
                            <thead>
                                <tr>
                                    <th class="uk-width-1-10 uk-text-center">#</th>
                                    <th class="uk-width-1-10"><?php echo $this->lang->line('role_name'); ?></th>
                                    <th class="uk-width-2-10"><?php echo $this->lang->line('role_desc'); ?></th>
                                    <th class="uk-width-2-10">
                                        <?php echo $this->lang->line('role_users'); ?>
                                    </th>
                                    <th class="uk-width-1-10 uk-text-center"><?php echo $this->lang->line('status'); ?></th>
                                    <th class="uk-width-1-10 uk-text-center"><?php echo $this->lang->line('actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            	<?php  
                                $this->load->helper('access'); $i='0'; 
                                if(!empty($result)) {      
				foreach($result as $key=>$details) { 
                                if($details['organiser_id'] == $org_id){
                                    $i += 1;
				?>          
                                <tr>
                                    <td class="uk-text-center"><?php echo $i; ?></td>
                                    <td><?php echo $details['role_name']; ?></td>
                                    <td>
                                        <?php
                                            echo ucfirst(wordwrap($details['role_desc'],40,"<br>",TRUE));
                                        ?>
                                    </td>
                                    <td class="uk-width-2-10">
                                        <?php 
                                        if(isset($role_users[$details['role_id']])){ ?>
                                        <ul class="preview">
                                        <?php
                                            $k = 0; 
                                            foreach($role_users[$details['role_id']] as $key=>$value){ 
                                                if($k < 2 ){
                                            ?>
                                                <li>
                                                    <?php echo $value; ?>
                                                </li>
                                            <?php  
                                                $k++;
                                                } 
                                            } ?>
                                        </ul>
                                        <?php if(count($role_users[$details['role_id']]) > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php foreach($role_users[$details['role_id']] as $key=>$value){  
                                                    //if($key > 2){
                                                        echo $value .'<br/>';
                                                    //}
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } 
                                        }
                                        else {
                                            echo ' - ';
                                        }
                                        ?>
                                    </td>
                                    <td class="uk-text-center">
                                    	<?php if($details['status'] == "1"){ ?>
                                        <span class="uk-badge uk-badge-success" ><?php echo $this->lang->line('active'); ?></span> <?php } ?>
                                    	<?php if($details['status'] == "0"){ ?>
                                        <span class="uk-badge uk-badge-danger2"><?php echo $this->lang->line('inactive'); ?></span> <?php } ?>
                                    </td>
                                    <td class="uk-text-center">
                                        <a title="Preview" onclick="role_preview('<?php echo $details['uuid']; ?>')" data-id ="<?php echo $details['uuid']; ?>" href="#">
                                                <i class="md-icon material-icons">&#xE8F4;</i>
                                        </a> 
                                       <?php if($details['default'] == 0){
                                            $edit = action_return($roles,'role',$details['uuid'],$user_id,$details['created_by']);

                                            if(in_array('delete',$roles)){
                                                if($edit != 'N/A'){ 
                                                    $edit; 
                                                }else{ 
                                                    $edit = ''; 
                                                }
                                            } else { 
                                                if($edit != 'N/A'){ 
                                                    $edit; 
                                                }else{ 
                                                    $edit = ''; 
                                                } 
                                            }
                                            if($org_id == 1){
                                                if($org_id === $details['organiser_id']){
                                                    echo $edit.' ';
                                                }else{
                                                    $edit =' ';
                                                    echo $edit.' ';
                                                }
                                            }else{
                                                echo $edit.'';
                                            }
                                        } else { 
                                            echo "N/A";
                                        } 
                                    ?>
                                        
                                    </td>
                                    <!-- <td class="uk-text-center">
                                        N/A
                                    </td> -->
                                </tr>

                               <?php } } } ?> 
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>  

        </div>
    </div>

   
