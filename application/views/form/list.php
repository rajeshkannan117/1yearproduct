
 <div id="page_content">
        <div id="page_content_inner" style="padding:0 0px;">

           <!--  <h3 class="heading_b uk-margin-bottom">List of Forms</h3> -->
            <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
            </div> <?php } ?> 
            <div class="uk-margin-medium-bottom">
                <div class="md-card-content">
                     <div class="uk-grid">
                             <div class="uk-width-1-2">
                             </div>
                            <div class="uk-width-1-2 uk-text-right">
                                <?php if(in_array('create',$roles)){ ?>
                                    <a class="add-buuton-new newForm" href="<?php echo base_url().'form/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                        <span>Add new</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                     <table class="uk-table" id="dt_default">
                        <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">#</th>
                                <th class="uk-width-2-10">Form Name</th>
                                <th class="uk-width-2-10">Jobsites</th>
                                <th class="uk-width-1-10">Assigned Users</th>
                                <th class="uk-width-1-10 uk-text-center">Status</th>
                                <th class="uk-width-1-10 uk-text-center" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i='0'; 
                                $this->load->helper('access');
                                //print_r($list); exit;
                                foreach($list as $key=>$value){
                                    $i += 1;
                             ?>
                            <tr>
                            <td class="uk-text-center">
                                <?php echo $i; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url().'form/report/'.$value->uuid; ?>" title="submissions">
                                    <?php echo $value->form_name; ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                if(isset($form_location[$value->form_id])){ 
                                    //print_r($form_location[$value->form_id]);
                                    ?>
                                    <ul class="preview">
                                        <?php
                                            $l = 0; 
                                            foreach($form_location[$value->form_id] as $k=>$v){ 
                                                if($l < 2){
                                            ?>
                                                <li>
                                                    <?php 
                                                     echo ucfirst(wordwrap($v,40,"<br>",TRUE));
                                                     ?>
                                                </li>
                                            <?php  
                                                $l++;
                                                } 
                                            } ?>
                                        </ul>
                                        <?php if(count($form_location[$value->form_id]) > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php foreach($form_location[$value->form_id] as $key=>$value){  
                                                    //if($key > 2){
                                                        echo $value .'<br/>';
                                                    //}
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } 
                                }else{
                                        echo ' - ';
                                    }
                                    /*foreach($form_location[$value->form_id] as $k=>$v){ ?>
                                        <!-- <a onclick="location_preview('<?php echo $k; ?>')" title ="Preview Location"> -->
                                            <?php echo $v; ?>
                                        <!-- </a> --><br/>
                                      }
                                    }*/
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(isset($form_user[$value->form_id])){ ?>
                                        <ul class="preview">
                                        <?php
                                            $u = 0; 
                                            foreach($form_user[$value->form_id] as $k=>$v){ 
                                                if($u < 2 ){
                                            ?>  <li>
                                                    <?php echo $v; ?>
                                                </li>
                                            <?php  
                                                $u++;
                                                } 
                                            } ?>
                                        </ul>
                                        <?php if(count($form_user[$value->form_id]) > 2){ ?>
                                            <span class="loadmore" title="
                                        <?php foreach($form_user[$value->form_id] as $k=>$v){  
                                                    echo $v .'<br/>';
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } 
                                    } else {
                                        echo ' - ';
                                    }   
                                ?>
                            </td>
                            <td class="uk-text-center">
                                <?php
                                
                                    if($value->status == 1){
                                        echo '<span class="uk-badge uk-badge-success" >Active</span>';
                                    } else {
                                        echo '<span class="uk-badge uk-badge-danger2">Inactive</span>';
                                    }
                                 ?>
                            </td>
                            <td class="uk-text-center">
                                <a onclick="form_preview('<?php echo $value->uuid; ?>')" 
                                title ="Preview">
                                    <i class="md-icon material-icons">&#xE8F4;</i>
                                </a>
                             <?php if($value->default == 0){
                                   
                                    $edit = action_return($roles,'form',$value->uuid,$user_id,$value->created_by);
                                    if(in_array('delete',$roles)){
                                        if($edit != 'N/A'){ 
                                            //echo $edit; 
                                            $edit = 'N/A';
                                        }else{ 
                                            echo $edit = ''; 
                                        }
                                ?>
                               <!--  <a onclick="UIkit.modal.confirm('Are you sure want to delete this form ?', function(){ 
                                    location.href='<?php echo base_url().'form/delete/'.$value->form_id; ?>'
                                    })" >
                                    <i class="md-icon material-icons">&#xE872;</i>
                                </a> -->
                                <?php 
                                    } else { 
                                            if($edit === 'N/A'){ 
                                                echo ''; 
                                            }else{ 
                                                echo $edit; 
                                            } 
                                       }
                                }else{ 
                                    echo " ";
                                    
                                } ?>
                            
                            <?php if(access_edit($roles,'forms',$user_id,$value->created_by)){ ?>
                                 <a href="<?php echo base_url() .'form/edit/'.$value->uuid; ?>" title="Edit">
                                    <i class="md-icon material-icons">&#xE254;</i>
                                </a>
                             <?php } ?> 
                            </td>
                        </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
