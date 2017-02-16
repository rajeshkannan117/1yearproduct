<?php
	$content = json_decode($contents);
	//$this->load->library('fields');
	$CI =& get_instance();
	$CI->load->library('fields');
	$permission_access = $this->session->userdata('menu'); 
 ?>
 <div id="page_content">
    <div id="page_content_inner">
    	<h2 class="heading_b uk-margin-bottom">Form Preview</h2>
        <div class="md-card">
            <div class="md-card-content large-padding">
            <h3 class="heading_b uk-margin-bottom"><?php echo $formname.'-'.$formcode; ?></h3>
				
				<div class="md-card">
            		<div class="md-card-content large-padding">
				<?php foreach($content as $p=>$fieldss): //print_r($fields);?>
				<div class="uk-grid">
					<?php $count_pages = count($fieldss);?>
					<div class="uk-width-1-<?php echo $count_pages;?>">
						<?php foreach($fieldss as $p=>$pages):?>
							<?php $count_rows = count($pages);?>
								<div class="uk-grid">
									<div class="uk-width-1-1">
									<?php foreach($pages as $r=>$rows): ?>
										<?php $count_cols = count($rows); ?>
										<div class="uk-grid">
											
											<?php  foreach($rows as $c =>$cols): ?>

											<div class="uk-width-1-<?php echo $count_cols; ?>">
												<?php 
												if(is_object($cols)){ 
													if(!isset($cols->value)){
														
														
														$cols->value ='';
													}
													echo $CI->fields->generate($cols);
													//print_r($content); exit;
}
												?>
											</div>
										<?php endforeach; ?>
										</div>
									<?php endforeach;?>
									</div>
								</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		  <?php if(in_array('update',$roles)){ ?>
		<div class="uk-grid">
			<div class="uk-width-1-1">
			<form method="post" name="saveForm" action="<?php echo base_url().'form/saveform' ?>">
				<input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />
				<div class="uk-container-center">
					<div class="uk-grid">
						<div class="uk-width-1-3">
							<input type ="submit" class="md-btn md-btn-primary" name="saveform" value="Save Form" />
						</div>
						<div class="uk-width-1-3">
							<a href="<?php echo base_url().'form/edit_form/'.$form_id; ?>" class="md-btn md-btn-primary">Edit Form</a>
						</div>
						<div class="uk-width-1-3">
							<a href="<?php echo base_url().'form'; ?>" class="md-btn md-btn-primary">Cancel</a>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
		<?php } else { ?>
		<div class="uk-container-center">
			<div class="uk-grid">
				<div class="uk-width-1-3">
						<a href="<?php echo base_url().'form'; ?>" class="md-btn md-btn-danger">Cancel</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
</div>
</div>
