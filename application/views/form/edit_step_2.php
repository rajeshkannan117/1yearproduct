<?php	
$CI = & get_instance(); 
$CI->load->library('template');
?>
<div id="page_content">
    <div id="page_content_inner">

        <h3 class="heading_b uk-margin-bottom">Edit Form</h3>

        <div class="md-card" style="min-height:600px;">
            <div class="md-card-content large-padding">
            <!--<input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />-->
                <!--<div class="uk-grid">-->
                    <aside style="width: 180px;float: left;">
                                <div class="uk-width-1-1">
                            <div class="uk-panel">
                                <ul id="add">
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
                <!--</div>-->
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                            	<span class="errors" style="color:crimson;">
                                    
                            	</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-3">
                        <a href="javascript:void(0);" class="valid_field md-btn md-btn-primary">
                            <span class="aButtonText">Build form</span> 
                        </a>
                    </div>
                  <!--<form method="post" name="saveForm" action="<?php echo base_url().'form/saveform' ?>">
                     <input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />
                            <input type ="submit" class="md-btn md-btn-primary" name="saveform" value="Publish" />
                  </form>-->
                    <div class="uk-width-1-3 preview show">
                        <a href="<?php echo base_url().'form/preview/'.$form_id;?>" class="md-btn md-btn-primary">
                            <span class="aButtonText">Preview</span> 
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
                    <?php if(count($content) > 0){ ?>
                    <table style="width:100%" class="forms" data-form_id="<?php echo $form_id; ?>">
                        <tr>
                            <td>
                                <?php foreach($content->fields as $p=>$rows){ ?>
                                   <table id="pages">
                                        <tr class="hidden">
                                            <td class="uk-width-1-3 config" id="config_0">
                                            </td>
                                            <td class="uk-width-1-3 config" id="config_1">
                                            </td>
                                            <td class="uk-width-1-3 config" id="config_2">
                                            </td>
                                            <td class="delete">
                                                <a class="deleteRows" href="javascript:void(0);">Delete Rows</a>
                                            </td>
                                        </tr>
                                        <?php foreach($rows as $r=>$cols) { ?>
                                        <tr class="row" id="row_<?php echo $r; ?>">
                                            <?php foreach($cols as $c=>$value){ ?>
                                                <td class="uk-width-1-3 config" id="config_<?php echo $c; ?>">
                                                    <?php  echo $CI->template->generate($value); ?>
                                                </td>
                                            <?php }  if($r != 0) { ?>
                                                <td class="delete">
                                                    <a class="deleteRows" onclick="var current = this;UIkit.modal.confirm('Are you sure, you want to delete this row?',function(){ 
                                                            var rowid = $(current).data('rowid'); $('#row_'+rowid+' td').each(function(){
                                                                type = $(this).find('div.portlet-content').attr('type');
                                                                var value = $(this).find('.'+type+'_datafieldId').val();
                                                                if(value !== undefined){
                                                                    $('.delete_fields').val($('.delete_fields').val()+','+value);
                                                                 }
                                                            });
                                                            $('#row_'+rowid).remove();
                                                            
                                                    });" data-rowid="<?php echo $r; ?>" href="javascript:void(0);">
                                                        Delete Rows
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                   </table>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <?php } else{ ?>
                     <table style="width:100%" class="forms" data-form_id="<?php echo $form_id; ?>">
                    <tr>
                        <td>
                            <table id="pages">
                                <tr class="hidden">
                                    <td class="uk-width-1-3 config">
                                    </td>
                                    <td class="uk-width-1-3 config">
                                    </td>
                                    <td class="uk-width-1-3 config">
                                    </td>
                                    <td class="delete">
                                        <a class="deleteRows" href="javascript:void(0);">Delete Rows</a>
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="uk-width-1-3 config" id="">
                                    </td>
                                    <td class="uk-width-1-3 config" id="">
                                    </td>
                                    <td class="uk-width-1-3 config" id="">
                                    </td>
                                </tr>
                            </table>
                            <!--<a href="#" class="addPages">Add Pages</a>-->
                        </td>
                    </tr>
                </table>
                    <?php } ?>
                    <input type="hidden" class="delete_fields" value="" />
                    <input type="hidden" class="delete_options" value="" />
                    <a href="javascript:void(0)" class="addRows">Add Rows</a>
                 </div>
		<?php $this->load->view('form/template'); ?>
            </div>
        </div>
    </div>
</div>