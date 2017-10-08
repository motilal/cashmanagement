<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $viewData;

    function __construct() {
        parent::__construct();
        $this->site_santry->allow();
        $this->layout->set_layout("layout_main");
    }

    public function index($flag = "") {
        $this->load->model(array('transaction', 'account'));
        $AccWallet = $this->transaction->getAccountWallet();
        $this->viewData['AccWallet'] = $AccWallet;

        $this->viewData['total_account'] = $this->account->totalAccounts();

        $recentTrans = $this->transaction->get_all_list('', array('limit' => 10, 'start' => 0), array('tran.created', 'DESC'), false);
        $this->viewData['recentTrans'] = $recentTrans;

        $AccCreditDebit = $this->transaction->AccountTotalDrCr(10);
        $this->viewData['AccCreditDebit'] = $AccCreditDebit;

        $this->viewData['title'] = "Dashboard";
        $this->layout->view('dashboard/dashboard', $this->viewData);
    }

}
