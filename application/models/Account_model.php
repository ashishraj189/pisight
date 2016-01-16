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
        $query = $this->db->query("SELECT account_type,account_name from account where user_id = '$loginId'");
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

}
