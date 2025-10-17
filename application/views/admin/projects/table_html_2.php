<?php

defined('BASEPATH') or exit('No direct script access allowed');

$table_data = [
   _l('the_number_sign'),
   _l('project_name'),
    [
         'name'     => _l('project_customer'),
         'th_attrs' => ['class' => isset($client) ? 'not_visible' : ''],
    ],
   _l('Amount'),
   _l('project_start_date'),
   _l('project_deadline'),
   _l('project_members'),
   _l('project_status'),
];

$custom_fields = get_custom_fields('projects', ['show_on_table' => 1]);

foreach ($custom_fields as $field) {
    array_push($table_data, [
     'name'     => $field['name'],
     'th_attrs' => ['data-type' => $field['type'], 'data-custom-field' => 1]
 ]);
}

$table_data = hooks()->apply_filters('projects_table_columns', $table_data);

$total_project_cost = 0;

 $query = $this->db->select_sum('project_cost')->get('projects');
    $result = $query->row();
    $total_project_cost = $result->project_cost;

render_projects_datatable($table_data, isset($class) ?  $class : 'projects', ['number-index-1'], [
  'data-last-order-identifier' => 'projects',
  'data-default-order'         => get_table_last_order('projects'),
],$total_project_cost);
