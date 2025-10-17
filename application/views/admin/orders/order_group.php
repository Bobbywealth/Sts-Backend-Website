<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal fade" id="order_group_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button group="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo _l('Edit Order Group'); ?></span>
                    <span class="add-title"><?php echo _l('Add New Order Group'); ?></span>
                </h4>
            </div>
            <?php echo form_open('admin/order/group', array('id' => 'customer-group-modal'));  ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo render_input('name', 'customer_group_name'); ?>
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
<div class="modal fade" id="order_group_modal_assign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button group="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo _l('Allotment'); ?></span>
                </h4>
            </div>
            <?php echo form_open('admin/order/group_assign', array('id' => 'customer-group-modal_assign')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="specific_staff_notify">
                            <?php echo render_select('staff[]', $members, array('staffid', array('firstname', 'lastname')), 'Allot order to Staff', '', array('multiple' => true)); ?>
                        </div>
                        <div id="specific_client_notify">
                            <?php echo render_select('clients[]', $clients, array('userid', array('company')), 'Allot order to Clients', '', array('multiple' => true)); ?>
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
<div class="modal fade" id="order_group_modal_send_mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button group="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo _l('Send Mail'); ?></span>
                </h4>
            </div>
            <?php echo form_open('admin/order/send_mail', array('id' => 'customer-group-modal_sms')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="specific_staff_notify">
                            <?php echo render_input('subject', 'Subject'); ?>
                        </div>
                        <div id="specific_staff_notify">
                            <?php echo render_textarea('message', 'Message'); ?>
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
<div class="modal fade" id="order_group_modal_send_sms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button group="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo _l('Send SMS'); ?></span>
                </h4>
            </div>
            <?php echo form_open('admin/order/send_sms', array('id' => 'customer-group-modal_sms')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="specific_staff_notify">
                            <?php echo render_textarea('message', 'message'); ?>
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
<script>
    window.addEventListener('load', function() {
        appValidateForm($('#customer-group-modal'), {
            name: 'required'
        }, manage_customer_groups);
        appValidateForm($('#customer-group-modal_assign'), {}, manage_customer_groups);

        $('#order_group_modal').on('show.bs.modal', function(e) {
            var invoker = $(e.relatedTarget);
            var group_id = $(invoker).data('id');
            $('#order_group_modal .add-title').removeClass('hide');
            $('#order_group_modal .edit-title').addClass('hide');
            $('#order_group_modal input[name="id"]').val('');
            $('#order_group_modal input[name="name"]').val('');
            // is from the edit button
            if (typeof(group_id) !== 'undefined') {
                $('#order_group_modal input[name="id"]').val(group_id);
                $('#order_group_modal .add-title').addClass('hide');
                $('#order_group_modal .edit-title').removeClass('hide');
                $('#order_group_modal input[name="name"]').val($(invoker).parents('tr').find('td').eq(0).find('a').eq(0).text());
            }
        });
        $('#order_group_modal_assign').on('show.bs.modal', function(e) {
            var invoker = $(e.relatedTarget);
            var group_id = $(invoker).data('id');
            $('#order_group_modal_assign .add-title').removeClass('hide');
            $('#order_group_modal_assign .edit-title').addClass('hide');
            $('#order_group_modal_assign input[name="id"]').val('');
            $('#order_group_modal_assign input[name="name"]').val('');
            // is from the edit button
            if (typeof(group_id) !== 'undefined') {
                $('#order_group_modal_assign input[name="id"]').val(group_id);
                $('#order_group_modal_assign .add-title').addClass('hide');
                $('#order_group_modal_assign .edit-title').removeClass('hide');
                $('#order_group_modal_assign input[name="name"]').val($(invoker).parents('tr').find('td').eq(0).text());
            }
            
            $.ajax({ type: "GET",   
            url: "get_assigned_group/"+group_id,   
            async: false,
            success : function(text)
             {
                console.log(JSON.parse(text));
                var response  = JSON.parse(text);
                $('#order_group_modal_assign #specific_staff_notify select').selectpicker('val', response.staff_id);
                $('#order_group_modal_assign #specific_client_notify select').selectpicker('val', response.client_id);
              }
            });   
        });
        
        $('#order_group_modal_send_sms').on('show.bs.modal', function(e) {
            var invoker = $(e.relatedTarget);
            var group_id = $(invoker).data('id');
            $('#order_group_modal_send_sms .add-title').removeClass('hide');
            $('#order_group_modal_send_sms .edit-title').addClass('hide');
            $('#order_group_modal_send_sms input[name="id"]').val('');
            $('#order_group_modal_send_sms input[name="name"]').val('');
            // is from the edit button
            if (typeof(group_id) !== 'undefined') {
                $('#order_group_modal_send_sms input[name="id"]').val(group_id);
                $('#order_group_modal_send_sms .add-title').addClass('hide');
                $('#order_group_modal_send_sms .edit-title').removeClass('hide');
                $('#order_group_modal_send_sms input[name="name"]').val($(invoker).parents('tr').find('td').eq(0).find('a').eq(0).text());
            }
        });
        $('#order_group_modal_send_mail').on('show.bs.modal', function(e) {
            var invoker = $(e.relatedTarget);
            var group_id = $(invoker).data('id');
            $('#order_group_modal_send_mail .add-title').removeClass('hide');
            $('#order_group_modal_send_mail .edit-title').addClass('hide');
            $('#order_group_modal_send_mail input[name="id"]').val('');
            $('#order_group_modal_send_mail input[name="name"]').val('');
            // is from the edit button
            if (typeof(group_id) !== 'undefined') {
                $('#order_group_modal_send_mail input[name="id"]').val(group_id);
                $('#order_group_modal_send_mail .add-title').addClass('hide');
                $('#order_group_modal_send_mail .edit-title').removeClass('hide');
                $('#order_group_modal_send_mail input[name="name"]').val($(invoker).parents('tr').find('td').eq(0).find('a').eq(0).text());
            }
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
            $('#order_group_modal').modal('hide');
            $('#order_group_modal_assign').modal('hide');
        });
        return false;
    }
    
</script>