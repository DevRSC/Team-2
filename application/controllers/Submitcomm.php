<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submitcomm extends CI_Controller {

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
		$comm = $this->input->get_post('comm', TRUE);
		$indexx = $this->input->get_post('ind', TRUE);

		$a = $this->Crudcentral->insertComment($indexx, "-1", $comm);
		if (intval($a['code']) == 1) {
			echo $a['geniusdebug'];
		} else {
			
		}
		
	}
}
