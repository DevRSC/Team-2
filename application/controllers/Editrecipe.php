<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editrecipe extends CI_Controller {

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
			$mm = $this->input->get('r', TRUE);
			$aaa = $this->Crudcentral->getRecipe($mm);
			if ($_SESSION['userid'] == $aaa[0]['userIndex']) {
				$aaa = $this->Crudcentral->getRecipe($mm);
				$data['currentRecipe'] = $aaa;
				$data['categories'] = $this->Crudcentral->getAllCategories();
				$data['currentRecipeIngredients'] = $this->Crudcentral->getIngredients($mm);
				$this->load->view('postrecipepage', $data); 
			} else {
				echo "WHAT ARE YOU TRYING TO DO?! ARE U TRYING TO HACKXZ ME?!";
			}
			
		}
		
		
	}
}
