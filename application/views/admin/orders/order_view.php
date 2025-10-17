<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
    table th{
        font-weight: 600;
    }
</style>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
            <div class="panel_s">
              <div class="panel-body">
               <div class="row mbot15">
                <div class="col-md-12">
                  <h4 class="no-margin"><?php echo _l('Details'); ?></h4>
                </div>
             </div>
             <div class="clearfix"></div>
              <hr class="hr-panel-heading" />
              <div class="row">
              <div class="col-sm-8">
              <?php  
                foreach($val as $data) {
                    $index=array_keys($data);
                  }
                     ?>
                     <table class="table table-striped">
                         <tbody>
                             <tr><th>Order ID</th> <td><?php echo($data[$index[0]]); ?></td></tr>
                             <tr><th>Business Name</th> <td><?php echo($data[$index[11]]); ?></td></tr>
                             <tr><th>Contact Person</th> <td><?php echo($data[$index[5]]); ?></td></tr>
                             <tr><th>Contact</th> <td><?php echo($data[$index[6]]); ?></td></tr>
                             <tr><th>Email</th> <td><?php echo($data[$index[8]]); ?></td></tr>
                             <tr><th>Products Supported</th> <td><?php echo($data[$index[10]]); ?></td></tr>
                             <tr><th>	Comments</th> <td><?php echo($data[$index[18]]); ?></td></tr>




                            
                         </tbody>
                     </table>
               
              
              </div>
              <div class="col-sm-4">
              <h4 class="no-margin"><?php echo _l('Files'); ?></h4>
              <div class="clearfix"></div>
              <?php  
          foreach($val as $data) {
              $index=array_keys($data);
          }
            ?>
     <table class="table table-striped">
         <tbody>
            
             <tr><th><?php echo($index[59]); ?></th> <td><a target="_blank" href="<?= base_url().'uploads/eviction_filling/'. $data[$index[59]]?>"><?php echo($data[$index[59]])  ?> </a> 
             <?php if (isset($data[$index[59]]) && !empty($data[$index[59]]) ) {?>
              <a href="<?= base_url().'uploads/eviction_filling/'. $data[$index[59]];?>" download><p><i class='fa fa-download'></i> Download</p></a><?php }?> </td></tr>
             <tr><th><?php echo($index[60]); ?></th> <td><a target="_blank" href="<?= base_url().'uploads/eviction_filling/'. $data[$index[60]];?>"><?php echo($data[$index[60]]); ?></a>
             <?php if (isset($data[$index[60]]) && !empty($data[$index[60]]) ) {?>
              <a href="<?= base_url().'uploads/eviction_filling/'. $data[$index[60]];?>" download><p><i class='fa fa-download'></i> Download</p></a><?php }?> </td></tr>
             <tr><th><?php echo($index[61]); ?></th> <td><a target="_blank" href="<?= base_url().'uploads/eviction_filling/'. $data[$index[61]];?>"><?php echo($data[$index[61]]); ?></a>
             <?php if (isset($data[$index[61]]) && !empty($data[$index[61]]) ) {?>
              <a href="<?= base_url().'uploads/eviction_filling/'. $data[$index[61]];?>" download><p><i class='fa fa-download'></i> Download</p></a> <?php }?> </td></tr>
             <tr><th><?php echo($index[62]); ?></th> <td><a target="_blank" href="<?= base_url().'uploads/eviction_filling/'. $data[$index[62]];?>"><?php echo($data[$index[62]]) ?></a>
             <?php if (isset($data[$index[61]]) && !empty($data[$index[62]]) ) {?>
              <a href="<?= base_url().'uploads/eviction_filling/'. $data[$index[61]]?>" download><p><i class='fa fa-download'></i> Download</p></a> <?php }?> </td></tr>
     
         </tbody>
     </table>


              </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php init_tail(); ?>
</body>
</html>
