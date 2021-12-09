<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postrecipe extends CI_Controller {

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
			$data['categories'] = $this->Crudcentral->getAllCategories();
			$this->load->view('postrecipepage', $data); 
		}
		
		
	}
}
