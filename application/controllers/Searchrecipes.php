<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searchrecipes extends CI_Controller {

	public function __construct(){
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

		//$data['suggested'] = $this->Crudcentral->getAllRecipes_summary();
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$inglist = $this->Crudcentral->getAllIngredientsLiterally();
			$finalinglist = array();
			foreach($this->input->post() as $key => $val) {
				if (strpos($key, '_ing') !== false) {
					foreach ($inglist as $ing) {
						if ($ing['ingName'] == $val) {
							$finalinglist[] = $ing;
							break;
						}
					}
				}
			}
			$data['suggested'] = $this->Crudcentral->getSuggestedRecipes($finalinglist);
			$data['prevings'] = $finalinglist;
			$this->load->view('searchrecipespage',$data);
			
		} else {
			$this->load->view('searchrecipespage');
		}
		
	}
}
