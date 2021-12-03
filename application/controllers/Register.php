<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        //$this->load->helper('url');
        //$this->load->helper('cookie');
    } 

	public function index()
	{
		
		//getting post, and then get requests guide
		// if ($this->input->server('REQUEST_METHOD') == 'POST'){
		// 	//$this->input->get_post('data', TRUE);
		// }
		//foreach($this->input->post() as $key => $val) {
		// 	echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
		// }

		//$data['userdata'] = $this->Crudcentral->getUsers();

		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$lastname = $this->input->get_post('lastname', TRUE);
			$firstname = $this->input->get_post('firstname', TRUE);
			$age = $this->input->get_post('age', TRUE);
			$birth = $this->input->get_post('birth', TRUE);
			$email = $this->input->get_post('email', TRUE);
			$contact = $this->input->get_post('contact', TRUE);
			$add = $this->input->get_post('add', TRUE);
			$username = $this->input->get_post('username', TRUE);
			$pass = $this->input->get_post('pass', TRUE);
			$repeatpass = $this->input->get_post('repeatpass', TRUE);
			$goods = 0;
			if ($pass != $repeatpass) {
				$this->session->set_userdata('registerlog',"Yow, your passwords doesn't match! Please try again.");
				$this->load->view('registerpage');
			} else {
				$goods = 1;
			}
			if (strlen($lastname) <= 0 || strlen($firstname) <= 0 || strlen($email) <= 0 || strlen($contact) <= 0 || strlen($add) <= 0) {
				$this->session->set_userdata('registerlog',"Check your form data!");
				$this->load->view('registerpage');
			} else {
				$goods = 1;
			}
			date_default_timezone_set('Asia/Manila');
			$date1 = strtotime(date('Y-m-d H:i:s')); 
			$date2 = strtotime($birth); 
			if (intval($age) < 18 || ( floor( (abs($date1 - $date2)) / (365*60*60*24) ) < 18 )   ) {
				$this->session->set_userdata('registerlog',"Only 18 years old and above are allowed!");
				$this->load->view('registerpage');
			} else {
				$goods = 1;
			}
			if (strlen($username) < 8) {
				$this->session->set_userdata('registerlog',"Username must be 8 characters and above");
				$this->load->view('registerpage');
			} else {
				$goods = 1;
			}
			if (strlen($pass) < 8) {
				$this->session->set_userdata('registerlog',"Password must be 8 characters and above");
				$this->load->view('registerpage');
			} else {
				$goods = 1;
			}
			if ($goods == 1) {
				//add Email OTP here bro
				$result = $this->Crudcentral->registerUser($lastname, $firstname, $age, $birth, $email, $contact, $add, "null", $username, $pass);
				if (intval($result['code']) == 1) {
					$this->session->set_userdata('registerlog',"Registered successfully! Please log in to continue.");
					redirect('Login');
					//$this->load->view('loginpage');
				} else {
					$this->session->set_userdata('registerlog',"Registration failed! Please try again.");
					redirect('Login');
					//$this->load->view('loginpage');
				}
				
			}
		} else {
			$this->load->view('registerpage');
		}
		
	}
}
