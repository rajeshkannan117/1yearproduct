    <div id="page_content">
        <div id="page_content_inner">
                 <h3 class="heading_b uk-margin-bottom">Permission List</h3> 
                 <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                    <div class="uk-alert uk-alert-success" data-uk-alert="">
                        <a href="#" class="uk-alert-close uk-close"></a>
                        <?php echo $this->session->flashdata('SucMessage');  ?>
                    </div> 
                <?php } ?> 
                
                
        <div class="md-card uk-margin-medium-bottom">
             <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <div class="uk-grid">
                             <div class="uk-width-1-2">
                             </div>
                            <div class="uk-width-1-2">
                                    <a class="md-btn md-btn-primary" href="<?php echo base_url().'permission/add'?>">Add</a>
                            </div>
                        </div>
                        <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">S.no</th>
                                <th class="uk-width-2-10">Permission Name</th>
                                <th class="uk-width-3-10">Permission Description</th>
                                <th class="uk-width-1-10 uk-text-center">Status</th>
                                <th class="uk-width-2-10 uk-text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                                <?php $i='0';
                                //print_r($result); exit;
                                if(count($result) >= 1){                                
                                foreach($result as $key=>$details) { 
                                $i += 1;
                                ?>
                                <tr>
                                    <td class="uk-text-center"><?php echo $i; ?></td>
                                    <td><?php echo $details['permission_name']; ?>
                                    </td>
                                    <td><?php echo trim($details['permission_desc']); ?></td>
                                    <td class="uk-text-center">
                                        <?php if($details['status'] == "1"){ ?><span class="uk-badge">Active</span> <?php } ?>
                                        <?php if($details['status'] == "0"){ ?><span class="uk-badge">Inactive</span> <?php } ?>
                                    </td>
                                    <td class="uk-text-center">
                                        <a href="<?php echo base_url();?>permission/edit/<?php echo $details['permission_id']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>
                                        <a href="<?php echo base_url();?>permission/delete/<?php echo $details['permission_id']; ?>" onclick="return confirm('Are you sure, you want to delete this Permission?')"><i class="md-icon material-icons">&#xE872;</i></a>
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