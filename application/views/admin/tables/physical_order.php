<?php
defined('BASEPATH') or exit('No direct script access allowed');
$hasPermissionEdit   = has_permission('projects', '', 'edit');
$hasPermissionDelete = has_permission('projects', '', 'delete');
$hasPermissionCreate = has_permission('projects', '', 'create');
$aColumns = [
    'id',
    'o_name',
    'o_email',
    'o_contact',
    'e_case_number',
    'e_date',
    
    
    ];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'physical_eviction';
$join = [];
$where  = [];
$filter = [];
if ($clientid != '') {
    array_push($where, ' AND client_id=' . $this->ci->db->escape_str($clientid));
}

if (!has_permission('projects', '', 'view') || $this->ci->input->post('my_projects')) {
    array_push($where, ' AND ' . db_prefix() . 'projects.id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id=' . get_staff_user_id() . ')');
}
$statusIds = [];
if (count($filter) > 0) {
    array_push($where, 'AND (' . prepare_dt_filter($filter) . ')');
}
$custom_fields = get_table_custom_fields('projects');
foreach ($custom_fields as $key => $field) {
    $selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
    array_push($customFieldsColumns, $selectAs);
    array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
}
$aColumns = hooks()->apply_filters('projects_table_sql_columns', $aColumns);
// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
]);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = $aRow['id'];
    $name = '<a href="#">' . $aRow['o_name'] . '</a>';
    $name .= '<div class="row-options">';
    $name .= '<a href="' . admin_url('order/order_physical_view/' . $aRow['id']) . '">' . _l('view') . '</a>';
    if ($hasPermissionEdit) {
        $name .= ' | <a href="' . admin_url('order/order_physical_edit/' . $aRow['id']) . '">' . _l('edit') . '</a>';
    }
    if ($hasPermissionDelete) {
        $name .= ' | <a href="' . admin_url('order/physical_delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    if ($hasPermissionEdit) {
        $name .= ' | <a href="#" data-toggle="modal" data-target="#order_group_modal_assign_group_two" data-id="' . $aRow['id'] . '">' . _l('Assign to Group') . '</a>';
    }
    $name .= '</div>';
    $row[] = $name;
    $row[] = $aRow['o_email'];
    $row[] = $aRow['o_contact'];
    $row[] = $aRow['e_case_number'];
    $row[] = $aRow['e_date'];
    $row = hooks()->apply_filters('projects_table_row_data', $row, $aRow);

    $output['aaData'][] = $row;
}
