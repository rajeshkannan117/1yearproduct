<div id="page_content">
    <div id="page_content_inner" class="padding-zero">
    
    <form action="" method="post" id="setWorkflow" class="workflow-main">
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content layout-scroll">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-3">
                        <label for="val_select" >Form name </label><br/>
                        <span>
                            <?php echo $form_name; ?>
                        </span>
                    </div>
                    <div class="uk-width-1-3">
                        <label for="val_select" >Job Sites <span class="req">*</span></label>
                        <div id="location">
                            <ul class="preview">
                                <?php 
                                    foreach($location as $key=>$value) { 
                                        if(is_array($formlocation)){
                                            if(in_array($value['location_id'], $formlocation)){ ?>
                                        <li>
                                           <?php echo $value['location']; ?>
                                        </li>
                                <?php       }
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="uk-width-1-3">
                        <label for="due_date">Form Category <span class="req">*</span></label><br/>
                        <span> <?php echo $formcategory; ?>" </span>
                    </div>
                </div>
                <hr>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-1">
                        <div id="user" style="">
                            <label for="val_select" >Users <span class="req">*</span></label><br/>
                                <select id="assign_user_0" name="report[report][0][users][]" multiple ="multiple" class="assign_user chosen_select" data-placeholder="Select Users...">
                                    <?php foreach($going_to_report_user as $key=>$value){ ?>
                                        <option value="<?php echo $value['id']; ?>"<?php
                                            if(is_array($formusers)){
                                                if(in_array($value['id'],$formusers)){
                                                    echo 'selected';
                                                }
                                            }?>>
                                            <?php echo $value['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                        </div>
                    </div>
                </div>
            <?php 
            if(is_array($workflow)){
                $count = count($workflow);        
            }
            else{
                $count = 0;
            }
            ?>
            <table class="uk-table workflows_page">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Authorized User</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="level" data-level="0" id="level_0">
                        <td> Level 1</td>
                        <td>
                            <div id="authorized_user" style="">
                                <select id="approve_user_0" name="report[report][0][approve]" class="authorized_users" required  placeholder="Select Authorized User">
                                    <option value=""></option>
                                   <?php foreach($going_to_approve_user as $key=>$value){ ?>
                                        <option value="<?php echo $value['id']; ?>"
                                        <?php
                                            if(isset($workflow[0]['user_id'])){ 
                                                if($value['id'] === $workflow[0]['user_id']){
                                                    echo 'selected';
                                                }
                                            }
                                        ?> >
                                            <?php echo $value['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div id="approve" style="">
                                <select id="authority_0" name="report[report][0][authority]" class="authority" required  placeholder="Select Authority...">
                                    <option value =""></option>
                                    <?php if(count($going_to_approve_user) > 1){ ?>
                                    <option value="1" <?php echo ($count > 1) ? 'selected':''; ?>>Review</option>
                                    <option value="2" <?php echo ($count == 1) ? 'selected':''; ?>>Approve</option>
                                    <?php } else{ ?> 
                                        <option value="2" <?php echo ($count == 1) ? 'selected':''; ?>>Approve</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                        <td class="report_level_0"> 
                            <?php 
                                if($count > 1){  
                                    echo 'Report to next level';
                                }else if($count == 1){
                                    echo 'N/A';
                                } 
                            ?>
                        </td>
                    </tr>
                    <?php if(is_array($workflow)){
                            $count = count($workflow);        
                        }
                        else{
                            $count = 0;        
                        }
                        $i = '0';
                        $inital_row = '1';
                        if($count >= 1){
                            $count_workflow_user = count($workflow);
                            $count_approval_user = count($going_to_approve_user);
                            foreach($workflow as $key=>$values){
                            $level = $key++;
                            $i++;
                            $inital_row++;
                            $already_user[] = $values['user_id'];
                            if($i < $count) {
                    ?>
                    <tr class="level" id="level_<?php echo $i; ?>" data-level="<?php echo $i; ?>">
                        <td> Level <?php $row_level = $i; echo ++$row_level; ?></td>
                        <td>
                            <?php if($i !== $count) { ?>
                                <div id="authorized_user" style="">
                                    <select id="approve_user_<?php echo $i;?>" name="report[report][<?php echo $i;?>][approve]" class="authorized_users" required  placeholder="Select Authorized User">
                                        <option value=""> </option>
                                       <?php foreach($going_to_approve_user as $key=>$value){
                                            if(!in_array($value['id'], $already_user)){
                                        ?>
                                            <option value="<?php echo $value['id']; ?>"
                                                <?php if($workflow[$i]['user_id'] === $value['id']) {
                                                    echo 'selected';
                                                } ?> >
                                                <?php echo $value['name']; ?>
                                            </option>
                                        <?php } 
                                        } 
                                    ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </td>
                        <td>
                            <div id="approve" style="">
                                <select id="authority_<?php echo $i;?>" name="report[report][<?php echo $i;?>][authority]" class="authority" required  placeholder="Select Authority...">
                                <option value=""></option>
                                    <?php 
                                    if($inital_row !== $count){ ?>
                                        <option value="1" selected>Review</option>
                                        <option value="2" >Approve</option>
                                    <?php } else if($count_approval_user > $count_workflow_user) {  ?>
                                        <option value="1">Review</option>
                                        <option value="2" selected >Approve</option>
                                    <?php } else { ?> 
                                        <option value="2" selected >Approve</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                        <td  class="report_level_<?php echo $i; ?>">
                            <?php 
                            if($inital_row !== $count) { ?>
                                Report to next level
                            <?php } else { ?>
                                N/A
                            <?php } ?>
                        </td>
                        <!-- <td>

                        </td> -->
                    </tr>
                    <?php } }
                    }
                    ?>
                </tbody>
            </table>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-2">
                        <?php if(!$hierarchy_id){ ?>
                        <input type="submit" name="submit" style="float:right;" value="Submit" class="md-btn md-btn-primary" />
                        <?php } else{ ?>
                        <input type="submit" name="submit" style="float:right;" id="update" value="Update" class="md-btn md-btn-primary" />
                        <?php } ?>
                    </div>
                    <div class="uk-width-1-2">
                        <a class="md-btn md-btn-danger" href="<?php echo base_url() ?>workflow">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="org_id" name="org_id" value="<?php echo $org_id; ?>" />
        <input type="hidden" id="form_id" name="form_id" value="<?php echo $form_id; ?>" />
        <input type="hidden" name="workflow" value="workflow" />
        <input type="hidden" id="hierarchy_id" name="hierarchy_id" value="<?php echo $hierarchy_id; ?>" />
        </form>
    </div>
</div>
