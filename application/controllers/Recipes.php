<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipes extends CI_Controller {

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
		
		//foreach($this->input->post() as $key => $val) {
		// 	echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
		// }
		
		$cat = "all";
		$a = $this->input->get('cat', TRUE);
		if (isset($a)) {
			$cat = $a;
		}
		$data['recipes'] = $this->Crudcentral->getAllRecipes_summary($cat);
		$data['categories'] = $this->Crudcentral->getAllCategories();
		$data['currentget'] = $cat;
		$this->load->view('recipespage', $data);
		
	}
}
