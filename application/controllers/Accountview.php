<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountview extends CI_Controller {

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
		if (empty($_SESSION['userid'])) {
			redirect('Login');
		} else {
			$data['userProfile'] = $this->Crudcentral->getUser($this->input->get('a', TRUE));
			$data['userrecipes'] = $this->Crudcentral->getAllRecipes_summary_currentUser($this->input->get('a', TRUE));

			$this->load->view('viewaccountpage', $data); 
		}
		
		
	}
}
