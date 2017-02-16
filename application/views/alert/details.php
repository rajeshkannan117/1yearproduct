<div class="md-card-content uk-overflow-container">
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-2-4">
            <h3 class="heading_a"><?php echo $this->lang->line('issue_details'); ?></h3>
            
        </div>
        <?php 
            if ($alert['status'] == '1' && in_array($user_id,$alert['reporting_authority'])) { ?>
            <div class="uk-width-medium-1-4">
                <a class="md-btn md-btn-danger"
                   href="<?php echo base_url() . "alert/close/" . $alert['alert_id'] ?>"><?php echo $this->lang->line('close'); ?></a>
            </div>
            
        <?php } else {?>
        	<div class="uk-width-medium-1-4">
            
            </div>
        <?php } ?>
        <div class="uk-width-medium-1-4 close-button" style=""><a href="#" class="close-alert">x</a></div>
    </div>
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-2-2">
            <div class="uk-form-row">
                <label><?php echo $this->lang->line('title'); ?></label>
                <input type="text" value="<?php echo $alert["title"]; ?>" class="md-input" disabled/>
            </div>
            <div class="uk-form-row">
                <label><?php echo $this->lang->line('description'); ?></label>
                <textarea cols="30" disabled rows="4" class="md-input"><?php echo $alert["description"]; ?></textarea>
            </div>
            <div class="uk-form-row">
                <label><?php echo $this->lang->line('job_site'); ?></label>
                <input type="text" value="<?php echo $alert["job_site"]; ?>" class="md-input" disabled/>
            </div>
            <div class="uk-form-row">
                <label><?php echo $this->lang->line('created_by'); ?></label>
                <input type="text" value="<?php echo $alert["name"]; ?>" class="md-input" disabled/>
            </div>
            <div class="uk-form-row">
                <label><?php echo $this->lang->line('created_at'); ?></label>
                <input type="text" value="<?php echo $alert["created_at"]; ?>" class="md-input" disabled/>
            </div>
            <div class="uk-form-row">
                <label><?php echo $this->lang->line('status'); ?></label>
                <input type="text" value="<?php if ($alert["status"] == '1') {
                    echo $this->lang->line('pending');
                } else {
                    echo $this->lang->line('closed');
                } ?>" class="md-input" disabled/>
            </div>
            <div class="uk-form-row">
                <label><?php echo $this->lang->line('reporting-to'); ?></label>
                <select name="reporting_to" id="reporting_to" multiple disabled>
                    <?php
                    foreach ($alert['reporting_to'] as $report) {
                        ?>
                        <option selected value="<?php echo $report['id']; ?>"><?php echo $report['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <?php if (count($alert['images']) > 0) { ?>
                <div class="uk-form-row">
                    <label><?php echo $this->lang->line('attachments'); ?></label>
                </div>
                <?php
                foreach ($alert['images'] as $image) { ?>
                    <div class="uk-form-row">
                        <img src="<?php echo $image; ?>" alt="">
                    </div>
                <?php }
                ?>
            <?php } ?>
            <div class="uk-from-row">
                <label><?php echo $this->lang->line('comments'); ?></label>
                <div class="md-card md-card-single">
                    <!--<div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text large">
                                <?php /*echo $this->lang->line('comments'); */ ?>
                            </h3>
                        </div>-->
                    <div class="md-card-content padding-reset" style="height: 274px;">
                        <div class="chat_box_wrapper">
                            <div class="chat_box touchscroll chat_box_colors_a" id="chat">
                                <?php
                                foreach ($alert['comment'] as $comment) {
                                    ?>
                                    <div class="chat_message_wrapper <?php if ($user_id == $comment['user_id']) {
                                        echo "chat_message_right";
                                    } ?> ">
                                        <div class="chat_user_avatar">
                                            <img class="md-user-image" src="<?php echo $comment['profile'] ?>" alt="" />
                                        </div>
                                        <ul class="chat_message">
                                            <li>
                                                <p><?php //if ($user_id != $comment['user_id']) {
                                                        echo $comment['name'];
                                                    //} ?> <br/>
                                                        &nbsp;&nbsp;&nbsp;<?php echo $comment['comment']; ?>
                                                    <span class="chat_message_time" id="message_time" style="text-transform: none;"><?php echo $comment['created_at']; ?></span>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                                //echo $user_id;
                                if((in_array($user_id,$alert['reporting_authority'])) || ($user_id === $alert['alert_owner'])){ ?>
                            <div class="chat_submit_box" id="chat_submit_box">
                                <!-- <?php echo base_url() . 'alert/create'; ?> method="post"  -->
                                <form id="comments_alert">
                                    <div class="uk-input-group">
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-input" name="submit_message"
                                                   id="submit_message" placeholder="Send message" onkeypress="return comments(event,this);">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <input type="hidden" name="alert_id"
                                                   value="<?php echo $alert['alert_id']; ?>">
                                            <span class="md-input-bar"></span>
                                        </div>
                                        
                                        <span class="uk-input-group-addon">
                                            <input type="button" class="md-btn md-btn-success" onclick="insertComments()" value="<?php echo $this->lang->line('comment'); ?>"/>
                                        </span>
                                      
                                    </div>
                                </form>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#reporting_to').kendoMultiSelect({});
		$('.close-alert').on('click',function() {
			$("#detail-container").css('display','none');
			$(".containers").empty();
			$(".md-card-content").find('.uk-width-6-10').removeClass().addClass('uk-width-10-10');
		});
        
    })
    function insertComments() {
        $.ajax({
            type: "post",
            url: baseURL + "alert/create",
            data:$( "#comments_alert" ).serialize(),
            dataType: "html",
            success: function(data)
            {
                $('#chat').append(data);
                $("#submit_message").val('');
            }
        });
        }
    function comments(e,current){
        if (e.keyCode == 13) {
            $.ajax({
                type: "post",
                url: baseURL + "alert/create",
                data:$( "#comments_alert" ).serialize(),
                dataType: "html",
                success: function(data)
                {
                    $('#chat').append(data);
                    
                }
            });
            $("#submit_message").val('');            
            return false;
        }
    }
</script>