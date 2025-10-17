<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="modal fade" id="order_group_modal_assign_group_one" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button group="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo _l('Assign Group'); ?></span>
                </h4>
            </div>
            <?php echo form_open('admin/order/group_assign_to_order_one', array('id' => 'assign_group_order_one'));  ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="group_name">
                            <?php  echo render_select('group_id', $group, ['id', 'name'], _l('Select Group *')); ?>
                        </div>
                        <?php echo form_hidden('id'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button group="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button group="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
            <div class="panel_s">
              <div class="panel-body">
              <div class="_buttons"> 
              <?php if(has_permission('projects','','create')){ ?>
                <a href="<?php echo admin_url('order/new_other_order'); ?>" class="btn btn-info pull-left display-block mright5">
                  <?php echo _l('New Other Orders'); ?>
                </a>
              <?php } ?>
                <div class="clearfix"></div>
                <hr class="hr-panel-heading" />
              </div>
               <div class="row mbot15">
                <div class="col-md-12">
                  <h4 class="no-margin"><?php echo _l('Order Summary'); ?></h4>
                </div>
             </div>
             <div class="clearfix"></div>
              <hr class="hr-panel-heading" />
             <?php echo form_hidden('custom_view'); ?>
             <?php $this->load->view('admin/orders/other_table'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php init_tail(); ?>
<script>
   window.addEventListener('load', function() {
        appValidateForm($('#assign_group_order_one'), {
            name: 'required'
        }, manage_customer_groups);
        appValidateForm($('#assign_group_order_one_assign'), {}, manage_customer_groups);

        $('#order_group_modal_assign_group_one').on('show.bs.modal', function(e) {
            var invoker = $(e.relatedTarget);
            var g_id = $(invoker).data('id');
            $('#order_group_modal_assign_group_one .add-title').removeClass('hide');
            $('#order_group_modal_assign_group_one .edit-title').addClass('hide');
            $('#order_group_modal_assign_group_one input[name="id"]').val('');
            $('#order_group_modal_assign_group_one input[name="name"]').val('');
            // is from the edit button
            if (typeof(g_id) !== 'undefined') {
                $('#order_group_modal_assign_group_one input[name="id"]').val(g_id);
                $('#order_group_modal_assign_group_one .add-title').addClass('hide');
                $('#order_group_modal_assign_group_one .edit-title').removeClass('hide');
                $('#order_group_modal_assign_group_one input[name="name"]').val($(invoker).parents('tr').find('td').eq(0).find('a').eq(0).text());
            }
            
            $.ajax({ type: "GET",   
            url: "get_assigned_group_other/"+g_id,   
            async: false,
            success : function(text)
             {  
              console.log(JSON.parse(text));
                var response  = JSON.parse(text);
                $('#order_group_modal_assign_group_one #group_name select').selectpicker('val', response.gp_id);
              }
            });  
        });
    });

    function manage_customer_groups(form) {
        var data = $(form).serialize();
        var url = form.action;
        $.post(url, data).done(function(response) {
            response = JSON.parse(response);
            if (response.success) {
                alert_float('success', response.message);
            }
            $('#order_group_modal_assign_group_one').modal('hide');
        });
        return false;
    }
$(function(){
     var ProjectsServerParams = {};
     $.each($('._hidden_inputs._filters input'),function(){
         ProjectsServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
     });
     initDataTable('.table-projects', admin_url+'order/other_table', undefined, undefined, ProjectsServerParams, <?php echo hooks()->apply_filters('projects_table_default_order', json_encode(array(5,'asc'))); ?>);
    
});
</script>
</body>
</html>
