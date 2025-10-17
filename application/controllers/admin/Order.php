<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');
class Order extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('clients_model');
        $this->load->model('contracts_model');
    }
    public function index()
    {
        $data['group'] = $this->order_model->get_order();
        $this->load->view('admin/orders/order', $data);
    }
    public function new_order()
    {
        if ($this->input->post()) {
            $postdata = $this->input->post();
            if (isset($postdata['c_month_late'])) {
                $postdata['c_month_late'] = implode(",", $postdata['c_month_late']);
            }
            $e_id = $this->order_model->order($postdata);
            if ($e_id) {
                if (count($_FILES) > 0) {
                    handle_eviction_file_upload($e_id);
                }
                set_alert('success', _l('Form Submiited successfully'));
            }
            redirect(admin_url('order'));
        }
        $data['custumer'] = $this->order_model->get_custumer();
        $data['customer_id'] = $this->input->get('client_id') ? $this->input->get('client_id') : NULL;
        $this->load->view('admin/orders/new_order', $data);
    }
    public function new_physical_order()
    {
        if ($this->input->post()) {
            $postdata = $this->input->post();
            if (isset($postdata['eviction_fees'])) {
                $postdata['eviction_fees'] = implode(",", $postdata['eviction_fees']);
            }
            $e_id = $this->clients_model->physical_eviction($postdata);
            if ($e_id) {
                set_alert('success', _l('Form Submiited successfully'));
            }
            redirect(admin_url('order/new_physical_order'));
        }
        $data['custumer'] = $this->order_model->get_custumer();
        $data['customer_id'] = $this->input->get('client_id') ? $this->input->get('client_id') : NULL;
        $this->load->view('admin/orders/new_physical_order', $data);
    }
    public function new_other_order()
    {
        if ($this->input->post()) {
            $postdata = $this->input->post();
            if (isset($postdata['eviction_fees'])) {
                $postdata['eviction_fees'] = implode(",", $postdata['eviction_fees']);
            }
            $e_id = $this->clients_model->other_services($postdata);
            if ($e_id) {
                set_alert('success', _l('Form Submiited successfully'));
            }
            redirect(admin_url('order/new_other_order'));
        }
        $data['custumer'] = $this->order_model->get_custumer();
        $data['customer_id'] = $this->input->get('client_id') ? $this->input->get('client_id') : NULL;
        $this->load->view('admin/orders/new_other_order', $data);
    }
    public function table($clientid = '')
    {
        $this->app->get_table_data('order', [
            'clientid' => $clientid,
        ]);
    }
    public function physical_table($clientid = '')
    {
        $this->app->get_table_data('physical_order', [
            'clientid' => $clientid,
        ]);
    }
    public function other_table($clientid = '')
    {
        $this->app->get_table_data('other_order', [
            'clientid' => $clientid,
        ]);
    }
    public function order_edit($view_id = '')
    {
        $data['val'] = $this->order_model->fetchorder($view_id);
        $data['group'] = $this->order_model->get_order();
        $this->load->view('admin/orders/order_edit', $data);
        if ($this->input->post()) {
            $postdata = $this->input->post();
            if (isset($postdata['c_month_late'])) {
                $postdata['c_month_late'] = implode(",", $postdata['c_month_late']);
            }
            $edit_id = $this->order_model->order_edit($postdata, $view_id);
            if ($edit_id) {
                if (count($_FILES) > 0) {
                    handle_eviction_file_upload($view_id);
                }
                set_alert('success', _l('Form Edited successfully'));
            }
            redirect(admin_url('order'));
        }
    }
    public function order_physical_edit($view_id = '')
    {
        $data['custumer'] = $this->order_model->get_custumer();
        $data['customer_id'] = $this->input->get('client_id') ? $this->input->get('client_id') : NULL;
        $data['val'] = $this->order_model->fetchorder_physical($view_id);
        $data['group'] = $this->order_model->get_order();
        $this->load->view('admin/orders/new_physical_order', $data);
        if ($this->input->post()) {
            $postdata = $this->input->post();
            if (isset($postdata['eviction_fees'])) {
                $postdata['eviction_fees'] = implode(",", $postdata['eviction_fees']);
            }
            $edit_id = $this->order_model->order_physical_edit($postdata, $view_id);
            if ($edit_id) {
                set_alert('success', _l('Form Edited successfully'));
            }
            redirect(admin_url('order/physical_order'));
        }
    }
    public function order_other_edit($view_id = '')
    {
        $data['custumer'] = $this->order_model->get_custumer();
        $data['customer_id'] = $this->input->get('client_id') ? $this->input->get('client_id') : NULL;
        $data['val'] = $this->order_model->fetchorder_other($view_id);
        $data['group'] = $this->order_model->get_order();
        $this->load->view('admin/orders/new_other_order', $data);
        if ($this->input->post()) {
            $postdata = $this->input->post();
            if (isset($postdata['eviction_fees'])) {
                $postdata['eviction_fees'] = implode(",", $postdata['eviction_fees']);
            }
            $edit_id = $this->order_model->order_other_edit($postdata, $view_id);
            if ($edit_id) {
                set_alert('success', _l('Form Edited successfully'));
            }
            redirect(admin_url('order/other_order'));
        }
    }
    public function delete($del_id = '')
    {
        if (has_permission('projects', '', 'delete')) {
            $success = $this->order_model->delete($del_id);
            if ($success) {
                set_alert('success', _l('deleted', _l('Order')));
                redirect(admin_url('order'));
            }
        }
    }
    public function physical_delete($del_id = '')
    {
        if (has_permission('projects', '', 'delete')) {
            $success = $this->order_model->physical_delete($del_id);
            if ($success) {
                set_alert('success', _l('deleted', _l('Order')));
                redirect(admin_url('order/physical_order'));
            }
        }
    }
    public function other_delete($del_id = '')
    {
        if (has_permission('projects', '', 'delete')) {
            $success = $this->order_model->other_delete($del_id);
            if ($success) {
                set_alert('success', _l('deleted', _l('Order')));
                redirect(admin_url('order/other_order'));
            }
        }
    }
    public function order_view($view_id = '')
    {
        $fetchdata['val'] = $this->order_model->fetchorder($view_id);
        $this->load->view('admin/orders/order_view', $fetchdata);
    }
    public function groups()
    {
        $data['members'] = $this->staff_model->get('', [
            'active'       => 1,
            'is_not_staff' => 0,
            'admin' => 0
        ]);
        $data['clients'] = $this->order_model->get_client();
        if (!is_admin()) {
            access_denied('Customer Groups');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('orders_group');
        }
        $data['title'] = _l('order groups');
        $this->load->view('admin/orders/group_manage', $data);
    }
    public function group()
    {
        if (!is_admin() && get_option('staff_members_create_inline_order groups') == '0') {
            access_denied('Customer Groups');
        }
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            if ($data['id'] == '') {
                $response      = $this->order_model->add_group($data);
                $message = $response ? _l('added_successfully', _l('order group')) : '';
                echo json_encode([
                    'success' => $response ? true : false,
                    'message' => $message,
                    'id'      => $response,
                    'name'    => $data['name'],
                ]);
            } else {
                $success = $this->order_model->edit_group($data);
                $message = '';
                if ($success == true) {
                    $message = _l('updated_successfully', _l('order group'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                ]);
            }
        }
    }

    public function delete_group($id)
    {
        if (!is_admin()) {
            access_denied('Delete Customer Group');
        }
        if (!$id) {
            redirect(admin_url('order/groups'));
        }
        $response = $this->order_model->delete_group($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('order group')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('order group_lowercase')));
        }
        redirect(admin_url('order/groups'));
    }
    public function group_assign()
    {
        if (!is_admin() && get_option('staff_members_create_inline_order groups') == '0') {
            access_denied('Customer Groups');
        }
        $response = array('staff_status' => false, 'client_status' => false, 'message' => '');
        if ($this->input->is_ajax_request()) {
            // $data = $this->input->post();
            $data = array(
                'group_id' => $this->input->post('id'),
                'client_id' => implode(",", $this->input->post('clients')),
                'staff_id' => implode(",", $this->input->post('staff')),
            );
            $success = $this->order_model->group_assign_add($data);
            $message = '';
            if ($success == true) {
                $message = _l('Added successfully', _l('order group'));
            }
            echo json_encode([
                'success' => $success,
                'message' => $message,
            ]);
        }
    }
    public function physical_order()
    {
        $data['group'] = $this->order_model->get_order();
        $this->load->view('admin/orders/physical_order', $data);
    }
    public function order_physical_view($view_id = '')
    {
        $fetchdata['val'] = $this->order_model->fetchorder_physical($view_id);
        $this->load->view('admin/orders/order_physical_view', $fetchdata);
    }
    public function other_order()
    {
        $data['group'] = $this->order_model->get_order();
        $this->load->view('admin/orders/other_order', $data);
    }
    public function order_other_view($view_id = '')
    {
        $fetchdata['val'] = $this->order_model->fetchorder_other($view_id);
        $this->load->view('admin/orders/order_other_view', $fetchdata);
    }
    public function client_eviction_order()
    {
        $this->load->view('admin/orders/table', array('class' => 'order-single-client'));
    }
    public function group_assign_to_order(){
        if ($this->input->is_ajax_request()) {
             $id = $this->input->post('id');
             $group_id = $this->input->post('group_id');
            $success = $this->order_model->group_assign_to_order($id,$group_id);
            $message = '';
            if ($success == true) {
                $message = _l('Added successfully', _l('order group'));
            }
            echo json_encode([
                'success' => $success,
                'message' => $message,
            ]);
        }
    }
    public function group_assign_to_order_one(){
        if ($this->input->is_ajax_request()) {
             $id = $this->input->post('id');
             $group_id = $this->input->post('group_id');
            $success = $this->order_model->group_assign_to_order_one($id,$group_id);
            $message = '';
            if ($success == true) {
                $message = _l('Added successfully', _l('order group'));
            }
            echo json_encode([
                'success' => $success,
                'message' => $message,
            ]);
        }
    }
    public function group_assign_to_order_two(){
        if ($this->input->is_ajax_request()) {
             $id = $this->input->post('id');
             $group_id = $this->input->post('group_id');
            $success = $this->order_model->group_assign_to_order_two($id,$group_id);
            $message = '';
            if ($success == true) {
                $message = _l('Added successfully', _l('order group'));
            }
            echo json_encode([
                'success' => $success,
                'message' => $message,
            ]);
        }
    }
    public function send_sms()
    {
        if ($this->input->post()) {
            $postdata = $this->input->post();
            $this->db->where('id', $this->input->post('id'));
            $group_details = $this->db->get(db_prefix().'orders_group')->row();
            
            
            $this->db->where('group_id', $this->input->post('id'));
            $group = $this->db->get(db_prefix().'orders_group_assign')->row();
            
                if(!empty($group->client_id)){
                    $cleints = explode(',', $group->client_id);
                }
                if(!empty($group->staff_id)){
                    $staffs = explode(',', $group->staff_id);
                }
               
                if(!empty($cleints)) {
                    foreach($cleints as $client){
                        
                        $this->db->where('userid', $client)
                            ->where('is_primary', 1);
    
                        $primary = $this->db->get(db_prefix() . 'contacts')->row();
                        
                        $template = 'order-assigned-to-client';
                        if(!empty($primary->phonenumber)){
                            
                            $a = $this->app_sms->trigger_custom(SMS_TRIGGER_CLIENT_EVICTION_FORM, $primary->phonenumber, $this->input->post('message'));
                        }
                    }
                }
                
                
                if(!empty($staffs)) {
                    foreach($staffs as $staff){
                        
                        $this->db->where('staffid', $staff);
    
                        $primary = $this->db->get(db_prefix() . 'staff')->row();
                        
                        
                        $template = 'order-assigned-to-staff';
                        if(!empty($primary->phonenumber)){
                            
                            $b=  $this->app_sms->trigger_custom(SMS_TRIGGER_STAFF_EVICTION_FORM, $primary->phonenumber,$this->input->post('message'));
                            
                        }
                    }
                }
                if(!empty($a) || !empty($b)){
                    set_alert('success', _l('SMS sent successfully'));
                }else{
                    set_alert('danger', _l('SMS could not be sent'));
                }
                
            
            redirect(admin_url('order/groups'));
        }
        
    }
    public function send_mail()
    {
        $this->load->model('emails_model');
        if ($this->input->post()) {
            $postdata = $this->input->post();
            $this->db->where('id', $this->input->post('id'));
            $group_details = $this->db->get(db_prefix().'orders_group')->row();
            
            
            $this->db->where('group_id', $this->input->post('id'));
            $group = $this->db->get(db_prefix().'orders_group_assign')->row();
            
                if(!empty($group->client_id)){
                    $cleints = explode(',', $group->client_id);
                }
                if(!empty($group->staff_id)){
                    $staffs = explode(',', $group->staff_id);
                }
                
                if(!empty($cleints)) {
                    foreach($cleints as $client){
                        
                        $this->db->where('userid', $client)
                            ->where('is_primary', 1);
    
                        $primary = $this->db->get(db_prefix() . 'contacts')->row();
                        
                        $template = 'order-assigned-to-client';
                        
                        if(!empty($primary->email)){
                            
                           $a =  $this->emails_model->send_simple_email($primary->email, $this->input->post('subject'), $this->input->post('message'));
                            
                            
                            
                            
                        }
                    }
                }
                
                
                if(!empty($staffs)) {
                    foreach($staffs as $staff){
                        
                        $this->db->where('staffid', $staff);
    
                        $primary = $this->db->get(db_prefix() . 'staff')->row();
                        
                        
                        $template = 'order-assigned-to-staff';
                        if(!empty($primary->email)){
                            
                           $b =  $this->emails_model->send_simple_email($primary->email, $this->input->post('subject'), $this->input->post('message'));
                            
                        }
                    }
                }
            
                if(!empty($a) || !empty($b)){
                    set_alert('success', _l('Mail sent successfully'));
                }else{
                    set_alert('danger', _l('Mail could not be sent'));
                }
            
            redirect(admin_url('order/groups'));
        }
        
    }
    
    public function get_assigned_group($group_id){
    $a_val=$this->order_model->get_assigned_group($group_id);
    $client_id = $a_val->client_id;
    $staff_id = $a_val->staff_id;
    echo json_encode([
      'success' => $a_val ? true : false,
      'client_id'      => explode(',',$client_id),
      'staff_id'      => explode(',', $staff_id), 
   ]);
  } 
  public function get_assigned_group_eviction($g_id){
      $e_id=$this->order_model->get_assigned_group_eviction($g_id);
      $gp_id= $e_id->group_id;
      echo json_encode([
        'success' => $e_id ? true : false,
        'gp_id'      => $gp_id,
    ]);
  } 
    public function get_assigned_group_physical($g_id){
      $e_id=$this->order_model->get_assigned_group_physical($g_id);
      $gp_id= $e_id->group_id;
      echo json_encode([
        'success' => $e_id ? true : false,
        'gp_id'      => $gp_id,
    ]);
   } 
    public function get_assigned_group_other($g_id){
      $e_id=$this->order_model->get_assigned_group_other($g_id);
      $gp_id= $e_id->group_id;
      echo json_encode([
        'success' => $e_id ? true : false,
        'gp_id'      => $gp_id,
    ]);
  } 
}
