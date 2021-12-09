<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toggupv extends CI_Controller {

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
		//sleep(1.5);//lol
		$ind = $this->input->get_post('ind', TRUE);
		echo json_encode($this->Crudcentral->toggleCommentUpvote($ind));
		
		
	}
}
