<?php
	$count = count($contents);
	if($count > 0){
		$content_val = $contents[0];
		$form_id = $content_val['form_id'];
		$content = json_decode($content_val['submission']);
		$CI =& get_instance();
		$CI->load->library('fields');
		$permission_access = $this->session->userdata('menu'); 
 ?>
 <div id="page_content">
    <div id="page_content_inner">
    	<h2 class="heading_b uk-margin-bottom"><?php //echo $formname.'-'.$formcode; ?> </h2>
        <div class="md-card">
            <div class="md-card-content large-padding">
            <h3 class="heading_b uk-margin-bottom"></h3>
				<form id="register" novalidate onsubmit="return validate()" method="post">
            		<div class="md-card-content large-padding">
				<?php foreach($content->fields as $p=>$pages): //print_r($fields);?>
				<div class="uk-grid">
					<?php $count_pages = count($pages);?>
					<div class="uk-width-1-<?php echo $count_pages;?>">
						<?php foreach($pages as $r=>$rows):?>
						<?php $count_rows = count($rows);?>
						<div class="uk-grid">
							<div class="uk-width-1-1">
								<?php //if($r == $count_rows-1){break;}?>
								<?php $count_cols = count(array_filter($rows));?>
								<div class="uk-grid">
								<?php  $i=1;
								foreach(array_filter($rows) as $c =>$cols): ?>
									<div class="uk-width-1-<?php echo $count_cols; ?>">
										<?php 
										if(is_object($cols)){ 
											if(!isset($cols->value)){
												$cols->value ='';
											}
										if($cols->type !== 'submit' && $cols->type !== 'reset'){	echo $CI->fields->generate($cols);
											}
										}
										?>
									</div>
								<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</form>	
		<a href="/form/submission_list/<?php echo $form_id; ?>" class="md-btn md-btn-primary" >Back to submission list</a>
	</div>
</div>
</div>
</div>
<?php } else { ?>
<div id="page_content">
    <div id="page_content_inner">
    	<h2 class="heading_b uk-margin-bottom"><?php //echo $formname.'-'.$formcode; ?> </h2>
        <div class="md-card">
            <div class="md-card-content large-padding">
	            <h3 class="heading_b uk-margin-bottom">Submission list </h3>
	            <?php echo 'No Form submission for the form';  ?><br/>
	            <div class="uk-grid">
	            	<div class="uk-width-1-1">
		            	<a href="/form" class="md-btn md-btn-primary" >
		            		Back to Form list
		            	</a>
		            </div>
	            </div>
        	</div>
    	</div>
	</div>
</div>
<?php } ?>
