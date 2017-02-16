<select id='' class='domain_change chosen_select' required data-placeholder='Select Domain...'name='domain'>
<?php foreach($org_domain as $key=>$value){  ?>
    <option value="<?php echo $key; ?>">
        <?php echo $value; ?> 
    </option>
<?php } ?>
</select>
<script type="text/javascript">
    $('.chosen_select').chosen({no_results_text:'Oops, nothing found!',width:'95%'});
</script>