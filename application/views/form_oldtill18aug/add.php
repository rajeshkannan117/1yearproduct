 <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Create a New Form</h3>

            <div class="md-card">
                <div class="md-card-content large-padding">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <div class="uk-panel">
                                        <ul id="add">

                                            <li><span value="text">Input text</span></li>

                                            <li><span value="radio">Radio</span></li>

                                            <li><span value="checkbox">Checkbox</span></li>

                                            <li><span value="select">Select</span></li>

                                            <li><span value="textarea">Textarea</span></li>

                                            <li><span value="password">Password</span></li>

                                            <li><span value="file">File</span></li>

                                            <li><span value="hidden">Hidden</span></li>

                                            <li><span value="reset">Reset</span></li>

                                            <li><span value="submit">Submit</span></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <a href="javascript:void(0);" class="aButton valid_field uk-button uk-button-primary">
                                        <span class="aButtonText">Build form</span> 
                                        <span class="aButtonIcon"><span></span></span>
                                    </a>
                                </div>
                                <div class="uk-width-1-2">
                                    <a href="javascript:void(0);" class="aButton view_form btn btn-default fancybox" style="visibility:hidden">
                                        <span class="aButtonText">View Form</span> 
                                        <span class="aButtonIcon"><span></span></span>
                                    </a>
                                </div>
                                <!--<div class="uk-width-1-3">
                                    <a href="#" class="aButton generate_json btn btn-default fancybox" style="visibility:hidden">
                                        <span class="aButtonText">Generate JSON</span> 
                                        <span class="aButtonIcon"><span></span></span>
                                    </a>
                                </div>-->
                            </div>
                         </div>
                         <div class="uk-width-1-1">
                             <div class="uk-grid">
                                <div class="uk-width-1-1">
                                     <div class="uk-grid">
                                        <div class="uk-width-medium-1-2">
                                                <div class="form_name form-group">
                                                    <label>Form Name<span class="error">*</span></label>
                                                    <input type="text" class="form_name md-input" id="form_name" name="form_name"/>
                                                    <input type="hidden" name="form_id" class="form_id" id="form_id" value="0"/>
                                                    <input type="hidden" name ="action" class="action" value="<?php echo site_url('saveForm'); ?>" />
                                                </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="form_desc form-group">
                                                <label>Form Description</label>
                                                    <textarea id="form_desc" name="form_desc" rows="2" cols="20" style="" class="md-input"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="uk-width-1-1">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-2">
                                            <div class="form_desc form-group">
                                                <label>Select Categories</label>
                                                <select name="categories" id="categories" class="md-input">
                                                    <?php foreach($categories as $key=>$value){ ?>

                                                        <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="form_desc form-group">
                                                <label>Select User</label>
                                                 <select name="userassign" id="users" class="md-input">

                                                    <?php foreach($user as $key=>$value) { ?>

                                                        <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>

                                                     <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             <!--<div class="uk-width-1-1">
                                <div class="form-group">
                                        <label>No Of Rows </label>
                                        <input type="text" class="form_rows" id="form_rows" name="form_rows"/>
                                </div>
                                <input type="button" class="uk-button set_rows" value="Assign" />
                             </div>-->
                            <ul id="pages">
                                <li>
                             <div class="uk-width-1-2 left" style="float:left">
                                <ul class="md-list md-list-addon uk-sortable sortable-handler" id="config" data-uk-sortable="{group:'connected-group'}">
                                </ul>
                             </div>
                             <div class="uk-width-1-2 right" style="float:left">
                                <ul class="md-list md-list-addon uk-sortable sortable-handler" id="config1" data-uk-sortable="{group:'connected-group'}">
                                </ul>
                             </div>
                                </li>
                            </ul>
                             <!--<div class="uk-width-1-1">  
                             <ul class="uk-grid sortable" data-uk-sortable id="config">
                                
                             </ul>
                            </div>-->
                             <?php $this->load->view('form/template'); ?>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>