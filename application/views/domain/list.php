    <div id="page_content">
        <div id="page_content_inner" style="padding:0 0px">
            <!-- <h3 class="heading_b uk-margin-bottom">Industry</h3>  -->
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
                                    <a class="add-buuton-new" href="<?php echo base_url().'domain/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                        <span>Add new</span>
                                    </a>
                                     <?php } ?>
                            </div>
                        </div>
                        <table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">#</th>
                                <th class="uk-width-2-10">Industry Name</th>
                                <th class="uk-width-3-10">Industry Description</th>
                                <th class="uk-width-2-10">Country Name</th>
                                <th class="uk-width-1-10 uk-text-center">Status</th>
                                <th class="uk-width-2-10 uk-text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                                <?php $i='0';
                                $k =0;
                               
                                if(is_array($details) && count($details) > 0){    
                                foreach($details as $domain=>$value) { 
                                 $i += 1;
                                ?>
                                <tr>
                                    <td class="uk-text-center"><?php echo $i; ?></td>
                                    <td><?php echo wordwrap($value['domain_name'],25,"<br>",TRUE); ?><br>
                                    <span style="font-size: 12px;color:red;"><?php if($value['default'] == "1"){ echo "System Default"; } ?> </span>
                                    </td>
                                    <td><?php echo wordwrap($value['domain_desc'],50,"<br>",TRUE); ?>
                                    </td>

                                    <td class="">
                                        <?php //echo $value['country_name'];
                                            $country = explode(',',$value['country_name']) ?>
                                            <ul class="preview">
                                            <?php
                                                $j = 0; 
                                                foreach($country as $k=>$v){ 
                                                    if($j < 2 ){ ?>
                                                    <li>
                                                        <?php echo $v; ?>
                                                    </li>
                                                <?php $j++; 
                                                }
                                            } ?>
                                            </ul>
                                            <?php if(count($country) > 2){ ?>
                                                <span class="loadmore" title="
                                                <?php foreach($country as $key=>$value){  
                                                        //if($key > 2){
                                                            echo $value .'<br/>';
                                                        //}
                                                    }?>" data-uk-tooltip="{cls:'long-text'}">
                                                        ...
                                                </span>
                                            <?php } 
                                        
                                            /*$country_list = '';
                                            for($i=0;$i<count($country);$i++){
                                                if($i%2!=0){
                                                    $country_list .= $country[$i].'<br>';
                                                }else{
                                                    $country_list .= $country[$i].",";
                                                }
                                            }
                                            echo substr($country_list,'0','-1');*/

                                     ?>
                                    </td>
                                        
                                    <!--<td><?php //echo trim($details['domain_desc']); ?></td>
                                    <td class="uk-text-center" id="<?php //echo $i;?>" mapid="<?php //echo $details["mapid"];?>" page="domain">
                                        <?php //if($details['setdefault'] == "1"){ ?><input type="button" class="default" name="default" value="Default" > <?php //} ?>
                                        <?php //if($details['setdefault'] == "0"){ ?><input type="button" class="setdefault" name="setdefault" value="Set" > <?php //} ?>
                                    </td>-->
                                    <td class="uk-text-center">
                                        <?php if($value['status'] == "1"){ ?><span class="uk-badge uk-badge-success" style="">Active</span> <?php } ?>
                                        <?php if($value['status'] == "0"){ ?><span class="uk-badge uk-badge-danger2" style="">Inactive</span> <?php } ?>
                                    </td>
                                    <td class="uk-text-center">
                                    <?php if($value['default'] != 1){
                                            $this->load->helper('access');
                                            $edit = action_return($roles,'domain',$value['uuid'],$user_id,$value['created_by']);    
                                            if(in_array('delete',$roles)){ 
                                                if($edit != 'N/A'){ echo $edit; }else{ echo $edit = ''; }  
                                        ?>
                                        <a onclick="domain_delete('<?php echo $value['uuid']; ?>')" >
                                            <i class="md-icon material-icons">&#xE872;</i>
                                        </a>
                                        <?php 
                                            } else { 
                                                    if($edit === 'N/A'){ echo $edit; }else{ echo $edit; } 
                                               }
                                        } else{ echo "N/A";} ?>
                                    </td>
                                </tr>

                               <?php } }  ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  

        </div>
    </div>

  
