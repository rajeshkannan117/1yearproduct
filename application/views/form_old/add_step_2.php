<?php
    
?>
<div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Create Form</h3>

            <div class="md-card">
                <div class="md-card-content large-padding">
					<input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />
					<div class="uk-grid">
						<div class="uk-width-1-1">
                            <div class="uk-panel">
                                <ul id="add">
                                    <li><span value="text">Input text</span></li>
                                    <li><span value="radio">Radio</span></li>
                                    <!--<li><span value="checkbox">Checkbox</span></li>-->
                                    <li><span value="select">Select</span></li>
                                    <li><span value="textarea">Textarea</span></li>
                                    <li><span value="password">Password</span></li>
                                    <!--<li><span value="file">File</span></li>
                                    <li><span value="hidden">Hidden</span></li>-->
                                    <li><span value="reset">Reset</span></li>
                                    <li><span value="submit">Submit</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <span class="errors" style="color:crimson;">
                                            Note : Please Click controls to draw the form
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                            <div class="uk-width-1-2">
                                <a href="javascript:void(0);" class="aButton valid_field md-btn md-btn-primary">
                                    <span class="aButtonText">Build form</span> 
                                    <span class="aButtonIcon"><span></span></span>
                                </a>
                            </div>
                            <div class="uk-width-1-2 preview hide">
                               <a href="<?php echo base_url().'form/preview/'.$form_id;?>" class="md-btn md-btn-primary">
                                <span class="aButtonText">Preview</span> 
                                <span class="aButtonIcon"><span></span></span>
                            </a>
                            </div>
                            <div class="uk-width-1-3"> 
                                 <a href="<?php echo base_url().'form';?>" class="md-btn md-btn-danger">
                                    <span class="aButtonText">Cancel</span> 
                                </a>
                            </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="form_error">
                                
                            </div>
                        </div>
                    </div>
                    <ul id="pages">
                            <li>
                                    <div class="uk-grid">
                                    <?php for($i=0;$i<$columns;$i++){ ?>
                                            <div class="uk-width-1-<?php echo $columns ; ?>">
                                                    <ul class="config columns md-list md-list-addon uk-sortable sortable-handler" id="config_<?php echo $i; ?>" data-uk-sortable="{group:'connected-group'}">
                                                    </ul>
                                            </div>
                                    <?php } ?>
                                    </div>
                            </li>
                    </ul>
                    <?php $this->load->view('form/template'); ?>
                </div>
	</div>
    </div>
</div>