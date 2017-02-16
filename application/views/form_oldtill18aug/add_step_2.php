<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Create Form</h3>
        <div class="md-card" style="min-height:600px;">
            <div class="md-card-content large-padding">
                <!--<input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />-->
                <div class="uk-grids">
                    <aside style="width: 180px;float: left;">
                        <div class="uk-width-1-1">
                            <div class="uk-panel">
                                <ul id="add" data-state="new" style="padding-left:0px;">
                                    <li><span value="heading">Heading</span></li>
                                    <li><span value="text">Text</span></li>
                                    <li><span value="email">Email</span></li>
                                    <li><span value="password">Password</span></li>
                                    <li><span value="textarea">Textarea</span></li>
                                    <li><span value="radio">Radio</span></li>
                                    <li><span value="select">Select</span></li>
                                    <li><span value="checkbox">Checkbox</span></li>
                                    <li><span value="date">Date</span></li>
                                    <li><span value="time">Time</span></li>
                                    <li><span value="signature">Signature</span></li>
                                    <!--<li><span value="file">File</span></li>
                                    <li><span value="hidden">Hidden</span></li>-->
                                    <li><span value="reset">Reset</span></li>
                                    <li><span value="submit">Submit</span></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
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
                <div class="uk-grid">
                <style>
                    td.config{
                        height: 100px;
                    }
                    .hidden{
                        display:none;
                    }
                    tr.row td{
                        border:1px solid #ccc;
                    }
                    tr.row td:nth-child(4n+4){
                        border:0px;
                    }
                </style>
                <table style="width:100%" class="forms" data-form_id="<?php echo $form_id; ?>">
                    <tr>
                        <td>
                            <table id="pages">
                                <tr class="hidden">
                                    <td class="uk-width-1-3 config" id="config_0">
                                    </td>
                                    <td class="uk-width-1-3 config" id="config_1">
                                    </td>
                                    <td class="uk-width-1-3 config" id="config_2">
                                    </td>
                                    <td class="delete">
                                        <a class="deleteRows" href="#">Delete Rows</a>
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="uk-width-1-3 config" id="config_0">
                                    </td>
                                    <td class="uk-width-1-3 config" id="config_1">
                                    </td>
                                    <td class="uk-width-1-3 config" id="config_2">
                                    </td>
                                </tr>
                            </table>
                            <!--<a href="#" class="addPages">Add Pages</a>-->
                        </td>
                    </tr>
                </table>
                <a href="#" class="addRows">Add Rows</a>
                <!--<ul id="pages" style="background-repeat: repeat-x;border-color: #9acfea;min-height: 100px;">
                    <li class="sortable columns">
                        <div class="uk-grid">
                            <div class="config uk-width-1-3" id="config_0">
                            </div>
                            <div class="config uk-width-1-3" id="config_1">
                            </div>
                            <div class="config uk-width-1-3" id="config_2">
                            </div>
                        </div>
                    </li>
                </ul>-->
                <?php $this->load->view('form/template'); ?>
            </div>
            </div>
	</div>
    </div>
</div>