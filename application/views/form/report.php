<?php 
	//$content = json_decode($contents);
 //print_r( $this->uri->segment(2));
?>

<div id="page_content">
  <div id="page_content_inner" class="report-page-main" style="padding:0 0px;">
    <div class="md-card dataTables_wrapper">
      <div class="dt-uikit-header" style="margin-bottom:0px;">
        <div class="uk-grid">
          <div class="feedback-form-left">
          		<label><?php echo $form_name; ?></label><br/>
          		<label>Created by : <strong><?php echo $created_by; ?></strong></label>
              <label>Created on : <strong><span id="created_on"></span></strong></label>
              <label>Status     : <strong><?php echo $status_lang; ?></strong></label>

          </div>
          <?php if(count($submission_list) > 0) { ?>
          <div class="feedback-form-right">
                <a class="show-buuton" href="#" style="min-width:0px;min-height:0px;">
                    <span>Advanced Filter</span>
                </a>
          </div>
          <?php } ?>
      	</div>
      </div>
       <script>
    var date = moment(<?php echo $created_on; ?>).format('YYYY/DD/MM HH:mm:ss');
    jQuery('#created_on').text(date);
   // document.getElementById('created_on').value=date;
</script>               
      <div class="md-card-content show-content large-padding" style="display:none;">
        <form method="post" action ="<?php echo base_url() ?>form/reports" id="filter_form">
          <input type="hidden" id="form_id" name="org_forms" value="<?php echo $form_id; ?>" />
          <div class="uk-grid">
            <div class="uk-width-1-2 advanced_filters">
              <?php if(is_array($fields) && count($fields) > 0){ ?>
              <h2 class="">Filter Criteria</h2>
              <div class="uk-grid advanced_filter" data-filter ="0">
                <div class="uk-width-3-10" >
                  <select id="filter" name="filter[filter][0][column]" class="filter0" onchange = "filter_change(this)" class="uk-width-1-1">
                  <option value=""> </option>
                  <?php foreach($fields as $key=>$value) { ?>
                  <option id="<?php echo $key; ?>" value="<?php echo $key; ?>"> <?php echo $value; ?> </option>
                  <?php } ?>
                  </select>
                </div>
                <div class="uk-width-3-10 condition padding-zero">
                  <select id="filter_condition" name="filter[filter][0][condition]">
                    <option value=""> </option>
                    <?php foreach($filter as $key=>$value) { ?>
                    <option value="<?php echo $key; ?>"> <?php echo $value; ?> </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="uk-width-2-10 data padding-zero">
                  <input type="text" name="filter[filter][0][data]" style="width: 100%; height: 15px; padding-left: 0px;    margin-left: 0px;" id="filter_data" value="" />
                </div>
                <div class="uk-width-2-10 action"> <span class="addremove"> <a class="remove" href="#"> <img class="icon" title="" height="22px" width="22px" src="<?php echo base_url() ?>assets/assets/images/minus.png" alt=""> </a> <a class="add" href="#" style="display: inline;"> <img class="icon" height="22px" width="22px" title="" src="<?php echo base_url() ?>assets/assets/images/add2.png" alt=""> </a> </span> </div>
              </div>
              <?php } ?>
            </div>
            <div class="uk-width-1-2 advanced_filters_right">
              <h2 class="">Sorting Order</h2>
              <div class="select-content">
              <select name="field">
                <option value="created_at">Last Updated</option>
                <option value="id">Submission</option>
              </select>
              <select class="order" name="order">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
              </select>
              </div>
              <div class="customize_columns" id="customize_columns">Customize Columns</div>
            </div>
          </div>
          <?php if(is_array($fields) && count($fields) > 0){ ?>
          <div class="filter-submit">
            <input type="button" value="Clear All" class="md-btn md-btn-danger" id="clear_all" />
            <input type="button" value="Search" class="md-btn md-btn-primary blue-bg search-button" onclick="filter_submit()"/>
            <input type="hidden" value="report" name="report" />
            <input type="hidden" name="columns_selected[]" class="columns_selected" value="" />
          </div>
          <?php } ?>
        </form>
      </div>
    </div>
    <?php if(count($submission_list) > 0) { ?>
    <div class="md-card margin-top">
      <div class="md-card-content">
        
        <div class="uk-grid">
          <div class="uk-width-1-1 submission_list">
            <div class="download-button">
              <a href="<?php echo $download_url; ?>" >
                Download
              </a>
            </div>
            <table class="uk-table" id="dt_default">
              <thead>
                <tr>
                  <th class="uk-width-1-10 uk-text-center">#</th>
                  <?php
                  $i = 1; 
                  foreach($submission_list as $key =>$value){
                    if($i == 1){
                      foreach($value as $k=>$v){ 
                        if(in_array($k, $columns)){
                  ?>
                  <th class="uk-width-1-10 uk-text-center"> <?php echo $k; ?></th>
                  <?php }
                      } 
                      $i++; 
                    } 
                  } ?>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  		$i='0'; 
                  		foreach($submission_list as $key=>$value){ 
		              ?>
                <tr>
                    <td class="uk-width-1-10 uk-text-center"><?php echo $key; ?></td>
                    <?php 	
                    	foreach($value as $k=>$v){
                    		if(in_array($k, $columns)){ 
                    ?>
                    <td class="uk-width-1-10 uk-text-center"><?php echo $v; ?></td>
                    <?php  } 
                      } ?>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php } else { ?>
      <div class="md-cards margin-tops">
        <div class="md-card-contents">
            <p class="">No Submission aganist the form</p>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
