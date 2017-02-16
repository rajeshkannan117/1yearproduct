<div id="page_content" style="margin-left:30px;">
    <div id="page_content_inner" class="white-bg" style="padding-left:0px;">
        <h3>Assign</h3>
           <div class="uk-grid">
            <!-- <div class="uk-width-1-1" style="margin:10px 0px;">
                <label class="fn">
                    Select Jobsites
                </label>
                <div class="location">
                    <select name="location[]" class="chosen_select location" required id="location" multiple data-placeholder="Select Job Sites">
                        <option value=""></option>
                        <?php foreach($org_location as $key=>$value){ ?>
                            <option value="<?php echo $value['id']?>"
                            <?php if(in_array($value['id'], $sel_location)){
                                echo 'selected';
                             }?> >
                                <?php echo $value['location_name'].','.$value['city'].','.$value['state'];?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div> -->
            <input type="hidden" name="location[]" id="location" value="<?php echo $location; ?>" />
            <div class="uk-width-1-1" style="margin:10px 0px;">
                <!--<label class="fn">
                    Select Department
                </label>-->
                <div class="dept"> 
                    <select id="department_change" name="assign_dept" class="chosen_select" multiple data-placeholder="Select Department">
                        <?php foreach($org_dept as $key=>$value){ ?>
                            <option value="<?php echo $value['dept_id'] ?>"
                                <?php if(in_array($value['dept_id'], $sel_department)){
                                    echo 'selected';
                                }?> >
                                <?php echo $value['dept_name'];?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="uk-width-1-1 move-list-fields" style="margin:10px 0px;">
                <!--<label class="fn">
                    List Of users

                </label>-->
                <div class="users include"> 
                    <label>Assigned users</label>
                    <select id="assign_users" name="assign_users" class="include list from" multiple data-placeholder="Select Users">
                        <?php 
                        if(count($org_users) > 0){
                            foreach($org_users as $key=>$value){
                                if($value != ''){
                                    if($key != $logged_user && $key != $superadmin){
                                ?>
                                    <option value="<?php echo $key; ?>">
                                        <?php echo $value;?>
                                    </option>
                                <?php } 
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="controls" style="margin-top:35px;">
                    <a href="javascript:moveAll('from','to')"> >> </a> 
                    <a href="javascript:moveSelected('from','to')"> > </a> 
                    <a href="javascript:moveSelected('to','from')"> < </a> 
                    <a href="javascript:moveAll('to','from')"> << </a> 
                </div>
                <div class="exclude">
                    <label>Excluded Users</label>
                    <select id="exclude" class="list to" multiple="" name="exclude[]">
                        <?php if(count($exclude_users) > 0) { 
                            foreach($exclude_users as $key=>$value){
                                if($value != ''){
                                ?>
                                    <option value="<?php echo $key; ?>">
                                        <?php echo $value; ?>
                                    </option>
                        <?php   }

                            }  
                        } ?>
                    </select>
                </div>
            </div>
        </div> 
    </div>
    </div>
</div>
<style>
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('.chosen_select').chosen({no_results_text:'Oops, nothing found!',width:'95%'});
        
    });
</script>
