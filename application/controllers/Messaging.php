<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messaging extends CI_Controller {

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

		$data['msgsummary'] = $this->Crudcentral->readMessages("mah name chef",2);
		$a = array();
		foreach ($data['msgsummary'] as $mm) {
			array_push($a, array('ind' => $mm['userIndexTo'], 'nm' => $mm['mainname'], 'data' =>  $this->Crudcentral->readMessages($mm['userIndexTo'],0)));
		}
		$data['allmsgdata'] = $a;
		if (empty($_SESSION['userid'])) { 
			redirect('Login');
		} else {
			$this->load->view('msgpage', $data);
		}
		
	}
}
