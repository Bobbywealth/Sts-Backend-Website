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
              <div class="col-sm-12">
                     <table class="table table-striped">
                         <tbody>
                             <tr><th>ID</th> <td><?php echo($val->id); ?></td></tr>
                             <tr><th>Name</th> <td><?php echo($val->o_name); ?></td></tr>
                             <tr><th>Email</th> <td><?php echo($val->o_email); ?></td></tr>
                             <tr><th>Contact</th> <td><?php echo($val->o_contact); ?></td></tr>
                             <tr><th>Products Supported</th> <td><?php echo($val->e_case_number); ?></td></tr>
                          
                             <tr><th>Rating</th> <td><?php echo($val->e_street_address); ?></td></tr>
                             <tr><th>Rating</th> <td><?php echo($val->e_city); ?></td></tr>
                             <!-- <tr><th>State</th> <td><?php echo($val->e_state); ?></td></tr> -->
                           
<!--                            
                             <tr><th>Eviction Fees</th> <td><?php echo($val->eviction_fees); ?></td></tr>
                             <tr><th>Bedrooms</th> <td><?php echo($val->e_declear); ?></td></tr> -->
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