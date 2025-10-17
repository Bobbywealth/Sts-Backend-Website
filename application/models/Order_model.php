<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_groups_model');
    }
    public function order($postdata){
        $this->db->insert(db_prefix() . 'eviction_filling', $postdata);
         return $this->db->insert_id();
     }
     public function fetchorder($view_id){
       return $this->db->query('SELECT * FROM ' . db_prefix() . 'eviction_filling where evic_id='. $view_id . '')->result_array();
       
     }
     public function fetchorder_physical($view_id){
        return $this->db->get_where(db_prefix() . 'physical_eviction', ['id' => $view_id])->row();
      }
      public function fetchorder_other($view_id){
        return $this->db->get_where(db_prefix() . 'other_services', ['id' => $view_id])->row();
      }
     public function delete($del_id)
    {
        $project_name = get_project_name_by_id($del_id);
        $this->db->where('evic_id', $del_id);
        $this->db->delete(db_prefix() . 'eviction_filling');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }
    public function physical_delete($del_id)
    {
        $this->db->where('id', $del_id);
        $this->db->delete(db_prefix() . 'physical_eviction');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }
    public function other_delete($del_id)
    {
        $this->db->where('id', $del_id);
        $this->db->delete(db_prefix() . 'other_services');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }
    public function order_edit($postdata, $view_id){
        $this->db->where('evic_id', $view_id);
        $this->db->update(db_prefix() . 'eviction_filling', $postdata);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
     }
     public function order_physical_edit($postdata, $view_id){
        $this->db->where('id', $view_id);
        $this->db->update(db_prefix() . 'physical_eviction', $postdata);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
     }
     public function order_other_edit($postdata, $view_id){
        $this->db->where('id', $view_id);
        $this->db->update(db_prefix() . 'other_services', $postdata);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
     }
       /**
     * Get customer groups where customer belongs
     * @param  mixed $id customer id
     * @return array
     */
    public function get_customer_groups($id)
    {
        return $this->client_groups_model->get_customer_groups($id);
    }

    /**
     * Get all customer groups
     * @param  string $id
     * @return mixed
     */
    public function get_groups($id = '')
    {
        return $this->client_groups_model->get_groups($id);
    }

    /**
     * Delete customer groups
     * @param  mixed $id group id
     * @return boolean
     */
    public function delete_group($id)
    {
        return $this->order_groups_model->delete($id);
    }

    /**
     * Add new customer groups
     * @param array $data $_POST data
     */
    public function add_group($data)
    {
        return $this->order_groups_model->add($data);
    }

    /**
     * Edit customer group
     * @param  array $data $_POST data
     * @return boolean
     */
    public function edit_group($data)
    {
        return $this->order_groups_model->edit($data);
    }

    public function get_client($id = '', $where = [])
    {
        $select_str = '*,company';
        $this->db->select($select_str);
        $this->db->where($where);

        if (is_numeric($id)) {
            $this->db->where('userid', $id);
            $staff = $this->db->get(db_prefix() . 'clients')->row();

            if ($staff) {
                $staff->permissions = $this->get_staff_permissions($id);
            }

            return $staff;
        }
        $this->db->order_by('company', 'desc');

        return $this->db->get(db_prefix() . 'clients')->result_array();
    }
    public function get_order($id = '', $where = [])
    {
        $select_str = '*,name';
        $this->db->select($select_str);
        $this->db->where($where);

        if (is_numeric($id)) {
            $this->db->where('id', $id);
            $group = $this->db->get(db_prefix() . 'orders_group')->row();
            return $group;
        }
        $this->db->order_by('name', 'desc');

        return $this->db->get(db_prefix() . 'orders_group')->result_array();
    }
    public function get_custumer($id = '', $where = [])
    {
        $select_str = '*,company';
        $this->db->select($select_str);
        $this->db->where($where);

        if (is_numeric($id)) {
            $this->db->where('id', $id);
            $group = $this->db->get(db_prefix() . 'clients')->row();
            return $group;
        }
        $this->db->order_by('userid', 'desc');

        return $this->db->get(db_prefix() . 'clients')->result_array();
    }
    public function group_assign_add($data){
    $this->db->where('group_id', $data['group_id']);
    $group = $this->db->get(db_prefix() . 'orders_group_assign')->row();
    if ($group)
    {
        $this->db->where('group_id', $data['group_id']);
        $this->db->update(db_prefix() . 'orders_group_assign', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }   
    }
    else{
        $this->db->insert(db_prefix().'orders_group_assign', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return true;
        }    
    }
}
    public function get_all_client(){
        return $this->db->query('SELECT company FROM ' . db_prefix() . 'clients')->result_array();
    }
    public function group_assign_to_order($id,$group_id){
        $this->db->where('evic_id', $id);
        $this->db->update(db_prefix() . 'eviction_filling', ['group_id'=>$group_id]);
        if ($this->db->affected_rows() > 0) {
            $this->db->where('evic_id', $id);
            $evic = $this->db->get(db_prefix().'eviction_filling')->row();
            
            if(!empty($evic->group_id)){
                $this->db->where('group_id', $evic->group_id);
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
                        
                        
                        if(!empty($primary->email)){
                            
                            $template = 'order-assigned-to-client';
                            $sent = send_mail_template(str_replace('-', '_', $template), $evic->evic_id, $client, $primary);
                            
                            
                            
                        }
                        if(!empty($primary->phonenumber)){
                            
                           
                            $template1 = mail_template(str_replace('-', '_', $template), $evic->evic_id, $client, $primary);
                            $this->app_sms->trigger(SMS_TRIGGER_CLIENT_EVICTION_FORM, $primary->phonenumber, $template1->get_merge_fields());
                        }
                    }
                }
                
                
                if(!empty($staffs)) {
                    foreach($staffs as $staff){
                        
                        $this->db->where('staffid', $staff);
    
                        $primary = $this->db->get(db_prefix() . 'staff')->row();
                        
                        
                        if(!empty($primary->email)){
                            $template = 'order-assigned-to-staff';
                            $sent = send_mail_template(str_replace('-', '_', $template), $evic->evic_id, $primary);
                            
                        }
                        
                        if(!empty($primary->phonenumber)){
                            
                           
                            $template1 = mail_template(str_replace('-', '_', $template), $evic->evic_id, $primary);
                            $a=  $this->app_sms->trigger(SMS_TRIGGER_STAFF_EVICTION_FORM, $primary->phonenumber,$template1->get_merge_fields());
                            
                        }
                    }
                }
            }
            return true;
        }   
    }
    public function group_assign_to_order_one($id,$group_id){
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'other_services', ['group_id'=>$group_id]);
        if ($this->db->affected_rows() > 0) {
            return true;
        }   
    }
    public function group_assign_to_order_two($id,$group_id){
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'physical_eviction', ['group_id'=>$group_id]);
        if ($this->db->affected_rows() > 0) {
            return true;
        }   
    }
    
    public function get_assigned_group($group_id){
        return $this->db->query('SELECT * FROM ' . db_prefix() . 'orders_group_assign WHERE group_id = '.$group_id)->row();
     }
     public function get_assigned_group_eviction($g_id){
       return $this->db->query('SELECT group_id FROM ' . db_prefix() . 'eviction_filling WHERE evic_id = '.$g_id)->row(); 
     }
     public function get_assigned_group_physical($g_id){
        return $this->db->query('SELECT group_id FROM ' . db_prefix() . 'physical_eviction WHERE id = '.$g_id)->row(); 
      }
      public function get_assigned_group_other($g_id){
        return $this->db->query('SELECT group_id FROM ' . db_prefix() . 'other_services WHERE id = '.$g_id)->row(); 
      }

}
