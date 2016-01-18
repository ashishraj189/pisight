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
        $val = array();
        $logged_in = $this->session->userdata('logged_in');
        $loginId = $logged_in['user_id'];
        $type = array(
            '' => 'Type of Account',
            'Credit' => 'Credit',
            'Saving' => 'Saving',
            'Current' => 'Current'
        );
        $val['all_institution_list'] = $this->account_model->get_all_institution_list();

        $val['category_list'] = $this->account_model->get_all_category_list();

        $user_selectvals = $this->account_model->get_UserSelecteAcoount($loginId);
        $val['accounts_list_bank'] = '';
        $val['accounts_list_credit'] = '';
        if (sizeof($user_selectvals) > 0) {
            foreach ($user_selectvals as $selkey => $selvals) {
                if ($selvals->account_type == 'Saving' || $selvals->account_type == 'Current') {
                    $val['accounts_list_bank'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '"><div class="sc" id="account_' . $selvals->account_id . '">' . $selvals->account_name . ' ' . $selvals->account_balance . '</div></a>';
                }

                if ($selvals->account_type == 'Credit') {
                    $val['accounts_list_credit'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '"><div class="sc" id="account_' . $selvals->account_id . '">' . $selvals->account_name . ' ' . $selvals->account_balance . '</div></a>';
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
        $institution_id = $input["institution_id"];
        $category = $input["category"];
        $catamt = $input["catamt"];
        $userdefinedate = date('Y-m-d', strtotime($input["date"]));
        $create_date = date('Y-m-d h:i:s', time());
        $logged_in = $this->session->userdata('logged_in');
        $loginId = $logged_in['user_id'];
        $inputData = array(
            'transaction_account_id' => $institution_id,
            'transaction_category_id' => $category,
            'transaction_amount' => $catamt,
            //'category_val' => $category,
            'transaction_date' => $userdefinedate,
            'transaction_created_at' => $create_date
        );
        $chk_accinfo = $this->account_model->get_account_detail_by_account_id($institution_id);
        if (sizeof($chk_accinfo) == 0) {
            echo "No Record Found";
            exit;
        }
        $amt = $chk_accinfo->account_balance;

        if ($amt < $catamt) {
            echo "You do not have sufficient amout.";
            exit;
        }
        $user_registerid = $this->user_model->insertData($inputData, 'transaction');
        $status = false;
        if ($user_registerid) {
            $act_id = $chk_accinfo->account_id;
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

    public function transaction($account_id = '') {
        $data = array();
        $logged_in = $this->session->userdata('logged_in');
        $loginId = $logged_in['user_id'];
        $type = array(
            '' => 'Type of Account',
            'Credit' => 'Credit',
            'Saving' => 'Saving',
            'Current' => 'Current'
        );
        $data['all_institution_list'] = $this->account_model->get_all_institution_list();

        $data['category_list'] = $this->account_model->get_all_category_list();

        $user_selectvals = $this->account_model->get_UserSelecteAcoount($loginId);
        $data['accounts_list_bank'] = '';
        $data['accounts_list_credit'] = '';
        if (sizeof($user_selectvals) > 0) {
            foreach ($user_selectvals as $selkey => $selvals) {
                if ($selvals->account_type == 'Saving' || $selvals->account_type == 'Current') {
                    $data['accounts_list_bank'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '"><div class="sc" id="account_' . $selvals->account_id . '">'
                            . $selvals->account_name . ' ' . $selvals->account_balance .
                            '</div></a>';
                }

                if ($selvals->account_type == 'Credit') {
                    $data['accounts_list_credit'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '"><div class="sc" id="account_' . $selvals->account_id . '">'
                            . $selvals->account_name . ' ' . $selvals->account_balance .
                            '</div></a>';
                }
            }
        }
        $account_transaction_detail = array();
        $data['account_bal'] = '';
        $data['transaction_rows'] = '';
        $data['account_name'] = '';
        if ($account_id != '') {
            $account_detail = $this->account_model->get_account_detail_by_account_id($account_id);
            $data['account_bal'] = $account_detail->account_balance;
            $data['account_name'] = $account_detail->account_name;
            $account_transaction_detail = $this->account_model->get_transaction_by_account_id($account_id);
            if (!empty($account_transaction_detail)) {
                //print_r($account_transaction_detail);
                foreach ($account_transaction_detail as $account_transaction_row) {
                    $data['transaction_rows'] .= "<tr> <td>$account_transaction_row->transaction_date</td>
                                                        <td>??</td>
                                                        <td>$account_transaction_row->category_name</td>
                                                        <td>$account_transaction_row->transaction_amount</td>
                                                   </tr>";
                }
            }
        }
        $this->load->view('common/header');
        $this->load->view('account/transaction_view', $data);
        $this->load->view('common/footer');
    }

    public function acount_types_for_add_transaction() {
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['user_id'];
        $account_type_list = $this->account_model->get_account_type_list_for_user($user_id);
        echo form_dropdown('type_of_account', $account_type_list, '', 'class="form-control tran_type" id="tran_type"');
    }

    public function name_institution_for_add_transaction() {
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['user_id'];
        $account_type = $this->input->post('account_type');
        if ($account_type != '') {
            $institution_name_list = $this->account_model->get_institution_list_for_add_transaction($account_type='Credit', $user_id);
            echo form_dropdown('trans_account', $institution_name_list, '', 'class="form-control" id="trans_account"');
        }
    }

}
