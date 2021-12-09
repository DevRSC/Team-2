<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
			$password = $this->input->get_post('password', TRUE);
			$res = $this->Crudcentral->authenticateUser($username, $password);
			if (intval($res['code']) == 1) {
				redirect('/');
			} else {
				$this->session->set_userdata('registerlog',"User not found!");
				$this->load->view('loginpage');
			}
			
		} else {
			$this->load->view('loginpage');
		}
	}
}
