<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Payment
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payments extends CI_Controller {

    var $viewData = array();
    var $per_page = PAGINATION_LIMIT;
    var $segment = 3;

    public function __construct() {
        parent::__construct();
        $this->site_santry->allow();
        $this->layout->set_layout("layout_main");
        $this->load->model('transaction');
    }

    public function index() {
        $condition = array();
        $start = (int) $this->input->get('start');

        $perpage = $this->per_page;
        if ($this->input->get('perpage') != "" && $this->input->get('perpage') > 0) {
            $perpage = (int) $this->input->get('perpage');
        }
        $this->viewData['perpage'] = $perpage;

        if ($this->input->get('keyword') != "") {
            $keyword = $this->db->escape_str($this->input->get('keyword'));
            $condition["ac.name like '%{$keyword}%' OR tran.note like '%{$keyword}%'"] = null;
        }

        $limit = array(
            'start' => $start,
            'limit' => $perpage
        );
        $order = array('tran.created', 'DESC');
        if ($this->input->get('order_by') != "" && $this->input->get('sort') != "") {
            $order = array($this->input->get('order_by'), $this->input->get('sort'));
        }
        $result = $this->transaction->get_all_list($condition, $limit, $order, true);
        //pr($result->data->result()); die;
        if ($this->input->get('download') == 'report') {
            $csv_array[] = array('user' => 'Account Name', 'date' => 'Date', 'note' => 'Note', 'debit' => 'Debit', 'credit' => 'Credit', 'balance' => 'Cummulative Balance');

            foreach ($result->data->result() as $row) {
                $this->load->helper('csv');
                $balance = abs($row->cummulative_balance);
                $balanceType = $row->cummulative_balance >= 0 ? ' Dr' : ' Cr';
                $csv_array[] = array('user' => $row->username, 'date' => "$row->created", 'note' => $row->note, 'debit' => ($row->type == 'Dr' ? $row->amount : ''), 'credit' => ($row->type == 'Cr' ? $row->amount : ''), 'balance' => $balance . $balanceType);
            }
            array_to_csv($csv_array, 'TransactionList.csv');
            exit();
        }
        $this->viewData['result'] = $result->data;
        $this->viewData['pagination'] = create_pagination("payments/index", $result->num_rows, $perpage, $this->segment);
        $this->viewData['title'] = "All Payments";
        $this->layout->view("payment/index", $this->viewData);
    }

    public function manage($id = null) {
        $this->load->model('account');
        $this->form_validation->set_rules('manage');

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "account_id" => $this->input->post('account'),
                'amount' => $this->input->post('amount'),
                'note' => $this->input->post('note')
            );

            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
                $fileUpload = $this->do_upload();
                if (isset($fileUpload['error']) && $fileUpload['error'] != "") {
                    $this->session->set_flashdata('error', $fileUpload['error']);
                    redirect('payments/manage');
                } else {
                    $data['file'] = $fileUpload['upload_data']['file_name'];
                }
            }

            if ($this->input->post('credit')) {
                $data['type'] = 'Cr';
            } else {
                $data['type'] = 'Dr';
            }
            if ($this->input->post('id') > 0) {
                //$data['updated'] = date("Y-m-d H:i:s");
                //$this->db->update("transaction", $data, array("id" => $this->input->post('id')));
                //$this->session->set_flashdata("success", getLangText('PaymentUpdateSuccess'));
            } else {
                $data['created'] = date("Y-m-d H:i:s");
                $this->db->insert("transaction", $data);
                $last_id = $this->db->insert_id();
                $cummulativeBalance = $this->transaction->getCummulativePayment($data['account_id']);
                $this->db->where('id', $last_id)->update('transaction', array('cummulative_balance' => $cummulativeBalance));
                $this->session->set_flashdata("success", getLangText('PaymentAddSuccess'));
            }
            if ($this->input->post('redirect') != "") {
                redirect("accounts/transactions/{$data['account_id']}");
            } else {
                redirect("payments");
            }
        }

        $this->viewData['title'] = "Manage Payment";
        $accounts_list = $this->account->get_list($condition = array());
        $this->viewData['accounts_list'] = $accounts_list;

        if ($id > 0) {
            $this->viewData['data'] = $data = $this->transaction->getById((int) $id);
            if (empty($data)) {
                $this->session->set_flashdata("error", getLangText('LinkExpired'));
                redirect('accounts');
            }
            $this->viewData['title'] = "Edit Account";
        }
        $this->viewData['select2_asset'] = TRUE;
        $this->layout->view("payment/manage", $this->viewData);
    }

    public function actions() {
        if ($this->form_validation->run('actions') === TRUE) {
            if ($this->input->post("actions") == "delete") {
                //$this->db->where_in("id", $this->input->post("ids"))->delete("transaction");
            }
            $this->session->set_flashdata("success", "Selected rows {$this->input->post("actions")} successfully");
        }
        if ($this->input->post('redirect') != "") {
            redirect(base64_decode($this->input->post('redirect')));
        } else {
            redirect("payments");
        }
    }

    public function do_upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|docx|txt|xls|xlsx|pdf';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors('', ''));
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    public function download_file($file) {
        $this->load->helper('download');
        $path = file_get_contents('./uploads/' . $file);
        if (file_exists('./uploads/' . $file)) {
            force_download($file, $path);
        }
    }

}

?>
