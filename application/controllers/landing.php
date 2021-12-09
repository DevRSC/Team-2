<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

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
		$data['cats'] = $this->Crudcentral->getAllCategories();
		$data['dashdata'] = $this->Crudcentral->getDashboardCounts();
		$data['randrecipe'] = $this->Crudcentral->getRandomRecipe();
		$data['sixrecipes'] = $this->Crudcentral->getAllRecipes_summary("all",6);
		$data['latestmember'] = $this->Crudcentral->getUser($this->Crudcentral->getLatestUser()[0]['userIndex']);
		$this->load->view('landingpage', $data);
	}
}
