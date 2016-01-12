<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
       function __construct() 
		{
			parent::__construct();
            $this->load->model('user_model');
		}

	public function index()
	{
		$this->load->view('user_view/login_view');	
	}
	public function signup()
	{
	    $this->load->view('user_view/signup_view');
	}
	public function forgatepassword()
	{
	    $this->load->view('user_view/forgatepwassord_view');
	}
	
	public function signupVals()
	{ 
	   $val = array();
	   if($this->input->post("aceepterms")) {
	       $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
		   $this->form_validation->set_rules('user_firstname', 'First Name', 'trim|required');
		   $this->form_validation->set_rules('user_lastname', 'Last Name', 'trim|required');
		   $this->form_validation->set_rules('user_email', 'Email', 'trim|required');
		   $this->form_validation->set_rules('user_password', 'Password', 'required');
		   $this->form_validation->set_rules('user_cnpassword', 'Password Confirmation', 'required|matches[user_password]');
		   if ($this->form_validation->run() == TRUE) 
		   {
		           $input = $this->input->post();
				   $user_name     = $input["user_name"];
				   $user_firstname = $input["user_firstname"];
				   $user_lastname = $input["user_lastname"];
				   $user_email    = $input["user_email"];
				   $user_password = md5($input["user_password"]);
				   $date = date('Y-m-d h:i:s', time());
				   $inputData = array(
						'user_name'=>$user_name,
						'first_name'=>$user_firstname,
						'last_name'=>$user_lastname,
						'email'=>$user_email,
						'password'=>$user_password,
						'created_at'=>$date
					); 
					$data = $this->user_model->insertData($inputData, 'user');
					$val["secqus"] = $this->user_model->get_Question();
				    if($data) {
					    $userdata = array('user_id'=>$data);
					    $this->user_model->create_user_session($userdata);
					    $this->load->view("user_view/securityquestions_view",$val);
					}	
		   }
		   else 
		   {
				$this->session->set_flashdata('message', 'Please give me all informations.');
				redirect('user/signup/');
		   }
		   
	   } else {
	       $this->session->set_flashdata('message', 'Please accept terms and conditions.');
		   redirect('user/signup/');
	   }
	}
	
	public function loginVals()
	{
	     if($this->input->post('login'))
		    {
			   $input = $this->input->post();
			   $user_email = $input["user_email"];
			   //$user_id =  $this->encrypt->encode($user_id);
			   $user_pass = md5($input['user_pass']);
			   $this->form_validation->set_rules('user_email', 'Email', 'trim|required');
		       $this->form_validation->set_rules('user_pass', 'password', 'trim|required');
		       $this->form_validation->set_error_delimiters('<em>','</em>');
			   if($this->form_validation->run())
			   {
			       $arr = array("user_id");
			       $cond = "email='".$user_email."' and password='".$user_pass."'";
			       $data = $this->user_model->getData("user",$arr,$cond);
			       $seluserId = $data["0"]["user_id"];
				   $userdata = array('user_id'=>$seluserId,"user_email"=>$user_email);
				   if($seluserId != "")
					{
					   $date = date('Y-m-d h:i:s', time());
					   $ip = $_SERVER['REMOTE_ADDR'];
					   $randormcode = rand(1000,10000);
					    $inputData = array(
						    'user_id'=>$seluserId,
						    'last_login'=>$date,
						    'ip_address'=>$ip,
							'login_sendcode'=>$randormcode
					     ); 
						  $this->user_model->create_user_session($userdata);
					      $data = $this->user_model->insertData($inputData, 'login'); 
						  if($data) {
						     $this->load->view("user_view/onetimecode_view"); 
						  }
					}
					else
					{
						$this->session->set_flashdata('message', 'Incorrect Details.');
						redirect('user/index/');
					}
			   }
			   else 
			   {
			        $this->session->set_flashdata('message', 'A user does not exist for the username specified.');
					redirect('user/index/');
			   }
		    }	   
	}
	
	public function forgatepassword_vals()
	{
	   if($this->input->post("forgate")) {
	       $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_email_check');
		    if ($this->form_validation->run() == FALSE)
            {
                  $this->load->view('user_view/forgatepwassord_view');
            }
            else
            {         $email = $this->input->post("forgate");
                      $this->email->from('gupta.mayank.765@gmail.com', "Admin Team");
					  $this->email->to($email);
					  $this->email->subject("Forgate Mail");
					  $this->email->message("Mail sent test message...");
					  $data['message'] = "Sorry Unable to send email..."; 
					  if($this->email->send()){     
					   $data['message'] = "Mail sent...";   
					  } 
            }
		}   
		   
    }	
	 public function email_check($str)
     {
		 $query = $this->db->get_where('user', array('email' => $str), 1);
		  if ($query->num_rows()== 1)
		  {
				 return true;
		  }
		  else
		  {        
				   $this->form_validation->set_message('email_check', 'This Email does not exist.');
                   return false;
		  } 
     }
	 public function chksecurity()
	 {
	     if($this->input->post('submit_code'))
		  {
		       $val = array();
		       $this->form_validation->set_rules('user_validcode', 'Valid Code', 'numeric|trim|required|callback_chkonetimecode');
			   if ($this->form_validation->run() == FALSE)
               {
                  $this->load->view("user_view/onetimecode_view");
               }
			   else
			   {
			      $val["secqus"] = $this->user_model->get_Question();
			      $this->load->view("user_view/securityquestions_view",$val);
			   }
		  }
	 }
	 public function chkonetimecode($str)
     {
		  $query = $this->db->get_where('login', array('login_sendcode' => $str), 1);
		  if ($query->num_rows()== 1)
		  {
				 return true;
		  }
		  else
		  {        
				   $this->form_validation->set_message('chkonetimecode', 'Code does not exist.');
                   return false;
		  } 
     }
	 public function getSecrityQuestion()
	 { 
	      if($this->input->post('submit_ques'))
		  {
		      $val = array();
		      $this->form_validation->set_rules('user_secrity', 'Security Questions', 'numeric|trim|required');
			  $this->form_validation->set_rules('user_answer', 'Answer', 'trim|required');
			  if ($this->form_validation->run() != FALSE)
              {
			     $questionid = $this->input->post("user_secrity");
				 $answer     = $this->input->post("user_answer");
				 $date = date('Y-m-d h:i:s', time());
				 $login_session = $this->session->userdata('logged_in');
				 $user_id = $login_session['user_id']; 
				 $randormcode = rand(1000,10000);
				 $arr =  array(
						  'security_question_id' => $questionid,
						  'security_question_ans'  => $answer,
						  'updated_at'=>$date,
						  'verification_code'=>$randormcode
				       );
			     //$code = $this->encrypt->encode($randormcode); 		   
				 $this->user_model->update_data("user", $arr, "user_id",$user_id);
				 $this->load->view("user_view/verifyemail");
			  }
			  else
			  {
			      $val["secqus"] = $this->user_model->get_Question();
			      $this->session->set_flashdata('message', 'Not selected');
			      $this->load->view("user_view/securityquestions_view",$val);
			  }
		  } 
	 }
	 public function verifyemail($code)
	 { 
	    $val = array();
	    if(isset($code) && !empty($code))
		{
		      //$code = $this->encrypt->decode($code);
		      $status = false;
		      $query = $this->db->get_where('user', array('verification_code' => $code), 1);
		      $sqlresult =  $query->result();
			  if ($query->num_rows()== 1)
			  {
					   $status = true;
					   $user_id = $sqlresult[0]->user_id;  
			  }
			  else
			  {        
					   $status = false;
			  } 
		     if( $status != false)
			 {
			      $date = date('Y-m-d h:i:s', time());
		          $arr =  array
		           (
						'is_verified' => 1,
						'updated_at'=>$date,
						'status'=>1
				   );
				   $this->user_model->update_data("user", $arr, "user_id",$user_id);
				   $val["msg"] = "You have successfully registerd";
				    $this->load->view("user_view/verifyemail",$val);
			 }
			 else
			 {
			      $val["msg"] = "Not valid codes";
				  $this->load->view("user_view/verifyemail",$val);
			 }
		}		 
	 }
}