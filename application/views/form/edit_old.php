<?php	
$CI = & get_instance(); 
$CI->load->library('templates');
$datas = json_decode($details->form_content);
?>
<style>
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
    .content{
        padding-left: 0px !important;
    }
</style>
<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid" style="display: block;padding-left:0px !important"; data-uk-grid-margin data-uk-grid-match id="wizard_forms">
        <div class="uk-width-large-2-10"  id="sidebar" style="float: left;">
            <div class="uk-width-1-1">
                <div class="parsley-row">
                    <div class="md-card  form-desc ">
                        <label class="fn">Name your form<span class="req">*</span></label>
                        <input type="text" class="md-input fn-field" id="form_name" name="form_name" value="" data-parsley-trigger="change" required value="<?php echo $details->form_name; ?>" />
                        <label class="fd">Short description about your form </label>
                        <textarea name="form_desc"  class="md-input" id="form_desc" style=""><?php echo $details->form_desc; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="md-card dragdrop-panel">
                <div class="md-card-content">
                   <div class="uk-panel">
                        <div class="heading">Drag and drop for build new form</div>
                        <div class="uk-accordion" data-uk-accordion>
                            <h3 class="uk-accordion-title uk-accordion-title-primary">Basic</h3>
                            <div class="uk-accordion-content">
                                <ul id="basic">
                                    <li><div class="singleline-icon" ></div><span value="heading">Heading</span></li>
                                    <li><div class="singleline-icon" ></div><span value="text">Single Line Text</span></li>
                                    <li><div class="email-icon"></div><span value="email">Email</span></li>
                                    <li><div class="multiline-icon"></div><span value="textarea">Multi Line Text</span></li>
                                    <li><div class="multiline-icon"></div><span value="number">Number</span></li>
                                    <li><div class="radio-icon"></div><span value="radio">Radio</span></li>
                                    <li><div class="select-icon"></div><span value="select">Select</span></li>
                                    <li><div class="checkbox-icon"></div><span value="checkbox">Checkbox</span></li>
                                    <li><div class="date-icon"></div><span value="date">Date</span></li>
                                    <li><div class="time-icon"></div><span value="time">Time</span></li>
                                    <li><div class="file-icon"></div><span value="file">File</span></li>
                                    <!--<li><span value="reset">Reset</span></li>
                                    <li><span value="submit">Submit</span></li>-->
                                </ul>
                            </div>
                            <!--<h3 class="uk-accordion-title uk-accordion-title-primary">Group</h3>
                            <div class="uk-accordion-content">
                                <ul id="group">
                                    <li><span value="name">Name</span></li>
                                    <li><span value="address">Address</span></li>
                                </ul>
                            </div>-->
                            <h3 class="uk-accordion-title uk-accordion-title-primary">Advanced</h3>
                            <div class="uk-accordion-content">
                                <ul id="advanced">
                                    <li><div class="sign-icon"></div><span value="signature">Signature</span></li>
                                    <!--<li>
                                        <span value="placepicker">Place Picker</span>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="uk-width-large-8-10"  id="content_right" style="float:left;height: 520px;padding-left:12px;">
            <div class="md-card">
                <div class="md-card-content" style="">
                    <div id="forms" data-form_id ="1" style="width:100%;height: 550px;">
                            <ul id="pages" style="height: 520px;overflow-y: scroll;">
                               <?php foreach($datas->fields as $p=>$pages){ 
                                    foreach($pages as $r=>$rows){ 
                                        $r++;
                                        $column_count = count($rows);
                                    ?>
                                    <li class="rows uk-width-1-1" id="rows_<?php echo $r; ?>">
                                        <ul id="rows_<?php echo $r; ?>" class="connected">
                                            <?php foreach($rows as $c=>$columns) {
                                                    $c++;
                                            ?>
                                            <li class="uk-width-1-<?php echo $column_count;?> columns" id="columns_<?php echo $r; ?>">
                                                <div class="cols uk-width-1-1"> 
                                                    <?php echo $CI->templates->generate($columns); ?>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php } 
                                } ?>
                            </ul>
                    </div>
                </div>
                <div class="buildform">
                     <a class="publish">Build this form </a>
                </div>
            </div>                     
        </div>
        <form class="uk-form-stacked" id="wizard_advanced_form" method="post" action ="">
            <input type="hidden" name="formToken" class="form_token" value ="" />
            <input type="hidden" name="form_name" class="form_name" value = " "/>
            <input type="hidden" name="form_desc" class="form_desc" value = " "/>
            <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
        </form>
        <?php $this->load->view('form/template'); ?>
    </div>
</div>