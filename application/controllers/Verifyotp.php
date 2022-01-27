<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifyotp extends CI_Controller {

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
		$registerdata = $_SESSION['registerdata_mx'];
		$otp = $_SESSION['registerdata_mx_otp'];
		if ($this->input->server('REQUEST_METHOD') == 'POST' && strlen($registerdata) >= 0 && strlen($otp) == 6){
			$userotp = $this->input->get_post('userotp', TRUE);
			$registerdatamx = explode("[][]",$registerdata);
			$lastname = $registerdatamx[0];
			$firstname = $registerdatamx[1];
			$age = $registerdatamx[2];
			$birth = $registerdatamx[3];
			$email = $registerdatamx[4];
			$contact = $registerdatamx[5];
			$add = $registerdatamx[6];
			$username = $registerdatamx[7];
			$pass = $registerdatamx[8];
			if ($userotp == $otp) {
				$result = $this->Crudcentral->registerUser($lastname, $firstname, $age, $birth, $email, $contact, $add, "null", $username, $pass);
				$this->session->unset_userdata('registerdata_mx');
				$this->session->unset_userdata('registerdata_mx_otp');
				if (intval($result['code']) == 1) {
					$this->session->set_userdata('registerlog',"Registered successfully! Please log in to continue.");
					$this->load->view('loginpage');
				} else {
					$this->session->set_userdata('registerlog',$result['msg']);
					$this->load->view('loginpage');
				}
			} else {
				$this->session->set_userdata('verifyotplog', "Invalid OTP! Please try again.");
				$this->load->view('verifyotppage');
			}
		} else {
			if (strlen($registerdata) >= 0 && strlen($otp) == 6){
				$this->load->view('verifyotppage');
			}
		}		
	}
}
