<h2> Columns to Display</h2>
<div class="uk-grid">
<?php foreach($columns as $key=>$value) { 
		if(in_array($value,$selected)){
			$check = 'Checked';
		}else{
			$check = '';
		}
	?>
	<div class="uk-width-1-3">
		<input type="checkbox" name="columns" class="columns" <?php echo $check; ?> value="<?php echo $value; ?>"/> <?php echo $value; ?>
	</div>
<?php } ?>
	<input type="hidden" name="column" value=""/>
</div>
