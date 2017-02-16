<div class="dataTables_wrapper margin-top">
      <div class="md-card-content">
        <div>
          <a href="<?php echo $download_url ?>" >
            Download
          </a>
        </div>
        <div class="uk-grid">
          <div class="uk-width-1-1 submission_list">
            <table class="uk-table" id="dt_default">
                <thead>
                    <tr>
                      <th class=" uk-width-1-10 uk-text-center">#</th>
                      <?php
                        $i = 1; 
                        foreach($submission_list as $key =>$value){
                          if($i == 1){
                            foreach($value as $k=>$v){ 
                              if(in_array($k, $columns)){
                      ?>
                      <th class="uk-width-1-10 uk-text-center"> <?php echo $k; ?></th>
                      <?php   }
                            } 
                            $i++; 
                          } 
                        } 
                    ?>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                      $i='0'; 
                      foreach($submission_list as $key=>$value){ 
                  ?>
                <tr>
                    <td class="uk-width-1-10 uk-text-center"><?php echo $key; ?></td>
                    <?php   
                      foreach($value as $k=>$v){
                        if(in_array($k, $columns)){ 
                    ?>
                    <td class="uk-width-1-10 uk-text-center"><?php echo $v; ?></td>
                    <?php  } 
                      } ?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      var $dt_default = $('#dt_default');
        if($dt_default.length) {
            $dt_default.DataTable({
                'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1,-2],
                 /* 1st one, start by the right */
                 }],
            });
        }
    </script>