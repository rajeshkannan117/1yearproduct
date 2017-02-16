<?php 
  $org_id = $this->session->userdata['org_id'];
?>
<h3 class="heading_b uk-margin-bottom">
    <?php echo $this->lang->line('user_preview'); ?>
</h3>
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="rolename"><?php echo $this->lang->line('first_name'); ?>
            </label>
            <input type="text" disabled name="role_name" required class="md-input" value="<?php echo trim($user['firstname']);?>" />
        </div>
    </div>
    <div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="last_name"><?php echo $this->lang->line('last_name'); ?>
            </label>
            <input type="text" disabled name="last_name" required class="md-input" value="<?php echo trim($user['lastname']);?>" />
        </div>
    </div>
</div>
<div class="uk-grid" data-uk-grid-margin>
 	<div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="email"><?php echo $this->lang->line('email'); ?>
            </label>
            <input type="email" disabled name="email" required class="md-input" value="<?php echo trim($user['email']);?>" />
        </div>
    </div>
    <div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="phone"><?php echo $this->lang->line('phone'); ?>
            </label>
            <input type="text" disabled name="phone" required class="md-input" value="<?php echo trim($user['phone']);?>" />
        </div>
    </div>
</div>
<div class="uk-grid" data-uk-grid-margin>
 	<div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="organization"><?php echo $this->lang->line('organization'); ?>
            </label>
            <input type="text" disabled name="organization" required class="md-input" value="<?php echo trim($user['org_name']);?>" />
        </div>
    </div>
    <div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="location"><?php echo $this->lang->line('location'); ?>
            </label>
            <input type="text" disabled name="location" required class="md-input" value="<?php echo trim($user['location']);?>" />
        </div>
    </div>
</div>
<div class="uk-grid" data-uk-grid-margin>
 	<div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="departments"><?php echo $this->lang->line('departments'); ?>
            </label>
            <input type="text" disabled name="dept_name" required class="md-input" value="<?php echo trim($user['dept_name']);?>" />
        </div>
    </div>
    <div class="uk-width-medium-1-2">
        <div class="parsley-row">
            <label for="role_name"><?php echo $this->lang->line('roles'); ?>
            </label>
            <input type="text" disabled name="role_name" required class="md-input" value="<?php echo trim($user['role_name']);?>" />
        </div>
    </div>
</div>
