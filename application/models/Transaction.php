<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Transaction model 
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array()) {
        $this->db->select("transaction.*");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $this->db->order_by('created', 'DESC');
        $data = $this->db->get("transaction");
        return $data;
    }

    public function get_all_list($condition = array(), $limit = array(), $order = array(), $with_num_rows = false) {
        $this->db->select("tran.*,ac.name as username");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $this->db->join('accounts as ac', 'ac.id = tran.account_id', 'LEFT');
        if (!empty($limit)) {
            $this->db->limit($limit['limit'], $limit['start']);
        }
        if (!empty($order)) {
            $this->db->order_by($order[0], $order[1]);
        }
        $data = $this->db->get("transaction as tran");
        if ($with_num_rows == true) {
            $num_rows = $this->db->select('ac.id')
                    ->join('accounts as ac', 'ac.id = tran.account_id', 'LEFT')
                    ->where(!empty($condition) ? $condition : 1, TRUE)
                    ->get("transaction as tran")
                    ->num_rows();

            return (object) array("data" => $data, "num_rows" => $num_rows);
        }
        return $data;
    }

    public function getById($id) {
        if (is_integer($id) && $id > 0) {
            $result = $this->db->select("transaction.*")
                    ->get_where("transaction", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function getAccountWallet($account_id = null) {
        $this->db->select('id,account_id,sum(amount) as total_amount,type');
        if ($account_id != "") {
            $this->db->where('account_id', $account_id);
        }
        $this->db->group_by('type');
        $sql = $this->db->get('transaction');

        $credit = 0;
        $debit = 0;
        $type = 'Dr';
        $difference = 0;
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            foreach ($result as $row) {
                if ($row->type == 'Cr') {
                    $credit = $row->total_amount;
                } else if ($row->type == 'Dr') {
                    $debit = $row->total_amount;
                }
            }
            if ($credit > $debit) {
                $difference = $credit - $debit;
                $type = 'Cr';
            } else if ($debit > $credit) {
                $type = 'Dr';
                $difference = $debit - $credit;
            } else {
                $type = 'Dr';
                $difference = $debit - $credit;
            }
        }
        return (object) array('credit' => $credit, 'debit' => $debit, 'type' => $type, 'balance' => $difference);
    }

    function recentTransaction() {
        
    }

    function AccountTotalDrCr($limit = 10) {
        $sql = $this->db->select("account_id,,ac.name as username,
                            , SUM(COALESCE(CASE WHEN type = 'Dr' THEN amount END,0)) total_debits
                            , SUM(COALESCE(CASE WHEN type = 'Cr' THEN amount END,0)) total_credits
                            , SUM(COALESCE(CASE WHEN type = 'Dr' THEN amount END,0)) - SUM(COALESCE(CASE WHEN type = 'Cr' THEN amount END,0)) balance")
                ->group_by('account_id')
                ->limit($limit)
                ->join('accounts as ac', 'ac.id = tran.account_id', 'LEFT')
                ->get('transaction as tran');
        return $sql;
    }

    function getCummulativePayment($account_id) {
        $sql = $this->db->select("`account_id`,SUM(COALESCE(CASE WHEN type = 'Dr' THEN amount END, 0)) - SUM(COALESCE(CASE WHEN type = 'Cr' THEN amount END, 0)) balance")
                ->where('account_id', $account_id)
                ->group_by('account_id')
                ->get('transaction');
        if ($sql->num_rows() > 0) {
            $balance = $sql->row()->balance;
        }
        return $balance;
    }

}

?>
