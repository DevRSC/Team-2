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
			$errors = "ATTENTION: ";
			if ($pass != $repeatpass) {
				$errors = $errors . " \\n Your passwords doesn't match! Please try again.";
				$goods = 0;
			}
			if ( (strlen($lastname) <= 1 || strlen($lastname) > 30) || (strlen($firstname) <= 1 || strlen($firstname) > 30) || (strlen($email) <= 5 || strlen($email) > 30) || (strlen($contact) < 10 || strlen($contact) > 11) || (strlen($add) <= 5 || strlen($add) > 100)) {
				$errors = $errors . " \\n " . "Check your user information!";
				$goods = 0;
			}
			date_default_timezone_set('Asia/Manila');
			$date1 = strtotime(date('Y-m-d H:i:s')); 
			$date2 = strtotime($birth); 
			$age = floor( (abs($date1 - $date2)) / (365*60*60*24) );
			if ($date2 >= $date1) {
				$errors = $errors . " \\n " . "Invalid birthdate! Please try again!";
				$goods = 0;
			}
			// if (substr( $contact, 0, 2 ) === "09") {
				// $errors = $errors . " \\n" . "Contact phone number country code is invalid!";
				// $goods = 0;
			// }
			// if (preg_match('~[0-9]+~', $contact)) {
				// $errors = $errors . " \\n " . "Invalid contact phone number! Please try again!";
				// $goods = 0;
			// }
			if (( $age < 18 )   ) {
				$errors = $errors . " \\n " . "Only 18 years old and above are allowed!";
				$goods = 0;
			}
			if (strlen($username) < 8 || ctype_space($username)) {
				$errors = $errors . " \\n " . "Username must be 8 characters and above";
				$goods = 0;
			}
			if (strlen($username) > 20 || ctype_space($username)) {
				$errors = $errors . " \\n " . "Username must be less than 20 characters in length";
				$goods = 0;
			}
			if (strlen($pass) < 8 || ctype_space($pass)) {
				$errors = $errors . " \\n " . "Password must be 8 characters and above";
				$goods = 0;
			} 
			if (strlen($pass) > 20 || ctype_space($pass)) {
				$errors = $errors . " \\n " . "Password must only be 20 characters in length";
				$goods = 0;
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors = $errors . " \\n " . "Please enter a valid email!";
				$goods = 0;
			}
			if ($goods == 1) {
				//add Email OTP here bro
				$otp = $this->Crudcentral->genrNum();
				$this->session->set_userdata('registerdata_mx', $lastname . "[][]" . $firstname . "[][]" . $age . "[][]" . $birth . "[][]" . $email . "[][]" . $contact . "[][]" . $add . "[][]" . $username . "[][]" . $pass);
				$this->session->set_userdata('registerdata_mx_otp', $otp);
				$this->Crudcentral->sendMail("Continue your registration to Meals for Makers!", 
											"<p>Howdy, " . $firstname . " " . $lastname . "! To continue to your registration and share your awesome recipes, please take note of this One-Time Pin (OTP) and enter it on the registration screen.</p><br><br><h2>OTP: " . $otp . "</h2><br><br><p>Thank you!</p>", 
											$email);
				//$result = $this->Crudcentral->registerUser($lastname, $firstname, $age, $birth, $email, $contact, $add, "null", $username, $pass);
				// if (intval($result['code']) == 1) {
					//$this->session->set_userdata('registerlog',"Registered successfully! Please log in to continue.");
					redirect('Verifyotp');
					//$this->load->view('loginpage');
				// }
				// else {
					// $this->session->set_userdata('registerlog',$result['msg']);
					// redirect('Login');
					$this->load->view('loginpage');
				// }
				
			} else {
				$this->session->set_userdata('registerlog', $errors);
				$this->load->view('registerpage');
			}
		} else {
			$this->load->view('registerpage');
		}
		
	}
}
