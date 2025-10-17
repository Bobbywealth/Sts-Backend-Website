<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Eviction_merge_fields extends App_merge_fields
{
    public function build()
    {
        return [
                [
                    'name'      => 'Eviction Form Fname',
                    'key'       => '{eviction_form_fname}',
                    'available' => [
                        'client'
                    ],
                       'templates' => [
                        'order-assigned-to-client'

                    ],
                ],
                
                [
                    'name'      => 'Eviction Form Lname',
                    'key'       => '{eviction_form_lname}',
                    'available' => [
                        'client'
                    ],
                       'templates' => [
                        'order-assigned-to-client'

                    ],
                ],
                
                [
                    'name'      => 'Eviction Form Email',
                    'key'       => '{eviction_form_email}',
                    'available' => [
                        'client'
                    ],
                       'templates' => [
                        'order-assigned-to-client'

                    ],
                ],
                
                
            ];
    }

    /**
     * Merge fields for Contacts and Customers
     * @param  mixed $client_id
     * @param  string $contact_id
     * @param  string $password   password is used when sending welcome email, only 1 time
     * @return array
     */
    public function format($evic_id)
    {
        $fields = [];

        if ($evic_id != '') {
            $evic = get_eviction($evic_id);
        }

        $fields['{eviction_form_fname}']                 = $evic->o_fname;
        $fields['{eviction_form_lname}']                 = $evic->o_lname;
        $fields['{eviction_form_email}']                 = $evic->o_email;
        
        
        
        return hooks()->apply_filters('eviction_merge_fields', $fields, [
            
    ]);
    }

    /**
 * Statement merge fields
 * @param  array $statement
 * @return array
 */
    public function statement($statement)
    {
        $fields = [];

        $fields['{statement_from}']              = _d($statement['from']);
        $fields['{statement_to}']                = _d($statement['to']);
        $fields['{statement_balance_due}']       = app_format_money($statement['balance_due'], $statement['currency']->name);
        $fields['{statement_amount_paid}']       = app_format_money($statement['amount_paid'], $statement['currency']->name);
        $fields['{statement_invoiced_amount}']   = app_format_money($statement['invoiced_amount'], $statement['currency']->name);
        $fields['{statement_beginning_balance}'] = app_format_money($statement['beginning_balance'], $statement['currency']->name);

        return hooks()->apply_filters('client_statement_merge_fields', $fields, [
            'statement' => $statement,
         ]);
    }

    /**
     * Password merge fields
     * @param  array $data
     * @param  string $type  template type
     * @return array
     */
    public function password($data, $type)
    {
        $fields['{reset_password_url}'] = '';
        $fields['{set_password_url}']   = '';

        if ($type == 'forgot') {
            $fields['{reset_password_url}'] = site_url('authentication/reset_password/0/' . $data['userid'] . '/' . $data['new_pass_key']);
        } elseif ($type == 'set') {
            $fields['{set_password_url}'] = site_url('authentication/set_password/0/' . $data['userid'] . '/' . $data['new_pass_key']);
        }

        return $fields;
    }
}
