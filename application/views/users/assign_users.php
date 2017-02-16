<div id="page_content" style="margin-left:30px;">
    <div id="page_content_inner" class="white-bg" style="padding-left:0px;">
    <h3>Assign</h3>
        <div class="uk-grid">
            <div class="uk-width-1-1" style="margin:10px 0px;">
                <div class="users"> 
                    <select id="assign_users" name="assign_users" class="chosen_select" multiple data-placeholder="Select Users">
                        <option value="-1"></option>
                        <?php foreach($org_users as $key=>$value){ ?>
                            <option value="<?php echo $key; ?>"
                            <?php 
                                if(in_array($key,$sel_user)){
                                    echo 'selected'; 
                                }
                            ?> >
                                <?php echo $value;?>
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
       //$('#assign_users').kendoMultiSelect({});
        $('.chosen_select').chosen({no_results_text:'Oops, nothing found!',width:'95%'});
    });
</script>