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
			//$age = $this->input->get_post('age', TRUE);
			$birth = $this->input->get_post('birth', TRUE);
			$email = $this->input->get_post('email', TRUE);
			$contact = $this->input->get_post('contact', TRUE);
			$add = $this->input->get_post('add', TRUE);
			$username = $this->input->get_post('username', TRUE);
			$pass = $this->input->get_post('pass', TRUE);
			$repeatpass = $this->input->get_post('repeatpass', TRUE);
			$goods = 1;
			$errors = "";
			if ($pass != $repeatpass) {
				$errors = $errors . " & " . "Yow, your passwords doesn't match! Please try again.";
				$goods = 0;
			}
			if ( (strlen($lastname) <= 5 && strlen($lastname) > 30) || (strlen($firstname) <= 5 && strlen($firstname) > 30) || (strlen($email) <= 5 && strlen($email) > 30) || (strlen($contact) < 10 && strlen($contact) > 11) || (strlen($add) <= 5 && strlen($add) > 100)) {
				$errors = $errors . " & " . "Check your form data!";
				$goods = 0;
			}
			date_default_timezone_set('Asia/Manila');
			$date1 = strtotime(date('Y-m-d H:i:s')); 
			$date2 = strtotime($birth); 
			$age = floor( (abs($date1 - $date2)) / (365*60*60*24) );
			if (new DateTime($date2) >= new DateTime($date1)) {
				$errors = $errors . " & " . "Invalid birthdate! Please try again!";
				$goods = 0;
			}
			if (substr( $contact, 0, 2 ) === "09") {
				$errors = $errors . " & " . "Contact phone number country code is invalid!";
				$goods = 0;
			}
			if (preg_match('~[0-9]+~', $contact)) {
				$errors = $errors . " & " . "Invalid contact phone number! Please try again!";
				$goods = 0;
			}
			if (( $age < 18 )   ) {
				$errors = $errors . " & " . "Only 18 years old and above are allowed!";
				$goods = 0;
			}
			if (strlen($username) < 8) {
				$errors = $errors . " & " . "Username must be 8 characters and above";
				$goods = 0;
			}
			if (strlen($username) > 20) {
				$errors = $errors . " & " . "Username must only be 20 characters in length";
				$goods = 0;
			}
			if (strlen($pass) < 8) {
				$errors = $errors . " & " . "Password must be 8 characters and above";
				$goods = 0;
			} 
			if (strlen($pass) > 20) {
				$errors = $errors . " & " . "Password must only be 20 characters in length";
				$goods = 0;
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors = $errors . " & " . "Please enter a valid email!";
				$goods = 0;
			}
			if ($goods == 1) {
				//add Email OTP here bro
				$result = $this->Crudcentral->registerUser($lastname, $firstname, $age, $birth, $email, $contact, $add, "null", $username, $pass);
				if (intval($result['code']) == 1) {
					$this->session->set_userdata('registerlog',"Registered successfully! Please log in to continue.");
					redirect('Login');
					//$this->load->view('loginpage');
				} else {
					$this->session->set_userdata('registerlog',$result['msg']);
					redirect('Login');
					//$this->load->view('loginpage');
				}
				
			} else {
				$this->session->set_userdata('registerlog', $errors);
				$this->load->view('registerpage');
			}
		} else {
			$this->load->view('registerpage');
		}
		
	}
}
