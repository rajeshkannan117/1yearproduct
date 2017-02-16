<?php
	$content = json_decode($contents);
	//print_r($content);exit;
	//$this->load->library('fields');
	$CI =& get_instance();
	$CI->load->library('fields');
	$permission_access = $this->session->userdata('menu'); 
 ?>
 <div id="page_content">
    <div id="page_content_inner">
    	<h2 class="heading_b uk-margin-bottom"><?php echo $formname.'-'.$formcode; ?> </h2>
        <div class="md-card">
            <div class="md-card-content large-padding">
            <h3 class="heading_b uk-margin-bottom"></h3>
				
				<form id="register" novalidate onsubmit="return validate()" method="post">
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
										<?php $count_cols = count(array_filter($rows));?>
										<div class="uk-grid">
											
											<?php  foreach(array_filter($rows) as $c =>$cols): ?>

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
		</form>	
		  
	</div>
</div>
</div>
</div>


