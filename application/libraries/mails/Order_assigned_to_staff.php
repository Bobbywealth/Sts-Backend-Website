<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_assigned_to_staff extends App_mail_template
{
    protected $for = 'staff';

    protected $staff;
    protected $evictionid;
    
    public $slug = 'order-assigned-to-staff';

    public $rel_type = 'client';

    public function __construct($evictionid, $staff)
    {
        parent::__construct();
        $this->evictionid = $evictionid;
        $this->staff  = $staff;
        $this->ci->load->library('merge_fields/staff_merge_fields');

        // For SMS
        $this->set_merge_fields('staff_merge_fields', $this->staff->staffid);
        $this->set_merge_fields('eviction_merge_fields', $this->evictionid);
    }

    public function build()
    {
        
        $this->to($this->staff->email);
    }
}
