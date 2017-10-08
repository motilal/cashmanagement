<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Account model 
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array()) {
        $this->db->select("accounts.*");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $data = $this->db->get("accounts");
        return $data;
    }

    public function getById($id) {
        if (is_integer($id) && $id > 0) {
            $result = $this->db->select("accounts.*")
                    ->get_where("accounts", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function totalAccounts($condition = NULL) {
        $this->db->select("accounts.id");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $data = $this->db->get("accounts");
        return $data->num_rows();
    }

}

?>
