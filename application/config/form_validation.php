<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'accounts/manage' => array(
        array(
            'field' => 'name',
            'label' => 'Account Name',
            'rules' => "trim|required|max_length[100]"
        ),
        array(
            'field' => 'phone',
            'label' => 'Contact No.',
            'rules' => "trim|required|exact_length[10]|is_natural|callback__unique_phone_check"
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => "trim|valid_email|max_length[120]|callback__unique_email_check"
        ),
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|max_length[255]'
        ),        
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|max_length[1000]'
        )
    ),
    'payments/manage' => array(
        array(
            'field' => 'account',
            'label' => 'Account Name',
            'rules' => "trim|required"
        ),
        array(
            'field' => 'amount',
            'label' => 'Amount',
            'rules' => 'trim|required|is_numeric'
        ),
        array(
            'field' => 'note',
            'label' => 'Note',
            'rules' => 'trim|max_length[255]'
        )
    ),
    'actions' => array(
        array(
            'field' => 'ids[]',
            'label' => 'Select checkbox',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'actions',
            'label' => 'Actions',
            'rules' => 'trim|required'
        )
    )
);
$config['error_prefix'] = '<div class="text-danger v_error">';
$config['error_suffix'] = '</div>';
