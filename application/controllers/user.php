<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('user/login_view');
        $this->load->view('common/footer');
    }

    public function signup() {
        $this->load->view('common/header');
        $this->load->view('user/signup_view');
        $this->load->view('common/footer');
    }

    public function forgot_password() {
        $this->load->view('common/header');
        $this->load->view('user/forgot_password_view');
        $this->load->view('common/footer');
    }

    public function signupVals() {
        $val = array();
        if ($this->input->post("register")) {
            $this->form_validation->set_rules('user_name', 'User ID', 'trim|required');
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('user_password', 'Password', 'required');
            $this->form_validation->set_rules('user_cnpassword', 'Password Confirmation', 'required|matches[user_password]');
            $this->form_validation->set_rules('aceepterms', 'I have read accept the Terms of use and Privacy policy', 'required');
            if ($this->form_validation->run() == TRUE) {
                $input = $this->input->post();
                $user_name = $input["user_name"];
                $user_email = $input["user_email"];
                $user_password = md5($input["user_password"]);
                $date = date('Y-m-d h:i:s', time());
                $inputData = array(
                    'user_name' => $user_name,
                    'first_name' => '',
                    'last_name' => '',
                    'email' => $user_email,
                    'password' => $user_password,
                    'created_at' => $date,
                    'agree_terms_cond' => 1
                );
                $user_registerid = $this->user_model->insertData($inputData, 'user');
                $security_ques_arr = $this->user_model->get_Question();
                $val["secqus"] = $security_ques_arr['security_question'];
                $val["secqus_id"] = $security_ques_arr['question_id'];
                if ($user_registerid) {
                    $user_vals = array('user_id' => $user_registerid, 'email' => $user_email);
                    $this->user_model->create_user_session($user_vals);
                    $this->load->view("common/header");
                    $this->load->view("user/securityquestions_view", $val);
                    $this->load->view("common/footer");
                }
            } else {
                $this->session->set_flashdata('message', 'Please give me all informations.');
                $sec = $this->input->post('submit_ques');
                if (!isset($sec)) {
                    redirect('user/signup/');
                }
            }
        } else {
            $this->session->set_flashdata('message', 'Please accept terms and conditions.');
            $sec = $this->input->post('submit_ques');
            if (!isset($sec)) {
                redirect('user/signup/');
            }
        }
        if ($this->input->post('submit_ques')) {
            $val = array();
            $this->form_validation->set_rules('user_answer', 'Answer', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
                $questionid = $this->input->post("sec_ques_id");
                $answer = $this->input->post("user_answer");
                $date = date('Y-m-d h:i:s', time());
                $registerdata = $this->session->userdata("user_in");
                //$sec_ques_session = $this->session->logindata('sec_ques');
                $user_id = $registerdata['user_id'];
                $randormcode = rand(1000, 10000);
                $arr = array(
                    'security_question_id' => $questionid,
                    'security_question_ans' => $answer,
                    'updated_at' => $date,
                    'verification_code' => $randormcode
                );
                $this->send_verification_email($randormcode, $registerdata['email']);
                $this->user_model->update_data("user", $arr, "user_id", $user_id);
                $this->load->view("common/header");
                $this->load->view("user/verifyemail");
                $this->load->view("common/footer");
            } else {
                $security_ques_arr = $this->user_model->get_Question();
                $val["secqus"] = $security_ques_arr['security_question'];
                $val["secqus_id"] = $security_ques_arr['question_id'];
                $this->session->set_flashdata('message', 'Not selected');
                $this->load->view("common/header");
                $this->load->view("user/securityquestions_view", $val);
                $this->load->view("common/footer");
            }
        }
    }

    public function send_verification_email($verification_code, $email) {
        $data['activation_link'] = site_url("user/verifyemail/$verification_code");

        $email_type = "email_activation";
        $subject = "Pisight User Email Validation";

        $this->load->library('email');
        //$config['protocol'] = 'mail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('info@pisight.com', 'Pisight');
        $this->email->to($email);
        //$this->email->cc('admin@pisight.com');
        $this->email->subject($subject);

        $this->email->message($this->load->view('email/' . $email_type . '-html', $data, TRUE));

        $this->email->set_alt_message($this->load->view('email/' . $email_type . '-txt', $data, TRUE));

        $this->email->send();
    }

    public function send_otp($otp_code, $email) {
        $data['otp_code'] = $otp_code;

        $email_type = "email_otp";
        $subject = "Pisight User OTP";

        $this->load->library('email');
        //$config['protocol'] = 'mail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('info@pisight.com', 'Pisight');
        $this->email->to($email);
        //$this->email->cc('admin@pisight.com');
        $this->email->subject($subject);

        $this->email->message($this->load->view('email/' . $email_type . '-html', $data, TRUE));

        $this->email->set_alt_message($this->load->view('email/' . $email_type . '-txt', $data, TRUE));

        $this->email->send();
    }

    public function loginVals() {
        if ($this->input->post('login')) {
            $input = $this->input->post();
            $user_email = $input["user_email"];
            //$user_id =  $this->encrypt->encode($user_id);
            $user_pass = md5($input['user_pass']);
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_verify_login');
            $this->form_validation->set_rules('user_pass', 'password', 'trim|required');
            $this->form_validation->set_error_delimiters('<em>', '</em>');
            if ($this->form_validation->run()) {
                $arr = array("user_id");
                $cond = "email='" . $user_email . "' and password='" . $user_pass . "'";
                $data = $this->user_model->getData("user", $arr, $cond);
                $loginid = $data["0"]["user_id"];
                $logindata = array('user_id' => $loginid, "email" => $user_email);
                if ($loginid != "") {
                    $date = date('Y-m-d h:i:s', time());
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $randormcode = rand(1000, 10000);
                    $inputData = array(
                        'user_id' => $loginid,
                        'last_login' => $date,
                        'ip_address' => $ip,
                        'login_otp' => $randormcode
                    );
                    $this->user_model->create_user_session($logindata);
                    $data = $this->user_model->insertData($inputData, 'login');
                    $this->send_otp($randormcode, $user_email);
                    if ($data) {
                        $this->load->view('common/header');
                        $this->load->view("user/onetimecode_view");
                        $this->load->view('common/footer');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Incorrect Details.');
                    redirect('user/index/');
                }
            } else {
                $this->session->set_flashdata('message', 'A user does not exist for the username specified.');
                redirect('user/index/');
            }
        } else {
            $chk = $this->input->post('submit_code');
            if (!isset($chk)) {
                redirect('user');
            }
        }
        if ($this->input->post('submit_code')) {
            $val = array();
            $this->form_validation->set_rules('user_validcode', 'Valid Code', 'numeric|trim|required|callback_chkonetimecode');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("common/header");
                $this->load->view("user/onetimecode_view");
                $this->load->view("common/footer");
            } else {
                $user_data = $this->session->userdata('user_in');
                $security_ques_arr = $this->user_model->userInsert_securityQu($user_data['user_id']);
                $val["secqus"] = $security_ques_arr['security_question'];
                $val["secqus_id"] = $security_ques_arr['question_id'];
                $inputData = array(
                        'user_id' => $user_data['user_id'],
                        
                    );
                    $this->user_model->create_user_session($inputData);
                $this->load->view("common/header");
                $this->load->view("user/confirm_security_questions_view", $val);
                $this->load->view("common/footer");
            }
        }

        
    }
    
    /* public function login check*/
public function verify_login($str) {
       $query = $this->db->get_where('user', array('email'=>$str,'is_verified' => 1,'status'=>1), 1);
       if ($query->num_rows() == 1) {
           return true;
       } else {
           $this->form_validation->set_message('verify_login', 'You are not registered user');
           return false;
       }
   }

    public function verify_security_question(){
        if ($this->input->post('submit_ques')) {
            //die('mmmm');
            $val = array();
            $this->form_validation->set_rules('user_answer', 'Answer', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
                $questionid = $this->input->post("sec_ques_id");
                $answer = $this->input->post("user_answer");

                $registerdata = $this->session->userdata("user_in");
                //$sec_ques_session = $this->session->logindata('sec_ques');
                $user_id = $registerdata['user_id'];
//die('lllll');
                if($this->user_model->confirm_security_ques($user_id, $questionid, $answer)) {
                    //die('kkkk');
                    $login_session = array('user_id' => $user_id);
                    $this->user_model->create_login_session($login_session);
//                    $this->load->view("common/header");
//                    $this->load->view("account/dashboard");
//                    $this->load->view("common/footer");
                    redirect('account','refresh');
                } else {
                    $this->session->set_flashdata('message', 'Something goes wrong, please try again');
                    redirect('user', 'refresh');
                }
            } else {
                $security_ques_arr = $this->user_model->get_Question();
                $val["secqus"] = $security_ques_arr['security_question'];
                $val["secqus_id"] = $security_ques_arr['question_id'];
                $this->session->set_flashdata('message', 'Not selected');
                $this->load->view("common/header");
                $this->load->view("user/securityquestions_view", $val);
                $this->load->view("common/footer");
            }
        }
    }
    public function forgot_password_vals() {
        if ($this->input->post("forgot")) {
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_email_check');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('user/forgot_password_view');
            } else {
                $email = $this->input->post("forgot");
                $this->email->from('gupta.mayank.765@gmail.com', "Admin Team");
                $this->email->to($email);
                $this->email->subject("Forgot Email");
                $this->email->message("Mail sent test message...");
                $data['message'] = "Sorry Unable to send email...";
                if ($this->email->send()) {
                    $data['message'] = "Mail sent...";
                }
            }
        }
    }

    public function email_check($str) {
        $query = $this->db->get_where('user', array('email' => $str), 1);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            $this->form_validation->set_message('email_check', 'This Email does not exist.');
            return false;
        }
    }

    public function chkonetimecode($str) {
        $query = $this->db->get_where('login', array('login_otp' => $str), 1);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            $this->form_validation->set_message('chkonetimecode', 'Code does not exist.');
            return false;
        }
    }

    public function confirm_security() {

        if ($this->input->post('submit_ques')) {
            $val = array();
            //$this->form_validation->set_rules('user_secrity', 'Security Questions', 'numeric|trim|required');
            $this->form_validation->set_rules('user_answer', 'Answer', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
                $questionid = $this->input->post("sec_ques_id");
                $answer = $this->input->post("user_answer");
                $date = date('Y-m-d h:i:s', time());
                $sec_ques_session = $this->session->logindata('sec_ques');
                $user_id = $sec_ques_session['user_id'];
                $randormcode = rand(1000, 10000);
                $arr = array(
                    'security_question_id' => $questionid,
                    'security_question_ans' => $answer,
                    'updated_at' => $date,
                    'verification_code' => $randormcode
                );
                //$code = $this->encrypt->encode($randormcode); 

                $this->user_model->update_data("user", $arr, "user_id", $user_id);
                $this->load->view("common/header");
                $this->load->view("user/verifyemail");
                $this->load->view("common/footer");
            } else {
                $security_ques_arr = $this->user_model->get_Question();
                $val["secqus"] = $security_ques_arr['security_question'];
                $val["secqus_id"] = $security_ques_arr['question_id'];
                $this->session->set_flashdata('message', 'Not selected');

                $this->load->view("common/header");
                $this->load->view("user/securityquestions_view", $val);
                $this->load->view("common/footer");
            }
        }
    }

    public function verifyemail($code) {
        $val = array();
        if (isset($code) && !empty($code)) {
            //$code = $this->encrypt->decode($code);
            $status = false;
            $query = $this->db->get_where('user', array('verification_code' => $code), 1);
            $sqlresult = $query->result();
            if ($query->num_rows() == 1) {
                $status = true;
                $user_id = $sqlresult[0]->user_id;
            } else {
                $status = false;
            }
            if ($status != false) {
                $date = date('Y-m-d h:i:s', time());
                $arr = array
                    (
                    'is_verified' => 1,
                    'updated_at' => $date,
                    'status' => 1
                );
                $this->user_model->update_data("user", $arr, "user_id", $user_id);
                $val["msg"] = "You have successfully registerd, Please <a href='" . site_url('user') . "'>click here</a> for login";
                $this->load->view("common/header");
                $this->load->view("user/verifyemail", $val);
                $this->load->view("common/footer");
            } else {
                $val["msg"] = "Not valid codes";
                $this->load->view("common/header");
                $this->load->view("user/verifyemail", $val);
                $this->load->view("common/footer");
            }
        }
    }

    /**
     * used to logout by unset and destroy all session variables
     *
     */
    public function logout() {
        $this->session->unset_userdata('user_in');
        $this->session->unset_userdata('logged_in');

        // session_destroy();
        $this->session->sess_destroy();
        $redrct = site_url('user');
        redirect($redrct, 'refresh');
    }

}
