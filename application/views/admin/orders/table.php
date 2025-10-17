<?php defined('BASEPATH') or exit('No direct script access allowed');

$table_data = [
   _l('Order id'),
   _l('Order name'),
   _l('email'),
   _l(' zip'),
   _l('Primary Contact'),
   _l('State')
];
$custom_fields = get_custom_fields('physical_order', ['show_on_table' => 1]);
foreach ($custom_fields as $field) {
    array_push($table_data, $field['name']);
}
$table_data = hooks()->apply_filters('projects_table_columns', $table_data);

render_datatable($table_data, isset($class) ?  $class : 'projects', [], [
  'data-last-order-identifier' => 'projects',
  'data-default-order'  => get_table_last_order('projects'),
]);
