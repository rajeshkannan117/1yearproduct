<div id="page_content">
    <div id="page_content_inner" class="padding-zero">
    	<!-- circular charts -->
            <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3 uk-text-center uk-sortable sortable-handler" id="dashboard_sortable_cards" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content blue-border">
                            <div class="epc_chart" data-percent="<?php echo $forms; ?>" data-bar-color="#03a9f4">
                                    <a href="<?php echo base_url().'form' ;?>">
                                        <span class="epc_chart_icon">
                                            <i class="dash-form-icon"></i>
                                        </span>
                                    </a>
                            </div>
                        </div>
                        <div class="md-card-overlay-content blue-bg">
                            <div class="uk-clearfix md-card-overlay-header">
                                <h3 style="width:80%">
                                    <?php echo $this->lang->line('forms'); ?>
                                </h3>
                                <span class="num-count" ><?php echo $forms; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content green-border ">
                            
                            <div class="epc_chart" data-percent="<?php echo $users; ?>" data-bar-color="#009688">
                                 <a href="<?php echo base_url().'users' ?>">
                                    <span class="epc_chart_icon">
                                        <i class="material-icons align_users">&#xE7FE;</i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="md-card-overlay-content green-bg">
                            <div class="uk-clearfix md-card-overlay-header">
                                <h3 style="width:80%">
                                    <?php echo $this->lang->line('users'); ?>
                                </h3>
                                <span class="num-count" ><?php echo $users; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content gray-border ">
                            
                            <div class="epc_chart" data-percent="<?php echo $submission ?>" data-bar-color="#607d8b">
                                <a href="<?php echo base_url().'form' ?>">
                                    <span class="epc_chart_icon">
                                        <i class="dash-formsubmit-icon"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="md-card-overlay-content gray-bg">
                            <div class="uk-clearfix md-card-overlay-header">
                                <h3 style="width:80%">
                                    <?php echo $this->lang->line('form_submission'); ?>
                                </h3>
                                <span class="num-count" ><?php echo $submission; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<!-- tasks -->
        <div class="uk-grid margin-top" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
            <?php if(!empty($alerts)){ ?>
            <div class="uk-width-1-1">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-overflow-container">
                            <table class="uk-table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="uk-width-3-10"><?php echo $this->lang->line('alerts'); ?></th>
                                    <th class="uk-width-3-10"><?php echo $this->lang->line('name'); ?></th>
                                    <th class="uk-width-2-10"><?php echo $this->lang->line('created_by'); ?></th>
                                    <th class="uk-width-2-10"><?php echo $this->lang->line('status'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($alerts as $alert) {
                                    ?>
                                    <tr id="alert-row<?php echo $alert['id']; ?>">
                                        <td class="uk-width-3-10">
                                            <!-- /<?php echo $alert['id']; ?> -->
                                            <a href="<?php echo base_url() .'alert/alert/'.$alert['id'] ?>">
                                                <?php echo $alert["title"]; ?>
                                            </a>
                                        </td>
                                        <td class="uk-width-3-10"><?php echo $alert["name"]; ?></td>
                                        <td class="uk-width-2-10"><?php echo $alert["name"]; ?></td>
                                        <td class="uk-width-2-10">
                                            <?php if($alert["status"] == '1') { ?>
                                                <a href="<?php echo base_url().'alert/alert/'.$alert['id'] ?>">
                                            <span class="uk-badge uk-badge-warning">Pending</span>
                                                </a>
                                           <?php } else { ?>
                                                <span class="uk-badge uk-badge-success">Closed</span>
                                          <?php  } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>    


