<div id="page_contents">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">
            <?php echo $this->lang->line('role'); ?>
        </h3>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                    <div class="parsley-row">
                        <label for="rolename"><?php echo $this->lang->line('role_name'); ?>
                        </label>
                        <input type="text" disabled name="role_name" required class="md-input" value="<?php echo trim($result->role_name);?>" />
                    </div>
            </div>
            <div class="uk-width-medium-1-2">
                <label for="roledesc">
                        <?php echo $this->lang->line('status'); ?>
                </label>
                <p class="parsley-row">
                    <?php
                        if($result->status){
                            echo 'Active';
                        }else{
                            echo 'Inactive';
                        }
                     ?>
                </p>
            </div>
        </div>
        <!--<div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="roledesc">
                        <?php echo $this->lang->line('role_desc'); ?>
                    </label>
                    <textarea name="role_desc" disabled class="md-input"><?php 
                            if(trim($result->role_desc) != ''){                                 
                                echo trim($result->role_desc);
                            }else{
                                echo 'Empty Description';
                            }
                        ?>
                    </textarea>
                </div>
            </div>
            <div class="uk-width-medium-1-2"></div>
        </div>-->
        <div class="md-card" style="border:0px;box-shadow: none;">
            <div class="md-card-contents large-paddings">
                <h3 class="heading_b uk-margin-bottom">
                    <?php echo $this->lang->line('permission'); ?>   
                </h3>
                <table class="">
                    <thead>
                        <tr>
                            <th style="text-align:left;"><?php echo $this->lang->line('menu'); ?></th>
                            <th><?php echo $this->lang->line('create'); ?></th>
                            <th><?php echo $this->lang->line('view'); ?></th>
                            <th><?php echo $this->lang->line('update'); ?></th>
                            <th><?php echo $this->lang->line('review'); ?></th>
                            <th><?php echo $this->lang->line('delete'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($this->session->userdata('org_id') == '1'){ ?>
                            <!-- Country -->
                            <tr>
                                <td><b><?php echo $this->lang->line('country'); ?> </b></td>
                                <td><?php if($result->country['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->country['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->country['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->country['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->country['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->country['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <!-- <?php if($result->review['create']) {?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="reviews[]" value="create" data-md-icheck disabled <?php if($result->review['create']){ echo 'checked'; } ?> id="switch_demo_1" />
                                        </span>
                                    <?php } ?> -->
                                </td>
                                <td>
                                    <?php if($result->country['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="countries[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->country['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- Domin / Industry -->
                            <tr>
                                <td><b><?php echo $this->lang->line('domain'); ?> </b></td>
                                <td><?php if($result->domain['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="domains[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->domain['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->domain['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="domains[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->domain['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->domain['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="domains[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->domain['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <!-- <?php if($result->review['create']) {?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="reviews[]" value="create" data-md-icheck disabled <?php if($result->review['create']){ echo 'checked'; } ?> id="switch_demo_1" />
                                        </span>
                                    <?php } ?> -->
                                </td>
                                <td>
                                    <?php if($result->country['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="domains[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->domain['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- Organization -->
                             <tr>
                                <td><b><?php echo $this->lang->line('organization'); ?> </b></td>
                                <td><?php if($result->organizations['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="organizations[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->organizations['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->organizations['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="organizations[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->organizations['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->organizations['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="organizations[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->organizations['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <!-- <?php if($result->location['create']) {?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="location[]" value="create" data-md-icheck disabled <?php if($result->location['create']){ echo 'checked'; } ?> id="switch_demo_1" />
                                        </span>
                                    <?php } ?> -->
                                </td>
                                <td>
                                    <?php if($result->organizations['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="organizations[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->organizations['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                            <!-- Jobsite / Location -->
                            <tr>
                                <td><b><?php echo $this->lang->line('location'); ?> </b></td>
                                <td><?php if($result->location['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="location[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->location['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->location['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="location[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->location['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->location['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="location[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->location['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <?php if($result->location['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="location[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->location['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- Department -->
                            <tr>
                                <td><b><?php echo $this->lang->line('department'); ?> </b></td>
                                <td><?php if($result->department['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="department[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->department['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->department['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="department[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->department['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->department['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="department[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->department['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td></td>
                                <td>
                                    <?php if($result->department['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="department[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->department['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- Category -->
                            <tr>
                                <td><b><?php echo $this->lang->line('category'); ?> </b></td>
                                <td><?php if($result->category['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="category[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->category['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->category['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="category[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->category['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->category['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="category[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->category['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td></td>
                                <td>
                                    <?php if($result->category['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="category[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->category['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- Roles -->
                            <tr>
                                <td><b><?php echo $this->lang->line('roles'); ?> </b></td>
                                <td><?php if($result->role['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="roles[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->role['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->role['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="role[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->role['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->role['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="role[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->role['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td></td>
                                <td>
                                    <?php if($result->role['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="role[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->role['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- Users -->
                            <tr>
                                <td><b><?php echo $this->lang->line('users'); ?> </b></td>
                                <td><?php if($result->user['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="user[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->user['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->user['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="user[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->user['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->user['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="user[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->user['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td></td>
                                <td>
                                    <?php if($result->user['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="user[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->user['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- Forms -->
                            <tr>
                                <td><b><?php echo $this->lang->line('forms'); ?> </b></td>
                                <td><?php if($result->forms['create']) { ?>
                                   <span class="icheck-inline">
                                        <input type="checkbox" name="forms[]" id="country_permission" data-md-icheck disabled value ="create" <?php if($result->forms['create']){ echo 'checked'; } ?>/>
                                    </span>
                                <?php } ?>
                                </td>
                                <td><?php if($result->forms['read']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="forms[]" id="country_permission" data-md-icheck disabled value ="read" <?php if($result->forms['read']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->forms['update']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="forms[]" id="country_permission" data-md-icheck disabled value ="update" <?php if($result->forms['update']){ echo 'checked'; } ?>/>
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->review['create']){ ?>
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="reviews[]" value="create" data-switchery disabled <?php if($result->review['create']){ echo 'checked'; } ?> id="switch_demo_1" />
                                    </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($result->forms['delete']){ ?>
                                        <span class="icheck-inline">
                                            <input type="checkbox" name="forms[]" id="country_permission" data-md-icheck disabled  value ="delete" <?php if($result->forms['delete']){ echo 'checked'; } ?>/>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

   
