<div class="md-card">
    <div class="md-card-content">
        <h3 class="heading_a">Preview</h3>
        <?php if ($this->session->flashdata('SucMessage')!='') { ?>
        <div class="uk-alert uk-alert-success" data-uk-alert="">
           <a href="#" class="uk-alert-close uk-close"></a>
            <?php echo $this->session->flashdata('SucMessage');  ?>
        </div> <?php } ?> 
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="val_select" >
                        <?php echo $this->lang->line('location_name'); ?>
                    </label>
                    <input type="text" class="md-input" required disabled name="location_name" value="<?php echo $location['location_name']; ?>"/>
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="val_select" ><?php echo $this->lang->line('location_id'); ?></label>
                    <input type="text" class="md-input" required disabled name="location_id" value="<?php echo $location['location_id']; ?>"/>
                </div>
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                <div class="parsley-row">
                    <label for="address"><?php echo $this->lang->line('address'); ?> (100 Chars max)</label>
                    <textarea name="address" required class="md-input" cols="4" rows="4" ><?php echo $location['address'];?></textarea>
                </div>
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="val_select" ><?php echo $this->lang->line('city'); ?></label>
                    <input type="text" class="md-input" required name="city" disabled value="<?php echo $location['city']; ?>"/>
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="val_select" ><?php echo $this->lang->line('state'); ?></label>
                    <input type="text" class="md-input" required name="state" value="<?php echo $location['state']; ?>" disabled/>
                </div>
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="val_select" ><?php echo $this->lang->line('zip_code'); ?></label>
                    <input type="number" class="md-input" required name="zip_code" value="<?php if(isset($_POST['zip_code'])){echo $_POST['zip_code'];}elseif($location['zip_code'] != ''){echo $location['zip_code'];} ?>"/>
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="val_select" >
                        <?php echo $this->lang->line('country'); ?> 
                    </label><br/>
                     <input type="text" class="md-input" required name="state" value="<?php echo $country_name; ?>" disabled/>
                </div>
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <div class="uk-form-row parsley-row org_users">
                    <label><?php echo $this->lang->line('users'); ?></label><br/>
                        <?php if(count($location_user) > 0){ ?>
                        <ul id="users" >
                        <?php foreach($users as $key=>$value) { 
                                if(in_array($value['id'],$location_user)){
                            ?>
                            <li class="padding-zero">
                                <label><?php echo $value['firstname'].' '.$value['lastname']; ?></label>
                            </li>
                        <?php } } ?>
                        </ul>
                        <?php } else { ?>
                           <label> None</label>
                        <?php } ?>
                </div>
            </div>
            <div class="uk-width-medium-1-2"> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.chosen_select').chosen({no_results_text:'Oops, nothing found!',width:'95%'});
  </script> 