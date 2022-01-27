<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        //$this->load->helper('url');
        //$this->load->helper('cookie');
    } 
	public function do_upload() {
			$config['upload_path']          = './static/images/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;
			$config['max_width']            = 1920;
			$config['max_height']           = 1080;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('filee')) {
					$error = array('error' => $this->upload->display_errors());
					return "errorrrr";
			} else {
					$data = array('upload_data' => $this->upload->data());
					return $data['upload_data']['file_name'];
			}
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
		if (empty($_SESSION['userid'])) {
			redirect('Login');
		} else {
			if ($this->input->server('REQUEST_METHOD') == 'POST'){

				$accfirstname = $this->input->get_post('accfirstname', TRUE);
				$acclastname = $this->input->get_post('acclastname', TRUE);
				$accdate = $this->input->get_post('accdate', TRUE);
				
				//data validation, borrowed from Register controller 
				$goods = 1;
				$errors = "ATTENTION: ";
				if ( (strlen($acclastname) <= 1 || strlen($acclastname) > 30) || (strlen($accfirstname) <= 1 || strlen($accfirstname) > 30)) {
					$errors = $errors . " \\n " . "Check your user information!";
					$goods = 0;
				}
				date_default_timezone_set('Asia/Manila');
				$date1 = strtotime(date('Y-m-d H:i:s')); 
				$date2 = strtotime($accdate); 
				$age = floor( (abs($date1 - $date2)) / (365*60*60*24) );
				if ($date2 >= $date1) {
					$errors = $errors . " \\n " . "Invalid birthdate! Please try again!";
					$goods = 0;
				}
				if (intval($age) < 18) {
					$errors = $errors . " \\n " . "18 years old and above are only allowed!";
					$goods = 0;
				}
				$iimg = $this->do_upload();
				if ($iimg == "errorrrr") {
					$iimg = "null";
				}
				if ($goods == 1) {
					//all data validation passed
					$mainres = $this->Crudcentral->updateUserBasic($acclastname, $accfirstname, $accdate, $age, $iimg);
					echo $iimg;
				} else {
					//no bro
					echo $errors;
				}
			
			} else {
				$data['userProfile'] = $this->Crudcentral->getUser();
				$data['userrecipes'] = $this->Crudcentral->getAllRecipes_summary_currentUser();
				$this->load->view('myaccountpage', $data); 
			}
			
		}
		
		
	}
}
