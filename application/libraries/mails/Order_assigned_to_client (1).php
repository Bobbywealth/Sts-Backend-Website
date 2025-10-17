<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_assigned_to_client extends App_mail_template
{
    protected $for = 'customer';

    protected $client_id;
    protected $evictionid;
    protected $contact;

    public $slug = 'order-assigned-to-client';

    public $rel_type = 'client';

    public function __construct($evictionid, $client_id, $contact)
    {
        parent::__construct();
        $this->evictionid = $evictionid;
        $this->client_id  = $client_id;
        $this->contact    = $contact;
        
        $this->ci->load->library('merge_fields/client_merge_fields');

        // For SMS
        $this->set_merge_fields('client_merge_fields', $this->client_id, $this->contact->id);
        $this->set_merge_fields('eviction_merge_fields', $this->evictionid);
    }

    public function build()
    {
        /*if(!empty($this->contact->email))
        print_r($this->contact->email);die;*/
        $this->to($this->contact->email);
    }
}
