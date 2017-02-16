<div id="page_content">
    <div id="page_content_inner" style="padding:0 0px;">
        <!--<h3 class="heading_b uk-margin-bottom">Organizations</h3> -->
        <?php if ($this->session->flashdata('SucMessage') != '') { ?>
            <div class="uk-alert uk-alert-success" data-uk-alert="">
                <a href="#" class="uk-alert-close uk-close"></a>
                <?php echo $this->session->flashdata('SucMessage'); ?>
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
                               <!-- <a class="md-btn md-btn-primary" href="<?php echo base_url() . 'organization/add' ?>">Add</a>-->
                            <a class="add-buuton-new" href="<?php echo base_url() . 'organization/add' ?>" style="">
                                <!--<img src="<?php echo base_url(); ?>assets/assets/img/add_circle_white_48dp.png" style="width:40px;" />-->
                                <span>Add new</span>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <table id="dt_default" class="uk-table" cellspacing="0" width="96%">
                        <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">&nbsp;&nbsp;&nbsp;  #</th>
                                <th class="uk-width-3-10">Organization Name</th>
                                <th class="uk-width-3-10">Industry Name</th>
                                <th class="uk-width-1-10 uk-text-center">Status</th>
                                <th class="uk-width-2-10 uk-text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = '0';
                            if (!empty($result)) {

                                foreach ($result as $details) {
                                    $i += 1;
                                    ?>
                                    <tr>
                                        <td class="uk-text-center"><?php echo $i; ?></td>
                                        <td><?php echo wordwrap($details['org_name'], 25, "<br>", TRUE); ?></td>
                                        <td><?php echo $details['domain_name']; ?></td>
                                        <td class="uk-text-center">
                                            <?php if ($details['status'] == "1") { ?>
                                                <span class="uk-badge uk-badge-success">
                                                    Active
                                                </span> 
                                            <?php } else { ?>
                                                <span class="uk-badge uk-badge-danger2">
                                                    Inactive
                                                </span> 
                                            <?php } ?>
                                        </td>
                                        <td class="uk-text-center">
                                            <?php
                                                $this->load->helper('access');
                                            if(in_array('update',$roles)){ ?>
                                       <a href="<?php echo base_url();?>organization/edit/<?php echo $details['uuid']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>
                                        <?php } 
                                            
                                            if(in_array('delete',$roles)){ ?>
                                                <a onclick="UIkit.modal.confirm('Are you sure want to delete this Organization ?', function(){ 
                                                location.href='<?php echo base_url();?>organization/delete/<?php echo $details['uuid']; ?>' 
                                                })" title ="Delete" >
                                                <i class="md-icon material-icons">&#xE872;</i>
                                                </a>
                                             <?php   //echo '-NA-'; 
                                             } ?>
                                        </td>
                                    </tr>

    <?php }
} ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  

    </div>
</div>



