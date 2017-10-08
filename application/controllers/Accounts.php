<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Accounts
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounts extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->allow();
        $this->layout->set_layout("layout_main");
        $this->load->model(array("account"));
    }

    public function index() {
        $this->load->model('transaction');
        $condition = array();
        $result = $this->account->get_list($condition);
        if ($this->input->get('download') == 'report') {
            $csv_array[] = array('name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'description' => 'Description', 'created' => 'Created');
            foreach ($result->result() as $row) {
                $this->load->helper('csv');
                $other_contact = $row->secondary_contacts != "" ? ',' . $row->secondary_contacts : "";
                $csv_array[] = array('name' => $row->name, 'phone' => "$row->phone $other_contact", 'email' => $row->email, 'description' => $row->description, 'created' => $row->created);
            }
            array_to_csv($csv_array, 'AccountList.csv');
            exit();
        }
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Account list";
        $this->viewData['datatable_asset'] = true;
        $this->layout->view("account/index", $this->viewData);
    }

    public function manage($id = null) {
        $secondary_phone = array();
        if ($this->input->post('secondary') != "") {
            $secondary_phone = $this->input->post('secondary');
        }
        $this->viewData['secondary_phone'] = $secondary_phone;


        $this->load->config('form_validation');
        $validation = $this->config->item('accounts/manage');
        if ($secondary_phone != "") {
            foreach ($secondary_phone as $k => $sec) {
                $validation[] = array(
                    'field' => "secondary[$k]",
                    'label' => 'Phone Number',
                    'rules' => 'trim|required|exact_length[10]|is_natural|callback__unique_phone_check'
                );
            }
        }
        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "name" => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                "description" => $this->input->post('description')
            );
            $data['secondary_contacts'] = NULL;
            if ($this->input->post('secondary') != "") {
                $data['secondary_contacts'] = implode(',', $this->input->post('secondary'));
            }
            if ($this->input->post('id') > 0) {
                $data['updated'] = date("Y-m-d H:i:s");
                $this->db->update("accounts", $data, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", getLangText('AccountUpdateSuccess'));
            } else {
                $data['created'] = date("Y-m-d H:i:s");
                $data['status'] = '1';
                $this->db->insert("accounts", $data);
                $this->session->set_flashdata("success", getLangText('AccountAddSuccess'));
            }
            redirect("accounts");
        }
        $this->viewData['title'] = "Add Account";
        if ($id > 0) {
            $this->viewData['data'] = $data = $this->account->getById((int) $id);
            if (empty($data)) {
                $this->session->set_flashdata("error", getLangText('LinkExpired'));
                redirect('accounts');
            }
            $this->viewData['title'] = "Edit Account";
        }
        $this->layout->view("account/manage", $this->viewData);
    }

    public function transactions($id = null) {
        $this->load->model('transaction');
        $condition = array('account_id' => $id);
        $result = $this->transaction->get_list($condition);
        if ($result->num_rows() <= 0) {
            //redirect('accounts/index');
        }
        $this->viewData['AccountData'] = $AccountData = $this->account->getById((int) $id);
        if ($this->input->get('download') == 'report') {
            $csv_array[] = array('date' => 'Date', 'note' => 'Note', 'debit' => 'Debit', 'credit' => 'Credit', 'balance' => 'Cummulative Balance');
            foreach ($result->result() as $row) {
                $this->load->helper('csv');
                $balance = abs($row->cummulative_balance);
                $balanceType = $row->cummulative_balance >= 0 ? ' Dr' : ' Cr';
                $csv_array[] = array('date' => "$row->created", 'note' => $row->note, 'debit' => ($row->type == 'Dr' ? $row->amount : ''), 'credit' => ($row->type == 'Cr' ? $row->amount : ''), 'balance' => $balance . $balanceType);
            }
            array_to_csv($csv_array, "{$AccountData->name}_TransactionList.csv");
            exit();
        }
        $AccountWallet = $this->transaction->getAccountWallet($id);
        $this->viewData['AccountWallet'] = $AccountWallet;
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Account list";
        $this->viewData['datatable_asset'] = true;
        $this->layout->view("account/transactions", $this->viewData);
    }

    public function _unique_phone_check($phone) {
        $condition = array('phone' => $phone);
        if ($this->input->post('id') > 0) {
            $condition['id !='] = $this->input->post('id');
        }
        $sql = $this->db->select('id')->get_where('accounts', $condition);
        if ($sql->num_rows() > 0) {
            $this->form_validation->set_message('_unique_phone_check', 'The {field} already exist.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function _unique_email_check($email) {
        if ($email == "") {
            return TRUE;
        }
        $condition = array('email' => $email);
        if ($this->input->post('id') > 0) {
            $condition['id !='] = $this->input->post('id');
        }
        $sql = $this->db->select('id')->get_where('accounts', $condition);
        if ($sql->num_rows() > 0) {
            $this->form_validation->set_message('_unique_email_check', 'The {field} already exist.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete($id) {
        $accsql = $this->db->select('id')->where(array('account_id' => $id))->limit(1)->get('transaction');
        if ($accsql->num_rows() > 0) {
            $this->session->set_flashdata("error", "This Account have running transation so you cannot delete this.");
        } else {
            $this->db->where("id", $id)->delete("accounts");
            $this->session->set_flashdata("success", "Account deleted successfully");
        }
        redirect("accounts");
    }

}
