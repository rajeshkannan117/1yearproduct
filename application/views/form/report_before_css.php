<?php 
	//$content = json_decode($contents);
 //print_r( $this->uri->segment(2));
?>
<div id="page_content">
    <div id="page_content_inner">
	    <div class="md-card">
	    	<div class="md-card-content large-padding">
		    	<form method="post" action ="<?php echo base_url() ?>form/reports" id="filter_form">
		    		<input type="hidden" id="form_id" name="form_id" value="<?php echo $form_id; ?>" /> 
		    		<!-- <div class="uk-grid">
	    				<div class="uk-width-1-2">
	    				
	    				</div>
		    		</div> -->
		    		<div class="uk-grid">
		    		<div class="uk-width-1-2 advanced_filters">
		    			<label>Form Name</label> <br/>
		    			<select id="org_forms" name="org_forms" placeholder="Select Forms... required">
		                        <?php foreach($forms as $key=>$value){ ?>
		                            <option value="<?php echo $value->form_id; ?>" <?php echo ($form_id === $value->form_id)?" selected":" "; ?> >
		                                <?php echo $value->form_name; ?>
		                            </option>
		                        <?php } ?>
		                </select>
		                <label class="">Filter Criteria</label><br/>
			    		<div class="uk-grid advanced_filter" data-filter ="0">
			    			<div class="uk-width-3-10" >
			    				<select id="filter" name="filter[filter][0][column]" class="filter0" onchange = "filter_change(this)" class="uk-width-1-1">
			    					<option value=""> </option>
			    					<?php foreach($fields as $key=>$value) { ?>
			    						<option id="<?php echo $key; ?>" value="<?php echo $key; ?>">
			                                <?php echo $value; ?>
			                            </option>
			    					<?php } ?>
			    				</select>
			    			</div>
			    			<div class="uk-width-2-10 condition">
			    				<select id="filter_condition" name="filter[filter][0][condition]">
			    					<option value=""> </option>
			    					<?php foreach($filter as $key=>$value) { ?>
			    						<option value="<?php echo $key; ?>">
			                                <?php echo $value; ?>
			                            </option>
			    					<?php } ?>
			    				</select>
			    			</div>
			    			<div class="uk-width-3-10 data">
			    				<input type="text" name="filter[filter][0][data]" style="width:100px;height:15px;padding-left:15px !important;" id="filter_data" value="" />
			    			</div>
			    			<div class="uk-width-2-10 action">
				    			<span class="addremove">
									<a class="remove" href="#">
										<img class="icon" title="" height="14px" width="14px" src="<?php echo base_url() ?>assets/assets/images/minus.png" alt="">
									</a>
									<a class="add" href="#" style="display: inline;">
										<img class="icon" height="14px" width="14px" title="" src="<?php echo base_url() ?>assets/assets/images/add2.png" alt="">
									</a>
								</span>
							</div>
			    		</div>
					</div>
					<div class="uk-width-1-2">
						<a class="advanced_check_filters">Advanced</a>
					<div class="check_filters" style="display:none">
						<div class="uk-grid">
							<input type="hidden" value="#" name="columns[]" />
							<input type="hidden" value="Submitted By" name="columns[]" />
		    				
			<!-- 				<div class="uk-width-1-3">
								<input type="checkbox" name="columns[]" value="Submission Id" disabled checked  />Submission Id
							</div> -->
							
							<div class="uk-width-1-3">
								<input type="checkbox" name="columns[]"  value="Submitted By"  />Submitted By
							</div>			
							<div class="uk-width-1-3">
								<input type="checkbox" name="columns[]"  value="Created at"  />Created at
								<input type="hidden" value="Created at" name="columns[]" />
							</div>
						 <?php $k=0; foreach($required as $key=>$value){
								if($value[1] === '1'){   ?>
								<div class="uk-width-1-3">
                                                                    <input type="checkbox" onclick="filter_check(<?php echo $k; ?>)" class="ckeck_sub<?php echo $k; ?>" name="columns[]" value="<?php echo $value[0]; ?>"  /> <?php echo $value[0]; ?>
								</div>
								<?php } $k++;  ?>
						<?php } ?> 
							<!-- <div class="uk-width-1-4">
								<input type="checkbox" name="columns[]" value="Form Name"/>Form Name
							</div>	 -->
						</div>
					</div>
					</div>
					</div>
		    		<div class="filter-submit">
		    			<input type="button" value="Search" onclick="filter_submit()"/>
		    			<input type="hidden" value="report" name="report" />
		    			
		    		</div>
		    	</form>
		    </div>
		</div>
		<div class="md-card">
	    	<div class="md-card-content large-padding">
	    		<div class="uk-grid">
		        	<div class="uk-width-1-1 submission_list">
		        		<table class="uk-table" id="dt_default">
		                    <thead>
		                        <tr>
		                            <th class="uk-width-1-10 uk-text-center">#</th>
		                            <th class="uk-width-1-10 uk-text-center">Submitted By</th>
		                            <th class="uk-width-1-10 uk-text-center">Created at</th>
		                            <?php foreach($required as $key=>$value){ ?>
		                            <th class="uk-width-1-10 uk-text-center">
		                            <?php echo $value[0]; ?></th>
		                            <?php } ?>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	<?php 
		                    		$i='0'; 
		                    		foreach($submission_list as $key=>$value){ 
		                    	?>
                        		<tr>
                            		<td class="uk-width-1-10 uk-text-center"><?php echo $key; ?></td>
                            		<td class="uk-width-1-10 uk-text-center"><?php echo $value['submitted_by']; ?></td>
                            		<td class="uk-width-1-10 uk-text-center"><?php echo $value['created_at']; ?></td>
                            <?php 	
                            		foreach($value as $k=>$v){
                            			if(in_array($k, $columns) && $k !== 'submitted_by' && $k !== 'created_at'){ ?>
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
	</div>
</div>