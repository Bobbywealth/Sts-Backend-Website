<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">

            <?php echo $this->import->downloadSampleFormHtml(); ?>
            <?php echo $this->import->maxInputVarsWarningHtml(); ?>

            <?php if(!$this->import->isSimulation()) { ?>
              <?php echo $this->import->importGuidelinesInfoHtml(); ?>
              <?php echo $this->import->createSampleTableHtml(); ?>
            <?php } else { ?>
              <?php echo $this->import->simulationDataInfo(); ?>
              <?php echo $this->import->createSampleTableHtml(true); ?>
            <?php } ?>
            <div class="row">
              <div class="col-md-4">
                <?php echo form_open_multipart($this->uri->uri_string(),array('id'=>'import_order')) ;?>
                <?php echo form_hidden('orders_import','true'); ?>
                <?php echo render_input('file_csv','choose_csv_file','','file'); ?>
            
                <div class="form-group">
                  <button type="button" class="btn btn-info import btn-import-order-submit"><?php echo _l('import'); ?></button>
                  <button type="button" class="btn btn-info simulate btn-import-order-submit"><?php echo _l('simulate_import'); ?></button>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
 $(function(){
    appValidateForm($('#import_order'),{file_csv:{required:true,extension: "csv"},source:'required',status:'required'});
    $('.btn-import-order-submit').on('click', function () {
        if ($(this).hasClass('simulate')) {
            $('#import_order').append(hidden_input('simulate', true));
        }
        $('#import_order').submit();
    });
 });
</script>
</body>
</html>
