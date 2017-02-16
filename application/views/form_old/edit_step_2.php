<?php	
$CI = & get_instance(); 
$CI->load->library('template');
?>
<div id="page_content">
    <div id="page_content_inner">

        <h3 class="heading_b uk-margin-bottom">Edit Form</h3>

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
                                    1.Before publish the form  Please click Build the Form button
                                    
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
                  <form method="post" name="saveForm" action="<?php echo base_url().'form/saveform' ?>">
                     <input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />
                            <input type ="submit" class="md-btn md-btn-primary" name="saveform" value="Publish" />
                  </form>
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
                <?php //print_r($content); exit;
               // $contents = json_decode($content);
                foreach($content as $p=>$pages){ 
                        $no_pages = count($pages);
                                        foreach($pages as $r=>$rows){
                                                 $no_rows = count($rows);
                                        }
                                }
                                       // echo $no_rows;
                                        
				?>

                <ul id="pages">
                    <li>
                        <div class="uk-grid">
                            <?php 
                                $k=0;
                                for($i=0;$i<$columns;$i++){ 
                            ?>
                            <div class="uk-width-1-<?php echo $columns; ?>">
                                <ul class="config columns md-list md-list-addon uk-sortable sortable-handler" id="config_<?php echo $i; ?>" data-uk-sortable="{group:'connected-group'}">
                                <?php for($rows =0;$rows<$no_rows;$rows++){
                                        //echo $content->fields;
                                        if(isset($content->fields[0][$rows][$i])){
                                            if(!isset($content->fields[0][$rows][$i]->value)){
                                                $content->fields[0][$rows][$i]->value ='';
                                            }
                                            if(!isset($content->fields[0][$rows][$i]->rules)){
                                                $content->fields[0][$rows][$i]->rules ='';
                                            }
                                            echo $CI->template->generate($content->fields[0][$rows][$i]);
                                        }
                                    } ?>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
				<?php
					/*foreach($content->fields as $p=>$pages){ 
						foreach($pages as $r=>$rows){
							foreach($rows as $c=>$columns){
								
								/*echo '<script type="text/javascript">
										$("ul#config_'.$c.').append(\"'.$res.'\");
								</script>'
							}
						} 
					}*/
					?>
				<?php $this->load->view('form/template'); ?>
            </div>
        </div>
    </div>
</div>