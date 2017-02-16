<div class="md-card" style="box-shadow:0px 0px 0px #fff;">
      <h3 class="heading_b uk-margin-bottom">
            <?php echo $form_details->form_name; ?>
        </h3>
    <div class="md-card-content uk-grid padding-zero">
      
        <div class="uk-width-medium-1-2">
            <label class="padding-zero">Jobsites</label>
            <?php foreach($formlocation as $key=>$value){ ?>
                <span class="preview"><?php echo $value; ?></span><br/>
            <?php } ?>
        </div>
        <div class="uk-width-medium-1-2">
            <label class="padding-zero">Category</label>
            <span><?php echo $formcategory ?></span>
        </div>
        <br/>
        <div class="model-list">
        <?php 
        $total_workflows = count($workflow);
            $i=0;
            foreach($workflow as $key=>$value){   
                $i++;              
             ?>
                <div class="details">
                    <h4 class="">Level <?php echo $i; ?></h4>
                    <div class="model-list-image">
                        <img src="<?php echo base_url().'uploads/user/thumb/'.$value['profile'] ?>" />
                    </div>
                    <div class="model-list-content-one">
                        <p class="margin-zero"><?php echo $value['name'] ?></p>
                        <p class="margin-zero"><?php echo $value['rolename'] ?></p>
                    </div>
                    <div class="model-list-content-two">
                        <?php if($i == $total_workflows) { ?> 
                            <p class="margin-zero">
                                <span><strong>Action 1 :</strong></span> 
                                    <span> 
                                        <?php echo 'Approver'; ?>                                    
                                    </span>
                             </p>
                             <p>
                                <span><strong>Action 2 :</strong></span> 
                                    <span> 
                                        <?php echo 'N/A'; ?>                                    
                                    </span>
                             </p>
                        <?php } else {  ?>
                        	<p class="margin-zero">
                                <span><strong>Action 1 :</strong></span> 
                                    <span> 
                                        <?php echo 'Reviewer'; ?>                                    
                                    </span>
                                </p>
                                <p>
                                <span><strong>Action 2 :</strong></span> 
                                    <span> 
                                        <?php echo 'Report to next level'; ?>                                    
                                    </span>
                            </p>
                        <?php } ?>
                    </div>
                </div>
        <?php  //}

        } ?>
        
        </div>
    </div>
</div>

