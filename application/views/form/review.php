<?php
    $content = json_decode($contents);
    //$this->load->library('fields');
    $CI =& get_instance();
    $CI->load->library('review');
    $permission_access = $this->session->userdata('menu'); 
 ?>
 <style>
        #pages{
            padding-left:0px;
        }
      li.rows{
            min-height:80px;
        }
        li.columns{
            float:left;
            height:75px;
            list-style: none;
        }
        li.highlight{
            min-height: 70px;
        }   
        h5{
            font-weight: 300;
        }
 </style>
<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid">
            <div class="uk-width-1-2">
                <a class="md-btn md-btn-primary" style="float:left" href="<?php echo base_url() ?>form/reviews">
                    Back to form
                </a> 
                <input type="hidden" id="name" value="<?php echo $name; ?>" />
            </div>
        </div>
        <div class="md-card">
            <div class="md-card-content large-padding">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-2">
                    <h2 class="heading_b uk-margin-bottom"><?php echo $formname; ?></h2>
                </div>
            </div>
                <form action ="<?php echo base_url() ?>form/review_submission" method="post" id="formreview" name = "review">
                    <?php
                        $row = 0;
                        foreach($content->fields as $p=>$pages){  
                            $i = 0;
                            $row++;
                            $row_count = count($pages);
                            foreach($pages as $r=>$rows){ 
                                $count = count($rows);
                                $i++;
                            ?>
                            <div class="uk-grid">
                            <?php
                                $col = 0;
                                foreach($rows as $c=>$cols){ 
                                    $col++;
                            ?>
                                <div class="uk-width-1-<?php echo $count; ?>">
                            <?php 
                                if($cols->type !== 'reset' && $cols->type !== 'submit'){
                                    echo $CI->review->generate($cols,$comments,$submission_data); 
                                }
                            ?>
                                </div>
                            <?php } ?>
                            </div>
                            <?php } ?>
                    <?php } ?>
                    <input type="hidden" name="action" id="action" />
                    <input type="hidden" name="submission_id" id="submission_id" value="<?php echo $submission_id; ?>" />
                </form>
                <?php if($status === '0') { ?>
                <div class="uk-grid" data-uk-grid-margin style="text-align:center" >
                    <div class="uk-width-1-1 uk-center">
                        <div class="buildform">
                            <input type="button" class="md-btn md-btn-success" name="accepted" value="Accepted" onclick = "document.getElementById('action').value = this.value;
                                        document.getElementById('formreview').submit();" />
                            <input type="button" class="md-btn md-btn-warning" name="reassigned" value="Reassigned" onclick = "reassign(this);" />
                            <input type="button" class="md-btn md-btn-danger" name="rejected" value="Rejected" onclick = "document.getElementById('action').value = this.value;
                                        document.getElementById('formreview').submit();" />
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <button class="md-btn" id="reassign" data-uk-modal="{target:'#modal_reassign'}" style="display:none;"></button>
            <div class="uk-modal"  id="modal_reassign" aria-hidden="true" style="display: none; overflow-y: scroll;">
                <div class="uk-modal-dialog" style="top: 46.5px;">
                    <div class="uk-modal-header">
                        <h3 class="uk-modal-title">Reassign</h3>
                    </div>
                    <div class="uk-content">
                        <div id="desc">
                            <label>Reassign Description </label>
                            <textarea name="reassign_desc"  class="md-input" id="reassign_desc" style=""></textarea>
                        </div>
                        <div id="reassign_users">
                        </div>
                    </div>
                    <div class="uk-modal-footer uk-text-right">
                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                        <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="reassign_submit(this)">Reassign</button>
                    </div>
                </div>
                <div id="scripts">
                </div>
            </div>
            <button class="md-btn" id="declined" data-uk-modal="{target:'#modal_declined'}" style="display:none;"></button>
            <div class="uk-modal"  id="modal_declined" aria-hidden="true" style="display: none; overflow-y: scroll;">
                <div class="uk-modal-dialog" style="top: 46.5px;">
                    <div class="uk-modal-header">
                        <h3 class="uk-modal-title">Declined</h3>
                    </div>
                    <div class="uk-content">
                        <div id="desc">
                            <label>Declined Description </label>
                            <textarea name="decline_desc"  class="md-input" id="decline_desc" style=""></textarea>
                        </div>
                        <div id="decline_users">
                        </div>
                    </div>
                    <div class="uk-modal-footer uk-text-right">
                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                        <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="reassign_submit(this)">Reassign</button>
                    </div>
                </div>
                <div id="scripts">
                </div>
            </div>
        </div>
    </div>
</div>

