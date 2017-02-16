<div id="page_content">
    <div id="page_content_inner" style="padding: 0 0px">
        <?php if ($this->session->flashdata('ErrorMessage')!='') { ?>
            <div class="uk-alert uk-alert-warning" data-uk-alert="">
                <a href="#" class="uk-alert-close uk-close"></a>
                <?php echo $this->session->flashdata('ErrorMessage');  ?>
            </div> 
        <?php } ?> 
        <div class="uk-margin-medium-bottom">
            <div class="md-card-content">
                 <table class="uk-table" id="dt_default">
                    <thead>
                        <tr>
                            <th class="uk-width-1-10 uk-text-center">#</th>
                            <th class="uk-width-1-10">Form Name</th>
                            <th class="uk-width-1-10">Category</th>
                            <th class="uk-width-1-10 ">Assigned Users</th>
                            <th class="uk-width-1-10 uk-text-center">Status</th>
                            <th class="uk-width-1-10 uk-text-center" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i='0'; 
                            $this->load->helper('access');
                            foreach($forms as $key=>$value){
                                $i += 1;
                         ?>
                    <tr>
                        <td class="uk-text-center"><?php echo $i; ?></td>
                        <td><?php echo $value->form_name; ?></td>
                        <td>
                            <?php
                                echo $form_category[$value->form_id];
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
                                if($value->status){
                                    echo '<span class="uk-badge uk-badge-success" style="">Active</span>';
                                } else {
                                    echo '<span class="uk-badge uk-badge-danger2" style="">Inactive</span>';
                                }
                             ?>
                        </td>
                        <td class="uk-text-center">
                            <a onclick="worflow_preview('<?php echo $value->uuid; ?>')" title="Preview">
                                <i class="md-icon material-icons">&#xE8F4;</i>
                            </a>
                            <a href="<?php echo base_url().'workflow/edit/'.$value->uuid; ?>" title="Edit">
                                <i class="md-icon material-icons">&#xE254;</i>
                            </a>
                        </td>
                    </tr>
                         <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
