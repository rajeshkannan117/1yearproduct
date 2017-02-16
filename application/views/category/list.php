<?php //print_r($result);exit;?>

    <div id="page_content">
        <div id="page_content_inner" style="padding:0 0px">
<!-- <h3 class="heading_b uk-margin-bottom"><?php echo $this->lang->line('categories'); ?></h3> -->
<?php if ($this->session->flashdata('SucMessage')!='') { ?>
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                	<a href="#" class="uk-alert-close uk-close"></a>
                    <?php echo $this->session->flashdata('SucMessage');  ?>
                </div> <?php } ?> 
            <div class="uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <div class="uk-grid">
                             <div class="uk-width-1-2">
                             </div>
                            <div class="uk-width-1-2 uk-text-right">
                                    <?php if(in_array('create',$roles)){ ?>
                                   <a class="add-buuton-new" href="<?php echo base_url().'category/add'?>" style="min-width:0px;min-height:0px;border-radius:51px;padding:0px;">
                                       <span>Add new</span>
                                    </a>
                                    <?php } ?>
                            </div>
                        </div>

                         <table id="dt_default" class="uk-table" cellspacing="0" width="96%">
                        <thead>

                            <tr>
                                <th class="uk-width-1-10 uk-text-center">#</th>
                                <th class="uk-width-2-10">
                                    <?php echo $this->lang->line('category'); ?>
                                </th>
                                <th class="uk-width-2-10">
                                    <?php echo $this->lang->line('department'); ?>
                                </th>
                                <?php if($org_id == 1) { ?>
                                <th class="uk-width-1-10">
                                    <?php echo $this->lang->line('industry'); ?>
                                </th>
                                <th class="uk-width-1-10">
                                    <?php echo $this->lang->line('country'); ?>
                                </th>
                                <?php } ?> 
                                <th class="uk-width-1-10">
                                    <?php echo $this->lang->line('form_category'); ?>
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
                            <?php $i='0'; if(!empty($result)) {
                                foreach($result as $details) { 
					            $i += 1; 
                            ?>
                            <tr>
                                <td class="uk-text-center"><?php echo $i; ?></td>
                                <td><?php echo $details['category_name']; ?></td>
                                <td>
                                    <?php   
                                            $dept= explode(',',$details['dept_name']);
                                            $count_dept = count($dept);
                                    ?>
                                        <ul class="preview">
                                    <?php
                                            foreach($dept as $k=>$v){
                                                if($k < 2){ ?>
                                                    <li>
                                                        <?php echo $v ; ?>
                                                    </li>
                                    <?php       }
                                            }   ?>
                                        </ul>
                                    <?php if($count_dept > 2){ ?>
                                        <span class="loadmore" title="
                                            <?php   foreach($dept as $k=>$v){
                                                        echo $v .'<br/>';
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                            ...
                                        </span>
                                    <?php } ?>    
                                </td>
                            <?php if($org_id==1){ ?>
                                <td>
                                    <?php   
                                        $domain= explode(',',$details['domain_name']);
                                        $count_domain = count($domain);
                                    ?>
                                        <ul class="preview">
                                    <?php
                                            foreach($domain as $k=>$v){
                                                if($k < 2){ ?>
                                                    <li>
                                                        <?php echo $v ; ?>
                                                    </li>
                                    <?php
                                                }
                                            }
                                    ?>
                                    </ul>
                                    <?php if($count_domain > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php   foreach($domain as $k=>$v){
                                                        echo $v .'<br/>';
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } ?>
                                </td>
                                <td>
                                    <?php   
                                            $country= explode(',',$details['country_name']);
                                            $count = count($country);
                                    ?>
                                    <ul class="preview">
                                    <?php   foreach($country as $k=>$v){
                                                if($k < 2){ ?>
                                                    <li>
                                                        <?php echo $v ; ?>
                                                    </li>
                                                <?php 
                                                    }
                                            }
                                    ?>
                                    </ul>
                                     <?php if($count > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php   foreach($country as $k=>$v){
                                                        echo $v .'<br/>';
                                                }?>" data-uk-tooltip="{cls:'long-text'}">
                                                    ...
                                            </span>
                                        <?php } ?>
                                </td>
                            <?php } ?>
                                <td>
                                    <?php 
                                        if(isset($form_category[$details['cat_id']])){ ?>

                                        <ul class="preview">
                                        <?php
                                            $k = 0; 
                                            foreach($form_category[$details['cat_id']] as $k=>$v){ 
                                                if($k < 2 ){ ?>
                                                <li>
                                                    <?php echo $v; ?>
                                                </li>
                                            <?php $k++; 
                                                } 
                                            } ?>
                                        </ul>
                                        <?php if(count($form_category[$details['cat_id']]) > 2){ ?>
                                            <span class="loadmore" title="
                                            <?php foreach($form_category[$details['cat_id']] as $key=>$value){  
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
                                	<?php if($details['status'] == "1"){ ?><span class="uk-badge uk-badge-success" style="">Active</span> <?php } ?>
                                	<?php if($details['status'] == "0"){ ?><span class="uk-badge uk-badge-danger2" style="">Inactive</span> <?php } ?>
                                </td>
                                <td class="uk-text-center">
                                     <?php 
                                     if(($details['created_by'] != 1 && $this->session->userdata('user_id') != 1) || ($details['created_by'] == 1 && $this->session->userdata('user_id') == 1))
                                    {
                                        $this->load->helper('access');
                                        $edit = action_return($roles,'category',$details['uuid'],$user_id,$details['created_by']);    
                                        
                                        if($edit != 'N/A'){
                                                    echo $edit;                                                     
                                                }else{ 
                                                    echo $edit = '';                                                     
                                                } 
                                        
                                    }
                                    if($edit == ''){
                                        echo str_repeat('&nbsp;', 8);
                                    }
                                    if(in_array('delete',$roles)){ ?>
                                    <a title="Delete" onclick="category_delete('<?php echo $details['uuid']; ?>')" ><i class="md-icon material-icons">&#xE872;</i></a>
                                        
                                    <?php }?>
                                   
                                </td> 
                                <!-- <td class="uk-text-center">
                                    N/A
                                </td> -->
                            </tr>

                               <?php } 
                            } ?> 
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>  

        </div>
    </div>

<script type="text/javascript">

function category_delete(cat_id)
{
    
    $.ajax({ 
            type: "POST",       
            url: baseURL + "category/category_delete_check/",
            data: {cat_id: cat_id},
            dataType: "json",
            success: function(data) 
            {
                if(data==0)
                {
                    UIkit.modal.confirm('<?php echo $this->lang->line("warning_category_delete"); ?>', function(){ 
                        location.href=baseURL+'category/delete/'+cat_id; 
                    });
                }
                else if(data>0)
                {
                    UIkit.modal.alert("<?php echo $this->lang->line('associated_category'); ?>", function(){ 
                       
                    });
                }
            }           
        });
    
//    UIkit.modal.confirm('Are you sure, you want to delete this Category?', function(){ 
//    location.href='<?php //echo base_url();?>category/delete/<?php //echo $details['cat_id']; ?>' 
    
}

</script>
