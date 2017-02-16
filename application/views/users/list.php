 <?php
 $ci =&get_instance();
 $ci->load->model('user_model');
 $ci->load->helper('access');
 ?>
<div id="page_content">
    <div id="page_content_inner" style="padding:0 0px;">    		
        <!-- <h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('users'); ?></h3>  -->
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
                         <?php if(in_array('create',$users)){?>
                            <!---->
                               <a class="add-buuton-new newUser" href="<?php echo base_url().'users/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                    <span>Add new</span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <table id="dt_default" class="uk-table" cellspacing="0" width="96%">
                        <thead>
                        <tr>
                            <th class="uk-width-1-10 uk-text-center">#</th>
                            <th class="uk-width-1-10"><?php echo $this->lang->line('first_name'); ?></th>
                            <th class="uk-width-1-10"><?php echo $this->lang->line('last_name'); ?></th>
                            <!-- <?php if($org_id == 1){ ?>
                            <th class="uk-width-2-10"><?php echo $this->lang->line('organization'); ?></th>
                            <?php } ?> -->
                            <th class="uk-width-1-10">
                                <?php echo $this->lang->line('email'); ?>
                            </th>
                            <th class="uk-width-1-10">
                                <?php echo $this->lang->line('phone'); ?>
                            </th>
                            <th class="uk-width-1-10">
                                <?php echo $this->lang->line('location'); ?>
                            </th>
                            <?php if($org_id != 1){ ?>
                            <th class="uk-width-1-10">
                                <?php echo $this->lang->line('forms'); ?>
                            </th>
                            <th class="uk-width-1-10">
                                <?php echo $this->lang->line('roles'); ?>
                            </th>
                            <?php } ?>
                            <th class="uk-width-1-10 uk-text-center">
                                <?php echo $this->lang->line('status'); ?>
                            </th>
                            <th class="uk-width-2-10 uk-text-center"><?php echo $this->lang->line('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php $i='0';
                            if ((is_array($result) || is_object($result))){
							foreach($result as $key=>$details) { 
							$i += 1;
                               // 
							?>
                            <tr>
                                <td class="uk-text-center"><?php echo $i; ?></td>
                                <td><?php echo $details['first_name']; ?></td>
                                <td><?php echo $details['last_name']; ?></td>
                               <!--  <?php if($org_id == 1){ ?>
                                    <td><?php echo $details['org_name']; ?></td>
                                <?php } ?> -->
                                <td><?php echo $details['email']; ?></td>
                                <td><?php echo $details['phone']; ?></td>
                                <td>
                                    <?php
                                        if(isset($location[$details['id']])){ ?>
                                            <ul class="preview">
                                                <?php
                                                    $j=0; 
                                                    foreach($location[$details['id']] as $k=>$v){
                                                    if($j <= 2) { 
                                                    ?>
                                                        <li>
                                                            <?php echo ucfirst(wordwrap($v,25,"<br>",TRUE));?>
                                                        </li>
                                            <?php  } $j++; } ?>
                                            </ul>
                                    <?php 
                                        if(count($location[$details['id']]) > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php foreach($location[$details['id']] as $key=>$value){  
                                                    if($key > 2){
                                                        echo $value .'<br/>';
                                                    }
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                    <?php  }
                                    } ?>

                                </td>
                                <?php if($org_id != 1){ ?>
                                <td>
                                    <?php
                                        if(isset($form_users[$key])){ ?>
                                        <ul class="preview">
                                        <?php 
                                            $f= 0;
                                            foreach($form_users[$key] as $k=>$value){ 
                                                if($f < 2){
                                            ?>
                                                <li>
                                                    <?php echo $value; ?>
                                                </li>
                                        <?php   } $f++;
                                            } ?>
                                        </ul>
                                            <?php if(count($form_users[$key]) > 2){ ?>
                                                <span class="loadmore" title="
                                            <?php foreach($form_users[$key] as $k=>$value){  
                                                    //if($k > 2){
                                                        echo $value .'<br/>';
                                                    //}
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                            <?php } ?>
                                     <?php   }else{
                                            echo '<span class="uk-text-center"> N/A </span>';
                                        }
                                    ?>
                                </td>
                                <td><?php echo $details['role_name']; ?></td>
                                <?php } ?>
                                <td class="uk-text-center">
                                	<?php if($details['activation'] == "1"){ ?><span class="uk-badge uk-badge-success" style="">Active</span> <?php } ?>
                                	<?php if($details['activation'] == "0"){ ?><span class="uk-badge uk-badge-danger2" style="">Inactive</span> <?php } ?>
                                </td>
                                <td class="uk-text-center">
                                    <a onclick="user_preview('<?php echo $details['uuid']; ?>')" data-id ="<?php echo $details['uuid']; ?>" href="#" title="Preview">
                                        <i class="md-icon material-icons">&#xE8F4;</i>
                                    </a>
                                    <?php 
                                    if(!isset($details['created_by'])){
                                        $created_by = 0;
                                    }
                                    else{
                                        $created_by = $details['created_by'];
                                    }
                                    $edit = action_return($roles,'users',$details['uuid'],$user_id,$created_by); 
                                        //if(in_array('update',$users)){ 
                                        //    if($details['id'] != $user_id){
                                            if($edit != 'N/A'){
                                                echo $edit;
                                            }else{
                                                echo $edit = '';
                                            } 
                                        if(in_array('delete',$users)){ 
                                                if($details['id'] != $user_id){
                                            ?>
                                            <a onclick="UIkit.modal.confirm('Are you sure want to delete this user ?', function(){ 
                                                location.href='<?php echo base_url();?>users/delete/<?php echo $details['uuid']; ?>';
                                                })" title="Delete">
                                                <i class="md-icon material-icons">&#xE872;</i>
                                            </a>
                                        <?php } } else { 
                                                if($edit == ''){
                                                    echo 'N/A';
                                                }
                                            } ?>
                                    
                                </td>
                            </tr>
                           <?php } } //} ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
