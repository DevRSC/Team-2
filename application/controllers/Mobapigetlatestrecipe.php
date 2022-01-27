<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobapigetlatestrecipe extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Manila');
        $this->load->library('session');
        //$this->load->helper('url');
        //$this->load->helper('cookie');
    } 


	public function mproc($usind) {

		$dataa1 = $this->Crudcentral->getLatestRecipe();
		$dataa2 = $this->Crudcentral->getLatestComments($usind);
		$dataa3 = $this->Crudcentral->getLatestMessageIndex($usind);
		$a = array();
		array_push($a, array('headerData' => "good",'dataLatestRecipe' =>  $dataa1, 'dataLatestComments' =>  $dataa2, 'dataLatestMessageIndex' =>  $dataa3));
		echo json_encode($a);
	}
	
	public function index()
	{
		//getting post, and then get requests guide
		// if ($this->input->server('REQUEST_METHOD') == 'POST'){
			// $this->input->get_post('data', TRUE);
		// }
		//foreach($this->input->post() as $key => $val) {
		// 	echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
		// }
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$us = $this->input->get_post('us', TRUE);
			$ps = $this->input->get_post('ps', TRUE);
			$usindex = $this->Crudcentral->getUserIndex($us,$ps);
			if ($usindex != "nuull") {
				$this->mproc($usindex);
			}
		}
		
	}
}
