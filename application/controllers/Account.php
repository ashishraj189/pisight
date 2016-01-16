<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('account_model');
        $logged_in = $this->session->userdata('logged_in');
        if (empty($logged_in)) {
            redirect('user', 'refresh');
        }
    }

    public function index() {
        $logged_in = $this->session->userdata('logged_in');
        $loginId = $logged_in['user_id'];
        $type = array(
            'Credit' => 'Credit',
            'Saving' => 'Saving',
            'Current' => 'Current'
        );
        $insti = array(
            '' => 'Please select name of institution',
            'hdfc' => 'HDFC',
            'icic' => 'ICIC',
            'pnb' => 'Punjab National Bank'
        );
        $user_selectvals = $this->account_model->get_UserSelecteAcoount($loginId);
        if (sizeof($user_selectvals) > 0) {
            foreach ($user_selectvals as $selkey => $selvals) {
                $val["type"][$selvals->account_type] = $type[$selvals->account_type];
                if ($selvals->account_type == "") {
                    $val["type"][""] = $type["No account seected"];
                }
                $val["ins"][$selvals->account_name] = $insti[$selvals->account_name];
                if($selvals->account_name == "") {
                    $val["ins"][""] = $insti["No instit"];
                }
            }
        }
        $this->load->view('common/header');
        $this->load->view('account/dashboard', $val);
        $this->load->view('common/footer');
    }

    public function add_account() {
        $this->load->view('common/header');
        $this->load->view('account/add_account');
        $this->load->view('common/footer');
    }

    public function add_loan() {
        $this->load->view('common/header');
        $this->load->view('account/add_loan');
        $this->load->view('common/footer');
    }

    public function add_property() {
        $this->load->view('common/header');
        $this->load->view('account/add_property');
        $this->load->view('common/footer');
    }

    public function add_deposit() {
        $this->load->view('common/header');
        $this->load->view('account/add_deposit');
        $this->load->view('common/footer');
    }

    public function add_transaction() {
        $val = array();
        $this->load->view('common/header');
        $logged_in = $this->session->userdata('logged_in');
        $loginId = $logged_in['user_id'];
        $type = array(
            'Credit' => 'Credit',
            'Saving' => 'Saving',
            'Current' => 'Current'
        );
        $insti = array(
            '' => 'Please select name of institution',
            'hdfc' => 'HDFC',
            'icic' => 'ICIC',
            'pnb' => 'Punjab National Bank'
        );
        $user_selectvals = $this->account_model->get_UserSelecteAcoount($loginId);
        if (sizeof($user_selectvals) > 0) {
            foreach ($user_selectvals as $selkey => $selvals) {
                $val["type"][$selvals->account_type] = $type[$selvals->account_type];
                if ($selvals->account_type == "") {
                    $val["type"][""] = $type["No account seected"];
                }
                $val["ins"][$selvals->account_name] = $insti[$selvals->account_name];
                if ($selvals->account_name == "") {
                    $val["ins"][""] = $insti["No instit"];
                }
            }
        }
        $this->load->view('account/add_transaction', $val);
        $this->load->view('common/footer');
    }

    public function addAccount() {
        $input = $this->input->post();
        $type_of_account = $input["type_of_account"];
        $institution_name = $input["institution_name"];
        $bank_id = md5($input["bank_id"]);
        $bank_password = md5($input["bank_password"]);
        $date = date('Y-m-d h:i:s', time());
        $logged_in = $this->session->userdata('logged_in');
        $loginId = $logged_in['user_id'];
        $inputData = array(
            'user_id' => $loginId,
            'account_type' => $type_of_account,
            'account_name' => $institution_name,
            'account_login_id' => $bank_id,
            'account_login_password' => $bank_password,
            'account_created_at' => $date
        );
        $user_registerid = $this->user_model->insertData($inputData, 'account');
        if ($user_registerid) {
            echo 'Account has been added';
        }
    }

    public function addTransaction() {
        $input = $this->input->post();
        $actype = $input["type_of_account"];
        $acname = $input["institution_name"];
        $category = $input["category"];
        $catamt = $input["catamt"];
        $userdefinedate = date('Y-m-d', strtotime($input["date"]));
        $create_date = date('Y-m-d h:i:s', time());
        $logged_in = $this->session->userdata('logged_in');
        $loginId = $logged_in['user_id'];
        $inputData = array(
            'transaction_account_id' => $loginId,
            'transaction_category' => $actype,
            'transaction_amount' => $catamt,
            'category_val' => $catamt,
            'date' => $userdefinedate,
            'transaction_created_at' => $create_date
        );
        $chk_accinfo = $this->account_model->get_transaction($loginId, $actype, $acname);
        if (sizeof($chk_accinfo) == 0) {
            echo "No Record Found";
            exit;
        }
        $amt = $chk_accinfo[0]->account_balance;

        if ($amt < $catamt) {
            echo "You do not have sufficient amout.";
            exit;
        }
        $user_registerid = $this->user_model->insertData($inputData, 'transaction');
        $status = false;
        if ($user_registerid) {
            $act_id = $chk_accinfo[0]->account_id;
            $dif = $amt - $catamt;
            $update_date = date('Y-m-d h:i:s', time());
            $arr = array(
                'account_balance' => $dif,
                'account_updated_at' => $update_date
            );
            $this->user_model->update_data("account", $arr, "account_id", $act_id);
            echo 'Transaction has been added';
        }
    }

}
