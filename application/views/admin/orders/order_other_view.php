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
                             <tr><th>Property NAme</th> <td><?php echo($val->p_property_name); ?></td></tr>
                             <tr><th>Address 1</th> <td><?php echo($val->p_address_one); ?></td></tr>
                             <tr><th>Address 2</th> <td><?php echo($val->p_address_two); ?></td></tr>
                             <tr><th>City</th> <td><?php echo($val->P_city); ?></td></tr>
                             <tr><th>State</th> <td><?php echo($val->P_state); ?></td></tr>
                             <tr><th>Zip</th> <td><?php echo($val->P_zip); ?></td></tr>
                             <tr><th>Country</th> <td><?php echo($val->P_country); ?></td></tr>
                             <tr><th>Special Instruction</th> <td><?php echo($val->P_special_instruction); ?></td></tr>
                             <tr><th>Declearation</th> <td><?php echo($val->p_declear); ?></td></tr>
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
