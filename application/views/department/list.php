
<div id="page_content">
    <div id="page_content_inner" style="padding:0 0px;">
            <!--  <h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('departments'); ?></h3>  -->
             <?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> 
            <?php } ?> 
    <div class="uk-margin-medium-bottom">
         <div class="md-card-content">
                <div class="uk-overflow-container">
                    <div class="uk-grid">
                         <div class="uk-width-1-2">
                         </div>
                        <div class="uk-width-1-2 uk-text-right">
                               <?php if(in_array('create',$roles)){ ?>
                                <a class="add-buuton-new" href="<?php echo base_url().'department/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                    <span>Add new</span>
                                </a>
                                <?php } ?>
                        </div>
                    </div>
                    <table id="dt_default" class="uk-table" cellspacing="0" width="96%">
                        <thead>
                        <tr>
                            <th class="uk-width-1-10 uk-text-center">#</th>
                            <th class="uk-width-3-10"><?php echo $this->lang->line('dept_name'); ?></th>
                            <?php if($org_id == 1) { ?>
                            <th class="uk-width-2-10">
                                <?php echo $this->lang->line('industry'); ?>
                            </th>
                            <th class="uk-width-2-10">
                                <?php echo $this->lang->line('country'); ?>
                            </th>
                            <?php }?>
                            <th class="uk-width-1-10">
                                <?php echo $this->lang->line('dept_user'); ?>
                            </th>
                            <th class="uk-width-1-10 uk-text-center">
                                <?php echo $this->lang->line('status'); ?>
                            </th>
                            <th class="uk-width-1-10 uk-text-center">
                                <?php echo $this->lang->line('actions'); ?>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        
                            <?php $i='0';  
                            if (is_array($result['department']) || is_object($result['department'])){                              
                            foreach($result['department'] as $details) { 
                            $i += 1;
                            ?>
                            <tr>
                                <td class="uk-text-center"><?php echo $i; ?></td>

                                <td><?php echo ucfirst(wordwrap($details['dept_name'],25,"<br>",TRUE)); ?><br>
                                <!-- <span style="font-size: 12px;color:red;"><?php if($details['default'] == "1"){ echo "System Default"; } ?> </span> -->
                                </td>
                            <?php if($org_id==1){  ?>
                                <td>
                                    <?php 
                                        $domains_arr = explode(',', $details['domains']); 
                                            if(count($domains_arr)){
                                        ?>
                                        <ul class="preview">
                                        <?php 
                                        foreach ($domains_arr as $k => $value) { 
                                            if($k < 2){
                                            ?>
                                                <li>
                                                    <?php echo $value; ?>
                                                </li>
                                        <?php 
                                            }  
                                        }?>
                                    </ul>
                                    <?php if(count($domains_arr) > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php foreach($domains_arr as $key=>$value){  
                                                        echo $value .'<br/>';
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } 
                                    }
                                    else {
                                        echo ' - ';
                                    } ?>
                                </td>

                                <td>
                                    <?php $country = explode(',', $details['countrys']);
                                    if(count($country)){ ?>
                                    <ul class="preview">
                                    <?php 
                                     foreach ($country as $key => $value) {
                                        if($key < 2){
                                        ?>
                                            <li>
                                                <?php echo $value; ?>
                                            </li>
                                        <?php 
                                            }
                                       } ?>
                                    </ul>
                                    <?php if(count($country) > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php foreach($country as $key=>$value){  
                                                        echo $value .'<br/>';
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } 
                                    }
                                    else {
                                        echo ' - ';
                                    } ?>
                                    
                                </td>
                                <?php } ?>
                                <td>
                                    <?php if(isset($dept_user[$details['dept_id']])){ ?>
                                        <ul class="preview">
                                        <?php
                                            $d = 1; 
                                            foreach($dept_user[$details['dept_id']] as $k=>$v){ 
                                                if($d <= 2 ){ ?>
                                                <li>
                                                    <?php echo $v; ?>
                                                </li>
                                            <?php $d++; 
                                                } 
                                            } ?>
                                        </ul>
                                        <?php if(count($dept_user[$details['dept_id']]) > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php foreach($dept_user[$details['dept_id']] as $key=>$value){  
                                                    //if($key > 2){
                                                        echo $value .'<br/>';
                                                    //}
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } 
                                    }
                                    else {
                                        echo ' - ';
                                    } ?>
                                </td>
                                <td class="uk-text-center">
                                <?php if($details['status'] == '1'){ ?>
                                    <span class="uk-badge uk-badge-success" id="department_active">
                                            Active
                                    </span>
                                <?php } else { ?>
                                    <span class="uk-badge uk-badge-danger2" id="department_inactive">
                                            Inactive
                                    </span>
                                <?php } ?>         
                                </td>
                                <td class="uk-text-center">
                                    <?php 

                                    if(($details['created_by'] != 1 && $this->session->userdata('user_id') != 1) || ($details['created_by'] == 1 && $this->session->userdata('user_id') == 1))
                                    {
                                        $edit = action_return($roles,'department',$details['uuid'],$user_id,$created_by);  
                                     
                                                if($edit != 'N/A'){ 
                                                    echo $edit; 
                                                }else{ 
                                                    echo $edit = ''; 
                                                } 
                                       // }
                                    } 
                                    if($edit == ''){
                                        echo str_repeat('&nbsp;', 8);
                                    }
                                        if(in_array('delete',$roles)){ 
                                            ?>
                                                <a title="Delete" onclick="department_delete('<?php echo $details['uuid']; ?>')" >
                                                    <i class="md-icon material-icons">&#xE872;</i>
                                                </a>
                                            <?php 
                                        }
                                     ?>
                                </td>
                            </tr>

                           <?php } } ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  

    </div>
</div>

  

<script type="text/javascript">

function department_delete(dept_id)
{
    
    $.ajax({ 
            type: "POST",       
            url: baseURL + "department/department_delete_check/",
            data: {dept_id: dept_id},
            dataType: "json",
            success: function(data) 
            {
                if(data==0)
                {
                    UIkit.modal.confirm('Are you sure, you want to delete this Department?', function(){ 
                        location.href=baseURL+'department/delete/'+dept_id; 
                    });
                }
                else if(data>0)
                {
                    UIkit.modal.alert("Since Category are associated with this Department, you can't delete this. ", function(){ 
                       
                    });
                }
            }           
        });
}


function changestatus(dept_id,status)
{   
    if(status==1)
    {
        var statusText = 'Activate';
    }
    else
    {
        var statusText = 'Deactivate';    
    }
    
    UIkit.modal.confirm('Do you want to '+statusText+' this Department?', function(){ 
        $.ajax({ 
                type: "POST",       
                url: baseURL + "department/department_status_change/",
                data: {dept_id: dept_id,status:status},
                dataType: "json",
                success: function(data) 
                {
                        UIkit.modal.alert("Department "+statusText+"d.", function(){ 
                            
                            
                        });
                        
                        if(status==0)
                            {
                                $("#department_active").show();
                                $("#department_inactive").hide();
                            }
                            else if(status==1)
                            {
                                $("#department_active").hide();
                                $("#department_inactive").show();
                            }
                            
                }           
            });    
    });
        
}
</script>
