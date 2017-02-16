<?php
	$content = json_decode($contents);
	$CI =& get_instance();
	$CI->load->library('fields');
	$permission_access = $this->session->userdata('menu'); 

 ?>
 <style>
    .uk-modal-dialog {
        width:750px;
    }
	.form-preview-main .md-input {
		border: 1px solid #CCC !important;
	}
	.form-preview-main label {
		padding: 0 0px !important;
	}

	.form-preview-main .uk-grid {
		margin-top: 12px !important;
	}
	
	.form-preview-main .uk-grid input[type="radio"] {
		margin-right: 10px;	
	}
</style>
<div class="md-card" style="box-shadow:0px 0px 0px #fff;">
    <div class="md-card-content padding-zero form-preview-main">
    	<?php
    		foreach($content->fields as $p=>$pages){  
    			foreach($pages as $r=>$rows){ 
    				$count = count($rows);
    			?>
    			<div class="uk-grid">
    			<?php
    				foreach($rows as $c=>$cols){ 
    			?>
    				<div class="uk-width-1-<?php echo $count; ?>">
    			<?php 
                    if($cols->type !== 'reset' && $cols->type !== 'submit'){
    					echo $CI->fields->generate($cols); 
                    }
                ?>
    				</div>
    			<?php } ?>
    			</div>
    			<?php }	?>
    	<?php } ?>
    </div>
</div>

