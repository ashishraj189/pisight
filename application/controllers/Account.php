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

        $account_lists = $this->account_model->get_UserSelecteAcoount($loginId);
        $val['accounts_list_bank'] = '';
        $val['accounts_list_credit'] = '';
        $bank_sum = 0;
        $credit_sum = 0;
        $val['bank_sum'] = '';
        $val['credit_sum'] = '';
        if (sizeof($account_lists) > 0) {
            foreach ($account_lists as $selkey => $selvals) {
                if ($selvals->account_type == 'Saving' || $selvals->account_type == 'Current') {
                    $val['accounts_list_bank'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '">'
                            . '<div class="sc" id="account_' . $selvals->account_id . '">' . $selvals->account_name . ' $' . $selvals->account_balance . '</div>'
                            . '</a>';
                    $bank_sum += $selvals->account_balance;
                }

                if ($selvals->account_type == 'Credit') {
                    $val['accounts_list_credit'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '"><div class="sc" id="account_' . $selvals->account_id . '">' . $selvals->account_name . ' $' . $selvals->account_balance . '</div></a>';
                    $credit_sum += $selvals->account_balance;
                }
            }
            $val['bank_sum'] = '<span>' . $bank_sum . '</span>';
            $val['credit_sum'] = '<span>' . $credit_sum . '</span>';;
        }
        /* Found User Account List Behalf Of Login Id */
        $user_id = $logged_in['user_id'];
        $val['institution_name_list'] = $this->account_model->get_institution_list_for_add_transaction("", $user_id);
        $val['currency'] = $this->account_model->get_Currency();
        /* End Here */
        /* code for display loan amount and loan account */
        $loan_display = $this->account_model->loan_account_name($user_id);
        $cur_sum = 0;
        $val['loan_sum'] = '';
        $val['loan_list'] = '';
        $currency = '';
        if (!empty($loan_display)) {
            foreach ($loan_display as $loan_dis) {
                $cur_sum += $loan_dis->loan_amount;
                $currency = $loan_dis->currency_type;

                $val['loan_list'] .= '<div class="sc">' . $loan_dis->account_name . ' ' . $loan_dis->currency_type . ' ' . $loan_dis->loan_amount . '</div>';
            }
            $val['loan_sum'] .= '<span>' . $currency . ' ' . $cur_sum . '</span>';
        }

        /* End here */
        /* code for display depoite amount and deposite account */
        $deposit_display = $this->account_model->deposit_account_name($user_id);
        $dep_sum = 0;
        $val['deposit_sum'] = '';
        $val['deposit_list'] = '';
        $dep_currency = '';
        if (!empty($deposit_display)) {
            foreach ($deposit_display as $deposit_dis) {
                $dep_sum += $deposit_dis->deposit_amount;
                $dep_currency = $deposit_dis->currency_type;

                $val['deposit_list'] .= '<div class="sc">' . $deposit_dis->account_name . ' ' . $deposit_dis->currency_type . ' ' . $deposit_dis->deposit_amount . '</div>';
            }
            $val['deposit_sum'] .= '<span>' . $dep_currency . ' ' . $dep_sum . '</span>';
        }
        /* End here */
        
        /* code for property amount and property account */
        $property_display = $this->account_model->property_details($user_id);
        $property_sum = 0;
        $val['property_sum'] = '';
        $val['property_list'] = '';
        $property_currency = '';
        if (!empty($property_display)) {
            foreach ($property_display as $property_dis) {
                $property_sum += $property_dis->property_amount;
                $property_currency = $property_dis->currency_type;

                $val['property_list'] .= '<div class="sc">' . $property_dis->property_name . ' ' . $property_dis->currency_type . ' ' . $property_dis->property_amount . '</div>';
            }
            $val['property_sum'] .= '<span>' . $property_currency . ' ' . $property_sum . '</span>';
        }
        /* End here */

        $val['add_transaction_view'] = $this->load->view('account/add_transaction', $val, TRUE);
        $val['add_deposit_view'] = $this->load->view('account/add_deposit', $val, TRUE);
        $val['add_property_view'] = $this->load->view('account/add_property', $val, TRUE);
        $val['add_loan_view'] = $this->load->view('account/add_loan', $val, TRUE);
        $val['add_dashboard_script_view'] = $this->load->view('common/dashboard_script', $val, TRUE);

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
        $trans_desc = $input["trans_desc"];
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
            'transaction_desc' => $trans_desc,
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

        $account_lists = $this->account_model->get_UserSelecteAcoount($loginId);
        $data['accounts_list_bank'] = '';
        $data['accounts_list_credit'] = '';
        $bank_sum = 0;
        $credit_sum = 0;
        $data['bank_sum'] = '';
        $data['credit_sum'] = '';
        if (sizeof($account_lists) > 0) {
            foreach ($account_lists as $selkey => $selvals) {
                if ($selvals->account_type == 'Saving' || $selvals->account_type == 'Current') {
                    $data['accounts_list_bank'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '">'
                            . '<div class="sc" id="account_' . $selvals->account_id . '">' . $selvals->account_name . ' ' . $selvals->account_balance . '</div>'
                            . '</a>';
                    $bank_sum += $selvals->account_balance;
                }

                if ($selvals->account_type == 'Credit') {
                    $data['accounts_list_credit'] .= '<a href="' . site_url('account/transaction/' . $selvals->account_id) . '"><div class="sc" id="account_' . $selvals->account_id . '">' . $selvals->account_name . ' ' . $selvals->account_balance . '</div></a>';
                    $credit_sum += $selvals->account_balance;
                }
            }
            $data['bank_sum'] = '<span>' . $bank_sum . '</span>';
            $data['credit_sum'] = '<span>' . $credit_sum . '</span>';;
        }
        /* Found User Account List Behalf Of Login Id */
        $user_id = $logged_in['user_id'];
        $data['institution_name_list'] = $this->account_model->get_institution_list_for_add_transaction("", $user_id);
        $data['currency'] = $this->account_model->get_Currency();
        /* End Here */
        /* code for display loan amount and loan account */
        $loan_display = $this->account_model->loan_account_name($user_id);
        $cur_sum = 0;
        $data['loan_sum'] = '';
        $data['loan_list'] = '';
        $currency = '';
        if (!empty($loan_display)) {
            foreach ($loan_display as $loan_dis) {
                $cur_sum += $loan_dis->loan_amount;
                $currency = $loan_dis->currency_type;

                $data['loan_list'] .= '<div class="sc">' . $loan_dis->account_name . ' ' . $loan_dis->currency_type . ' ' . $loan_dis->loan_amount . '</div>';
            }
            $data['loan_sum'] .= '<span>' . $currency . ' ' . $cur_sum . '</span>';
        }

        /* End here */
        /* code for display loan amount and loan account */
        $deposit_display = $this->account_model->deposit_account_name($user_id);
        $dep_sum = 0;
        $data['deposit_sum'] = '';
        $data['deposit_list'] = '';
        $dep_currency = '';
        if (!empty($deposit_display)) {
            foreach ($deposit_display as $deposit_dis) {
                $dep_sum += $deposit_dis->loan_amount;
                $dep_currency = $deposit_dis->currency_type;

                $data['deposit_list'] .= '<div class="sc">' . $deposit_dis->account_name . ' ' . $deposit_dis->currency_type . ' ' . $deposit_dis->loan_amount . '</div>';
            }
            $data['deposit_sum'] .= '<span>' . $dep_currency . ' ' . $dep_sum . '</span>';
        }
        /* End here */

        $data['add_transaction_view'] = $this->load->view('account/add_transaction', $data, TRUE);
        $data['add_deposit_view'] = $this->load->view('account/add_deposit', $data, TRUE);
        $data['add_property_view'] = $this->load->view('account/add_property', $data, TRUE);
        $data['add_loan_view'] = $this->load->view('account/add_loan', $data, TRUE);
        $data['add_dashboard_script_view'] = $this->load->view('common/dashboard_script', $data, TRUE);
        
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
                                                        <td>$account_transaction_row->transaction_desc</td>
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
            $institution_name_list = $this->account_model->get_institution_list_for_add_transaction($account_type , $user_id);
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
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['user_id'];
        $inputData = array(
            'loan_user_id' => $user_id,
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

    public function property_vals() {

        $input = $this->input->post();
        $propery_name = $input["propery_name"];
        $property_currency = $input["property_currency"];
        $propery_amount = $input["propery_amount"];
        $propery_address = $input["propery_address"];
        $propery_pur_date = $input["propery_pur_date"];
        $date = date('Y-m-d h:i:s', time());
        $propery_pur_date = date('Y-m-d', strtotime($propery_pur_date));
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['user_id'];
        $inputData = array(
            'property_user_id' => $user_id,
            'property_name' => $propery_name,
            'property_address' => $propery_address,
            'property_currency_id' => $property_currency,
            'property_amount' => $propery_amount,
            'property_purchage_date' => $propery_pur_date,
            'property_added_at' => $date,
            'property_updated_at' => $date,
            'property_status' => 1
        );
        $propery_added = $this->user_model->insertData($inputData, 'property');
        if ($propery_added) {
            echo 'Property has been added';
        }
    }

    public function deposit_vals() {
        $input = $this->input->post();
        $deposit_account = $input["deposit_account"];
        $deposit_currency = $input["deposit_currency"];
        $deposit_amount = $input["deposit_amount"];
        $deposit_endate = $input["deposit_endate"];
        $deposit_acnumber = $input["deposit_acnumber"];
        $deposit_stdate = $input["deposit_stdate"];
        $date = date('Y-m-d h:i:s', time());
        $deposit_endate = date('Y-m-d', strtotime($deposit_endate));
        $deposit_stdate = date('Y-m-d', strtotime($deposit_stdate));
        $logged_in = $this->session->userdata('logged_in');
        if (strtotime($deposit_stdate) > strtotime($deposit_endate)) {
            echo "Please insert last date greater than start date";
            exit;
        }
        $user_id = $logged_in['user_id'];
        $inputData = array(
            'deposit_user_id' => $user_id,
            'deposit_account_id' => $deposit_account,
            'deposit_account_num' => $deposit_acnumber,
            'deposit_currency_id' => $deposit_currency,
            'deposit_amount' => $deposit_amount,
            'deposit_start_date' => $deposit_stdate,
            'deposit_end_date' => $deposit_endate,
            'deposit_added_at' => $date,
            'deposit_updated_at' => $date,
            'deposit_status' => 1
        );
        $deposit_added = $this->user_model->insertData($inputData, 'deposit');
        if ($deposit_added) {
            echo 'Deposit has been added';
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
