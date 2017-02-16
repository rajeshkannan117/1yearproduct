<div id="page_content">
    <div id="page_content_inner">
    		
       <h3 class="heading_b uk-margin-bottom"> Job Titles </h3> 
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
                        <div class="uk-width-1-2 uk-text-right">
                         <?php if(in_array('create',$location)){?>
                               <a class="md-btn md-btn-primary" href="<?php echo base_url().'location/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                <img src="<?php echo base_url(); ?>/assets/assets/img/add_circle_white_48dp.png" style="width:40px;" />
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                     <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="uk-width-1-10 uk-text-center">#</th>
                            <th class="uk-width-2-10">Location Id</th>
                            <th class="uk-width-2-10">Location Name</th>
                            <th class="uk-width-2-10">City</th>
                            <th class="uk-width-2-10">State</th>
                            <th class="uk-width-2-10">Country</th>
                            <th class="uk-width-1-10 uk-text-center">Status</th>
                            <th class="uk-width-2-10 uk-text-center">Actions</th>
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
                                    <?php if(in_array('update',$location)){ ?>
                                   <!-- <a href="<?php echo base_url();?>users/edit/<?php echo $details['id']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>-->
                                    <?php //} ?> <?php if(in_array('delete',$location)){ ?>
                                    <a href="<?php echo base_url();?>users/delete/<?php echo $details['id']; ?>" onclick="return confirm('Are you sure, you want to delete this User?')"><i class="md-icon material-icons">&#xE872;</i></a>
                                    <?php } ?>
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
