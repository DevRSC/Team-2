<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmsg extends CI_Controller {

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
		sleep(1);//lol
		if (empty($_SESSION['userid'])) { 
			//redirect('Login'); 
		} else {
			$comm = $this->input->get_post('comm', TRUE);
			$indexx = $this->input->get_post('ind', TRUE);

			if (strlen($comm) >= 1 && strlen($comm) <=500 && !ctype_space($comm)) {
				$a = $this->Crudcentral->sendMessage($indexx, $comm);
			}
		
		}
		
	}
}
