<div id="page_content" style="margin-left:30px;">
    <div id="page_content_inner" class="white-bg" style="padding-left:0px;">
        <div class="uk-grid" data-uk-grid-margin>
            <?php if($org_id == 1){ ?>
            <div class="uk-width-1-2 uk-container-center">
                <div class="parsley-row">
                    <label for="val_select" >Organization  <span class="req">*</span></label><br/>
                    <select required name="organization" id="form_org">
                         <option value="">Choose Organization</option>
                        <?php
                           // print_r($organizations);    
                            foreach($organizations as $key=>$value){
                                if($value['id'] != '1'){
                            ?>
                            <option value="<?php echo $value['id'] ?>"
                            <?php 
                                if(isset($_POST['organization'])){ 
                                    if($_POST['organization'] === $value['id']){
                                        echo 'selected';
                                    }
                                } 
                            ?> ><?php echo $value['org_name']; ?>
                            </option>
                                <?php } ?>
                        <?php } ?>
                    </select>
                    <span class="errors" style="color:red;">*</span>
                </div>
            </div>
            <?php } ?>
            <div class="uk-width-1-2">
                <label for="val_select" >Job Sites <span class="req">*</span></label>
                <div id="location">
                <select name="location[]" multiple ="multiple" class="chosen_select" required  placeholder="Select location..." id="location_changes">
                    <option value=""></option>
                        <?php foreach($org_location as $key=>$value){ ?>
                            <option value="<?php echo $value['id']?>"
                        <?php if(in_array($value['id'], $sel_location)){ echo 'selected'; }?>>
                                <?php echo $value['location_name'].','.$value['city'].','.$value['state'];?>
                            </option>
                        <?php } ?>
                </select>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.chosen_select').chosen({no_results_text:'Oops, nothing found!',width:'95%'});
    });
</script>
