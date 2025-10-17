<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test_deployment extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Test Deployment Page';
        $this->load->view('admin/test_deployment/index', $data);
    }
}

