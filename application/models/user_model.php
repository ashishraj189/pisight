<?php

class User_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
      name		: insertData()
      @param		: $arr; 	// This array contains the table filed name as key of array and value as value of array.
      @param		: $table; 	// This is table name where data will be inserted
      description	: function will add the value in table.
      Author		: Mayank
     */

    function insertData($arr, $table) {
        $this->db->insert($table, $arr);
        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    /*
      name		: getData()
      @param		: $arr; 	// This array contains the table filed name as value of array.
      @param		: $table; 	// This is table name from where data has to fetch
      description	: function will add the value in table.
      Author		: Mayank.
     */

    function getData($table, $arr = "", $condition = "", $start = "", $limit = "") {
        if ($arr != "") {
            foreach ($arr as $a) {
                isset($field_value) ? $field_value .=", " . $a : $field_value = $a;
            }
            $sql = "SELECT " . $field_value . " FROM " . $table;
        } else {
            $sql = "SELECT * FROM " . $table;
        }
        if ($condition != "") {
            $sql .= " WHERE " . $condition;
        }
        if ($start != "" || $limit != "") {
            $sql .= "LIMIT " . $start . ", " . $limit;
        }

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /*
      name		: updateData()
      @param		: $arr; 	// This array contains the table filed name as value of array.
      @param		: $table; 	// This is table name from where data has to fetch
      description	: function will add the value in table.
      Author		: Mayank.
     */

    function updateData($table, $set, $condition = "") {

        $sql = "UPDATE " . $table . " SET " . $set;
        if ($condition != "") {
            $sql .= " where " . $condition;
            //print_r($sql);
        }
        $this->db->query($sql);
        if ($this->db->affected_rows()) {
            return 1;
        } else {
            return 0;
        }
    }

    function update_data($table, $data_array, $fld, $value) {

        if (!empty($data_array)) {
            $this->db->where($fld, $value);
            $this->db->update($table, $data_array);
        }
    }

    /* Funcition used for saving values into session */

    function create_login_session($session_data = array()) {
        $CI = &get_instance();
        $CI->session->set_userdata('logged_in', $session_data);
    }

    /* Function for getting security questions */

    function create_user_session($session_data = array()) {
        $CI = &get_instance();
        $CI->session->set_userdata('user_in', $session_data);
    }

    /* Function create user_session when registered user */

    function get_Question() {
        $this->db->from("security_question");
        $this->db->order_by('question_id', 'RANDOM');
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $return['security_question'] = $result->row()->security_question;
            $return['question_id'] = $result->row()->question_id;
            return $return;
        } else {
            return NULL;
        }
    }

    /* Get confirm security questions insert into database */

    function userInsert_securityQu($loginId) {
        //die($loginId);
        $this->db->select("security_question_id");
        $this->db->from("user");
        $this->db->where('user_id', $loginId);
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $questionID = $result->row()->security_question_id;
            if ($questionID) {
                $this->db->select("security_question, question_id");
                $this->db->from("security_question");
                $this->db->where('question_id', $questionID);
                $this->db->where('status', 1);
                $question = $this->db->get();
                $returnques = array();
                if ($question->num_rows() > 0) {
                    $returnques['security_question'] = $question->row()->security_question;
                    $returnques['question_id'] = $question->row()->question_id;
                    return $returnques;
                } else {
                    return NULL;
                }
            }
            return $returnques;
        } else {
            return NULL;
        }
    }
    
    function confirm_security_ques($user_id, $question_id, $answer){
        $this->db->select("user_id");
                $this->db->from("user");
                $this->db->where('user_id', $user_id);
                $this->db->where('security_question_id', $question_id);
                $this->db->where('security_question_ans', $answer);
                $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            return true;
        } else 
            return FALSE;
    }

}

?>