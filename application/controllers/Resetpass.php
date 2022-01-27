<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpass extends CI_Controller {

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
		$userindex = $_SESSION['forgotpass_userindex'];
		$forgotpass_otp = $_SESSION['forgotpass_otp'];
		if ($this->input->server('REQUEST_METHOD') == 'POST' && strlen($userindex) > 0 && strlen($forgotpass_otp) > 0) {
			$userotp = $this->input->get_post('userotp', TRUE);
			$firstpass = $this->input->get_post('userpassnorm', TRUE);
			$secondpass = $this->input->get_post('userpasstwo', TRUE);
			if ($userotp == $forgotpass_otp) {
				if ($firstpass == $secondpass) {
					$this->Crudcentral->updateUserPass($userindex, $firstpass);
					$this->session->unset_userdata('forgotpass_userindex');
					$this->session->unset_userdata('forgotpass_otp');
					$this->session->set_userdata('registerlog',"Your password has been reset!");
					redirect('Login');
					$this->load->view('resetpasspage');
				} else {
					$this->session->set_userdata('resetpasslog',"Wrong OTP, please try again.");
					$this->load->view('resetpasspage');
				}
			
				
			} else {
				$this->session->set_userdata('resetpasslog',"Wrong OTP, please try again.");
				$this->load->view('resetpasspage');
			}
			
		} else {
			$this->load->view('loginpage');
		}
	}
}
