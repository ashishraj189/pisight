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
        /* Found User Account List Behalf Of Login Id */
        $user_id = $logged_in['user_id'];
        $val['institution_name_list'] = $this->account_model->get_institution_list_for_add_transaction("", $user_id);
        $val['currency'] = $this->account_model->get_Currency();
        /* End Here */

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
            $institution_name_list = $this->account_model->get_institution_list_for_add_transaction($account_type = 'Credit', $user_id);
            echo form_dropdown('trans_account', $institution_name_list, '', 'class="form-control" id="trans_account"');
        }
    }

    public function addLoan() {
        $input = $this->input->post();
        $loan_account = $input["loan_account"];
        $loan_acnumber = $input["loan_acnumber"];
        $loan_currency = $input["loan_currency"];
        $loan_outamt = $input["loan_outamt"];
        $start_date = $input["start_date"];
        $end_date = $input["end_date"];
        if (strtotime($start_date) > strtotime($end_date)) {
            echo "Please insert last date greater than start date";
            exit;
        }
        $date = date('Y-m-d h:i:s', time());
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $inputData = array(
            'loan_account_id' => $loan_account,
            'loan_account_num' => $loan_acnumber,
            'loan_currency_id' => $loan_currency,
            'loan_outstanding_amount' => $loan_outamt,
            'loan_start_date' => $start_date,
            'loan_end_date' => $end_date,
            'loan_added_at' => $date,
            'loan_updated_at' => $date
        );
        $loan_added = $this->user_model->insertData($inputData, 'loan');
        if ($loan_added) {
            echo 'Loan has been added';
        }
    }
    
    public function account_statement_upload() {
        $data = array();
        $data['error'] = '';
        $data['success'] = '';
        //$this->load->library('upload');
        if (isset($_FILES["sold_property_file"]["name"]) && $_FILES["sold_property_file"]["name"] != "") {

            $name = $_FILES["sold_property_file"]["name"];
            $ext = end(explode(".", $name));
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/_temp/';
            $config['file_name'] = $name;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('sold_property_file')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();

                $filepath = $upload_data['full_path'];
                //load csv reader
                $this->load->library('CSVReader');
                $csvdata = $this->csvreader->parse_file($filepath);
                $insert_rows = array();
                foreach ($csvdata as $key => $row) {
                    $date_ts = strtotime($row['Date']);
                    $date = date("Y-m-d H:i:s", $date_ts);
                    $insert_rows[] = array(
                        'sold_property_type' => $row['Type'],
                        'sold_property_price' => $row['Price'],
                        'sold_property_city' => $row['City'],
                        'sold_property_state' => $row['State'],
                        'sold_property_date' => $date,
                        'sold_property_quality' => $row['Quality'],
                        'sold_property_cap_rate' => $row['Cap Rate'],
                        'sold_property_price_sf' => $row['Price/SF'],
                        'sold_property_price_sf_land' => $row['Price/SF Land'],
                    ); //$val->Retail;
                    //$row_data[$key] = str_replace('"', '', $val);
                }
                $insert_return = $this->admin_common_model->insert_sold_property($insert_rows);

                if ($insert_return) {
                    $data['success'] = 'File uploaded successfully';
                }
            }
        }
        $data['main_content'] = 'admin/property/sold_list_upload';
        $this->load->view('includes/admin_template', $data);
    }

}
