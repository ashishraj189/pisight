<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of account_model
 *
 * @author ashish
 */
class Account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* Function create user_session when registered user */


    /* function get_UserAcoount($loginId) {
      $this->db->select();
      $this->db->from("account");
      $this->db->where("user_id",$loginId);
      $result = $this->db->get();
      $return = array();
      if ($result->num_rows() > 0) {
      $return['security_question'] = $result->row()->security_question;
      $return['question_id'] = $result->row()->question_id;
      return $return;
      } else {
      return NULL;
      }
      } */

    function get_UserSelecteAcoount($loginId) {
        $query = $this->db->query("SELECT * from account where user_id = '$loginId'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /* Function for getting all details of transaction of user */

    function get_transaction($loginId, $actype, $acname) {
        $query = $this->db->query("SELECT * from account where user_id = '$loginId' and account_type='$actype' and account_name = '$acname'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function get_account_detail_by_account_id($account_id) {
        $this->db->select("*");
        $this->db->from('account ');
        $this->db->where('account_id', $account_id, FALSE);
        $query = $this->db->get();
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }

    function get_transaction_by_account_id($account_id) {
        $this->db->select("t.*, cm.category_name");
        $this->db->from('transaction t');
        $this->db->join('category_master cm', 't.transaction_category_id = cm.category_id', 'left');
        $this->db->where('transaction_account_id', $account_id, FALSE);
        $query = $this->db->get();
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function get_all_institution_list() {
        $this->db->select("institution_name");
        $this->db->from('institution_master');
        $query = $this->db->get();
//        echo $this->db->last_query();
        $result[''] = 'Select Institution Name';
        if ($query->num_rows() > 0) {
            //return $query->result();
            foreach ($query->result() as $row) {
                $result[$row->institution_name] = $row->institution_name;
            }
            return $result;
        } else {
            return $result;
        }
    }

    function get_account_type_list_for_user($user_id) {
        $this->db->select("account_type");
        $this->db->from('account');
        $this->db->where('user_id', $user_id, FALSE);
        $query = $this->db->get();
//        echo $this->db->last_query();
        $result[''] = 'Select Type of Account';
        if ($query->num_rows() > 0) {
            //return $query->result();
            foreach ($query->result() as $row) {
                $result[$row->account_type] = $row->account_type;
            }
            return $result;
        } else {
            return $result;
        }
    }

    function get_institution_list_for_add_transaction($account_type, $user_id) {
        $this->db->select("account_id, UCASE(account_name) as account_name");
        $this->db->from('account');
        $this->db->where('user_id', $user_id, FALSE);
        if ($account_type != "") {
            $this->db->where('account_type', $account_type);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result[''] = 'Select Institution Name';
        if ($query->num_rows() > 0) {
            //return $query->result();
            // print_r($query->result());
            foreach ($query->result() as $row) {
                $result[$row->account_id] = $row->account_name;
            }
            return $result;
        } else {
            return $result;
        }
    }

    function get_all_category_list() {
        $this->db->select("category_id, category_name");
        $this->db->from('category_master');
        $query = $this->db->get();
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result[''] = 'Add Category';
            //return $query->result();
            foreach ($query->result() as $row) {
                $result[$row->category_id] = $row->category_name;
            }
            return $result;
        } else {
            return NULL;
        }
    }

    /* Function for getting currency */

    function get_Currency() {
        $this->db->from("currency");
        $sql = $this->db->get();
        if ($sql->num_rows() > 0) {
            $arrcur = array();
            $result = $sql->result();
            foreach ($result as $curkey => $curval) {
                $cur_id = $curval->currency_id;
                $cur_val = $curval->currency_name;
                $arrcur[$cur_id] = $cur_val;
            }
            return $arrcur;
        } else {
            return NULL;
        }
    }

    /* Getting bank name and loan account from loan table */

    function loan_account_name($user_id) {
        $this->db->select('UCASE(account.account_name) as account_name ,currency.currency_code as currency_type,loan.loan_outstanding_amount as loan_amount');
        $this->db->from('loan');
        $this->db->join('account', 'loan.loan_account_id = account.account_id');
        $this->db->join('currency', 'loan.loan_currency_id = currency.currency_id');
        $this->db->where('loan.loan_user_id', $user_id);
        $this->db->order_by("account.account_name", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* Getting deposit bank name,bank amount,and currency from deposit table */

    function deposit_account_name($user_id) {
        $this->db->select('UCASE(account.account_name) as account_name ,currency.currency_code as currency_type,deposit.deposit_amount as deposit_amount');
        $this->db->from('deposit');
        $this->db->join('account', 'deposit.deposit_account_id = account.account_id');
        $this->db->join('currency', 'deposit.deposit_currency_id = currency.currency_id');
        $this->db->where('deposit.deposit_user_id', $user_id);
        $this->db->order_by("account.account_name", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
