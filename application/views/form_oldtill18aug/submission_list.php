<?php //print_r($contents); ?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/assets/js/custom_localtime.js"></script>
 <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom"><?php echo $contents[0]['form_name']; ?>  </h3>
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
                                <!--<?php if(in_array('create',$roles)){ ?>
                                    <a class="md-btn md-btn-primary" href="<?php echo base_url().'form/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                        <img src="<?php echo base_url(); ?>assets/assets/img/add_circle_white_48dp.png" style="width:40px;" />
                                    </a>
                                <?php } ?>-->
                                <a href="<?php echo base_url().'form'?>" class="md-btn md-btn-primary">
                                    Back to form list
                                </a>
                            </div>
                        </div>
                     <table class="uk-table" id="dt_formsubmission">
                        <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">#</th>
                                <th class="uk-width-2-10">Form Submission Id</th>
                                <th class="uk-width-2-10">Submitted By</th>
                                <th class="uk-width-2-10">Submitted On</th>
                                <!--<th class="uk-width-1-10 uk-text-center">Description</th>
                                <th class="uk-width-1-10 uk-text-center">Status</th>-->
                                <th class="uk-width-1-10 uk-text-center" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i='0'; 
                                $this->load->helper('access');
                               // print_r($list); exit;
                                foreach($contents as $key=>$value){
                                    $i += 1;
                             ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value['id']; ?></td>
                                    <td><?php echo $value['submitted_by']; ?></td>
                                    <td id="time_<?php echo $i; ?>">
                                    <script>
                                    get_local_date_js("<?php echo $value['created_at'] ?>",'time_<?php echo $i; ?>');
                                    //document.getElementById('time').innerHTML = time;
                                    </script>
                                    </td>
                                    
                                    <td class="uk-text-center">
                                        <a href="<?php echo base_url().'form/submission_view/'.$value['id']; ?>">
                                            <i class="md-icon material-icons">&#xE8F4;</i>
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
