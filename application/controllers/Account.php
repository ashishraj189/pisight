<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
        // Your own constructor code
        
        $logged_in = $this->session->userdata('logged_in');
        //print_r($logged_in);
        //die('hhhhh');
        if(empty($logged_in)){
            redirect('user', 'refresh');
        }
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('account/dashboard');
        $this->load->view('common/footer');
    }

    public function add_account() {
        $this->load->view('common/header');
        $this->load->view('account/add_account');
        $this->load->view('common/footer');
    }

}
