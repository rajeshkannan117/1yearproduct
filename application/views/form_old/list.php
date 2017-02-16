
 <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">List of Forms</h3>
            <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
            </div> <?php } ?> 
            <div class="md-card">
                <div class="md-card-content large-padding">
                     <div class="uk-grid">
                             <div class="uk-width-1-2">
                             </div>

                            <div class="uk-width-1-2 uk-text-right">
                                <?php if(in_array('create',$roles)){ ?>
                                    <a class="md-btn md-btn-primary" href="<?php echo base_url().'form/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                        <img src="<?php echo base_url(); ?>assets/assets/img/add_circle_white_48dp.png" style="width:40px;" />
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                     <table class="uk-table" id="dt_default">
                        <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">#</th>
                                <th class="uk-width-2-10">Form Name</th>
                                <th class="uk-width-1-10 uk-text-center">Description</th>
                                <th class="uk-width-1-10 uk-text-center">Status</th>
                                <th class="uk-width-1-10 uk-text-center" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i='0'; 
                                $this->load->helper('access');
                               // print_r($list); exit;
                                foreach($list as $key=>$value){
                                    $i += 1;
                             ?>
                                <tr>
                                    <td class="uk-text-center"><?php echo $i; ?></td>
                                    <?php if(access_edit($roles,'forms',$user_id,$value->created_by)){ ?>
                                     <td><a href="<?php echo base_url() .'form/edit_form/'.$value->form_id; ?>"><?php echo $value->form_name; ?></a></td>
                                    <?php } else{ ?>
                                    <td><?php echo $value->form_name; ?></td>
                                    <?php  } ?>
                                    <td><?php echo $value->form_desc; ?></td>
                                    <td class="uk-text-center">
                                        <?php
                                            if($value->status){
                                                echo '<span class="uk-badge uk-badge-success" style="">Active</span>';
                                            } else {
                                                echo '<span class="uk-badge uk-badge-danger2" style="">Inactive</span>';
                                            }
                                         ?>
                                    </td>
                                    <td class="uk-text-center">
                                     <?php if($value->default == 0){
                                           
                                            $edit = action_return($roles,'form',$value->form_id,$user_id,$value->created_by);
                                            if(in_array('delete',$roles)){
                                                if($edit != 'N/A'){ 
                                                    echo $edit; 
                                                }else{ 
                                                    echo $edit = ''; 
                                                }
                                        ?>
                                        <a onclick="UIkit.modal.confirm('Are you sure want to delete this form ?', function(){ 
                                            location.href='<?php echo base_url().'form/delete/'.$value->form_id; ?>
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
                                        }else{ 
                                            echo "N/A";
                                            
                                        } ?>
                                    </td>
                                </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>