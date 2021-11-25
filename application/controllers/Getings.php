<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getings extends CI_Controller {

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
		sleep(1.5);//lol
		$a = $this->Crudcentral->getAllIngredients($this->input->get_post('i', TRUE));
		if (!isset($a['code'])) {
			echo '<ul class="ing-list">';
			foreach($a as $ing) {
					echo '<li onClick="selectIng(' . "'" . $ing["ingName"] . "'" . ', ' . "'" . $this->input->get_post('el', TRUE) .  "'" . ');">' . $ing["ingName"] . '</li>';
				
			}
			
			echo '</ul>';
		} else {
			
		}
		
	}
}
