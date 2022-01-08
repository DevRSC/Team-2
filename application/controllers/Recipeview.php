<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipeview extends CI_Controller {

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
		if (empty($_SESSION['userid'])) { 
			redirect('Login'); 
		} else {
			
			$aaa = $this->Crudcentral->getRecipeByName($this->input->get('r', TRUE));
			$data['currentRecipe'] = $aaa;
			$data['currentRecipeIngredients'] = $this->Crudcentral->getIngredients($data['currentRecipe'][0]['recipeIndex']);
			$data['currentComments'] = $this->Crudcentral->getAllComments($data['currentRecipe'][0]['recipeIndex']);
			if (isset($aaa['code'])) {
				redirect('Recipes');
			} else {
				$this->load->view('viewrecipepage', $data);
			}
			
		}
	
		
	}
}
