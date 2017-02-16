<div id="page_content">
    <div id="page_content_inner" style="padding:0 0px">
        <!-- <h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('alerts'); ?></h3> -->
        <?php if ($this->session->flashdata('SucMessage') != '') { ?>
            <div class="uk-alert uk-alert-success" data-uk-alert="">
                <a href="#" class="uk-alert-close uk-close"></a>
                <?php echo $this->session->flashdata('SucMessage'); ?>
            </div>
        <?php } ?>
        <div class="uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="uk-grid alert-list">
                    <div class="uk-width-10-10">
                        <table id="dt_default" class="uk-table" cellspacing="0" width="96%">
                            <thead>

                            <tr>
                                <th class="uk-width-1-10 uk-text-center">#</th>
                                <th class="uk-width-2-10 uk-text-center"><?php echo $this->lang->line('alerts'); ?></th>
                                <th class="uk-width-2-10 uk-text-center"><?php echo $this->lang->line('name'); ?></th>
                                <th class="uk-width-1-10 uk-text-center"><?php echo $this->lang->line('status'); ?></th>
                                <th class="uk-width-1-10 uk-text-center"><?php echo $this->lang->line('action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            foreach ($alerts as $alert) {
                                $i++;
                                ?>
                                <tr id="alert-row<?php echo $alert['id']; ?>">
                                    <td class="uk-width-1-10 uk-text-center"><?php echo $i; ?></td>
                                    <td class="uk-width-2-10 uk-text-center"><?php echo $alert["title"]; ?></td>
                                    <td class="uk-width-2-10 uk-text-center"><?php echo $alert["name"]; ?></td>
                                    <td class="uk-width-1-10 uk-text-center"><?php if($alert["status"] == '1') { ?>
                                            <span class="uk-badge uk-badge-warning">Pending</span>
                                        <?php } else { ?>
                                            <span class="uk-badge uk-badge-success">Closed</span>
                                        <?php  } ?></td>
                                    <td class="uk-width-1-10 uk-text-center">
                                        <a onclick="getAlertDetails('<?php echo $alert['id']; ?>')">
                                            <i class="material-icons dp48">visibility</i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                   <div class="uk-width-4-10" id="detail-container" style="display: none">
                         <div class="dt-uikit-header" style="" ></div>
                        <div class="containers" style="" ></div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(window).load(function(){
       <?php if(isset($alertid)) { ?>
            getAlertDetails('<?php echo $alertid; ?>');
			
       <?php } ?>
    });
    function getAlertDetails(alertId) {
		
       
        $.ajax({
            type: "get",
            url: baseURL + "alert/view/"+alertId,
            beforeSend: function() {
                //$('#detail-container').append('<div class="content-preloaders"><img src="'+baseURL+'/assets/assets/img/spinners/spinner.gif" alt="" width="32" height="32"></div>');
            },
            dataType: "html",
            success: function(data)
            {

                $('.containers').html(data);

            },
			complete: function(){
				$("#dt_default_wrapper").parent().removeClass('uk-width-10-10').addClass('uk-width-6-10');
				
			}
        });
	setTimeout(function(){$("#detail-container").css('display','block')}, 1000);
    }
</script>