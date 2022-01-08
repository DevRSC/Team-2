<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpass extends CI_Controller {

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
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$username = $this->input->get_post('username', TRUE);
			$res = $this->Crudcentral->getUserByNotIndex($username)[0];
			if (!isset($res['code'])) {
				$otp = $this->Crudcentral->genrNum();
				$this->Crudcentral->sendMail("Password reset | Meals for Makers!", 
											"<p>Howdy, " . $res['firstname'] . " " . $res['lastname'] . "! To continue to reset your password, please take note of this One-Time Pin (OTP) and enter it on the password reset page.</p><br><br><h2>OTP: " . $otp . "</h2><br><br><p>Thank you!</p>", 
											$res['email']);
				$this->session->set_userdata('forgotpass_userindex',$res['userIndex']);
				$this->session->set_userdata('forgotpass_otp',$otp);
				$this->load->view('resetpasspage');
			} else {
				$this->session->set_userdata('forgotpasslog',"User not found!");
				$this->load->view('forgotpasspage');
			}
			
		} else {
			$this->load->view('forgotpasspage');
		}
	}
}
